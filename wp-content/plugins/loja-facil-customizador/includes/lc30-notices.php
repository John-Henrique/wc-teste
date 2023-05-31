<?php 

/**
 * Exibe a notificação dentro do painel do WordPress caso o usuário esteja dentro do dashboard
 */
function lf_notices() {
    global $pagenow;

    
    //echo "<script>console.log( '". get_bloginfo( 'name' ) ."');</script>";

    // verifica se é uma loja teste, se for mostra o banner
    if( get_bloginfo( 'name', 'raw' ) != "LOJA TESTE" ){
        return;
    }


    // está no dashboar?
    if( in_array( $pagenow, array( 'admin.php', 'edit.php' ) ) ){

        /*
        // exibe a notificação
        echo '<div class="notice notice-info is-dismissible">';
        echo '<p>';
        echo '<strong>Pronto para começar sua loja virtual?</strong>';
        echo 'Aproveite esta oferta, contrate a LC30 - loja completa em 30 minutos';
        echo '</strong>';
        echo '</p>';
        echo '</div>';
        */
/*
        echo '<div class="notice imagem">';
        //echo "<img src=\"https://woocommerce.com.br/wp-content/uploads/2021/11/LC30-banner-horizontal.jpg\">";
        echo '  <a href="https://material.woocommerce.com.br/p/oferta-loja-completa-30-minutos" target="_blank">';
        echo "      <img src=\"https://woocommerce.com.br/wp-content/uploads/2021/11/LC30-banner-horizontal.jpg\">";
        echo '  </a>';
        echo '</div>';
        echo "<style>.notice.imagem {
            background: transparent !important;
            border: none;
            padding: 0px;
            box-shadow: none;
            margin: 0px;
        }</style>";
        */
    }
}

add_action( 'admin_notices', 'lf_notices' );
?>
