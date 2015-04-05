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

?>
