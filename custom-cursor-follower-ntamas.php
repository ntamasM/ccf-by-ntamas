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
}
add_action('wp_enqueue_scripts', 'ntamas_enqueue_font_awesome');

// Enqueue admin CSS and JS files
function ntamas_cursor_follower_enqueue_admin_assets()
{
    wp_enqueue_style('ntamas-admin-style', plugin_dir_url(__FILE__) . 'admin/css/admin-styles.css');
    wp_enqueue_script('ntamas-admin-script', plugin_dir_url(__FILE__) . 'admin/js/admin-script.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'ntamas_cursor_follower_enqueue_admin_assets');

// Create admin menu
function ntamas_cursor_follower_menu()
{
    add_menu_page(
        'Custom Cursor Follower by Ntamas',  // Page title
        'Cursor Follower',         // Menu title
        'manage_options',          // Capability
        'ntamas-cursor-settings',  // Menu slug
        'ntamas_cursor_settings_page',  // Callback function
        'dashicons-star-half',    // Icon
        100                        // Position
    );
}
add_action('admin_menu', 'ntamas_cursor_follower_menu');

// Settings page callback
function ntamas_cursor_settings_page()
{
?>
    <div class="wrap">
        <h1>Custom Cursor Follower Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('ntamas_cursor_settings_group');
            do_settings_sections('ntamas-cursor-settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

// Register settings
function ntamas_cursor_register_settings()
{
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_icon');
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_size');
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_position_x');
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_position_y');
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_speed');

    add_settings_section('ntamas_cursor_main_section', 'Cursor Settings', null, 'ntamas-cursor-settings');

    add_settings_field('ntamas_cursor_icon', 'Cursor Icon', 'ntamas_cursor_icon_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_size', 'Icon Size (in px)', 'ntamas_cursor_size_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_position_x', 'Icon Position X (in px)', 'ntamas_cursor_position_x_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_position_y', 'Icon Position Y (in px)', 'ntamas_cursor_position_y_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_speed', 'Follow Speed Delay', 'ntamas_cursor_speed_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
}
add_action('admin_init', 'ntamas_cursor_register_settings');

// Fields for settings page
function ntamas_cursor_icon_field()
{
    $icon = get_option('ntamas_cursor_icon');
    $icons = [
        'fa fa-star',
        'fa fa-heart',
        'fa fa-circle',
        'fa fa-square',
        'fa fa-check',
        'fa fa-times',
        'fa fa-bars',
        'fa fa-search',
        'fa fa-envelope',
        'fa fa-globe',
        'fa fa-trash',
        'fa fa-user',
        'fa fa-home',
        'fa fa-lock',
        'fa fa-cog',
        'fa fa-cloud',
        'fa fa-camera',
        'fa fa-music',
        'fa fa-film',
        'fa fa-th-large',
        'fa fa-th',
        'fa fa-th-list',
        'fa fa-check-square',
        'fa fa-pencil-square',
        'fa fa-eraser',
        'fa fa-calendar',
        'fa fa-comment',
        'fa fa-folder',
        'fa fa-folder-open',
        'fa fa-chart-bar',
        'fa fa-chart-line',
        'fa fa-chart-pie',
        'fa fa-bolt',
        'fa fa-umbrella',
        'fa fa-sun',
        'fa fa-moon',
        'fa fa-star',
        'fa fa-cloud-moon',
        'fa fa-cloud-sun',
        'fa fa-cloud-sun-rain',
        'fa fa-cloud-showers-heavy',
        'fa fa-cloud-rain',
        'fa fa-cloud-snow',
        'fa fa-arrow-up',
        'fa fa-arrow-down',
        'fa fa-arrow-left',
        'fa fa-arrow-right'
    ];

    echo "<select name='ntamas_cursor_icon'>";
    foreach ($icons as $available_icon) {
        $selected = ($icon === $available_icon) ? 'selected' : '';
        echo "<option value='" . esc_attr($available_icon) . "' $selected><i class='" . esc_html($available_icon) . "'></i>" . esc_html($available_icon) . "</option>";
    }
    echo "</select>";
}

function ntamas_cursor_size_field()
{
    $size = get_option('ntamas_cursor_size');
    echo "<input type='number' name='ntamas_cursor_size' value='" . esc_attr($size) . "' min='1' max='100'/>";
}

function ntamas_cursor_position_x_field()
{
    $position_x = get_option('ntamas_cursor_position_x');
    echo "<input type='number' name='ntamas_cursor_position_x' value='" . esc_attr($position_x) . "' min='0' max='100'/>";
}

function ntamas_cursor_position_y_field()
{
    $position_y = get_option('ntamas_cursor_position_y');
    echo "<input type='number' name='ntamas_cursor_position_y' value='" . esc_attr($position_y) . "' min='0' max='100'/>";
}

function ntamas_cursor_speed_field()
{
    $speed = get_option('ntamas_cursor_speed');
    echo "<input type='number' name='ntamas_cursor_speed' value='" . esc_attr($speed) . "' min='1' max='100'/>";
}
