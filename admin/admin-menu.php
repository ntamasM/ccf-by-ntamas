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

// New callback function to include an image next to the page title
function ccfnt_settings_page_with_image()
{
?>
    <div class="ccf-header">
        <div class="logo">
            <a href="https://github.com/ntamasM/ccf-by-ntamas">
                <img src="<?php echo esc_url(plugin_dir_url(__DIR__)) ?>assets/media/Icon-CCF-by-Ntamas.svg" alt="CCFLogoSVG" style="vertical-align: middle; margin-right: 10px;">
            </a>
        </div>
        <div class="title">
            <h1><a href="https://github.com/ntamasM/CCF-by-Ntamas">Custom Cursor Follower by Ntamas</a></h1>
        </div>
        <div class="social">
            <div><a href="https://www.linkedin.com/in/manolis-ntamadakis/"><i class="fa-brands fa-linkedin"></i></a></div>
            <div><a href="https://github.com/ntamasM"><i class="fa-brands fa-github"></i></a></div>
            <div><a href="https://ntamadakis.gr"><i class="fa fa-globe"></i></a></div>
        </div>
    </div>
    <div class="wrap">
        <h2></h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('ccfnt_settings_group');
            do_settings_sections('ccf-by-ntamas');
            submit_button();
            ?>
        </form>
    </div>
<?php
}
