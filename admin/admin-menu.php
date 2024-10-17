<?php
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
