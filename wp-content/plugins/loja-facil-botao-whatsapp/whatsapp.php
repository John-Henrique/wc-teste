<?php
/*
Plugin Name: Loja Fácil - Botão WhatsApp
Description: Adiciona o botão do WhatsApp no lado direito inferior do site
Author: John-Henrique
Version: 1.1
*/



add_action( 'admin_menu', 'lj_whatsapp_add_admin_menu' );
add_action( 'admin_init', 'lj_whatsapp_settings_init' );
add_action( 'enqueue_scripts', 'enqueue_scripts' );


function enqueue_scripts(){
	wp_enqueue_script( 'whatsapp_js', plugins_url( 'js/custom.js', __FILE__ ) );
}


function lj_whatsapp_add_admin_menu(  ) { 
	add_submenu_page( 'themes.php', 'Botão WhatsApp', 'Botão WhatsApp', 'manage_options', 'wcbr-botao-whatsapp', 'lj_whatsapp_options_page' );
}



function lj_whatsapp_settings_init(  ) { 
	register_setting( 'pluginPage', 'lj_whatsapp_settings' );

	add_settings_section(
		'lj_whatsapp_pluginPage_section', 
		__( 'No canto inferior direito da sua tela, você pode ver como o botão aparecerá para seus clientes.', 'wcbr-botao-whatsapp' ), 
		'lj_whatsapp_settings_section_callback', 
		'pluginPage'

	);


	add_settings_field( 
		'lj_whatsapp_numero', 
		__( 'Telefone WhatsApp', 'wcbr-botao-whatsapp' ), 
		'lj_whatsapp_numero_render', 
		'pluginPage', 
		'lj_whatsapp_pluginPage_section' 
	);


	add_settings_field( 
		'lj_whatsapp_texto', 
		__( 'Mensagem inicial', 'wcbr-botao-whatsapp' ), 
		'lj_whatsapp_texto_render', 
		'pluginPage', 
		'lj_whatsapp_pluginPage_section' 
	);
}



function lj_whatsapp_numero_render(  ) { 
	$options = get_option( 'lj_whatsapp_settings' );
	?>
	<input type='text' name='lj_whatsapp_settings[lj_whatsapp_numero]' value='<?php echo $options['lj_whatsapp_numero']; ?>'>
	<?php
}



function lj_whatsapp_texto_render(  ) { 
	$options = get_option( 'lj_whatsapp_settings' );
	?>
	<input type='text' name='lj_whatsapp_settings[lj_whatsapp_texto]' value='<?php echo $options['lj_whatsapp_texto']; ?>'>
	<?php
}



function lj_whatsapp_settings_section_callback(  ) { 
	echo __( 'Apenas o campo telefone é obrigatório, siga o padrão DDDTELEFONE, exemplo 11222233333', 'wcbr-botao-whatsapp' );
}



function lj_whatsapp_options_page( ){ 
		?>
		<form action='options.php' method='post'>
			<h2>Botão do WhatsApp</h2>
			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			?>
		</form>
		<?php
		// executa apenas nesta tela, para o usuário ver como fica
		lj_btn_whatsapp();

}





add_action("wp_footer", "lj_btn_whatsapp");
function lj_btn_whatsapp(){

	$options = get_option( 'lj_whatsapp_settings' );
	//print_r( $options );
	

	// exibe apenas se o número do WhatsApp foi informado
	if( isset( $options['lj_whatsapp_numero'] ) && !empty( $options['lj_whatsapp_numero'] ) ){


		$html = '
		<style>
		.whatsapp {
			position: fixed;
			bottom:40px;
			right:40px;
			padding: 10px;
			z-index: 10000000;
		}
		</style>
		<div>
			<a href="https://api.whatsapp.com/send?phone='. $options['lj_whatsapp_numero'] .'&text='. $options['lj_whatsapp_texto'] .'" target="_blank" class="btn-whatsapp">
			   <img  class="whatsapp" src="'. plugin_dir_url(__FILE__) .'/imagens/suporte-woocommerce-whatsapp.png" />
			</a>
		</div>
		';

	  echo $html;

	}

}


?>