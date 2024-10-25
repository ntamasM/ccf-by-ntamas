<?php
// Add a custom 'View details' link in the plugins list
add_filter('plugin_action_links', 'ccf_by_ntamas_add_action_links', 10, 5);

function ccf_by_ntamas_add_action_links($actions, $plugin_file)
{
    if ($plugin_file == 'ccf-by-ntamas/ccf-by-ntamas.php') {

        $settings = array('settings' => '<a href="' . admin_url('admin.php?page=ccf-by-ntamas') . '">Settings</a>');
        // $site_link = array('support' => '<a href="http://thetechterminus.com" target="_blank">Support</a>');

        $actions = array_merge($settings, $actions);
        // $actions = array_merge($site_link, $actions);
    }
    return $actions;
}
