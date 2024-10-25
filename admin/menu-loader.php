<?php
// Create admin menu
function ccfnt_menu()
{
    add_menu_page(
        'CCF by Ntamas (Custom Cursor Follower by Ntamas)',  // Page title
        'CCF by ntamas',         // Menu title
        'manage_options',          // Capability
        'ccf-by-ntamas',  // Menu slug
        'ccfnt_settings_page_with_image',  // Updated callback function
        'dashicons-star-half',    // Icon
        100                        // Position
    );
}
add_action('admin_menu', 'ccfnt_menu');
