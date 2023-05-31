<?php 


function add_context_menu_help(){
    //get the current screen object
    $current_screen = get_current_screen();
    /*
    WP_Screen Object
    (
        [action] => 
        [base] => post
        [id] => post
        [is_network] => 
        [is_user] => 
        [parent_base] => edit
        [parent_file] => edit.php
        [post_type] => post
        [taxonomy] => 
    )
    */

/**
 * Menus 
 * dashboard
 * post
 * edit-post
 * update-core
 * edit-category
 * upload
 * media 
 * plugins
 * plugin-install
 * users
 * site-health
 * options-general
 * options-privacy
 * 
 * page
 * edit-page
 * 
 * edit-comments
 * faq
 * edit-faq
 * edit-faq_cat
 * toplevel_page_wpcf7
 * contato_page_wpcf7-new
 * contato_page_wpcf7-integration
 * edit-shop_order
 * edit-shop_coupon
 * woocommerce_page_wc-reports
 * woocommerce_page_wc-settings
 * product
 * edit-product
 * edit-product_cat
 * 
 * 
 */

    //content for help tab
    $content = '<p>Se precisar de ajuda, abra um chamado em <a href="https://woocommerce.com.br/contato" target="_blank">https://woocommerce.com.br/contato</a>.</p>';
    $filler = '<p></p>';
    

    //if($current_screen->id == 'dashboard'){

        //register primary help tab
        $current_screen->add_help_tab( array(
            'id'        => 'sp_basic_help_tab',
            'title'     => __("Contexto ". $current_screen->id ),
            'content'   => "Tela ". $current_screen->id ."   ". $content
        ));
    //}


    if($current_screen->id == 'dashboard' && $current_screen->base == 'edit'){

        //register secondary help tab
        $current_screen->add_help_tab( array(
            'id'        => 'sp_advanced_help_tab',
            'title'     => __('Contexto 2'),
            'content'   => "Tela ". $current_screen->id ."   ". $filler
        ));
    }
}
add_action('admin_head', 'add_context_menu_help');






//add a sidebar to the help menu
function add_help_sidebar(){
    //get the current screen object
    $current_screen = get_current_screen();
    //add the sidebar
    $current_screen->set_help_sidebar(
        '<p><b><a href="https://woocommerce.com.br/contato" target="_blank">Ticket de ajuda</a></b></p><p>Precisa de ajuda? Abra um chamado de assistência aqui.</p>'
    );
}
add_action('admin_head', 'add_help_sidebar');



?>