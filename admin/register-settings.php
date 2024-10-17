<?php
// Register settings
function ntamas_cursor_register_settings()
{
    // Register settings 
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_icon');
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_size');
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_position_x');
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_position_y');
    register_setting('ntamas_cursor_settings_group', 'ntamas_cursor_speed');

    // Add settings section
    add_settings_section('ntamas_cursor_main_section', 'Cursor Settings', null, 'ntamas-cursor-settings');

    // Add settings fields and callbacks
    add_settings_field('ntamas_cursor_icon', 'Cursor Icon', 'ntamas_cursor_icon_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_size', 'Icon Size (in px)', 'ntamas_cursor_size_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_position_x', 'Icon Position X (in px)', 'ntamas_cursor_position_x_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_position_y', 'Icon Position Y (in px)', 'ntamas_cursor_position_y_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
    add_settings_field('ntamas_cursor_speed', 'Follow Speed Delay', 'ntamas_cursor_speed_field', 'ntamas-cursor-settings', 'ntamas_cursor_main_section');
}
add_action('admin_init', 'ntamas_cursor_register_settings');
