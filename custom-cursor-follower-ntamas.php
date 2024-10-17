<?php
/*
Plugin Name: Custom Cursor Follower by Ntamas
Description: A plugin that adds a customizable icon that follows the cursor on the front end.
Version: 1.0
Author: Ntamas
*/

// Enqueue the necessary CSS and JS files
function ntamas_cursor_follower_enqueue_assets()
{
    wp_enqueue_style('ntamas-cursor-style', plugin_dir_url(__FILE__) . 'assets/css/styles.css?v0.0.14');
    wp_enqueue_script('ntamas-cursor-script', plugin_dir_url(__FILE__) . 'js/script.js?v0.0.8', array('jquery'), null, true);

    // Localize script to pass PHP variables to JS
    wp_localize_script('ntamas-cursor-script', 'ntamasCursorSettings', array(
        'icon' => get_option('ntamas_cursor_icon'),
        'color' => get_option('ntamas_cursor_color'),
        'size' => get_option('ntamas_cursor_size'),
        'speed' => get_option('ntamas_cursor_speed')
    ));
}
add_action('wp_enqueue_scripts', 'ntamas_cursor_follower_enqueue_assets');

function ntamas_enqueue_font_awesome()
{
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'ntamas_enqueue_font_awesome');

// Create admin menu
function ntamas_cursor_follower_menu()
{
    add_menu_page(
        'Custom Cursor Follower',  // Page title
        'Cursor Follower',         // Menu title
        'manage_options',          // Capability
        'ntamas-cursor-settings',  // Menu slug
        'ntamas_cursor_settings_page',  // Callback function
        'dashicons-admin-site',    // Icon
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
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_speed');

    add_settings_section('ntamas_cursor_main_section', 'Cursor Settings', null, 'ntamas-cursor-settings');

    add_settings_field('ntamas_cursor_icon', 'Cursor Icon', 'ntamas_cursor_icon_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_size', 'Icon Size', 'ntamas_cursor_size_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_speed', 'Follow Speed', 'ntamas_cursor_speed_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
}
add_action('admin_init', 'ntamas_cursor_register_settings');

// Fields for settings page
function ntamas_cursor_icon_field()
{
    $icon = get_option('ntamas_cursor_icon');
    echo "<input type='text' name='ntamas_cursor_icon' value='" . esc_attr($icon) . "' placeholder='e.g., fa fa-star'/>";
}

function ntamas_cursor_size_field()
{
    $size = get_option('ntamas_cursor_size');
    echo "<input type='number' name='ntamas_cursor_size' value='" . esc_attr($size) . "' min='1' max='100'/>";
}

function ntamas_cursor_speed_field()
{
    $speed = get_option('ntamas_cursor_speed');
    echo "<input type='number' name='ntamas_cursor_speed' value='" . esc_attr($speed) . "' min='1' max='100'/>";
}
