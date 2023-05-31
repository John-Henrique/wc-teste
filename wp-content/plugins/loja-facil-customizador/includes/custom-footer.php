<?php



/**
 * Customiza o texto de copyright do rodapé
 */
add_filter( 'admin_footer_text', 'lf_admin_footer', 999 );
function lf_admin_footer( $default ){
    return get_bloginfo( 'name' ) ." criado com <a href='https://woocommerce.com.br' target='blank'>WooCommerce.com.br</a>";
}


add_filter( 'update_footer', 'lf_admin_versao', 999 );
function lf_admin_versao(){
    return "Versão ". LOJA_FACIL_VERSION;
}


?>