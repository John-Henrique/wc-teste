<?php 

/**
 * Retira meta box de dentro da tela
 */
function remove_meta_boxes() {
    # Removes meta from Posts #
    remove_meta_box('postexcerpt','post','normal' ); 
    remove_meta_box('postcustom','post','normal');
    remove_meta_box('postcustom','shop_order','normal');
    remove_meta_box('dfiFeaturedMetaBox-2','shop_order','normal');
    remove_meta_box('trackbacksdiv','post','normal');
    remove_meta_box('commentstatusdiv','post','normal');
    remove_meta_box('commentsdiv','post','normal');
    # Removes meta from pages #
    remove_meta_box('postexcerpt','page','normal'); // optionally use this if page excerpts are enabled
    remove_meta_box('postcustom','page','normal');
    remove_meta_box('trackbacksdiv','page','normal');
    remove_meta_box('commentstatusdiv','page','normal');
    remove_meta_box('commentsdiv','page','normal');
}
add_action('admin_init','remove_meta_boxes', 999 );




/**
 *
 *  Remove WordPress Dashboard Widgets
 * 
 */
function bt_remove_dashboard_widgets() {
	global $wp_meta_boxes;


	remove_meta_box( 'dashboard_primary','dashboard','side' ); // WordPress.com Blog
	remove_meta_box( 'dashboard_plugins','dashboard','normal' ); // Plugins
	remove_meta_box( 'dashboard_right_now','dashboard', 'normal' ); // Right Now
	remove_meta_box('dashboard_quick_press','dashboard','side'); // Quick Press widget
	remove_meta_box('dashboard_recent_drafts','dashboard','side'); // Recent Drafts
	remove_meta_box('dashboard_secondary','dashboard','side'); // Other WordPress News
	remove_meta_box('dashboard_incoming_links','dashboard','normal'); //Incoming Links
	remove_meta_box('rg_forms_dashboard','dashboard','normal'); // Gravity Forms
	remove_meta_box('dashboard_recent_comments','dashboard','normal'); // Recent Comments
	remove_meta_box('icl_dashboard_widget','dashboard','normal'); // Multi Language Plugin
	remove_meta_box('dashboard_activity','dashboard', 'normal'); // Activity
	remove_meta_box('wc_admin_dashboard_setup', 'dashboard', 'normal');

	remove_meta_box('dashboard_site_health','dashboard', 'normal'); // Activity
	remove_meta_box('woocommerce_dashboard_recent_reviews','dashboard', 'normal'); // Activity
	//remove_meta_box('woocommerce_dashboard_status','dashboard', 'normal'); // Activity
	remove_meta_box('yith_dashboard_products_news','dashboard', 'normal'); // YITH 
	remove_meta_box('yith_dashboard_blog_news','dashboard', 'normal'); // Activity
	remove_meta_box('e-dashboard-overview','dashboard', 'normal'); // Elementor recent
	remove_meta_box('e-dashboard-widget-admin-top-bar','dashboard', 'normal'); // Elementor top bar
	remove_meta_box('aioseo-seo-setup', 'dashboard', 'normal' );
	remove_meta_box('aioseo-overview', 'dashboard', 'normal' );
	remove_meta_box('aioseo-rss-feed', 'dashboard', 'normal');

    remove_meta_box('dfiFeaturedMetaBox-2','shop_order','normal');

	
	remove_action( 'welcome_panel','wp_welcome_panel' ); // Welcome Panel
	remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel'); // Try Gutenberg
}
add_action( 'wp_dashboard_setup', 'bt_remove_dashboard_widgets', 999 );
?>