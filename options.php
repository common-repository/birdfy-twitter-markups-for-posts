<?php
// crio o item de menu para as configurações
add_action('admin_menu', 'birdfy_menu');

function birdfy_menu() {

	// crio o submenu em Configurações
	add_submenu_page('options-general.php',__('Birdfy Settings', 'birdfy-twitter-markups-for-posts'),__('Birdfy Settings', 'birdfy-twitter-markups-for-posts'), 'administrator', __FILE__, 'birdfy_options');

	// chamo a função para registrar os parâmetros
	add_action( 'admin_init', 'birdfy_regsettings' );
}


function birdfy_regsettings() {
	// registrando...
	register_setting( 'birdfy-config-group', 'cria_hashtags' );
	register_setting( 'birdfy-config-group', 'cria_users' );
	register_setting( 'birdfy-config-group', 'target_blank' );
}

function birdfy_options() {
?>
<div class="wrap">
<h2><?php _e('Birdy Options', 'birdfy-twitter-markups-for-posts'); ?></h2>

<form method="post" action="options.php">
    <?php settings_fields( 'birdfy-config-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><?php _e('Create Hashtags links?', 'birdfy-twitter-markups-for-posts'); ?></th>
        <td><input type="checkbox" name="cria_hashtags" <?php if(get_option('cria_hashtags')) echo 'checked="checked"'?> /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row"><?php _e('Create User links?', 'birdfy-twitter-markups-for-posts'); ?></th>
        <td><input type="checkbox" name="cria_users" <?php if(get_option('cria_users')) echo 'checked="checked"'?> /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row"><?php _e('Should the link opens in a new window?', 'birdfy-twitter-markups-for-posts'); ?></th>
        <td><input type="checkbox" name="target_blank" <?php if(get_option('target_blank')) echo 'checked="checked"'?> /></td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes', 'birdfy-twitter-markups-for-posts') ?>" />
    </p>

</form>
</div>
<?php } ?>