<?php
/*
* Author:Mrittunjoy Das
* url: mjdev.in
* Description: Implementing Bootstrap Components in Wordpress custom theme functions.php for (WooCommerce Plugin)
*/
?>
<?php
	/**
	 * Bootstrap Breadcrumb for WooCommerce
	 */
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb',20);
add_action( 'woocommerce_before_main_content','woocommerce_breadcrumb_mjdev');

	function woocommerce_breadcrumb_mjdev( $args = array() ) {
		$args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => '&nbsp;&#47;&nbsp;',
			'wrap_before' => '<ol class="breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>',
			'wrap_after'  => '</ol>',
			'before'      => '',
			'after'       => '&nbsp;',
			'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' )
		) ) );

		$breadcrumbs = new WC_Breadcrumb();

		if ( $args['home'] ) {
		$breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
		}

		$args['breadcrumb'] = $breadcrumbs->generate();

print_r($args['wrap_before']);
	foreach ( $args['breadcrumb'] as $key => $crumb ) {
		echo $before;
		if ( ! empty( $crumb[1] ) && sizeof( $args ) !== $key + 1 ) {
			echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
		} else {
			echo esc_html( $crumb[0] );
		}
		echo $after;
		if ( sizeof( $args['breadcrumb'] ) !== $key + 1 ) {
    print_r($args['delimiter']);
		}
	}
print_r($args['wrap_after']);
}

/*
* Bootstrap buttons overriding existing woocommerce 'add to cart' buttons
*
*/
add_filter( 'woocommerce_loop_add_to_cart_link', 'add_to_cart_mjdev_courses' );
function add_to_cart_mjdev_courses(){
global $product;

/*
* esc_url( $product->add_to_cart_url() )  : returns add to cart link(eg- '/?add-to-cart=110' ) 
* esc_attr( $product->id ) : returns products id ('110')
* esc_attr( $product->get_sku() ) : returns product sku
* esc_attr( isset( $quantity ) ? $quantity : 1 ) : returns product quantity
* $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '' ----- on stock available appends the necessary class
* esc_attr( $product->product_type ) : return type of product
* esc_html( $product->add_to_cart_text() ) : returns button text
 */

$btn_active = $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : 'disabled';
$add_to_cart_text = "Enroll Now";
        return '<a href="'.esc_url( $product->add_to_cart_url() ).'" rel="nofollow" data-product_id="'.esc_attr( $product->id ).'" data-product_sku="'.esc_attr( $product->get_sku() ).'" data-quantity="'.esc_attr( isset( $quantity ) ? $quantity : 1 ).'" class="btn btn-warning btn-lg '.$btn_active.' product_type_"> '.$add_to_cart_text.' <i class="fa fa-rocket"></i></a>';
}



?>
