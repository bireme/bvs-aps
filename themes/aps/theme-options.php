<?php
// create custom plugin settings menu
add_action('admin_menu', 'baw_create_menu');

function baw_create_menu() {

	//create new top-level menu
	add_theme_page('EVIPNet Configurações', 'EVIPNet', 'manage_options', __FILE__, 'evipnet_settings_page',plugins_url('/images/icon.png', __FILE__) );

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
    register_setting( 'evipnet-settings-group', 'link_facebook' );
    register_setting( 'evipnet-settings-group', 'link_twitter' );
    register_setting( 'evipnet-settings-group', 'link_linkedin' );
	register_setting( 'evipnet-settings-group', 'link_youtube' );
}

function evipnet_settings_page() {
?>
<div class="wrap">
<h2>Configurações EVIPNet</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'evipnet-settings-group' ); ?>
    <?php do_settings_sections( 'evipnet-settings-group' ); ?>

    <table class="form-table">
        <tr valign="top">
        <th scope="row">Link Página Facebook</th>
        <td><input type="text" name="link_facebook" value="<?php echo esc_attr( get_option('link_facebook') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Link Perfil Twitter</th>
        <td><input type="text" name="link_twitter" value="<?php echo esc_attr( get_option('link_twitter') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Link LinkedIn</th>
        <td><input type="text" name="link_linkedin" value="<?php echo esc_attr( get_option('link_linkedin') ); ?>" /></td>
        </tr>

        <tr valign="top">
        <th scope="row">Link Canal Youtube</th>
        <td><input type="text" name="link_youtube" value="<?php echo esc_attr( get_option('link_youtube') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>