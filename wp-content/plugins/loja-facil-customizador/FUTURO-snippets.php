<?php 


// remove o email padrão do WordPress
function woo_custom_wp_mail_from() {
        global $woocommerce;
        return html_entity_decode( 'your@email.com' );
}
add_filter( 'wp_mail_from', 'woo_custom_wp_mail_from', 99 );


// produtos em oferta (salve)
function woo_have_onsale_products() {
	
	global $woocommerce;

	// Get products on sale
	$product_ids_on_sale = array_filter( woocommerce_get_product_ids_on_sale() );

	if( !empty( $product_ids_on_sale ) ) {
		return true;
	} else {
		return false;
	}
	
}

// Example:
if( woo_have_onsale_products() ) {
	echo 'have onsale products';
} else {
	echo 'no onsale product';
}


// Valor mínimo para comprar
add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
function wc_minimum_order_amount() {
	global $woocommerce;
	$minimum = 50;
	if ( $woocommerce->cart->get_cart_total() < $minimum ) {
           $woocommerce->add_error( sprintf( 'You must have an order with a minimum of %s to place your order.' , $minimum ) );
	}
}



// remove itens desnecessários no checkout do storefront
add_action( 'wp', 'bbloomer_nodistraction_checkout' );
function bbloomer_nodistraction_checkout() {
   if ( ! is_checkout() ) return;
   remove_action( 'storefront_header', 'storefront_social_icons', 10 );
   remove_action( 'storefront_header', 'storefront_secondary_navigation', 30 );
   remove_action( 'storefront_header', 'storefront_product_search', 40 );
   remove_action( 'storefront_header', 'storefront_primary_navigation', 50 );
   remove_action( 'storefront_header', 'storefront_header_cart', 60 );
   remove_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
}



// dar desconto para comprar mais de 5 itens (o cupom é bulk)
add_action( 'woocommerce_before_cart', 'bbloomer_apply_bulk_coupon' ); 
function bbloomer_apply_bulk_coupon() {
    $coupon_code = 'bulk';
   if ( WC()->cart->get_cart_contents_count() > 5 ) {
       if ( ! WC()->cart->has_discount( $coupon_code ) ) WC()->cart->add_discount( $coupon_code );
   } else {
      if ( WC()->cart->has_discount( $coupon_code ) ) WC()->cart->remove_coupon( $coupon_code );
   }
}



// Embrulhar para presente? Cobrar adicional
add_action( 'woocommerce_before_add_to_cart_quantity', 'bbloomer_gift_wrap', 35 );
function bbloomer_gift_wrap() {    
   ?>
   <label><input type="checkbox" name="gift-wrap" value="Yes">Embrulhar papa presente por R$ 2,00</label>
    <?php
}
   
add_filter( 'woocommerce_add_cart_item_data', 'bbloomer_store_gift', 10, 2 );
function bbloomer_store_gift( $cart_item, $product_id ) {
   if( isset( $_POST['gift-wrap'] ) ) $cart_item['gift-wrap'] = $_POST['gift-wrap'];
   return $cart_item; 
}
 
add_action( 'woocommerce_cart_calculate_fees', 'bbloomer_add_checkout_fee' );
function bbloomer_add_checkout_fee() {
   foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if ( isset( $cart_item['gift-wrap'] ) ) {
            $itsagift = true;
            break;
        }
    }
    if ( $itsagift == true ) WC()->cart->add_fee( 'Gift Wrap', 2 );
}



// Compre um leve outro BOGO (Buy One, Get Other)
add_filter( 'woocommerce_add_to_cart_validation', 'bbloomer_bogo', 10, 3 );
function bbloomer_bogo( $passed, $product_id, $quantity ) {
   $sku_with_gift = 'sku0001';
   $sku_free_gift = 'sku0002'; 
   $product = wc_get_product( $product_id );
   $sku_this = $product->get_sku();
    if ( $sku_this == $skuswithgift ) {
       WC()->cart->add_to_cart( wc_get_product_id_by_sku( $sku_free_gift ) );
   }
   return $passed;
}



// Aviso "Ganhe frete grátis adicionando mais R$ XXX neste pedido"
add_action( 'woocommerce_before_cart', 'bbloomer_free_shipping_cart_notice' );
function bbloomer_free_shipping_cart_notice() {
   $threshold = 80;
   $current = WC()->cart->get_subtotal(); 
   if ( $current < $threshold ) {
      wc_print_notice( 'Get free shipping if you order ' . wc_price( $threshold - $current ) . ' more!', 'notice' );
   }
}




/**
 * Comprar apenas 1 item de cada (não repetir o produto)
 */
add_filter( 'woocommerce_add_to_cart_validation', 'wc_limit_one_per_order', 10, 2 );
function wc_limit_one_per_order( $passed_validation, $product_id ) {
	if ( 31 !== $product_id ) {
		return $passed_validation;
	}

	if ( WC()->cart->get_cart_contents_count() >= 1 ) {
		wc_add_notice( __( 'This product cannot be purchased with other products. Please, empty your cart first and then add it again.', 'woocommerce' ), 'error' );
		return false;
	}

	return $passed_validation;
}



/**
 * Impedindo de adicionar um item 2 vezes
 */
add_filter( 'woocommerce_add_cart_item_data', 'woo_custom_add_to_cart' );
function woo_custom_add_to_cart( $cart_item_data ) {
    global $woocommerce;
    $woocommerce->cart->empty_cart();
    // Do nothing with the data and return
    return $cart_item_data;
}