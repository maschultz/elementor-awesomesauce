<?php
/**
 * Elementor Video-Post Slider WordPress Plugin
 *
 * @package ElementorVideoPostSlider
 *
 * Plugin Name: Video Post Slider
 * Description: A simple video post slider for Elementor
 * Plugin URI:  https://www.apexrush.com/
 * Version:     1.1.0
 * Author:      Michael Schultz
 * Author URI:  https://www.apexrush.com
 * Text Domain: elementor-videopost
 */

define( 'ELEMENTOR_VIDEOPOST', __FILE__ );

/**
 * Include the ELEMENTOR_VIDEOPOST class.
 */
require plugin_dir_path( ELEMENTOR_VIDEOPOST ) . 'class-elementor-videopost.php';
