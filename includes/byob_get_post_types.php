<?php

/**
 * Created by PhpStorm.
 * Author: Rick Anderson
 * Date: 7/14/2017
 * Time: 8:36 AM
 * @since 3.2.1
 * Generally used to create the options in a select dropdown.  It excludes typical post types that aren't relevant
 */
class byob_get_post_types {

	private $excluded_post_types = array(
		'revision', // wp
		'nav_menu_item', // wp
		'attachment', // wp
		'custom_css', // wp
		'customize_changeset', // wp
		'product_variation ', // wc
		'product_visibility', // wc
		'shop_order', // wc
		'shop_coupon', // wc
		'shop_webhook', // wc
		'shop_order_refund', // wc
		'shop_subscription', // wcs
		'payment_retry', // wcs
		'wpcf7_contact_form', // cf7
		'bwg_gallery', // photo gallery
		'bwg_album', // photo gallery
		'bwg_tag', // photo gallery
		'wp-types-group', // types
		'wp-types-user-group' // types
	);

	/**
	 * @return array of post types as $name => $label
	 *
	 */
	public function post_types() {
		$post_type_args = array(
			'public' => true
		);
		$get_post_types = get_post_types( $post_type_args, 'objects' );
		$post_types     = array();
		foreach ( $get_post_types as $name => $pt_obj ) {
			if ( ! in_array( $name, $this->excluded_post_types ) ) {
				$post_types[ $name ] = ! empty( $pt_obj->labels->name ) ? esc_html( $pt_obj->labels->name ) : esc_html( $pt_obj->name );
			}
		}

		return $post_types;
	}

	/**
	 * @return array of post types as [] => $name
	 */
	public function simple_post_type_list() {
		$post_type_args = array(
			'public' => true
		);
		$get_post_types = get_post_types( $post_type_args, 'objects' );
		$post_types     = array();
		foreach ( $get_post_types as $name => $pt_obj ) {
			if ( ! in_array( $name, $this->excluded_post_types ) ) {
				$post_types[] = $name;
			}
		}

		return $post_types;
	}
}