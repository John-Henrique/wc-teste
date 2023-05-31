<?php



    // verifica se é uma loja teste, se for mostra o banner
    if( get_bloginfo( 'name', 'raw' ) == "LOJA TESTE" ){
        return;
    }


 
    // desabilita a edição de arquivos (temas e plugins)
    define('DISALLOW_FILE_EDIT', true);

    // Desabilita modificar arquivos
    //define('DISALLOW_FILE_MODS', true); // impede atualizações


?>
