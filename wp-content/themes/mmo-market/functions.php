<?php
//Child Theme Functions File
add_action( "wp_enqueue_scripts", "enqueue_wp_child_theme" );
function enqueue_wp_child_theme() 
{
	wp_enqueue_style("parent-css", get_template_directory_uri()."/style.css" );

	//This is your child theme stylesheet = style.css
	wp_enqueue_style("child-css", get_stylesheet_uri());

	//This is your child theme js file = js/script.js
	wp_enqueue_script("child-js", get_stylesheet_directory_uri() . "/js/script.js", array( "jquery" ), "1.0", true );
}

add_action( 'woocommerce_after_shop_loop_item_title', 'woo_show_excerpt_shop_page', 15 );

function woo_show_excerpt_shop_page() {
	global $product;
	?>
		<div class="excerpt-shop">
			<?php 
				echo $product->post->post_excerpt;
			?>
		</div>
	<?php
}

// Change curency
add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);
function change_existing_currency_symbol( $currency_symbol, $currency ) {
	switch( $currency ) {
	case 'VND': $currency_symbol = 'VNĐ'; break;
	}
return $currency_symbol;
}
 
// Get stock
add_action( 'woocommerce_after_shop_loop_item_title', 'mmo_show_stock_shop', 11 );
function mmo_show_stock_shop() {
	global $product;
	echo wc_get_stock_html( $product );
}

add_filter( 'woocommerce_checkout_fields' , 'custom_remove_woo_checkout_fields' );
 
function custom_remove_woo_checkout_fields( $fields ) {

    // remove billing fields
    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    unset($fields['billing']['billing_email']);
    
    return $fields;
}