<?php
// Register settings
function ccfnt_register_settings()
{
    // Register settings 
    register_setting('ccfnt_settings_group', 'ccfnt_icon');
    register_setting('ccfnt_settings_group', 'ccfnt_size');
    register_setting('ccfnt_settings_group', 'ccfnt_position_x');
    register_setting('ccfnt_settings_group', 'ccfnt_position_y');
    register_setting('ccfnt_settings_group', 'ccfnt_speed');

    // Add settings section
    add_settings_section('ccfnt_main_section', 'Cursor Settings', null, 'ccfnt-settings');

    // Add settings fields and callbacks
    add_settings_field('ccfnt_icon', 'Cursor Icon', 'ccfnt_icon_field', 'ccfnt-settings', 'ccfnt_main_section');
    add_settings_field('ccfnt_size', 'Icon Size (in px)', 'ccfnt_size_field', 'ccfnt-settings', 'ccfnt_main_section');
    add_settings_field('ccfnt_position_x', 'Icon Position X (in px)', 'ccfnt_position_x_field', 'ccfnt-settings', 'ccfnt_main_section');
    add_settings_field('ccfnt_position_y', 'Icon Position Y (in px)', 'ccfnt_position_y_field', 'ccfnt-settings', 'ccfnt_main_section');
    add_settings_field('ccfnt_speed', 'Follow Speed Delay', 'ccfnt_speed_field', 'ccfnt-settings', 'ccfnt_main_section');
}
add_action('admin_init', 'ccfnt_register_settings');
