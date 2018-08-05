<?php

function byobagn_page_details_metaboxes() {

	global $thesis;
	$s = new thesis_schema();
	$s->init();
	$schema_list = $s->select();

	$schema_list['options'][""] = __( 'Default schema', 'byobagn' );

	$filtered_post_types = new byob_get_post_types();
	$post_types          = $filtered_post_types->simple_post_type_list();

	$prefix = 'byob_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'           => 'byobagn_post_page_meta_boxes',
		'title'        => __( 'Agility Page Details', 'byobagn' ),
		'object_types' => $post_types, // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );

	$cmb->add_field( array(
			'name'    => __( 'Page Schema', 'byobagn' ),
			'desc'    => __( 'Choose the schema from the list', 'byobagn' ),
			'id'      => $prefix . 'post_schema',
			'type'    => 'select',
			'options' => $schema_list['options']
		)
	);

	$cmb->add_field( array(
			'name' => __( 'Page Icon', 'byobagn' ),
			'desc' => __( '<br>Enter the code for the desired icon - in this format "<code style="font-style:normal;font-weight:bold;">fa-flag</code>". <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">You can find the available codes here</a>', 'byobagn' ),
			'id'   => $prefix . 'post_icon',
			'type' => 'text_medium'
		)
	);

	$cmb->add_field( array(
			'name'    => __( 'Responsive Video', 'byobagn' ),
			'desc'    => __( 'Check this box if you want to add responsive video script to this page', 'byobagn' ),
			'id'      => $prefix . 'fit_vids',
			'type'    => 'checkbox',
			'options' => array(
				true => __( 'Add Responsive Video Script to this page', 'byobagn' ),
			)
		)
	);

	$cmb->add_field( array(
			'name'    => __( 'Page Specific Widget Content', 'byobagn' ),
			'desc'    => __( 'Enter any content that you wish displayed in the widget here.  This can include video & audio embeds, shortcodes, images and text.  Essentially anything that can be used in the post editor', 'byobagn' ),
			'id'      => $prefix . 'widget_content',
			'type'    => 'wysiwyg',
			'options' => array(
				'wpautop'       => true,
				'textarea_rows' => 5
			),
		)

	);

	$cmb->add_field( array(
			'name'    => __( 'Page Specific Responsive Banner', 'byobagn' ),
			'desc'    => __( 'Check this box if you want to add responsive banner that is unique to this page', 'byobagn' ),
			'id'      => $prefix . 'page_specific_banner',
			'type'    => 'checkbox',
			'options' => array(
				'on' => __( 'Add Responsive Page Specific Banner to this page', 'byobagn' ),
			)
		)
	);
}

function byobagn_page_specific_banner_metaboxes() {

	$filtered_post_types = new byob_get_post_types();
	$post_types          = $filtered_post_types->simple_post_type_list();

	$prefix = 'byob_';

	/**
	 * Initiate the metabox
	 */
	$cmb = new_cmb2_box( array(
		'id'           => 'byobagn_page_specific_banner_meta_boxes',
		'title'        => __( 'Agility Page Specific Banner Details', 'byobagn' ),
		'object_types' => $post_types, // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'show_on_cb'   => 'byobagn_show_if_checked', // function should return a bool value
	) );

	$cmb->add_field( array(
			'name' => __( 'Full Size Image', 'byobagn' ),
			'desc' => __( 'Full width image - 1920 px wide (screen) or page width', 'byobagn' ),
			'id'   => $prefix . 'image_full',
			'type' => 'file',
			'text'    => array(
				'add_upload_file_text' => __( 'Add Full Size Image', 'byobagn' ) // Change upload button text. Default: "Add or Upload File"
			),
			'preview_size' => 'medium', // Image size to use when previewing in the admin.
		)
	);

	$cmb->add_field( array(
			'name' => __( 'Page Width Image', 'byobagn' ),
			'desc' => __( 'Page width image - Check Design Options', 'byobagn' ),
			'id'   => $prefix . 'image_page',
			'type' => 'file',
			'text'    => array(
				'add_upload_file_text' => __( 'Add Page Width Image', 'byobagn' )
			),
			'preview_size' => 'medium',
		)
	);

	$cmb->add_field( array(
			'name' => __( 'Tablet landscape image', 'byobagn' ),
			'desc' => __( 'Tablet landscape image - 1024px wide', 'byobagn' ),
			'id'   => $prefix . 'image_tablet_landscape',
			'type' => 'file',
			'text'    => array(
				'add_upload_file_text' => __( 'Add Tablet Landscape Image', 'byobagn' )
			),
			'preview_size' => 'medium',
		)
	);

	$cmb->add_field( array(
			'name' => __( 'Tablet portrait image', 'byobagn' ),
			'desc' => __( 'Tablet portrait image - 800px wide', 'byobagn' ),
			'id'   => $prefix . 'image_tablet_portrait',
			'type' => 'file',
			'text'    => array(
				'add_upload_file_text' => __( 'Add Tablet Portrait Image', 'byobagn' )
			),
			'preview_size' => 'medium',
		)
	);

	$cmb->add_field( array(
			'name' => __( 'Phone landscape image', 'byobagn' ),
			'desc' => __( 'Phone landscape image - 615px wide', 'byobagn' ),
			'id'   => $prefix . 'image_phone_landscape',
			'type' => 'file',
			'text'    => array(
				'add_upload_file_text' => __( 'Add Phone Landscape Image', 'byobagn' )
			),
			'preview_size' => 'medium',
		)
	);

	$cmb->add_field( array(
			'name' => __( 'Phone portrait image', 'byobagn' ),
			'desc' => __( 'Phone portrait image - 415px wide', 'byobagn' ),
			'id'   => $prefix . 'image_phone_portrait',
			'type' => 'file',
			'text'    => array(
				'add_upload_file_text' => __( 'Add Phone Portrait Image', 'byobagn' )
			),
			'preview_size' => 'medium',
		)
	);

}

function byobagn_show_if_checked( $cmb ) {
	$status = get_post_meta( $cmb->object_id(), 'byob_page_specific_banner', 1 );
	return 'on' === $status;
}
