<?php
/**
 * Plugin Name: Graffino Elementor Extra
 * Description: Graffino addons for elementor
 * Plugin URI:  https://elementor.com/
 * Version:     1.0.0
 * Author:       Graffino
 * Author URI:  https://developers.elementor.com/
 * Text Domain: graffino-elementor-extra
 *
 * Elementor tested up to: 3.16.0
 * Elementor Pro tested up to: 3.16.0
 */

if (! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}
/**
 * Register Emoji One Area Control.
 *
 * Include control file and register control class.
 *
 * @since  1.0.0
 * @param  \Elementor\Controls_Manager $controls_manager Elementor controls manager.
 * @return void
 */

function register_custom_carousel_control( $controls_manager )
{

    include_once __DIR__ . '/includes/controls/custom-carousel-control.php';

    $controls_manager->register(new \Custom_Carousel_Control());

}
add_action('elementor/controls/register', 'register_custom_carousel_control');

/**
 * Register Custom-carousel-widget.
 *
 * Include widget file and register widget class.
 *
 * @since  1.0.0
 * @param  \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */

function register_list_widget( $widgets_manager )
{
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js', array(), '3.6.4', true);
    wp_enqueue_script('slick-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);

    // Încărcare CSS pentru Slick Carousel
    wp_enqueue_style('slick-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-carousel-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

    include_once __DIR__ . '/includes/widgets/custom-carousel-widget.php';

    $widgets_manager->register(new \Custom_Carousel_Widget());

}
add_action('elementor/widgets/register', 'register_list_widget');
