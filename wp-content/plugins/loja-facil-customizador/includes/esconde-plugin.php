<?php 



/**
 * Esconde todos os plugins listados
 */
function lf_esconde_plugin() {
    global $wp_list_table;

    
	// usuário atual
	$current_user = wp_get_current_user();
    

    // para o usuário suportewc nada será escondido
	if($current_user->data->user_login != 'suportewc'){ 

        $hidearr = array(
            'loja-facil-customizador/loja-facil.php', 
            'first_admin_theme/first-admin-theme.php', 
            'all-in-one-wp-migration/all-in-one-wp-migration.php', 
            'All-In-One-WP-Migration-With-Import-master/all-in-one-wp-migration-wi.php', 
            'duplicator/duplicator.php', 
            'athemes-blocks/athemes-blocks.php', 
            'athemes-starter-sites/athemes-starter-sites.php', 
            'disable-plugin-deactivation/disable-plugin-deactivation.php'
        );
        $myplugins = $wp_list_table->items;
        foreach ($myplugins as $key => $val) {
            if (in_array($key,$hidearr)) {
                unset($wp_list_table->items[$key]);
            }
        }
    }
  }
add_action('pre_current_active_plugins', 'lf_esconde_plugin');

?>
