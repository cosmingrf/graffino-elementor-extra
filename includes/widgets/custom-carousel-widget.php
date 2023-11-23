<?php

if (! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor Custom Carousel.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */


class Custom_Carousel_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'custom-carousel-widget';
    }


    /**
     * Get widget title.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Custom Carousel', 'custom-carousel-widget');
    }

    /**
     * Get widget icon.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-slider-device';
    }

    /**
     * Get custom help URL.
     *
     * Retrieve a URL where the user can get more information about the widget.
     *
     * @since  1.0.0
     * @access public
     * @return string Widget help URL.
     */
    public function get_custom_help_url()
    {
        return 'https://developers.elementor.com/docs/widgets/';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since  1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return [ 'general' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the oEmbed widget belongs to.
     *
     * @since  1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return [ 'Carousel', 'Custom', 'link' ];
    }



   
    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
            'label' => esc_html__('Content', 'custom-carousel-widget'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'navigation_text',
            [
            'label' => __('Navigation Text', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('Navigation text', 'custom-carousel-widget'),
            'label_block' => true
            ]
        );

        $repeater->add_control(
            'slider_text',
            [
            'label' => __('Slider Text', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::WYSIWYG,
            'default' => __('Slider text', 'custom-carousel-widget'),
            'label_block' => true
            ]
        );

        $repeater->add_control(
            'slider_image',
            [
            'label'   => __('Image', 'custom-carousel-widget'),
            'type'    => \Elementor\Controls_Manager::MEDIA,
            'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
            ],
        );

        $this->add_control(
            'slider',
            [
            'label' => __('Slider Items', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
            [
                'slider_title' => __('Slider title #1', 'custom-carousel-widget'),
            ],
            ],
            'title_field' => '{{{ slider_title }}}',
            ]
        );
    
        $this->end_controls_section();


        $this->start_controls_section(
            'slider_settings',
            [
            'label' => esc_html__('Slider Settings', 'custom-carousel-widget'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

          // show Loop
        $this->add_control(
            'loop',
            [
            'label' => __('Loop', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'custom-carousel-widget'),
            'label_off' => __('Hide', 'custom-carousel-widget'),
            'return_value' => true,
            'default' => false,
            ]
        );

        // show Dots
        $this->add_control(
            'dots',
            [
            'label' => __('Dots', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'custom-carousel-widget'),
            'label_off' => __('Hide', 'custom-carousel-widget'),
            'return_value' => true,
            'default' => false,
            ]
        );

        // Show Navs
        $this->add_control(
            'navs',
            [
            'label' => __('Navs', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __('Show', 'custom-carousel-widget'),
            'label_off' => __('Hide', 'custom-carousel-widget'),
            'return_value' => true,
            'default' => true,
            ]
        );

        // Margin
        $this->add_control(
            'margin',
            [
            'label' => __('Margin', 'custom-carousel-widget'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 10,
            'placeholder' => __('Enter the margin between to slides', 'custom-carousel-widget'),
            ]
        );

        $this->end_controls_section();


    }

    /**
     * Render custom carousel widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget = $this->get_data();
		$unique_id = $widget['id'];
        ?>
        <div id="custom-carousel-<?php echo $unique_id; ?>" class="custom-carousel-widget">
            <div class="slider-for">
                <?php foreach( $settings[ 'slider' ] as $slide ) : ?>
                        <div class="slider-simple">
                            <img class="slider-image" src="<?php echo esc_url($slide[ 'slider_image' ][ 'url' ]); ?>" alt="<?php esc_attr_e($slide[ 'slider_text' ]); ?>">
                            <div class="slider-quote"><?php echo $slide[ 'slider_text' ]; ?></div>
                        </div>
                <?php endforeach; ?>
            </div>
            
            <div class="slider-nav">
            <?php foreach( $settings[ 'slider' ] as $slideNav ) : ?>
                    <div class="simple-nav">
                        <div class="slider-quote"><?php echo $slideNav[ 'navigation_text' ]; ?></div>
                    </div>
            <?php endforeach; ?>
            </div>
        </div>
   
        <?php
    }

}
