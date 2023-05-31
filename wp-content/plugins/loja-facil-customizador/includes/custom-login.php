<?php 


/**
 * Redireciona o usuário para o painel geral do WooCommerce
 */
function lf_loginRedirect( $redirect_to, $request, $user ){
    if( is_array( $user->roles ) ) { // check if user has a role

        if( function_exists( "is_woocommerce_activated" ) ){
            return "wp-admin/admin.php?page=wc-admin&path=/analytics/overview";
        }
    }

    return $redirect_to;
}
add_filter("login_redirect", "lf_loginRedirect", 10, 3);




// adiciona o logo na tela de login
function lf_logo_login() { 

    if( has_custom_logo() ){
        $logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $logo_id , 'full' );
    ?> 
    <style type="text/css"> 
    body.login div#login h1 a {
        background-image: url(<?php echo $logo[0]; ?>);
        width:<?php echo $logo[1]; ?>px;
        height:<?php echo $logo[2]; ?>px;
        background-size:auto;
    }
    </style>
    <?php 
    }
}
add_action( 'login_enqueue_scripts', 'lf_logo_login' );




/**
 * Adiciona o logo na barra de menus do lado esquerdo superior
 */
function lf_logo_admin() { 

    if( has_custom_logo() ){
        $logo_id = get_theme_mod( 'custom_logo' );
        $logo = wp_get_attachment_image_src( $logo_id , 'full' );
    ?> 
    <style type="text/css"> 
    li#wp-admin-bar-site-name a span {
        background-image: url(<?php echo $logo[0]; ?>);
        background-size: contain;
        background-repeat: no-repeat;
        color:transparent;
    }
    </style>
    <?php 
    }// if has_custom_logo
}
add_action( 'admin_enqueue_scripts', 'lf_logo_admin' );
?>