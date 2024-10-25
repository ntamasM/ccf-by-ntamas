<?php
/*

@wordpress-plugin
Plugin Name:       CCF by Ntamas (Custom Cursor Follower by Ntamas)
Plugin URI:        https://github.com/ntamasM/ccf-by-ntamas
Description:       A Wordpress plugin that will add an icon that will follow your cursor
Version:           1.0.5
Author:            Ntamas
Author URI:        https://ntamadakis.gr
License:           GPLv2 (or later)
License URI:       https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
Text Domain:       ccf-by-ntamas

*/

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}


// import settings page and menu 
if (is_admin()) {
    require plugin_dir_path(__FILE__) . 'admin/menu-loader.php';
    require plugin_dir_path(__FILE__) . 'admin/register-fielsd-and-settings.php';
    require plugin_dir_path(__FILE__) . 'admin/fields-and-settings-loader.php';
    require plugin_dir_path(__FILE__) . 'admin/settings-page-loader.php';
    require plugin_dir_path(__FILE__) . 'admin/updater-of-ccf.php';
    require plugin_dir_path(__FILE__) . 'admin/plugin_actions_links.php';
}


// Enqueue the necessary CSS and JS files
function ccfnt_enqueue_assets()
{
    // Enqueue the CSS file
    wp_enqueue_style('ccfnt-style', plugin_dir_url(__FILE__) . 'public/css/styles.css', array(), filemtime(plugin_dir_path(__FILE__) . 'public/css/styles.css'));

    // Enqueue the JS file
    wp_enqueue_script('ccfnt-script', plugin_dir_url(__FILE__) . 'public/js/script.js', array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'public/js/script.js'), true);

    // Localize script to pass PHP variables to JS
    wp_localize_script('ccfnt-script', 'ccfntSettings', array(
        'icon' => get_option('ccfnt_icon'),
        'position_x' => get_option('ccfnt_position_x'),
        'position_y' => get_option('ccfnt_position_y'),
        'size' => get_option('ccfnt_size'),
        'speed' => get_option('ccfnt_speed')
    ));

    // Add defer attribute to the frontend script
    add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
}

add_action('wp_enqueue_scripts', 'ccfnt_enqueue_assets');

// Enqueue Font Awesome
function ccfnt_enqueue_font_awesome()
{
    if (!wp_style_is('font-awesome', 'enqueued')) {
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0-beta3'); // Added version parameter
    }
}
add_action('wp_enqueue_scripts', 'ccfnt_enqueue_font_awesome');
add_action('admin_enqueue_scripts', 'ccfnt_enqueue_font_awesome');

// Enqueue admin CSS and JS files
function ccfnt_enqueue_admin_assets($hook_suffix)
{
    // Get the current screen object
    $screen = get_current_screen();

    // Check if we are on the specific plugin admin page
    if ($screen->id === 'toplevel_page_ccf-by-ntamas') {
        wp_enqueue_style('ccfnt-admin-style', plugin_dir_url(__FILE__) . 'admin/css/admin-styles.css', array(), filemtime(plugin_dir_path(__FILE__) . 'admin/css/admin-styles.css'));
        wp_enqueue_script('ccfnt-admin-script', plugin_dir_url(__FILE__) . 'admin/js/admin-script.js', array('jquery'), filemtime(plugin_dir_path(__FILE__) . 'admin/js/admin-script.js'), true);

        // Localize script to pass the plugin URL
        wp_localize_script('ccfnt-admin-script', 'ccfntSettings', array(
            'pluginUrl' => plugin_dir_url(__FILE__),
            'icon' => get_option('ccfnt_icon'),
            'position_x' => get_option('ccfnt_position_x'),
            'position_y' => get_option('ccfnt_position_y'),
            'size' => get_option('ccfnt_size'),
            'speed' => get_option('ccfnt_speed')
        ));

        // Add defer attribute to the admin script
        add_filter('script_loader_tag', 'add_defer_attribute', 10, 2);
    }
}

add_action('admin_enqueue_scripts', 'ccfnt_enqueue_admin_assets');

// Function to add defer attribute to the script
function add_defer_attribute($tag, $handle)
{
    // Check if this is the script we want to defer
    if ('ccfnt-admin-script' !== $handle) {
        return $tag;
    }

    // Add defer to the script tag
    return str_replace(' src', ' defer="defer" src', $tag);
}
