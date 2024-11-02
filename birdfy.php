<?php

/*
Plugin Name: Birdfy - Twitter markups for Wordpress
Version: 1.0.2.5
Plugin URI: http://paponerd.com/2011/02/birdfy-gere-links-automaticos-no-wordpress-para-o-twitter/
Description: With this plugin, you can transform all your mentions with @ and # in your posts into links to users/hashtags like on Twitter.
Author: Hilder Santos
Author URI: http://hildersantos.com/
*/

/*  Copyright 2011 Hilder Santos  (email : hilder[at]hildersantos.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/* Adiciono o suporte a internacionalização */
$plugin_dir = basename(dirname(__FILE__));
load_plugin_textdomain('birdfy-twitter-markups-for-posts', null, $plugin_dir.'/languages/');

/* Adiciono os filtros */
add_filter('the_content', 'birdfy_filtro');

/* Adiciono ao box aos posts/páginas e a função de salvar */
add_action('admin_menu', 'birdfy_box');
add_action('save_post', 'birdfy_save');

/* Função que registra as opções quando o plugin for ativado */
register_activation_hook(__FILE__, 'birdfy_seta_options');

/* Seto as opções padrão */
function birdfy_seta_options() {
	
	$aOpcoes = array(
				'cria_hashtags' => 'on',
				'cria_users' => 'on',
				'target_blank' => '',
	);
	
	foreach ($aOpcoes as $c => $v) {
		update_option($c, $v);
	}
	
	return;
}

/* Função que adiciona o box à administração */
function birdfy_box() {
  //WP 2.5+
  if( function_exists( 'add_meta_box' )) { 
  	foreach( array('post', 'page') as $tipo ) {
	    add_meta_box( 'bdf_box', __('Deactivate Birdfy for this?', 'birdfy-twitter-markups-for-posts'), 'birdfy_html', $tipo, 'side', 'high' );
    }
  }
}

/* Função com o HTML do box */

# Defino os campos para utilizar globalmente
$bdf_campos = array(
	'disable_hashtags' => __('Disable #hashtags links', 'birdfy-twitter-markups-for-posts'),
	'disable_users' => __('Disable @user links', 'birdfy-twitter-markups-for-posts'),
);
	
function birdfy_html(){
	global $post, $bdf_campos;
	// Uso o nonce para verificar
	echo '<input type="hidden" name="bdf_nonce" id="bdf_nonce" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	//Printo os radio buttons

	foreach($bdf_campos as $campo => $legenda){
?>
<label for="bdf_<?php echo $campo; ?>">
	<input type="checkbox" name="bdf_<?php echo $campo; ?>" id="bdf_<?php echo $campo; ?>" <?php
		if (get_post_meta($post->ID, 'bdf_'.$campo, true) == 1)
			echo ' checked="checked"';
	?>/>
	<?php echo $legenda; ?>
</label>
<br /> 
<?php }

}

/* Salvando as opções do post */
function birdfy_save( $post_id ){
	global $bdf_campos;

  // verifica se a requisição veio da tela e com autorização,
  // porque o save_post pode ser acionado outras vezes
  
  if ( !wp_verify_nonce( $_POST['bdf_nonce'], plugin_basename(__FILE__) )) {
    return $post_id;
  }

  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ))
      return $post_id;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ))
      return $post_id;
  }
  
  // Se estiver autenticado, salvamos os dados.
  foreach($bdf_campos as $campo => $legenda) {
		$cp = $_POST['bdf_'.$campo];
		
  	  if ( !empty($cp) ){
		update_post_meta($post_id, 'bdf_'.$campo, 1);
	  } else {
		delete_post_meta($post_id, 'bdf_'.$campo);
	  }
}

  return true;
}

/* Crio a função para filtrar os usuários e hashtags nos posts */
function birdfy_filtro($conteudo) {
	global $post;
	
	$target = get_option('target_blank') ? 'target="_blank"' : '';
	
	if(get_option('cria_hashtags')) {
		// Filtra as #hashtags
		if(!get_post_meta($post->ID, 'bdf_disable_hashtags', true))
			$conteudo =  preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]+)?#{1}(\w+)([\.|\,|\:|\!|\?|\>|\}|\)])?(\<\/[b-zB-Z]+\>)?(\<\/[a-zA-Z]+\>)?\s/i', "$1<a href=\"http://twitter.com/#search?q=%23$2\" class=\"twitter-hashtag-link\" title=\"Search '$2' on Twitter\" $target>#$2</a>$3$4$5 ", $conteudo);
	}
	
	if(get_option('cria_users')) {
		// Filtra os @usuarios
		if(!get_post_meta($post->ID, 'bdf_disable_users', true))
		$conteudo =  preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]+)?@{1}(\w+)([\.|\,|\:|\!|\?|\>|\}|\)])?(\<\/[b-zB-Z]+\>)?(\<\/[a-zA-Z]+\>)?\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user-link\" title=\"$2 profile on Twitter\" $target>@$2</a>$3$4$5 ", $conteudo);
	}
	
	return $conteudo;
}

/* Adiciono a página de opções à administração */
include_once dirname( __FILE__ ) . '/options.php';

?>