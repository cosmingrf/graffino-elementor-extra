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

function graffino_elementor_extra() {
	require_once( __DIR__ . '/includes/plugin.php' );
}
add_action( 'plugins_loaded', 'graffino_elementor_extra' );