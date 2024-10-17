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

    echo "<div class='ntamas-cursor-select-container'>
            <div class='custom-select'>
                <div class='selected'>
                    <i class='fa fa-star'></i> 
                    Select an option
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
