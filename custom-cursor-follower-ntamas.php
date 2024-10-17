<?php
/*
Plugin Name: Custom Cursor Follower by Ntamas
Plugin URI: https://github.com/ntamasM/CCF-by-Ntamas
Description: A Wordpress plugin to add an icon that will follow your cursor
Version: 1.0
Author: Ntamas
Author URI: https://ntamadakis.gr
License: GPL2
Text Domain: ccfnt
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// import settings page and menu 
require_once plugin_dir_path(__FILE__) . 'admin/admin-settings-page.php';
require_once plugin_dir_path(__FILE__) . 'admin/admin-menu.php';
require_once plugin_dir_path(__FILE__) . 'admin/register-settings.php';

// Enqueue the necessary CSS and JS files
function ntamas_cursor_follower_enqueue_assets()
{
    wp_enqueue_style('ntamas-cursor-style', plugin_dir_url(__FILE__) . 'public/css/styles.css');
    wp_enqueue_script('ntamas-cursor-script', plugin_dir_url(__FILE__) . 'public/js/script.js', array('jquery'), null, true);

    // Localize script to pass PHP variables to JS
    wp_localize_script('ntamas-cursor-script', 'ntamasCursorSettings', array(
        'icon' => get_option('ntamas_cursor_icon'),
        'position_x' => get_option('ntamas_cursor_position_x'),
        'position_y' => get_option('ntamas_cursor_position_y'),
        'size' => get_option('ntamas_cursor_size'),
        'speed' => get_option('ntamas_cursor_speed')
    ));
}
add_action('wp_enqueue_scripts', 'ntamas_cursor_follower_enqueue_assets');

// Enqueue Font Awesome
function ntamas_enqueue_font_awesome()
{
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
    // add this on admin pages as well
}
add_action('wp_enqueue_scripts', 'ntamas_enqueue_font_awesome');
add_action('admin_enqueue_scripts', 'ntamas_enqueue_font_awesome');

// Enqueue admin CSS and JS files
function ntamas_cursor_follower_enqueue_admin_assets()
{
    wp_enqueue_style('ntamas-admin-style', plugin_dir_url(__FILE__) . 'admin/css/admin-styles.css');
    wp_enqueue_script('ntamas-admin-script', plugin_dir_url(__FILE__) . 'admin/js/admin-script.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'ntamas_cursor_follower_enqueue_admin_assets');
