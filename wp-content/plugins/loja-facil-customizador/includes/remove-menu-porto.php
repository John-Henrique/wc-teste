<?php 
// nada funcionou até agora
/**
 * remove o menu do porto da barra de menu administrativa
 */
add_action( 'admin_menu', function() {
    remove_action( 'admin_bar_menu', 'add_wp_toolbar_menu' );
    remove_menu_page( 'dashicons-porto-logo' );
    //remove_admin_page( 'dashicons-porto-logo' );
}, 999);


/**
 * remove o menu após a renderização
 */
add_action( 'wp_before_admin_bar_render', 'remove_admin_menu_porto' );
function remove_admin_menu_porto() {  
    global $wp_admin_bar;  
    $wp_admin_bar->remove_menu('porto');  
} 

?>