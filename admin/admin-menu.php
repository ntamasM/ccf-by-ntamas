<?php
// Create admin menu
function ntamas_cursor_follower_menu()
{
    add_menu_page(
        'Custom Cursor Follower by Ntamas',  // Page title
        'Cursor Follower',         // Menu title
        'manage_options',          // Capability
        'ntamas-cursor-settings',  // Menu slug
        'ntamas_cursor_settings_page_with_image',  // Updated callback function
        'dashicons-star-half',    // Icon
        100                        // Position
    );
}
add_action('admin_menu', 'ntamas_cursor_follower_menu');

// New callback function to include an image next to the page title
function ntamas_cursor_settings_page_with_image()
{
    echo '<h1><img src="' . plugin_dir_url(__DIR__) . 'assets/media/Logo-CCF-by-Ntamas.jpg" alt="CCFLogo" style="vertical-align: middle; margin-right: 10px;"> Custom Cursor Follower by Ntamas</h1>';
    // Your existing settings page content goes here
    echo '<div class="wrap">
        <h1>Custom Cursor Follower Settings</h1>
        <form method="post" action="options.php">
            ';
    echo wrapper_start();
}
