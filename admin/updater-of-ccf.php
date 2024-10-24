<?php
// ----------------
// 1: Plugin Description When People Click On View Version Details

add_filter('plugins_api', 'ccf_by_ntamas_info', 20, 3);

function ccf_by_ntamas_info($res, $action, $args)
{
    if ('plugin_information' !== $action) return $res;
    if ($args->slug !== 'ccf-by-ntamas') return $res;
    $res = new stdClass();
    $changelog = ccf_by_ntamas_request();
    $res->name           = $changelog->name;
    $res->slug           = $changelog->slug;
    $res->version        = $changelog->version;
    $res->tested         = $changelog->tested;
    $res->requires       = $changelog->requires;
    $res->author         = $changelog->author;
    $res->author_profile = $changelog->author_profile;
    $res->homepage       = $changelog->homepage;
    $res->download_link  = $changelog->download_url;
    $res->trunk          = $changelog->download_url;
    $res->requires_php   = $changelog->requires_php;
    $res->last_updated   = $changelog->last_updated;

    $res->sections = [
        'description'  => $changelog->sections->description,
        'installation' => $changelog->sections->installation,
        'changelog'    => $changelog->sections->changelog
    ];

    if (! empty($changelog->banners)) {
        $res->banners = [
            'low'  => $changelog->banners->low,
            'high' => $changelog->banners->high
        ];
    }
    return $res;
}

// ----------------
// 2: Plugin Update using correct filter

add_filter('site_transient_update_plugins', 'ccf_by_ntamas_check_for_update');

function ccf_by_ntamas_check_for_update($transient)
{
    if (empty($transient->checked)) return $transient;

    // Path to the plugin's main file
    $plugin_file = 'ccf-by-ntamas/ccf-by-ntamas.php';

    // Retrieve plugin info from JSON
    $changelog = ccf_by_ntamas_request();
    if ($changelog && version_compare($changelog->version, $transient->checked[$plugin_file], '>')) {
        $plugin_data = array(
            'slug' => 'ccf-by-ntamas',
            'new_version' => $changelog->version,
            'package' => $changelog->download_url,
            'url' => 'https://github.com/ntamasM/ccf-by-ntamas', // Update with your plugin page URL if applicable
        );
        $transient->response[$plugin_file] = (object) $plugin_data;
    }

    return $transient;
}

// ----------------
// 3: Retrieve Plugin Changelog

function ccf_by_ntamas_request()
{
    $access = wp_remote_get('https://ntamadakis.gr/wp-plugins/ccf-by-ntamas/info.json', array('timeout' => 10, 'headers' => array('Accept' => 'application/json')));
    if (!is_wp_error($access) && wp_remote_retrieve_response_code($access) === 200) {
        $result = json_decode(wp_remote_retrieve_body($access));
        return $result;
    }
    return false; // Return false if request fails
}
