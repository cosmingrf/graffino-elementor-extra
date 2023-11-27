<?php

if (! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}



final class Plugin
{

    const VERSION = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.14.0';
    const MINIMUM_PHP_VERSION = '7.0';
    private static $_instance = null;


    public static function instance()
    {

        if (is_null(self::$_instance) ) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    public function __construct()
    {

        if ($this->is_compatible() ) {
            add_action('elementor/init', [ $this, 'init' ]);
        }

    }

    public function is_compatible()
    {

        // Check if Elementor installed and activated
        if (! did_action('elementor/loaded') ) {
            add_action('admin_notices', [ $this, 'admin_notice_missing_main_plugin' ]);
            return false;
        }

        // Check for required Elementor version
        if (! version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=') ) {
            add_action('admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ]);
            return false;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<') ) {
            add_action('admin_notices', [ $this, 'admin_notice_minimum_php_version' ]);
            return false;
        }

        return true;

    }

    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate']) ) { unset($_GET['activate']);
        }

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'graffino-elementor-extra'),
            '<strong>' . esc_html__('Graffino Elementor Extra', 'graffino-elementor-extra') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'graffino-elementor-extra') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }


    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate']) ) { unset($_GET['activate']);
        }

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'graffino-elementor-extra'),
            '<strong>' . esc_html__('Graffino Elementor Extra', 'graffino-elementor-extra') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'graffino-elementor-extra') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }


    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate']) ) { unset($_GET['activate']);
        }

        $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'graffino-elementor-extra'),
            '<strong>' . esc_html__('Graffino Elementor Extra', 'graffino-elementor-extra') . '</strong>',
            '<strong>' . esc_html__('PHP', 'graffino-elementor-extra') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }


    public function init()
    {

        add_action('elementor/widgets/register', [ $this, 'register_widgets' ]);
        add_action( 'elementor/controls/register', [ $this, 'register_controls' ] );

        add_action('elementor/elements/categories_registered', function () {
            $elementsManager = \Elementor\Plugin::instance()->elements_manager;
            $elementsManager->add_category(
                'graffino_elementor_extra',
                array(
                    'title' => 'Graffino Elementor Extra',
                    'icon' => 'fonts',
                ));
        });
    }


    public function register_widgets( $widgets_manager )
    {   
        wp_enqueue_script('slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);
        wp_enqueue_style('slick-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
        wp_enqueue_style('slick-carousel-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

        wp_enqueue_script('custom-carousel', plugin_dir_url(__DIR__) . '/includes/assets/js/custom-carousel.js', array('jquery'), '1.0.0', true);
        wp_enqueue_style('custom-carousel-css', plugin_dir_url(__DIR__) . '/includes/assets/css/custom-carousel.css');
        
        require_once (__DIR__ . '/widgets/custom-carousel-widget.php');
        $widgets_manager->register(new Custom_Carousel_Widget());
        
    }

 
	public function register_controls( $controls_manager ) {
		require_once( __DIR__ . '/controls/custom-carousel-control.php' );
		$controls_manager->register( new Custom_Carousel_Control() );
	}
}

Plugin::instance();
