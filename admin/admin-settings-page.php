<?php
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


// Fields for settings page
function ntamas_cursor_icon_field()
{
    $icon = get_option('ntamas_cursor_icon');
    $icons = [
        'fa fa-anchor',
        'fa fa-archive',
        'fa fa-arrow-down',
        'fa fa-arrow-left',
        'fa fa-arrow-right',
        'fa fa-arrow-up',
        'fa fa-bell',
        'fa fa-bicycle',
        'fa fa-bolt',
        'fa fa-bars',
        'fa fa-bus',
        'fa fa-box',
        'fa fa-building',
        'fa fa-calendar',
        'fa fa-camera',
        'fa fa-car',
        'fa fa-chart-bar',
        'fa fa-chart-line',
        'fa fa-chart-pie',
        'fa fa-check',
        'fa fa-check-square',
        'fa fa-city',
        'fa fa-clipboard',
        'fa fa-cloud',
        'fa fa-cloud-moon',
        'fa fa-cloud-rain',
        'fa fa-cloud-showers-heavy',
        'fa fa-cloud-snow',
        'fa fa-cloud-sun',
        'fa fa-cloud-sun-rain',
        'fa fa-cog',
        'fa fa-comment',
        'fa fa-compass',
        'fa fa-credit-card',
        'fa fa-envelope',
        'fa fa-eraser',
        'fa fa-file',
        'fa fa-file-alt',
        'fa fa-file-archive',
        'fa fa-file-audio',
        'fa fa-file-code',
        'fa fa-file-download',
        'fa fa-file-excel',
        'fa fa-file-image',
        'fa fa-file-pdf',
        'fa fa-file-powerpoint',
        'fa fa-file-upload',
        'fa fa-file-video',
        'fa fa-file-word',
        'fa fa-film',
        'fa fa-flag',
        'fa fa-flower',
        'fa fa-folder',
        'fa fa-folder-open',
        'fa fa-frown',
        'fa fa-gift',
        'fa fa-globe',
        'fa fa-headphones',
        'fa fa-heart',
        'fa fa-home',
        'fa fa-hospital',
        'fa fa-key',
        'fa fa-leaf',
        'fa fa-lightbulb',
        'fa fa-location-arrow',
        'fa fa-lock',
        'fa fa-map',
        'fa fa-meh',
        'fa fa-microphone',
        'fa fa-money-bill',
        'fa fa-moon',
        'fa fa-mountain',
        'fa fa-music',
        'fa fa-paper-plane',
        'fa fa-pencil-square',
        'fa fa-plane',
        'fa fa-search',
        'fa fa-school',
        'fa fa-shopping-cart',
        'fa fa-ship',
        'fa fa-smile',
        'fa fa-snowflake',
        'fa fa-star',
        'fa fa-store',
        'fa fa-subway',
        'fa fa-sun',
        'fa fa-th',
        'fa fa-th-large',
        'fa fa-th-list',
        'fa fa-times',
        'fa fa-trash',
        'fa fa-train',
        'fa fa-tree',
        'fa fa-truck',
        'fa fa-umbrella',
        'fa fa-unlock',
        'fa fa-user',
        'fa fa-users',
        'fa fa-video',
        'fa fa-wallet',
        'fa fa-water',
        'fa fa-wind',
        'fa fa-wrench'
    ];

    echo "<div class='ntamas-cursor-select-container'>
            <div class='custom-select'>
                <div class='selected'>
                    <i class='fa fa-star'></i> 
                    Select an option
                </div>
                <div class='search-box'>
                    <input type=;text' placeholder='Search...'>
                </div>
                <ul class='options'>";
    foreach ($icons as $available_icon) {
        $selected = ($icon === $available_icon) ? 'selected' : '';
        echo "<li><i class='" . esc_attr($available_icon) . "'></i>" . esc_html($available_icon) . "</li>";
    }
    echo "</ul></div></div>";
    echo "<select id='ntamas_cursor_select' name='ntamas_cursor_icon'>";
    foreach ($icons as $available_icon) {
        $selected = ($icon === $available_icon) ? 'selected' : '';
        echo "<option value='" . esc_attr($available_icon) . "' $selected>" . esc_html($available_icon) . "</option>";
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
