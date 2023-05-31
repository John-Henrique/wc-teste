<?php 

/**
 * Remove the Widgets submenu page.
 */
function lf_remove_menus() {

	// usuário conectado
	$current_user = wp_get_current_user();
    
    $dominios = array(
        'woocommerce.com.br',
        'lojafacil.cloud',
        'vibemidia.com.br',
        'wordpress.teste'
    );

    $usuarios = array(
        'suportewc',
        'johnjohn'
    );

    //print_r($_SERVER['HTTP_HOST']);

    // Se o usuário não for suportewc, executar
	if( ( in_array( $current_user->data->user_login, $usuarios ) && ( in_array( $_SERVER['HTTP_HOST'], $dominios ) ) ) ){ 

    
        remove_menu_page( 'plugins.php' );
        //remove_menu_page( 'theme-install.php' );// não consegui desativar
        remove_menu_page( 'loco' );
        remove_menu_page( 'ai1wm_export' );

        remove_submenu_page( 'tools.php', 'import.php' );
        remove_submenu_page( 'tools.php', 'export-personal-data.php' );
        remove_submenu_page( 'tools.php', 'erase-personal-data.php' );
        remove_submenu_page( 'tools.php', 'action-scheduler' );
        remove_submenu_page( 'tools.php', 'export.php' );
        remove_submenu_page( 'tools.php', 'wpsupercache' );       
        remove_submenu_page( 'options-general.php', 'first-admin-theme' );
        remove_submenu_page( 'themes.php', 'starter-sites' );
        remove_submenu_page( 'themes.php', 'theme-dashboard' ); 
        remove_submenu_page( 'woocommerce', 'wc-addons' );
        remove_submenu_page( 'woocommerce', 'wc-addons&section=helper' );
        remove_submenu_page( 'woocommerce', 'wc-reports' );
       // $page = remove_submenu_page( 'options-general.php', 'first-admin-theme' );


       // remove a capacidade de adicionar temas/plugins
       lf_remove_editor_read_private_posts( $current_user->data->ID );

    }

    // remove para colocar em outra posição
    remove_menu_page( 'hfcm-list' );
    remove_menu_page( 'wpcf7' );
    //remove_submenu_page( 'options-general.php', 'hfcm-list' );
    


    // verificando se o plugin existe
    if ( is_plugin_active( 'header-footer-code-manager/99robots-header-footer-code-manager.php' ) ) {
        
        // reposicionando
        //add_submenu_page( 'options-general.php', 'hfcm-list' );
        add_submenu_page(
            'tools.php',
            __('Header Footer Code Manager', '99robots-header-footer-code-manager'),
            "Gerenciador de Códigos",
            'manage_options',
            'hfcm-list',
            array('NNR_HFCM', 'hfcm_list'),
        );
    }



    // verificando se o plugin existe
    if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
        
        // adicionando o meu do contact form 7 dentro do menu Ferramentas
        add_submenu_page(
            'tools.php',
            __( 'Contact Form 7', 'contact-form-7' ),
            __( 'Contact', 'contact-form-7' )
                . wpcf7_admin_menu_change_notice(),
            'wpcf7_read_contact_forms',
            'wpcf7',
            'wpcf7_admin_management_page',
        );
    }
} 
add_action( 'admin_menu', 'lf_remove_menus', 999 );



/*
*
* Remove a capacidade de instalar temas
* @uses WP_Role::remove_cap()
*/
function lf_remove_editor_read_private_posts( $user_id ){

   // get_role returns an instance of WP_Role.
   //$role = get_role( 'administrator' );
   //$role->remove_cap( 'install_themes' );
   //$role = add_cap( 'install_themes', true );

    $user = new WP_User( $user_id );

    if( current_user_can( 'install_themes' ) ){
        $user->remove_cap( 'install_themes' );
    }

    if( current_user_can( 'install_plugins' ) ){
        $user->remove_cap( 'install_plugins' );
        $user->remove_cap( 'activate_plugins' );
    }

}

?>