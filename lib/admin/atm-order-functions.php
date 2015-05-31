<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function atm_register_order_type( $type, $args = array() ) {
	if ( post_type_exists( $type ) ) {
		return false;
	}

	global $atm_order_types;

	if ( ! is_array( $atm_order_types ) ) {
		$atm_order_types = array();
	}

	// Register as a post type
	if ( is_wp_error( register_post_type( $type, $args ) ) ) {
		return false;
	}

	// Register for WC usage
	$order_type_args = array(
		'exclude_from_orders_screen'       => false,
		'add_order_meta_boxes'             => true,
		'exclude_from_order_count'         => false,
		'exclude_from_order_views'         => false,
		'exclude_from_order_reports'       => false,
		'exclude_from_order_sales_reports' => false,
		'class_name'                       => 'ATM_Order'
	);

	$args                    = array_intersect_key( $args, $order_type_args );
	$args                    = wp_parse_args( $args, $order_type_args );
	$atm_order_types[ $type ] = $args;

	return true;
}

function automobile_order_columns( $existing_columns ) {
		$columns                     = array();
		$columns['cb']               = $existing_columns['cb'];
		$columns['order_status']     = '<span class="status_head tips" data-tip="' . esc_attr__( 'Status', 'automobile' ) . '">' . esc_attr__( 'Status', 'automobile' ) . '</span>';
		$columns['order_title']      = __( 'Order', 'automobile' );
		$columns['order_items']      = __( 'Purchased', 'automobile' );
		$columns['shipping_address'] = __( 'Ship to', 'automobile' );
		$columns['customer_message'] = '<span class="notes_head tips" data-tip="' . esc_attr__( 'Customer Message', 'automobile' ) . '">' . esc_attr__( 'Customer Message', 'automobile' ) . '</span>';
		$columns['order_notes']      = '<span class="order-notes_head tips" data-tip="' . esc_attr__( 'Order Notes', 'automobile' ) . '">' . esc_attr__( 'Order Notes', 'automobile' ) . '</span>';
		$columns['order_date']       = __( 'Date', 'automobile' );
		$columns['order_total']      = __( 'Total', 'automobile' );
		$columns['order_actions']    = __( 'Actions', 'automobile' );

		return $columns;
}
/**
	 * Output custom columns for coupons
	 * @param  string $column
	 */
	function render_automobile_order_columns( $column ) {
		global $post, $autoMobile;

		switch ( $column ) {
			case 'order_status' :
				echo '<mark class="on-hold tips atm-tooltip" data-tooltip="On Hold"><i class="fa fa-minus"></i></mark>';
			break;
			case 'order_date' :

				echo 'Order date';

			break;
			case 'customer_message' :
				echo 'cutomer message';
			break;
			case 'order_items' :
				echo 'order item';				
			break;
			case 'shipping_address' :

				echo 'shipping_address';

			break;
			case 'order_notes' :

				echo 'order note';

			break;
			case 'order_total' :
				echo '0';
			break;
			case 'order_title' :
				echo 'Order Title';
			break;
			case 'order_actions' :

				?><p>
					<a class="button tips atm_processing atm-tooltip" data-tooltip="Processing" href="#">
						<i class="fa fa-ellipsis-h"></i>
					</a>
					<a class="button tips atm_complete atm-tooltip" data-tooltip="Complete" href="#">
						<i class="fa fa-check"></i>
					</a>
					<a class="button tips atm_view atm-tooltip" data-tooltip="View" href="#"><i class="fa fa-book"></i></a>				
				</p>
					<?php

			break;
		}
	}