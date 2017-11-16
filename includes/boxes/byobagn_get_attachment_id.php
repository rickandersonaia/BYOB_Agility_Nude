<?php
/**
 * Created by PhpStorm.
 * User: ander
 * Date: 11/14/2017
 * Time: 10:41 AM
 */

class byobagn_get_attachment_id {

	public function get_attachment_id_from_url( $image_url ) {
		global $wpdb;

		$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM " . $wpdb->posts . " WHERE guid='%s';", $image_url ) );
		return $attachment[0];
	}

}