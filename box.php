<?php
/*
 * Custom boxes for the BYOB Agility Nude skin - Rick's$boxes
 */

class byobagn_hook extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->name = $this->title = __( 'Agility Hook', 'byobagn' );
	}

	public function html( $args = array() ) {
		global $thesis;
		$hook = trim( $thesis->api->esc( ! empty( $this->options['_id'] ) ?
			$this->options['_id'] : ( ! empty( $this->options['hook'] ) ?
				$this->options['hook'] : '' ) ) );
		! empty( $hook ) ? $thesis->api->hook( "hook_before_$hook" ) : '';
		! empty( $hook ) ? $thesis->api->hook( "hook_top_$hook" ) : '';
		! empty( $hook ) ? $thesis->api->hook( "hook_bottom_$hook" ) : '';
		! empty( $hook ) ? $thesis->api->hook( "hook_after_$hook" ) : '';
	}

}

class byobagn_easy_header extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_column_1',
		'byobagn_column_2',
		'byobagn_column_3',
		'byobagn_column_4'
	);
	public $children = array(
		'byobagn_column_1',
		'byobagn_column_2',
		'byobagn_column_3',
		'byobagn_column_4',
	);
	public $columns = 3;

	protected function translate() {
		$this->name = $this->title = __( 'Agility Easy Header', 'byobagn' );
	}

	public function construct() {
		// This stands in for admin_post hook
		if ( ! empty( $_GET['canvas'] ) && $_GET['canvas'] == $this->_id ) {
			add_action( 'admin_footer', array( $this, 'force_refresh' ) );
		}
	}

	public function force_refresh() {
		?>
		<script>
            jQuery(document).ajaxStop(function () {
                window.location.reload();
                window.location.reload();
            });
		</script>
		<?php
	}

	protected function html_options() {
		global $thesis;
		$options                 = $thesis->api->html_options();
		$options['page_wrapper'] = array(
			'type'    => 'checkbox',
			'label'   => __( 'Remove Page Wrapper', 'byobagn' ),
			'tooltip' => __( 'Choose the configuration for the page wrapper.  If you remove the page wrapper the element will be full width', 'byobagn' ),
			'code'    => true,
			'options' => array(
				'remove' => __( 'Remove the page wrapper', 'byobagn' )
			)
		);
		$options['columns_id']   = array(
			'type'        => 'text',
			'width'       => 'medium',
			'code'        => 'true',
			'label'       => __( 'Change the id to the columns - optional', 'byobagn' ),
			'tooltip'     => __( 'This id will be added to the div that wraps the columns - inside the page wrapper - the default is header_columns', 'byobagn' ),
			'placeholder' => 'header_columns'
		);

		return $options;
	}

	protected function options() {
		global $thesis;
		global $thesis;

		$menus = array();
		foreach ( wp_get_nav_menus() as $menu ) {
			$menus[ (int) $menu->term_id ] = esc_attr( $menu->name );
		}

		$col                        = new byobagn_responsive_columns_helper();
		$options['layout']          = $col->layout_options();
		$options['layout']['label'] = __( 'Select the column configuration for the Header', 'byobagn' );

		$count = 1;
		while ( $count < 5 ) {
			$options[ 'column_content_' . $count ] = array(
				'type'       => 'select',
				'label'      => __( 'Select the content for column ' . $count, 'byobagn' ),
				'options'    => $col->header_options(),
				'dependents' => array( 'multiple' ),
				'default'    => 'rotator'
			);
			$count ++;
		}

		$options['column_content_2']['parent'] = array(
			'layout' => array(
				'columns_2',
				'columns_321',
				'columns_312',
				'columns_413',
				'columns_431',
				'columns_3',
				'columns_4121',
				'columns_4211',
				'columns_4112',
				'columns_4'
			)
		);
		$options['column_content_3']['parent'] = array(
			'layout' => array(
				'columns_3',
				'columns_4121',
				'columns_4211',
				'columns_4112',
				'columns_4'
			)
		);
		$options['column_content_4']['parent'] = array( 'layout' => 'columns_4' );

// come back to this another day - trying to get each header column to take more than one element
//                $count = 1;
//                while ($count < 5) {
//                        foreach (array('_top' => 'Top', '_bottom' => 'Bottom') as $position => $label) {
//                                $options['column_content_' . $count . $position] = array(
//                                        'type' => 'select',
//                                        'label' => __('-- ' . $label . ' section of column ' . $count, 'byobagn'),
//                                        'options' => $col->header_section_options(),
//                                        'default' => 'empty',
//                                        'parent' => array('column_content_' . $count => array('multiple'))
//                                );
//                        }
//                        $count++;
//                }
//                $this->build_column_content();
		return $options;
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );

		$layout                  = ! empty( $this->options['layout'] ) ? $this->options['layout'] : 'columns_3';
		$this->options['layout'] = $layout;

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( 'area_wrapper', false );

		$idout = new byobagn_config_id( $this->options, 'id' );
		$id    = $idout->simple();

		$column_idout = new byobagn_config_id( $this->options, 'columns_id' );
		$column_id    = $column_idout->given( 'header_columns' );

		echo "$tab<div$id$class>\n";

		if ( empty( $this->options['page_wrapper'] ) ) {
			echo "$tab\t<div class=\"page_wrapper\">\n";
		}

		echo "$tab\t\t<div$column_id class=\"$layout\">\n";
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 3 ) ), $this->options );
		echo "$tab\t\t</div>\n";

		if ( empty( $this->options['page_wrapper'] ) ) {
			echo "$tab\t</div>\n";
		}

		echo "$tab\t<div style=\"clear:both\"></div>\n";

		echo "$tab</div>\n";
	}

}

class byobagn_title_and_tagline extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'thesis_site_title',
		'thesis_site_tagline'
	);
	public $children = array(
		'thesis_site_title',
		'thesis_site_tagline'
	);

	protected function translate() {
		$this->name = $this->title = __( 'Title and Tagline', 'byobagn' );
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );

		echo $this->rotator( $args );
	}

}

class byobagn_header_image extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->name = $this->title = __( 'Thesis Header Image', 'byobagn' );
	}

	public function preload() {
		add_action( 'hook_after_html', array( $this, 'footer_scripts' ) );
	}

	public function html( $args = array() ) {
		echo do_action( 'byobagn_header_image_hook' );
	}

	public function footer_scripts() {
		?>
		<script>
            jQuery(document).ready(function ($) {
                $("#thesis_header_image").closest("div").css({"font-size": "0px"});
            });
		</script>
		<?php
	}

}

class byobagn_responsive_images extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->name = $this->title = __( 'Agility Responsive Header Images', 'byobagn' );
	}

	public function construct() {

		if ( is_admin() ) {
			if ( ! empty( $_GET['canvas'] ) && strpos( $_GET['canvas'], 'byobagn' ) === 0 ) {

				add_action( 'admin_enqueue_scripts', array( $this, 'image_loader_styles_and_scripts' ) );
			}
		}
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['class'] );

		return $options;
	}

	public function image_loader_styles_and_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'byobloader', BYOBAGN_URL . '/js/loader.js' );
	}

	public function preload() {
		add_action( 'wp_head', array( $this, 'head_css' ) );
	}

	protected function options() {
		return array(
			'images_full'            => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the full size header image', 'byobagn' ),
				'upload_label' => __( 'Full width header image - 1032px wide', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the header image - recommended image width is 1032px', 'byobagn' ),
			),
			'images_tablet_portrait' => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the tablet portrait header image', 'byobagn' ),
				'upload_label' => __( 'Tablet portrait header image - 700px wide', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the header image - recommended image width is 700px', 'byobagn' )
			),
			'images_phone_landscape' => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the phone landscape header image', 'byobagn' ),
				'upload_label' => __( 'Phone landscape header image - 500px wide', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the header image - recommended image width is 500px', 'byobagn' )
			),
			'images_phone_portrait'  => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the phone portrait header image', 'byobagn' ),
				'upload_label' => __( 'Phone portrait portrait image - 300px wide', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the header image - recommended image width is 300px', 'byobagn' )
			),
			'link_title'             => array(
				'type'        => 'text',
				'width'       => 'long',
				'label'       => __( 'Enter the text that you want for the header image title', 'byobagn' ),
				'tooltip'     => __( 'The title is the text that displays in a tooltip when the user hovers over the header image', 'byobagn' ),
				'placeholder' => __( 'Return to our Home Page', 'byobagn' ),
			),
			'column_width'           => array(
				'type'    => 'select',
				'label'   => __( 'Choose the width of the column the image is located in', 'byobagn' ),
				'tooltip' => __( 'This is primarily for full width images - however you can specify a different column width if you choose', 'byobagn' ),
				'options' => array(
					'full'           => __( 'Full Width Column - default', 'byobagn' ),
					'three-quarters' => __( '3/4 Width Column - default', 'byobagn' ),
					'two-thirds'     => __( '2/3 Width Column - default', 'byobagn' ),
					'half'           => __( '1/2 Width Column - default', 'byobagn' ),
					'one-third'      => __( '1/3 Width Column - default', 'byobagn' ),
					'one-quarter'    => __( '1/4 Width Column - default', 'byobagn' ),
				),
				'default' => 'full'
			)
		);
	}

	public function html( $args = array() ) {
		extract( $args = is_array( $args ) ? $args : array() );
		$tab   = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$title = ! empty( $this->options['link_title'] ) ? esc_attr( $this->options['link_title'] ) : 'Return to our Home Page';
		echo "$tab<a class=\"header-image\" href=\"" . esc_url( site_url() ) . "\" title=\"$title\" > </a>\n";
	}

	public function head_css() {
		$column_width   = ! empty( $this->options['column_width'] ) ? esc_attr( $this->options['column_width'] ) : 'full';
		$full           = $tablet = $phone1 = $phone = "";
		$full_url       = ! empty( $this->options['images_full']['url'] ) ? esc_url( $this->options['images_full']['url'] ) : false;
		$full_ht        = ! empty( $this->options['images_full']['height'] ) ? $this->options['images_full']['height'] : false;
		$tablet_url     = ! empty( $this->options['images_tablet_portrait']['url'] ) ? esc_url( $this->options['images_tablet_portrait']['url'] ) : $full_url;
		$tablet_ht      = ! empty( $this->options['images_tablet_portrait']['height'] ) ? $this->options['images_tablet_portrait']['height'] : $full_ht;
		$phone_land_url = ! empty( $this->options['images_phone_landscape']['url'] ) ? esc_url( $this->options['images_phone_landscape']['url'] ) : $tablet_url;
		$phone_land_ht  = ! empty( $this->options['images_phone_landscape']['height'] ) ? $this->options['images_phone_landscape']['height'] : $tablet_ht;
		$phone_port_url = ! empty( $this->options['images_phone_portrait']['url'] ) ? esc_url( $this->options['images_phone_portrait']['url'] ) : $phone_land_url;
		$phone_port_ht  = ! empty( $this->options['images_phone_portrait']['height'] ) ? $this->options['images_phone_portrait']['height'] : $phone_land_ht;
		$id             = ! empty( $this->options['id'] ) ? esc_attr( $this->options['id'] ) : 'header_columns';

		if ( $full_url ) {
			$full   = "\n #" . $id . " .$column_width{padding-left:0; padding-right:0} #" . $id . " .$column_width a.header-image{display:block; background-image:url('" . $full_url . "'); background-position:top center; background-repeat:no-repeat; height:{$full_ht}px; width:100%;} \n";
			$tablet = "\n @media only screen and (max-width:1024px), screen and (max-device-width:1024px) and (orientation:landscape){ #" . $id . " .$column_width a.header-image{display:block; background-image:url('" . $tablet_url . "'); background-position:top center; background-repeat:no-repeat; height:{$tablet_ht}px; width:100%;} }\n";
			$phonel = "\n @media only screen and (max-width:800px), screen and (max-device-width:800px) and (orientation:portrait){ #" . $id . " .$column_width a.header-image{display:block; background-image:url('" . $phone_land_url . "'); background-position:top center; background-repeat:no-repeat; height:{$phone_land_ht}px; width:100%;} }\n";
			$phone  = "\n @media only screen and (max-width:500px), screen and (max-device-width:500px){ #" . $id . " .$column_width a.header-image{display:block; background-image:url('" . $phone_port_url . "'); background-position:top center; background-repeat:no-repeat; height:{$phone_port_ht}px; width:100%;} }\n";
			echo "\n <style type=\"text/css\">" . $full . $tablet . $phonel . $phone . "</style> \n";
		} else {
			return;
		}
	}

}

class byobagn_template_responsive_image extends thesis_box {
	public $type = 'box';

	protected function translate() {
		$this->name = $this->title = __( 'Agility Template Responsive Image', 'byobagn' );
	}

	public function construct() {

		if ( is_admin() ) {
			if ( ! empty( $_GET['canvas'] ) && strpos( $_GET['canvas'], 'byobagn' ) === 0 ) {

				add_action( 'admin_enqueue_scripts', array( $this, 'image_loader_styles_and_scripts' ) );
			}
		}
	}

	public function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function image_loader_styles_and_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'byobloader', BYOBAGN_URL . '/js/loader.js' );
	}

	protected function options() {
		return array(
			'image_full'             => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the full size image', 'byobagn' ),
				'upload_label' => __( 'Full width image - 1920 px wide (screen) or page width', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the image - recommended image width is 1920px', 'byobagn' ),
			),
			'image_page'             => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the page width image', 'byobagn' ),
				'upload_label' => __( 'Page width image', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the image - recommended image width is width of page', 'byobagn' ),
			),
			'image_tablet_landscape' => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the tablet landscape image', 'byobagn' ),
				'upload_label' => __( 'Tablet landscape image - 1024px wide', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the image - recommended image width is 1032', 'byobagn' )
			),
			'image_tablet_portrait'  => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the tablet portrait  image', 'byobagn' ),
				'upload_label' => __( 'Tablet portrait image - 800px wide', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the  image - recommended image width is 800px', 'byobagn' )
			),
			'image_phone_landscape'  => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the phone landscape image', 'byobagn' ),
				'upload_label' => __( 'Phone landscape  image - 615px wide', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the  image - recommended image width is 615px', 'byobagn' )
			),
			'image_phone_portrait'   => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose the phone portrait  image', 'byobagn' ),
				'upload_label' => __( 'Phone portrait portrait image - 415px wide', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the  image - recommended image width is 415px', 'byobagn' )
			),
			'alt_text'               => array(
				'type'    => 'text',
				'width'   => 'long',
				'label'   => __( 'Enter the alt text', 'byobagn' ),
				'tooltip' => __( 'This is the alt text that shows up in screen readers - good for SEO', 'byobagn' )
			)
		);
	}

	public function html( $args = array() ) {
		extract( $args = is_array( $args ) ? $args : array() );
		$tab    = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$output = '';

		if ( empty( $this->options['image_full'] ) ) {
			return '';
		}
		$base = get_site_url();

		$full_url = ! empty( $this->options['image_full']['url'] ) ? $base . esc_url( $this->options['image_full']['url'] ) : false;
		$full_id  = attachment_url_to_postid( $full_url );

		$alt = ! empty( $this->options['alt_text'] ) ? esc_attr( $this->options['alt_text'] ) : '';

		$single = $this->single_or_multiple_images();

		if ( true === $single ) {
			$output = $this->srcset_from_single_image_id( $alt, $full_id, $full_url );
		} else {
			$output = $this->picture_from_multiple_images( $alt );
		}
		echo $tab . $output;
	}

	public function single_or_multiple_images() {
		if ( ! empty( $this->options['image_full'] )
		     && empty( $this->options['image_page'] )
		     && empty( $this->options['image_tablet_landscape'] )
		     && empty( $this->options['image_tablet_portrait'] )
		     && empty( $this->options['image_phone_landscape'] )
		     && empty( $this->options['image_phone_portrait'] )
		) {
			return true;
		} else {
			return false;
		}
	}

	public function picture_from_multiple_images( $alt ) {
		$base            = get_site_url();
		$full_url        = ! empty( $this->options['image_full']['url'] ) ? $base . esc_url( $this->options['image_full']['url'] ) : false;
		$page_url        = ! empty( $this->options['image_page']['url'] ) ? $base . esc_url( $this->options['image_page']['url'] ) : $full_url;
		$tablet_land_url = ! empty( $this->options['image_tablet_landscape']['url'] ) ? $base . esc_url( $this->options['image_tablet_landscape']['url'] ) : $page_url;
		$tablet_port_url = ! empty( $this->options['image_tablet_portrait']['url'] ) ? $base . esc_url( $this->options['image_tablet_portrait']['url'] ) : $tablet_land_url;
		$phone_land_url  = ! empty( $this->options['image_phone_landscape']['url'] ) ? $base . esc_url( $this->options['image_phone_landscape']['url'] ) : $tablet_port_url;
		$phone_port_url  = ! empty( $this->options['image_phone_portrait']['url'] ) ? $base . esc_url( $this->options['image_phone_portrait']['url'] ) : $phone_land_url;
		$output          = "<picture>\n";
		$output          .= "\t<source media=\"(max-width: 615px)\" srcset=\"$phone_port_url\">\n";
		$output          .= "\t<source media=\"(max-width: 415px)\" srcset=\"$phone_land_url\">\n";
		$output          .= "\t<source media=\"(max-width: 800px)\" srcset=\"$tablet_port_url\">\n";
		$output          .= "\t<source media=\"(max-width: 1024px)\" srcset=\"$tablet_land_url\">\n";
		$output          .= "\t<source media=\"(max-width: 1140px)\" srcset=\"$page_url\">\n";
		$output          .= "\t<source media=\"(min-width: 1141px)\" srcset=\"$full_url\">\n";
		$output          .= "\t<img class=\"banner-image\" src=\"$full_url\" alt=\"$alt\">\n";
		$output          .= "</picture>\n";

		return $output;
	}

	public function srcset_from_single_image_id( $alt, $id, $img_url ) {
		$attachment_id = $id;
		$image_meta    = wp_get_attachment_metadata( $attachment_id );
		$content       = "<img class=\"banner-image\" src=\"$img_url\" alt=\"$alt\">";
		$output        = wp_image_add_srcset_and_sizes( $content, $image_meta, $attachment_id );

		return $output;
	}

}

class byobagn_easy_responsive_columns extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_column_1',
		'byobagn_column_2',
		'byobagn_column_3',
		'byobagn_column_4',
	);
	public $children = array(
		'byobagn_column_1',
		'byobagn_column_2'
	);

	protected function translate() {
		$this->name = $this->title = __( 'Agility Easy Responsive Columns Section', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$thesis_options                   = $thesis->api->html_options( array(
			'div'     => 'div',
			'main'    => 'main',
			'header'  => 'header',
			'footer'  => 'footer',
			'aside'   => 'aside',
			'section' => 'section',
			'nav'     => 'nav'
		), 'div' );
		$thesis_options['html']['label']  = __( 'HTML tag for column wrapper', 'byobagn' );
		$thesis_options['class']['label'] = __( 'HTML <code>class</code> for column wrapper', 'byobagn' );
		$thesis_options['id']['label']    = __( 'HTML <code>id</code> for column wrapper', 'byobagn' );
		$layout_options['layout']         = array(
			'type'       => 'select',
			'label'      => __( 'Select the column configuration for this column wrapper', 'byobagn' ),
			'options'    => array(
				'columns_1'    => __( 'Single column', 'byobagn' ),
				'columns_2'    => __( 'Two columns, equally sized', 'byobagn' ),
				'columns_321'  => __( 'Two columns, two thirds - one third', 'byobagn' ),
				'columns_312'  => __( 'Two columns, one third - two thirds', 'byobagn' ),
				'columns_431'  => __( 'Two columns, three quarters - one quarter', 'byobagn' ),
				'columns_413'  => __( 'Two columns, one quarter - three quarters', 'byobagn' ),
				'columns_3'    => __( 'Three columns, equally sized', 'byobagn' ),
				'columns_4211' => __( 'Three columns, one half - one quarter - one quarter', 'byobagn' ),
				'columns_4121' => __( 'Three columns, one quarter - one half - one quarter', 'byobagn' ),
				'columns_4112' => __( 'Three columns, one quarter - one quarter - one half', 'byobagn' ),
				'columns_4'    => __( 'Four columns, equally sized', 'byobagn' )
			),
			'dependents' => array( 'columns_312', 'columns_413', 'columns_4121', 'columns_4112' )
		);
		$layout_options['reverse']        = array(
			'type'    => 'checkbox',
			'label'   => __( 'Keep content column first on mobile', 'byobagn' ),
			'tooltip' => __( 'By checking this box the content column will display first on smaller mobile devices', 'byobagn' ),
			'options' => array(
				'use' => __( 'Display content first', 'byobagn' )
			),
			'parent'  => array(
				'layout' => array( 'columns_312', 'columns_413', 'columns_4121', 'columns_4112' )
			)
		);
		$options['use_area']              = array(
			'type'       => 'checkbox',
			'label'      => __( 'Add the "area wrapper" around these columns', 'byobagn' ),
			'tooltip'    => __( 'By checking this box you will create a wrapping div with the class of "area wrapper" - which is the main full screen horizontal element', 'byobagn' ),
			'options'    => array(
				'use' => __( 'Wrap this with "area wrapper"', 'byobagn' )
			),
			'dependents' => array( 'use' )
		);
		$options['area_id']               = array(
			'type'    => 'text',
			'width'   => 'medium',
			'code'    => 'true',
			'label'   => __( 'Add an id to the "area wrapper" - optional', 'byobagn' ),
			'tooltip' => __( 'This id will be added to the div with the class of "area wrapper" - which is the main full screen horizontal element', 'byobagn' ),
			'parent'  => array(
				'use_area' => 'use'
			)
		);
		$options['area_class']            = array(
			'type'    => 'text',
			'width'   => 'medium',
			'code'    => 'true',
			'label'   => __( 'Add another class to the "area wrapper" - optional', 'byobagn' ),
			'tooltip' => __( 'This class will be added to the div with the class of "area wrapper" - which is the main full screen horizontal element', 'byobagn' ),
			'parent'  => array(
				'use_area' => 'use'
			)
		);

		$options['overlay']            = array(
			'type'       => 'checkbox',
			'label'      => __( 'Add an Overlay element', 'byobagn' ),
			'tooltip'    => __( 'By checking this box you will add an overlay div between the area and the page wrapper', 'byobagn' ),
			'options'    => array(
				'add' => __( 'Add an overlay element', 'byobagn' )
			),
			'dependents' => array( 'add' ),
			'parent'     => array(
				'use_area' => 'use'
			)
		);
		$options['overlay_skin_class'] = array(
			'type'       => 'select',
			'label'      => __( 'Overlay Style', 'byobagn' ),
			'tooltip'    => __( 'Select a style for the overlay section', 'byobagn' ),
			'options'    => array(
				''          => __( 'Default', 'byobagn' ),
				'overlay-1' => __( 'Overlay Style 1', 'byobagn' ),
				'overlay-2' => __( 'Overlay Style 2', 'byobagn' ),
				'overlay-3' => __( 'Overlay Style 3', 'byobagn' ),
				'custom'    => __( 'Enter a custom class', 'byobagn' ),
			),
			'dependents' => array( 'custom' ),
			'parent'     => array(
				'overlay' => 'add'
			)
		);
		$options['overlay_class']      = array(
			'type'    => 'text',
			'width'   => 'medium',
			'code'    => true,
			'label'   => __( 'Overlay Class', 'byobagn' ),
			'tooltip' => __( 'Enter a class name for the overlay section', 'byobagn' ),
			'parent'  => array(
				'overlay_skin_class' => 'custom'
			)
		);
		$options['page_wrapper']       = array(
			'type'    => 'checkbox',
			'label'   => __( 'Remove Page Wrapper', 'byobagn' ),
			'tooltip' => __( 'Choose the configuration for the page wrapper.  If you remove the page wrapper the element will be full width', 'byobagn' ),
			'code'    => true,
			'options' => array(
				'remove' => __( 'Remove the page wrapper', 'byobagn' )
			)
		);

		$options['remove_padding'] = array(
			'type'    => 'checkbox',
			'label'   => __( 'Remove the typical padding from the columns', 'byobagn' ),
			'tooltip' => __( 'By checking this box you will add the class of "frameless" to the column wrapper', 'byobagn' ),
			'options' => array(
				'remove' => __( 'Remove the typcial padding', 'byobagn' )
			)
		);

		$options['v_padding'] = array(
			'type'   => 'group',
			'label'  => __( 'Remove top & bottom padding from column wrapper', 'byobagn' ),
			'fields' => array(
				'v_padding' => array(
					'tooltip' => __( 'Theses options will remove default padding from the top and bottom of the column wrapper', 'byobagn' ),
					'type'    => 'checkbox',
					'options' => array(
						'padding-top'    => __( 'Remove top padding', 'byobagn' ),
						'padding-bottom' => __( 'Remove bottom padding', 'byobagn' ),
					)
				)
			)
		);

		$options['include_heading'] = array(
			'type'       => 'checkbox',
			'label'      => __( 'Add a Heading above this Columns Section', 'byobagn' ),
			'tooltip'    => __( 'By checking this box you will add a section heading above this columns section', 'byobagn' ),
			'options'    => array(
				'add' => __( 'Add a section heading', 'byobagn' )
			),
			'dependents' => array( 'add' )
		);
		$options['section_heading'] = array(
			'type'        => 'text',
			'width'       => 'full',
			'code'        => true,
			'label'       => __( 'Section Heading', 'byobagn' ),
			'tooltip'     => __( 'Enter your heading text - html is ok', 'byobagn' ),
			'placeholder' => __( 'My Section Heading', 'byobagn' ),
			'parent'      => array(
				'include_heading' => 'add'
			)
		);
		$options['position']        = array(
			'type'    => 'checkbox',
			'label'   => __( 'Place the Section Heading outside the page wrapper', 'byobagn' ),
			'tooltip' => __( 'By default the section heading is within the page wrapper', 'byobagn' ),
			'options' => array(
				'outside' => __( 'Place section heading outside the page wrapper', 'byobagn' )
			),
			'parent'  => array(
				'include_heading' => 'add'
			)
		);

		return array_merge( $layout_options, $thesis_options, $options );
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab            = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$remove_padding = ! empty( $this->options['remove_padding'] ) ? 'frameless' : '';
		$padding_top    = ! empty( $this->options['v_padding']['padding-top'] ) ? $this->options['v_padding']['padding-top'] : false;
		$padding_bottom = ! empty( $this->options['v_padding']['padding-bottom'] ) ? $this->options['v_padding']['padding-bottom'] : false;
		$layout         = ! empty( $this->options['layout'] ) ? $this->options['layout'] : 'columns_321';
		$overlay        = ! empty( $this->options['overlay']['add'] ) ? true : false;

		$overlay_skin_class = ( ! empty( $this->options['overlay_skin_class'] ) && $this->options['overlay_skin_class'] !== 'custom' ) ? ' ' . esc_attr( $this->options['overlay_skin_class'] ) : false;
		if ( $overlay_skin_class ) {
			$overlay_class = $overlay_skin_class;
		} else {
			$overlay_class = ! empty( $this->options['overlay_class'] ) ? ' ' . esc_attr( $this->options['overlay_class'] ) : '';
		}
		$secondary = $remove_padding . $overlay_class;

		$section_heading = ! empty( $this->options['section_heading'] ) ? wp_kses_post( $this->options['section_heading'] ) : false;
		$outside         = isset( $this->options['position']['otside'] ) ? true : false;

		$style = "";

		if ( $padding_top || $padding_bottom ) {
			$style = ' style="';
			if ( $padding_top ) {
				$style .= 'padding-top:0; ';
			}
			if ( $padding_bottom ) {
				$style .= 'padding-bottom:0;';
			}
			$style .= '" ';
		}

		$areaclassout = new byobagn_config_classes( $this->options, 'area_class' );
		$area_class   = $areaclassout->secondary( 'area_wrapper', false, $secondary );

		$areaidout = new byobagn_config_id( $this->options, 'area_id' );
		$area_id   = $areaidout->simple();

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( $layout, false );

		$idout = new byobagn_config_id( $this->options, 'id' );
		$id    = $idout->simple();


		if ( ! empty( $this->options['use_area'] ) ) {
			echo "$tab<div$area_id$area_class>\n";
		}
		if ( $overlay ) {
			echo "$tab\t<div class=\"overlay\">\n";
		}
		if ( isset( $this->options['include_heading']['add'] ) && $section_heading && $outside ) {
			echo "$tab\t\t\t<p class=\"section_title\">$section_heading</p>\n";
		}
		if ( empty( $this->options['page_wrapper'] ) ) {
			echo "$tab\t<div class=\"page_wrapper\">\n";
		}
		if ( isset( $this->options['include_heading']['add'] ) && $section_heading && ! $outside ) {
			echo "$tab\t\t\t<p class=\"section_title\">$section_heading</p>\n";
		}

		echo "$tab\t\t<div$id$class$style>\n";
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 3 ) ), $this->options );
		echo "$tab\t\t</div>\n";

		if ( empty( $this->options['page_wrapper'] ) ) {
			echo "$tab\t</div>\n";
		}
		if ( ! empty( $this->options['use_area'] ) ) {
			echo "$tab\t<div style=\"clear:both\"></div>\n";
			if ( $overlay ) {
				echo "$tab\t</div>\n";
			}
			echo "$tab</div>\n";
		}
//                var_dump($this->options);
	}

}

class byobagn_column_1 extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->title = __( 'Column 1', 'byobagn' );
	}

	public function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array(), $options = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$column_no = 1;

		$options['class'] = ! empty( $this->options['class'] ) ? $this->options['class'] : '';

		$hoptions = new byobagn_responsive_columns_helper( $options, $column_no );
		$config   = $hoptions->column_1();
		$start    = $hoptions->open_html( $args );
		$end      = $hoptions->close_html( $args );
//                var_dump($this->options);
		echo $start;
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 3 ) ) );
		echo $end;
	}

}

class byobagn_column_2 extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->title = __( 'Column 2', 'byobagn' );
	}

	public function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array(), $options = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$column_no = 2;

		$options['class'] = ! empty( $this->options['class'] ) ? $this->options['class'] : '';

		$hoptions = new byobagn_responsive_columns_helper( $options, $column_no );
		$config   = $hoptions->column_2();
		$start    = $hoptions->open_html( $args );
		$end      = $hoptions->close_html( $args );
//                var_dump($this->options);
		echo $start;
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 3 ) ) );
		echo $end;
	}

}

class byobagn_column_3 extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->title = __( 'Column 3', 'byobagn' );
	}

	public function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array(), $options = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$column_no = 3;

		$options['class'] = ! empty( $this->options['class'] ) ? $this->options['class'] : '';

		$hoptions = new byobagn_responsive_columns_helper( $options, $column_no );
		$config   = $hoptions->column_3();
		$start    = $hoptions->open_html( $args );
		$end      = $hoptions->close_html( $args );
//                var_dump($this->options);
		echo $start;
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 3 ) ) );
		echo $end;
	}

}

class byobagn_column_4 extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->title = __( 'Column 4', 'byobagn' );
	}

	public function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array(), $options = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$column_no = 4;

		$options['class'] = ! empty( $this->options['class'] ) ? $this->options['class'] : '';

		$hoptions = new byobagn_responsive_columns_helper( $options, $column_no );
		$config   = $hoptions->column_4();
		$start    = $hoptions->open_html( $args );
		$end      = $hoptions->close_html( $args );
//                var_dump($this->options);
		echo $start;
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 3 ) ) );
		echo $end;
	}

}

class byobagn_sub_columns extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_column_1',
		'byobagn_column_2',
		'byobagn_column_3',
		'byobagn_column_4'
	);
	public $children = array(
		'byobagn_column_1',
		'byobagn_column_2'
	);

	protected function translate() {
		$this->name = $this->title = __( 'Agility Subcolumns Section', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options           = $thesis->api->html_options();
		$options['layout'] = array(
			'type'    => 'select',
			'label'   => __( 'Select the column configuration for this column wrapper', 'byobagn' ),
			'options' => array(
				'sub_columns_2' => __( 'Two columns, equally sized', 'byobagn' ),
				'sub_columns_3' => __( 'Three columns, equally sized', 'byobagn' ),
				'sub_columns_4' => __( 'Four columns, equally sized', 'byobagn' )
			)
		);

		return $options;
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab    = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$layout = ! empty( $this->options['layout'] ) ? $this->options['layout'] : 'columns_2';

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( $layout, false );

		$idout = new byobagn_config_id( $this->options, 'id' );
		$id    = $idout->simple();


		echo "$tab<div$id$class>\n";
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ), $this->options );
		echo "$tab</div>\n";
	}

}

class byobagn_content_grid extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_column_1',
		'byobagn_column_2',
		'byobagn_column_3',
		'byobagn_column_4'
	);
	public $children = array(
		'byobagn_column_1',
		'byobagn_column_2',
		'byobagn_column_3',
		'byobagn_column_4',
	);
	public $columns = 3;

	protected function translate() {
		$this->name = $this->title = __( 'Agility Content Grid Section', 'byobagn' );
	}

	public function construct() {
		// This stands in for admin_post hook
		if ( ! empty( $_GET['canvas'] ) && $_GET['canvas'] == $this->_id ) {
			add_action( 'admin_footer', array( $this, 'force_refresh' ) );
		}
	}

	public function force_refresh() {
		?>
		<script>
            jQuery(document).ajaxStop(function () {
                window.location.reload();
                window.location.reload();
            });
		</script>
		<?php
	}

	protected function html_options() {
		global $thesis;
		$options                   = $thesis->api->html_options();
		$options['page_wrapper']   = array(
			'type'    => 'checkbox',
			'label'   => __( 'Remove Page Wrapper', 'byobagn' ),
			'tooltip' => __( 'Choose the configuration for the page wrapper.  If you remove the page wrapper the element will be full width', 'byobagn' ),
			'code'    => true,
			'options' => array(
				'remove' => __( 'Remove the page wrapper', 'byobagn' )
			)
		);
		$options['remove_padding'] = array(
			'type'    => 'checkbox',
			'label'   => __( 'Remove the typical padding from the area wrapper', 'byobagn' ),
			'tooltip' => __( 'By checking this box you will add the class of "frameless" to the page wrapper', 'byobagn' ),
			'options' => array(
				'remove' => __( 'Remove the typcial padding', 'byobagn' )
			)
		);

		$options['v_padding'] = array(
			'type'   => 'group',
			'label'  => __( 'Remove top & bottom padding from column wrapper', 'byobagn' ),
			'fields' => array(
				'v_padding' => array(
					'tooltip' => __( 'Theses options will remove default padding from the top and bottom of the column wrapper', 'byobagn' ),
					'type'    => 'checkbox',
					'options' => array(
						'padding-top'    => __( 'Remove top padding', 'byobagn' ),
						'padding-bottom' => __( 'Remove bottom padding', 'byobagn' ),
					)
				)
			)
		);

		return $options;
	}

	protected function options() {
		global $thesis;
		$options['layout'] = array(
			'type'       => 'select',
			'label'      => __( 'Select the column configuration for this column wrapper', 'byobagn' ),
			'options'    => array(
				'columns_1'    => __( 'Single column', 'byobagn' ),
				'columns_2'    => __( 'Two columns, equally sized', 'byobagn' ),
				'columns_321'  => __( 'Two columns, two thirds - one third', 'byobagn' ),
				'columns_312'  => __( 'Two columns, one third - two thirds', 'byobagn' ),
				'columns_431'  => __( 'Two columns, three quarters - one quarter', 'byobagn' ),
				'columns_413'  => __( 'Two columns, one quarter - three quarters', 'byobagn' ),
				'columns_3'    => __( 'Three columns, equally sized', 'byobagn' ),
				'columns_4211' => __( 'Three columns, one half - one quarter - one quarter', 'byobagn' ),
				'columns_4121' => __( 'Three columns, one quarter - one half - one quarter', 'byobagn' ),
				'columns_4112' => __( 'Three columns, one quarter - one quarter - one half', 'byobagn' ),
				'columns_4'    => __( 'Four columns, equally sized', 'byobagn' )
			),
			'dependents' => array(
				'columns_2',
				'columns_321',
				'columns_312',
				'columns_413',
				'columns_431',
				'columns_3',
				'columns_4121',
				'columns_4211',
				'columns_4112',
				'columns_4'
			)
		);
		$count             = 1;
		while ( $count < 5 ) {
			$options[ 'column_content_' . $count ] = array(
				'type'    => 'select',
				'label'   => __( 'Select the content for column ' . $count, 'byobagn' ),
				'options' => array(
					'featured_content' => __( 'Featured Content Box', 'byobagn' ),
					'icon_content'     => __( 'Icon Content Box', 'byobagn' ),
					'widget_area'      => __( 'Widget Area', 'byobagn' ),
					'text_box'         => __( 'Thesis Text Box', 'byobagn' ),
					'call_to_action'   => __( 'Call to Action', 'byobagn' ),
					'copyright'        => __( 'Copyright', 'byobagn' ),
					'nav_menu'         => __( 'A WordPress menu', 'byobagn' ),
					'rotator'          => __( 'None, I&apos;ll drag something else there myself', 'byobagn' ),
				),
				'default' => 'rotator'
			);
			$count ++;
		}
		$options['column_content_2']['parent'] = array(
			'layout' => array(
				'columns_2',
				'columns_321',
				'columns_312',
				'columns_413',
				'columns_431',
				'columns_3',
				'columns_4121',
				'columns_4211',
				'columns_4112',
				'columns_4'
			)
		);
		$options['column_content_3']['parent'] = array(
			'layout' => array(
				'columns_3',
				'columns_4121',
				'columns_4211',
				'columns_4112',
				'columns_4'
			)
		);
		$options['column_content_4']['parent'] = array( 'layout' => 'columns_4' );

		$options['overlay']            = array(
			'type'       => 'checkbox',
			'label'      => __( 'Add an Overlay element', 'byobagn' ),
			'tooltip'    => __( 'By checking this box you will add an overlay div between the outer wrapper and the page wrapper', 'byobagn' ),
			'options'    => array(
				'add' => __( 'Add an overlay element', 'byobagn' )
			),
			'dependents' => array( 'add' )
		);
		$options['overlay_skin_class'] = array(
			'type'       => 'select',
			'label'      => __( 'Overlay Style', 'byobagn' ),
			'tooltip'    => __( 'Select a style for the overlay section', 'byobagn' ),
			'options'    => array(
				''          => __( 'Default', 'byobagn' ),
				'overlay-1' => __( 'Overlay Style 1', 'byobagn' ),
				'overlay-2' => __( 'Overlay Style 2', 'byobagn' ),
				'overlay-3' => __( 'Overlay Style 3', 'byobagn' ),
				'custom'    => __( 'Enter a custom class', 'byobagn' ),
			),
			'dependents' => array( 'custom' ),
			'parent'     => array(
				'overlay' => 'add'
			)
		);
		$options['overlay_class']      = array(
			'type'    => 'text',
			'width'   => 'medium',
			'code'    => true,
			'label'   => __( 'Overlay Class', 'byobagn' ),
			'tooltip' => __( 'Enter a class name for the overlay section', 'byobagn' ),
			'parent'  => array(
				'overlay_skin_class' => 'custom'
			)
		);
		$options['include_heading']    = array(
			'type'       => 'checkbox',
			'label'      => __( 'Add a Heading above this Content Grid Section', 'byobagn' ),
			'tooltip'    => __( 'By checking this box you will add a section heading above this content grid', 'byobagn' ),
			'options'    => array(
				'add' => __( 'Add a section heading', 'byobagn' )
			),
			'dependents' => array( 'add' )
		);
		$options['section_heading']    = array(
			'type'        => 'text',
			'width'       => 'full',
			'code'        => true,
			'label'       => __( 'Section Heading', 'byobagn' ),
			'tooltip'     => __( 'Enter your heading text - html is ok', 'byobagn' ),
			'placeholder' => __( 'My Section Heading', 'byobagn' ),
			'parent'      => array(
				'include_heading' => 'add'
			)
		);
		$options['position']           = array(
			'type'    => 'checkbox',
			'label'   => __( 'Place the Section Heading outside the page wrapper', 'byobagn' ),
			'tooltip' => __( 'By default the section heading is within the page wrapper', 'byobagn' ),
			'options' => array(
				'outside' => __( 'Place section heading outside the page wrapper', 'byobagn' )
			),
			'parent'  => array(
				'include_heading' => 'outside'
			)
		);

//                $this->build_column_content();
		return $options;
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab     = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$overlay = ! empty( $this->options['overlay']['add'] ) ? true : false;

		$overlay_skin_class = ( ! empty( $this->options['overlay_skin_class'] ) && $this->options['overlay_skin_class'] !== 'custom' ) ? ' ' . esc_attr( $this->options['overlay_skin_class'] ) : false;
		if ( $overlay_skin_class ) {
			$overlay_class = $overlay_skin_class;
		} else {
			$overlay_class = ! empty( $this->options['overlay_class'] ) ? ' ' . esc_attr( $this->options['overlay_class'] ) : '';
		}

		$remove_padding          = ! empty( $this->options['remove_padding'] ) ? 'frameless' : '';
		$padding_top             = ! empty( $this->options['v_padding']['padding-top'] ) ? $this->options['v_padding']['padding-top'] : false;
		$padding_bottom          = ! empty( $this->options['v_padding']['padding-bottom'] ) ? $this->options['v_padding']['padding-bottom'] : false;
		$layout                  = ! empty( $this->options['layout'] ) ? $this->options['layout'] : 'columns_3';
		$this->options['layout'] = $layout;
		$secondary               = $remove_padding . $overlay_class;

		$section_heading = ! empty( $this->options['section_heading'] ) ? wp_kses_post( $this->options['section_heading'] ) : false;
		$outside         = isset( $this->options['position']['otside'] ) ? true : false;

		$style = "";

		if ( $padding_top || $padding_bottom ) {
			$style = ' style="';
			if ( $padding_top ) {
				$style .= 'padding-top:0; ';
			}
			if ( $padding_bottom ) {
				$style .= 'padding-bottom:0;';
			}
			$style .= '" ';
		}


		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->secondary( 'area_wrapper', false, $secondary );

		$idout = new byobagn_config_id( $this->options, 'id' );
		$id    = $idout->simple();

		echo "$tab<div$id$class>\n";
		if ( $overlay ) {
			echo "$tab\t<div class=\"overlay\">\n";
		}

		if ( isset( $this->options['include_heading']['add'] ) && $section_heading && $outside ) {
			echo "$tab\t\t\t<p class=\"section_title\">$section_heading</p>\n";
		}

		if ( empty( $this->options['page_wrapper'] ) ) {
			echo "$tab\t<div class=\"page_wrapper\">\n";
		}

		if ( isset( $this->options['include_heading']['add'] ) && $section_heading && ! $outside ) {
			echo "$tab\t\t\t<p class=\"section_title\">$section_heading</p>\n";
		}

		echo "$tab\t\t<div class=\"$layout\"$style>\n";


		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 3 ) ), $this->options );
		echo "$tab\t\t</div>\n";

		if ( empty( $this->options['page_wrapper'] ) ) {
			echo "$tab\t</div>\n";
		}

		echo "$tab\t<div style=\"clear:both\"></div>\n";
		if ( $overlay ) {
			echo "$tab\t</div>\n";
		}
		echo "$tab</div>\n";
	}

}

class byobagn_social_profile_links extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_twitter_link',
		'byobagn_facebook_link',
		'byobagn_linkedin_link',
		'byobagn_stumbleupon_link',
		'byobagn_googleplus_link',
		'byobagn_pinterest_link',
		'byobagn_instagram_link',
		'byobagn_youtube_link',
		'byobagn_vimeo_link',
		'byobagn_vine_link',
		'byobagn_flickr_link',
		'byobagn_reddit_link',
		'byobagn_tumblr_link',
		'byobagn_slideshare_link',
		'byobagn_custom1_link',
		'byobagn_custom2_link'
	);
	public $children = array(
		'byobagn_twitter_link',
		'byobagn_facebook_link',
		'byobagn_linkedin_link',
		'byobagn_stumbleupon_link',
		'byobagn_googleplus_link',
		'byobagn_pinterest_link',
		'byobagn_instagram_link',
		'byobagn_youtube_link',
		'byobagn_vimeo_link',
		'byobagn_vine_link',
		'byobagn_flickr_link',
		'byobagn_reddit_link',
		'byobagn_tumblr_link',
		'byobagn_slideshare_link',
		'byobagn_custom1_link',
		'byobagn_custom2_link'
	);
	protected $filters = array(
		'menu'     => 'skin',
		'priority' => 1
	);

	protected function translate() {
		$this->name                   = $this->title = __( 'Agility Social Profile Links', 'byobagn' );
		$this->filters['text']        = __( 'Agility Social Profiles', 'byobagn' );
		$this->filters['description'] = __( 'Use this to display your own social media profiles', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();

		return $options;
	}

	protected function class_options() {
		$options = array(
			'social_profiles'        => array(
				'type'       => 'checkbox',
				'label'      => __( 'Choose your social profiles', 'byobagn' ),
				'options'    => array(
					'use_twitter'     => __( 'Twitter', 'byobagn' ),
					'use_facebook'    => __( 'Facebook', 'byobagn' ),
					'use_linkedin'    => __( 'LinkedIn', 'byobagn' ),
					'use_stumbleupon' => __( 'StumbleUpon', 'byobagn' ),
					'use_googleplus'  => __( 'Google+', 'byobagn' ),
					'use_pinterest'   => __( 'Pinterest', 'byobagn' ),
					'use_instagram'   => __( 'Instagram', 'byobagn' ),
					'use_youtube'     => __( 'YouTube', 'byobagn' ),
					'use_vimeo'       => __( 'Vimeo', 'byobagn' ),
					'use_vine'        => __( 'Vine', 'byobagn' ),
					'use_flickr'      => __( 'Flickr', 'byobagn' ),
					'use_reddit'      => __( 'Reddit', 'byobagn' ),
					'use_tumblr'      => __( 'Tumblr', 'byobagn' ),
					'use_slideshare'  => __( 'Slideshare', 'byobagn' ),
					'use_custom1'     => __( 'Other social profile 1', 'byobagn' ),
					'use_custom2'     => __( 'Other social profile 2', 'byobagn' ),
				),
				'dependents' => array(
					'use_twitter',
					'use_facebook',
					'use_linkedin',
					'use_stumbleupon',
					'use_googleplus',
					'use_pinterest',
					'use_instagram',
					'use_youtube',
					'use_vimeo',
					'use_vine',
					'use_flickr',
					'use_reddit',
					'use_tumblr',
					'use_slideshare',
					'use_custom1',
					'use_custom2'
				)
			),
			'use_images'             => array(
				'type'       => 'checkbox',
				'label'      => __( 'Use your own images rather than the skin icons', 'byobagn' ),
				'options'    => array(
					'use_images' => __( 'Use custom images', 'byobagn' )
				),
				'dependents' => array( 'use_images' )
			),
			'twitter_url'            => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Twitter Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_twitter' )
			),
			'twitter_link_title'     => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Twitter link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Follow me on Twitter', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_twitter' )
			),
			'twitter_image_url'      => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Twitter Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_twitter',
					'use_images'      => 'use_images'
				)
			),
			'facebook_url'           => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Facebook Page', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_facebook' )
			),
			'facebook_link_title'    => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Facebook link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Facebook Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_facebook' )
			),
			'facebook_image_url'     => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Facebook Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_facebook',
					'use_images'      => 'use_images'
				)
			),
			'linkedin_url'           => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your LinkedIn Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_linkedin' )
			),
			'linkedin_link_title'    => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'LinkedIn link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my LinkedIn Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_linkedin' )
			),
			'linkedin_image_url'     => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom LinkedIn Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_linkedin',
					'use_images'      => 'use_images'
				)
			),
			'stumbleupon_url'        => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your StumbleUpon Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_stumbleupon' )
			),
			'stumbleupon_link_title' => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'StumbleUpon link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my StumbleUpon Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_stumbleupon' )
			),
			'stumbleupon_image_url'  => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom StumbleUpon Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_stumbleupon',
					'use_images'      => 'use_images'
				)
			),
			'googleplus_url'         => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Google+ Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_googleplus' )
			),
			'googleplus_link_title'  => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Google+ link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Google+ Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_googleplus' )
			),
			'googleplus_image_url'   => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Google+ Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_googleplus',
					'use_images'      => 'use_images'
				)
			),
			'pinterest_url'          => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Pinterest Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_pinterest' )
			),
			'pinterest_link_title'   => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Pinterest link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Pinterest Board', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_pinterest' )
			),
			'pinterest_image_url'    => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Pinterest Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_pinterest',
					'use_images'      => 'use_images'
				)
			),
			'instagram_url'          => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Instagram Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_instagram' )
			),
			'instagram_link_title'   => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Instagram link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Instagram Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_instagram' )
			),
			'instagram_image_url'    => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Instagram Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_instagram',
					'use_images'      => 'use_images'
				)
			),
			'youtube_url'            => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your YouTube Channel', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_youtube' )
			),
			'youtube_link_title'     => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'YouTube Channel link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my YouTube Channel', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_youtube' )
			),
			'youtube_image_url'      => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom YouTube Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_youtube',
					'use_images'      => 'use_images'
				)
			),
			'vimeo_url'              => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Vimeo Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_vimeo' )
			),
			'vimeo_link_title'       => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Vimeo link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Vimeo Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_vimeo' )
			),
			'vimeo_image_url'        => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Vimeo Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_vimeo',
					'use_images'      => 'use_images'
				)
			),
			'vine_url'               => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Vine Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_vine' )
			),
			'vine_link_title'        => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Vine Profile link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Vine Profile', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_vine' )
			),
			'vine_image_url'         => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Vine Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_vine',
					'use_images'      => 'use_images'
				)
			),
			'flickr_url'             => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Flickr Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_flickr' )
			),
			'flickr_link_title'      => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Flickr link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Flickr Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_flickr' )
			),
			'flickr_image_url'       => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Flickr Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_flickr',
					'use_images'      => 'use_images'
				)
			),
			'reddit_url'             => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Reddit Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_reddit' )
			),
			'reddit_link_title'      => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Reddit link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Reddit Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_reddit' )
			),
			'reddit_image_url'       => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Reddit Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_reddit',
					'use_images'      => 'use_images'
				)
			),
			'tumblr_url'             => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Tumblr Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_tumblr' )
			),
			'tumblr_link_title'      => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Tumblr link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Tumblr Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_tumblr' )
			),
			'tumblr_image_url'       => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Tumblr Custom Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_tumblr',
					'use_images'      => 'use_images'
				)
			),
			'slideshare_url'         => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Slideshare Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_slideshare' )
			),
			'slideshare_link_title'  => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Slideshare link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Slideshare Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_slideshare' )
			),
			'slideshare_image_url'   => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Slideshare Custom Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_slideshare',
					'use_images'      => 'use_images'
				)
			),
			'custom1_url'            => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your First Custom Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_custom1' )
			),
			'custom1_icon'           => array(
				'type'        => 'text',
				'width'       => 'medium',
				'code'        => true,
				'label'       => __( 'Custom FontAwesome Icon - in the form of "fa-facebook"', 'byobagn' ),
				'tooltip'     => __( 'Choose one of the FontAwesome Icons for this profile', 'byobagn' ),
				'placeholder' => __( 'fa-question-mark', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_custom1' )
			),
			'custom1_link_title'     => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'First Custom link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my First Custom Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_custom1' )
			),
			'custom1_image_url'      => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom First Custom Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_custom1',
					'use_images'      => 'use_images'
				)
			),
			'custom2_url'            => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Second Custom Profile', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array( 'social_profiles' => 'use_custom2' )
			),
			'custom2_link_title'     => array(
				'type'        => 'text',
				'width'       => 'full',
				'code'        => true,
				'label'       => __( 'Second Custom link title - displays when someone hovers over the link', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display when someone hovers ovet the link', 'byobagn' ),
				'placeholder' => __( 'Visit my Second Custom Page', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_custom2' )
			),
			'custom2_icon'           => array(
				'type'        => 'text',
				'width'       => 'medium',
				'code'        => true,
				'label'       => __( 'Custom FontAwesome Icon - in the form of "fa-facebook"', 'byobagn' ),
				'tooltip'     => __( 'Choose one of the FontAwesome Icons for this profile', 'byobagn' ),
				'placeholder' => __( 'fa-question-mark', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_custom2' )
			),
			'custom2_image_url'      => array(
				'type'    => 'text',
				'width'   => 'full',
				'code'    => true,
				'label'   => __( 'URL of your Custom Second Custom Image', 'byobagn' ),
				'tooltip' => __( 'include the <code>http://</code> in the URL', 'byobagn' ),
				'parent'  => array(
					'social_profiles' => 'use_custom2',
					'use_images'      => 'use_images'
				)
			)
		);

		return $options;
	}

	public function options() {
		$options = array(
			'style'         => array(
				'type'    => 'select',
				'label'   => __( 'Choose a style', 'byobagn' ),
				'options' => array(
					''        => __( 'No style', 'byobagn' ),
					'style_1' => __( 'Social Icon  Style 1', 'byobagn' ),
					'style_2' => __( 'Social Icon Style 2', 'byobagn' )
				)
			),
			'add_heading'   => array(
				'type'       => 'checkbox',
				'label'      => __( 'Add a Heading above the Icons', 'byobagn' ),
				'tooltip'    => __( 'By checking this box you will add a heading above the icons', 'byobagn' ),
				'options'    => array(
					'add' => __( 'Add a heading', 'byobagn' )
				),
				'dependents' => array( 'add' )
			),
			'heading_class' => array(
				'type'        => 'text',
				'width'       => 'medium',
				'code'        => true,
				'label'       => __( 'Heading Class', 'byobagn' ),
				'tooltip'     => __( 'Enter a class name for the heading', 'byobagn' ),
				'placeholder' => __( 'widget_title', 'byobagn' ),
				'parent'      => array(
					'add_heading' => 'add'
				)
			),
			'heading_text'  => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Heading Text', 'byobagn' ),
				'placeholder' => __( 'Connect With Us', 'byobagn' ),
				'parent'      => array(
					'add_heading' => 'add'
				)
			)
		);

		return $options;
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );

		$style = ! empty( $this->options['style'] ) ? esc_attr( $this->options['style'] ) : '';

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->secondary( 'social_icons', false, $style );

		$output = new byobagn_config_id( $this->options, 'id' );
		$id     = $output->simple();


		$heading_classout = new byobagn_config_classes( $this->options, 'heading_class' );
		$heading_class    = $heading_classout->given( 'widget_title', true );

		echo "$tab<div$id$class>\n";
		if ( isset( $this->options['add_heading']['add'] ) && ! empty( $this->options['heading_text'] ) ) {
			echo "$tab<p$heading_class>" . wp_kses_post( $this->options['heading_text'] ) . "</p>\n";
		}
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ), $this->class_options );
		echo "$tab</div>\n";
	}

}

class byobagn_social_sharing_links extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_twitter_sharing_link',
		'byobagn_facebook_sharing_link',
		'byobagn_linkedin_sharing_link',
		'byobagn_stumbleupon_sharing_link',
		'byobagn_googleplus_sharing_link',
		'byobagn_pinterest_sharing_link',
		'byobagn_reddit_sharing_link',
		'byobagn_tumblr_sharing_link'
	);
	public $children = array(
		'byobagn_twitter_sharing_link',
		'byobagn_facebook_sharing_link',
		'byobagn_linkedin_sharing_link',
		'byobagn_stumbleupon_sharing_link',
		'byobagn_googleplus_sharing_link',
		'byobagn_pinterest_sharing_link',
		'byobagn_reddit_sharing_link',
		'byobagn_tumblr_sharing_link'
	);
	protected $filters = array(
		'menu'     => 'skin',
		'priority' => 2
	);

	protected function translate() {
		$this->name                   = $this->title = __( 'Agility Social Sharing Links', 'byobagn' );
		$this->filters['text']        = __( 'Agility Social Sharing Links', 'byobagn' );
		$this->filters['description'] = __( 'Choose which social sharing links to display on the site', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options           = $thesis->api->html_options();
		$options ['style'] = array(
			'type'    => 'select',
			'label'   => __( 'Choose a style', 'byobagn' ),
			'options' => array(
				''           => __( 'Social sharing colors for buttons', 'byobagn' ),
				'monochrome' => __( 'Monochrome buttons', 'byobagn' )
			)
		);

		return $options;
	}

	protected function class_options() {
		$options = array(
			'social_profiles'   => array(
				'type'       => 'checkbox',
				'label'      => __( 'Choose your social profiles', 'byobagn' ),
				'options'    => array(
					'use_twitter'     => __( 'Twitter', 'byobagn' ),
					'use_facebook'    => __( 'Facebook', 'byobagn' ),
					'use_linkedin'    => __( 'LinkedIn', 'byobagn' ),
					'use_stumbleupon' => __( 'StumbleUpon', 'byobagn' ),
					'use_googleplus'  => __( 'Google+', 'byobagn' ),
					'use_pinterest'   => __( 'Pinterest', 'byobagn' ),
					'use_reddit'      => __( 'Reddit', 'byobagn' ),
					'use_tumblr'      => __( 'Tumblr', 'byobagn' )
				),
				'dependents' => array(
					'use_twitter',
					'use_facebook',
					'use_linkedin',
					'use_stumbleupon',
					'use_googleplus',
					'use_pinterest',
					'use_reddit',
					'use_tumblr',
				)
			),
			'use_intro_label'   => array(
				'type'       => 'checkbox',
				'label'      => __( 'Add an intro label before the share buttons', 'byobagn' ),
				'options'    => array(
					'use_label' => __( 'Add a share label', 'byobagn' )
				),
				'dependents' => array(
					'use_label',
				)
			),
			'intro_lable'       => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Introductory Label', 'byobagn' ),
				'tooltip'     => __( 'This label will be placed in front of the social sharing buttons', 'byobagn' ),
				'placeholder' => __( 'Share this on: ', 'byobagn' ),
				'parent'      => array( 'use_intro_label' => 'use_label' )
			),
			'twitter_lable'     => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Text for Twitter Share Button - enter "none" for no label', 'byobagn' ),
				'tooltip'     => __( 'This can be any text you like', 'byobagn' ),
				'placeholder' => __( 'Tweet This', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_twitter' )
			),
			'facebook_lable'    => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Text for Facebook Share Button', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display in the share button - enter "none" for no label', 'byobagn' ),
				'placeholder' => __( 'Share on Facebook', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_facebook' )
			),
			'linkedin_lable'    => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Text for LinkedIn Share Button', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display in the share button - enter "none" for no label', 'byobagn' ),
				'placeholder' => __( 'Share on LinkedIn', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_linkedin' )
			),
			'stumbleupon_lable' => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Text for StumbleUpon Share Button', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display in the share button - enter "none" for no label', 'byobagn' ),
				'placeholder' => __( 'Share on StumbleUpo', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_stumbleupon' )
			),
			'googleplus_lable'  => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Text for Google+ Share Button', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display in the share button - enter "none" for no label', 'byobagn' ),
				'placeholder' => __( 'Share on Google+', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_googleplus' )
			),
			'pinterest_lable'   => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Text for Pinterest Share Button', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display in the share button - enter "none" for no label', 'byobagn' ),
				'placeholder' => __( 'Pin This', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_pinterest' )
			),
			'reddit_lable'      => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Text for Reddit Share Button', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display in the share button - enter "none" for no label', 'byobagn' ),
				'placeholder' => __( 'Share on Reddit', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_reddit' )
			),
			'tumblr_lable'      => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Text for Tumblr Share Button', 'byobagn' ),
				'tooltip'     => __( 'Enter any text you wish to display in the share button - enter "none" for no label', 'byobagn' ),
				'placeholder' => __( 'Share on Tumblr', 'byobagn' ),
				'parent'      => array( 'social_profiles' => 'use_tumblr' )
			)
		);

		return $options;
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );

		$style = ! empty( $this->options['style'] ) ? esc_attr( $this->options['style'] ) : '';

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->secondary( 'social_links', false, $style );

		$output = new byobagn_config_id( $this->options, 'id' );
		$id     = $output->simple();

		$intro_lable = false;
		if ( isset( $this->class_options['use_intro_label']['use_label'] ) ) {
			$intro_lable = ( ! empty( $this->class_options['intro_lable'] ) ) ? wp_kses_post( $this->class_options['intro_lable'] ) : 'Share This On: ';
		}

		echo "$tab<p$id$class>\n";
		if ( isset( $this->class_options['use_intro_label']['use_label'] ) && $intro_lable ) {
			echo "$tab<span class=\"intro_label\">$intro_lable</span>";
		}

		$args['depth']   = $depth + 1;
		$args['options'] = $this->class_options;

		echo $this->rotator( $args );
		echo "$tab</p>\n";
	}

}

class byobagn_twitter_sharing_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Twitter', 'byobagn' );
	}

	public function html( $args = false ) {

		extract( $args = is_array( $args ) ? $args : array() );

		if ( isset( $options['social_profiles']['use_twitter'] ) ) {
			global $thesis;

			if ( ! empty( $options['twitter_lable'] ) ) {
				$lable = $options['twitter_lable'] !== 'none' ? ' ' . wp_kses_post( $options['twitter_lable'] ) : '';
			} else {
				$lable = ' Twitter';
			}

			$url   = get_permalink();
			$title = rawurlencode( strip_tags( get_the_title() ) );

			echo "<a class=\"twitter\" title=\"$lable\" target=\"_blank\" href=\"https://twitter.com/intent/tweet?url=$url&amp;text=$title;\"><i class=\"fa fa-twitter\"></i>$lable</a>\n";
		}
	}

}

class byobagn_facebook_sharing_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Facebook', 'byobagn' );
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		if ( isset( $options['social_profiles']['use_facebook'] ) ) {

			if ( ! empty( $options['facebook_lable'] ) ) {
				$lable = $options['facebook_lable'] !== 'none' ? ' ' . wp_kses_post( $options['facebook_lable'] ) : '';
			} else {
				$lable = ' Facebook';
			}

			$url   = get_permalink();
			$title = rawurlencode( strip_tags( get_the_title() ) );

			echo "<a class=\"facebook\" title=\"$lable\" target=\"_blank\" href=\"http://www.facebook.com/sharer/sharer.php?u=$url&title=$title\"><i class=\"fa fa-facebook\"></i>$lable</a>\n";
		}
	}

}

class byobagn_stumbleupon_sharing_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'StumbleUpon', 'byobagn' );
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		if ( isset( $options['social_profiles']['use_stumbleupon'] ) ) {

			if ( ! empty( $options['stumbleupon_lable'] ) ) {
				$lable = $options['stumbleupon_lable'] !== 'none' ? ' ' . wp_kses_post( $options['stumbleupon_lable'] ) : '';
			} else {
				$lable = ' StumbleUpon';
			}

			$url   = get_permalink();
			$title = strip_tags( get_the_title() );

			echo "<a class=\"stumbleupon\" title=\"$lable\" target=\"_blank\" href=\"http://www.stumbleupon.com/submit?url=$url&title=$title\"><i class=\"fa fa-stumbleupon\"></i>$lable</a>\n";
		}
	}

}

class byobagn_linkedin_sharing_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'LinkedIn', 'byobagn' );
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		if ( isset( $options['social_profiles']['use_linkedin'] ) ) {

			if ( ! empty( $options['linkedin_lable'] ) ) {
				$lable = $options['linkedin_lable'] !== 'none' ? ' ' . wp_kses_post( $options['linkedin_lable'] ) : '';
			} else {
				$lable = ' LinkedIn';
			}

			$url   = get_permalink();
			$title = rawurlencode( strip_tags( get_the_title() ) );

			echo "<a class=\"linkedin\" title=\"$lable\" target=\"_blank\" href=\"http://www.linkedin.com/shareArticle?mini=true&url=$url&title=$title\"><i class=\"fa fa-linkedin\"></i>$lable</a>\n";
		}
	}

}

class byobagn_googleplus_sharing_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Google+', 'byobagn' );
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		if ( isset( $options['social_profiles']['use_googleplus'] ) ) {

			if ( ! empty( $options['googleplus_lable'] ) ) {
				$lable = $options['googleplus_lable'] !== 'none' ? ' ' . wp_kses_post( $options['googleplus_lable'] ) : '';
			} else {
				$lable = ' Google+';
			}

			$url = get_permalink();

			echo "<a class=\"googleplus\" title=\"$lable\" target=\"_blank\" href=\"https://plus.google.com/share?url=$url\"><i class=\"fa fa-google-plus\"></i>$lable</a>\n";
		}
	}

}

class byobagn_pinterest_sharing_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Pinterest', 'byobagn' );
	}

	public function html( $args = false ) {
		global $thesis, $post;
		extract( $args = is_array( $args ) ? $args : array() );
		if ( isset( $options['social_profiles']['use_pinterest'] ) ) {

			if ( ! empty( $options['pinterest_lable'] ) ) {
				$lable = $options['pinterest_lable'] !== 'none' ? ' ' . wp_kses_post( $options['pinterest_lable'] ) : '';
			} else {
				$lable = ' Pinterest';
			}

			$url      = get_permalink();
			$title    = strip_tags( get_the_title() );
			$thumb_id = get_post_thumbnail_id( $post->ID );

			if ( empty( $thumb_id ) ) {
				$attachments = get_attached_media( 'image', $post->ID );
				if ( is_array( $attachments ) ) {
					$first_image = reset( $attachments );
					$thumb_id    = $first_image->ID;
				}
			}
			if ( ! empty( $thumb_id ) ) {
				$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'full', false );
				$thumb_url       = $thumb_url_array[0];
				$featured_image  = ! empty( $thumb_url ) ? esc_url( $thumb_url ) : '';

				echo "<a class=\"pinterest\" title=\"$lable\" target=\"_blank\" href=\"http://pinterest.com/pin/create/bookmarklet/?media=$featured_image&url=$url&is_video=false&description=$title\"><i class=\"fa fa-pinterest-p\"></i>$lable</a>\n";
			}
		}
	}

}

class byobagn_reddit_sharing_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Reddit', 'byobagn' );
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		if ( isset( $options['social_profiles']['use_reddit'] ) ) {

			if ( ! empty( $options['reddit_lable'] ) ) {
				$lable = $options['reddit_lable'] !== 'none' ? ' ' . wp_kses_post( $options['reddit_lable'] ) : '';
			} else {
				$lable = ' Reddit';
			}

			$url   = get_permalink();
			$title = strip_tags( get_the_title() );

			echo "<a class=\"reddit\" title=\"$lable\" target=\"_blank\" href=\"http://www.reddit.com/submit?url=$url&title=$title\"><i class=\"fa fa-reddit\"></i>$lable</a>\n";
		}
	}

}

class byobagn_tumblr_sharing_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Tumblr', 'byobagn' );
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		if ( isset( $options['social_profiles']['use_tumblr'] ) ) {

			if ( ! empty( $options['tumblr_lable'] ) ) {
				$lable = $options['tumblr_lable'] !== 'none' ? ' ' . wp_kses_post( $options['tumblr_lable'] ) : '';
			} else {
				$lable = ' Tumblr';
			}

			$url   = get_permalink();
			$title = strip_tags( get_the_title() );

			echo "<a class=\"tumblr\" title=\"$lable\" target=\"_blank\" href=\"http://www.tumblr.com/share?v=3&u=$url&t=$title\"><i class=\"fa fa-tumblr\"></i>$lable</a>\n";
		}
	}

}

class byobagn_call_to_action extends thesis_box {

	protected function translate() {
		$this->name = $this->title = __( 'Agility Call to Action', 'byobagn' );
	}

	public function construct() {
		if ( is_admin() ) {
			if ( ! empty( $_GET['canvas'] ) && strpos( $_GET['canvas'], 'byobagn' ) === 0 ) {

				add_action( 'admin_enqueue_scripts', array( $this, 'image_loader_styles_and_scripts' ) );
			}
		}
	}

	public function image_loader_styles_and_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'byobloader', BYOBAGN_URL . '/js/loader.js' );
	}

	public function options() {
		$options = array(
			'configuration'      => array(
				'type'       => 'select',
				'label'      => __( 'Choose a configuration', 'byobagn' ),
				'options'    => array(
					'cta_tall'    => __( 'Tall and wide', 'byobagn' ),
					'cta_short'   => __( 'Short and wide', 'byobagn' ),
					'cta_stacked' => __( 'Vertical stacked', 'byobagn' )
				),
				'dependents' => array( 'cta_tall', 'cta_stacked' )
			),
			'style'              => array(
				'type'    => 'select',
				'label'   => __( 'Choose a style', 'byobagn' ),
				'options' => array(
					''      => __( 'No style', 'byobagn' ),
					'cta_1' => __( 'Call to Action Style 1', 'byobagn' ),
					'cta_2' => __( 'Call to Action Style 2', 'byobagn' ),
					'cta_3' => __( 'Call to Action Style 3', 'byobagn' ),
				)
			),
			'overlay'            => array(
				'type'       => 'checkbox',
				'label'      => __( 'Add an Overlay element', 'byobagn' ),
				'tooltip'    => __( 'By checking this box you will add an overlay div between the outer wrapper and the text', 'byobagn' ),
				'options'    => array(
					'add' => __( 'Add an overlay element', 'byobagn' )
				),
				'dependents' => array( 'add' ),
				'parent'     => array(
					'configuration' => 'cta_tall'
				)
			),
			'overlay_skin_class' => array(
				'type'       => 'select',
				'label'      => __( 'Overlay Style', 'byobagn' ),
				'tooltip'    => __( 'Select a style for the overlay section', 'byobagn' ),
				'options'    => array(
					''          => __( 'Default', 'byobagn' ),
					'overlay-1' => __( 'Overlay Style 1', 'byobagn' ),
					'overlay-2' => __( 'Overlay Style 2', 'byobagn' ),
					'overlay-3' => __( 'Overlay Style 3', 'byobagn' ),
					'custom'    => __( 'Enter a custom class', 'byobagn' ),
				),
				'dependents' => array( 'custom' ),
				'parent'     => array(
					'overlay' => 'add'
				)
			),
			'overlay_class'      => array(
				'type'    => 'text',
				'width'   => 'medium',
				'code'    => true,
				'label'   => __( 'Overlay Class', 'byobagn' ),
				'tooltip' => __( 'Enter a class name for the overlay section', 'byobagn' ),
				'parent'  => array(
					'overlay_skin_class' => 'custom'
				)
			),
			'image'              => array(
				'type'         => 'add_media',
				'label'        => __( 'Choose an image (optional)', 'byobagn' ),
				'upload_label' => __( 'Choose an image', 'byobagn' ),
				'tooltip'      => __( 'Enter the URL for the image or select one by clicking the button', 'byobagn' )
			),
			'heading'            => array(
				'type'    => 'textarea',
				'code'    => true,
				'label'   => __( 'Call to action heading', 'byobagn' ),
				'tooltip' => __( 'Enter the text for the call to action heading.  This can include html', 'byobagn' ),
				'parent'  => array(
					'configuration' => array(
						'cta_tall',
						'cta_stacked'
					)
				)
			),
			'remove_heading'     => array(
				'type'    => 'checkbox',
				'label'   => __( 'Remove the heading from this call to action', 'byobagn' ),
				'tooltip' => __( 'By checking this box you will remove the heading', 'byobagn' ),
				'options' => array(
					'remove' => __( 'Remove the heading', 'byobagn' )
				),
				'parent'  => array(
					'configuration' => array(
						'cta_tall',
						'cta_stacked'
					)
				)
			),
			'message'            => array(
				'type'    => 'textarea',
				'code'    => true,
				'label'   => __( 'Call to action text', 'byobagn' ),
				'tooltip' => __( 'Enter the text for the call to action text.  This can include html', 'byobagn' )
			),
			'remove_message'     => array(
				'type'    => 'checkbox',
				'label'   => __( 'Remove the message from this call to action', 'byobagn' ),
				'tooltip' => __( 'By checking this box you will remove the message', 'byobagn' ),
				'options' => array(
					'remove' => __( 'Remove the message', 'byobagn' )
				),
				'parent'  => array(
					'configuration' => array(
						'cta_tall',
						'cta_stacked'
					)
				)
			),
			'link_text'          => array(
				'type'        => 'text',
				'width'       => 'medium',
				'code'        => true,
				'label'       => __( 'Link text', 'byobagn' ),
				'tooltip'     => __( 'Enter the text you want the link to display', 'byobagn' ),
				'placeholder' => __( '-- Do It Now!', 'byobagn' )
			),
			'link_url'           => array(
				'type'    => 'text',
				'width'   => 'medium',
				'code'    => true,
				'label'   => __( 'Link URL', 'byobagn' ),
				'tooltip' => __( 'Enter the url you want the button to link to', 'byobagn' )
			)
		);

		return $options;
	}

	public function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		$tab   = str_repeat( "\t", $depth );
		$base = get_site_url();
		$use_heading   = isset( $this->options['remove_heading']['remove'] ) ? false : true;
		$use_message   = isset( $this->options['remove_message']['remove'] ) ? false : true;
		$image         = ! empty( $this->options['image'] ) ? $this->options['image'] : false;
		$heading       = ! empty( $this->options['heading'] ) ? wp_kses_post( $this->options['heading'] ) : __( 'Be sure to create some good call to action text', 'byobptsd14' );
		$message       = ! empty( $this->options['message'] ) ? wp_kses_post( $this->options['message'] ) : __( 'Be sure to create some good call to action text', 'byobptsd14' );
		$link_text     = ! empty( $this->options['link_text'] ) ? wp_kses_post( $this->options['link_text'] ) : __( 'Do It Now!', 'byobptsd14' );
		$link_url      = ! empty( $this->options['link_url'] ) ? esc_url( $this->options['link_url'] ) : '#';
		$overlay       = ! empty( $this->options['overlay']['add'] ) ? true : false;
		$configuration = ! empty( $this->options['configuration'] ) ? esc_attr( $this->options['configuration'] ) : 'cta_tall';

		$image_url = ! empty( $this->options['image']['url'] ) ? $base . $this->options['image']['url'] : false;
		$image_id = ! empty( $this->options['image']['url'] ) ? attachment_url_to_postid( $image_url ) : false;
		$image_alt = ! empty( $image_id ) ? get_post_meta( $image_id, '_wp_attachment_image_alt', true) : false;
		$image_output =  ! empty( $image_id ) ? $this->srcset_from_single_image_id( $image_alt, $image_id, $image_url ) : false;


		$overlay_skin_class = ( ! empty( $this->options['overlay_skin_class'] ) && $this->options['overlay_skin_class'] !== 'custom' ) ? ' ' . esc_attr( $this->options['overlay_skin_class'] ) : false;
		if ( $overlay_skin_class ) {
			$overlay_class = $overlay_skin_class;
		} else {
			$overlay_class = ! empty( $this->options['overlay_class'] ) ? ' ' . esc_attr( $this->options['overlay_class'] ) : '';
		}

		$style     = ! empty( $this->options['style'] ) ? ' ' . esc_attr( $this->options['style'] ) : '';
		$secondary = $configuration . $style;

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->secondary( 'call-to-action', false, $secondary );

		echo "$tab<div$class>";
		if ( $overlay ) {
			echo "$tab\t<div class=\"overlay\">\n";
		}
		if ( $configuration == 'cta_short' ) {
			echo "\n$tab\t<p class=\"message\">$message <span class =\"cta_submit\"> <a class =\"cta_link\" href=\"$link_url\">$link_text</a></span></p>";
		} else {
			if ( $image_output ) {
				echo "\n$tab\t$image_output";
			}
			if ( $use_heading ) {
				echo "\n$tab\t<p class=\"heading\">$heading</p>";
			}
			if ( $use_message ) {
				echo "\n$tab\t<p class=\"message\">$message</p>";
			}
			echo "\n$tab\t<p class =\"cta_submit\" ><a href=\"$link_url\">$link_text</a></p>";
		}
		if ( $overlay ) {
			echo "$tab\t</div>\n";
		}

		echo "\n$tab</div>";
	}



	public function srcset_from_single_image_id( $alt, $image_id, $img_url ) {
		$image_meta    = wp_get_attachment_metadata( $image_id );
		$content       = "<img class=\"banner-image\" src=\"$img_url\" alt=\"$alt\">";
		$output        = wp_image_add_srcset_and_sizes( $content, $image_meta, $image_id );

		return $output;
	}

}

class byobagn_thesis_email_signup_call_to_action extends thesis_box {

	public $type = 'rotator';
	public $child = array();
	public $vendor = 'aweber';
	public $box_options = array();
	public $template_options = array();

	protected function translate() {
		$this->name = $this->title = __( 'Agility DIYThemes Email Box Helper', 'byobagn' );
	}

	public function construct() {
		global $thesis;

		if ( ! empty( $_GET['canvas'] ) && $_GET['canvas'] == $this->_id ) {

			$this->box_options      = get_option( 'byob_agility_nude_boxes' );
			$this->template_options = get_option( 'byob_agility_nude_templates' );
//                        $this->children = $this->set_children();
//                        $this->set_submit_text();
//                        var_dump($this->box_options);
			add_action( 'thesis_admin_canvas', array( $this, 'set_children' ) );
			add_action( 'thesis_admin_canvas', array( $this, 'set_submit_text' ) );
			add_action( 'admin_footer', array( $this, 'force_refresh' ) );
		}
	}

	public function force_refresh() {
		?>
		<script>
            jQuery(document).ajaxStop(function () {
                window.location.reload();
            });
		</script>
		<?php
	}

	public function options() {
		$options = array(
			'submit_text'        => array(
				'type'        => 'text',
				'width'       => 'medium',
				'code'        => true,
				'label'       => __( 'Email Submit Button Text', 'byobagn' ),
				'tooltip'     => __( 'Enter the text you want to replace the default "Get Updates!"', 'byobagn' ),
				'placeholder' => __( 'Get Updates!', 'byobagn' ),
			),
			'configuration'      => array(
				'type'       => 'select',
				'label'      => __( 'Choose a configuration', 'byobagn' ),
				'options'    => array(
					'cta_tall'    => __( 'Tall and wide', 'byobagn' ),
					'cta_short'   => __( 'Short and wide', 'byobagn' ),
					'cta_stacked' => __( 'Vertical stacked', 'byobagn' )
				),
				'dependents' => array( 'cta_tall', 'cta_stacked' )
			),
			'style'              => array(
				'type'    => 'select',
				'label'   => __( 'Choose a style', 'byobagn' ),
				'options' => array(
					''      => __( 'No style', 'byobagn' ),
					'cta_1' => __( 'Call to Action Style 1', 'byobagn' ),
					'cta_2' => __( 'Call to Action Style 2', 'byobagn' ),
					'cta_3' => __( 'Call to Action Style 3', 'byobagn' ),
				)
			),
			'overlay'            => array(
				'type'       => 'checkbox',
				'label'      => __( 'Add an Overlay element', 'byobagn' ),
				'tooltip'    => __( 'By checking this box you will add an overlay div between the outer wrapper and the text', 'byobagn' ),
				'options'    => array(
					'add' => __( 'Add an overlay element', 'byobagn' )
				),
				'dependents' => array( 'add' ),
				'parent'     => array(
					'configuration' => 'cta_tall'
				)
			),
			'overlay_skin_class' => array(
				'type'       => 'select',
				'label'      => __( 'Overlay Style', 'byobagn' ),
				'tooltip'    => __( 'Select a style for the overlay section', 'byobagn' ),
				'options'    => array(
					''          => __( 'Default', 'byobagn' ),
					'overlay-1' => __( 'Overlay Style 1', 'byobagn' ),
					'overlay-2' => __( 'Overlay Style 2', 'byobagn' ),
					'overlay-3' => __( 'Overlay Style 3', 'byobagn' ),
					'custom'    => __( 'Enter a custom class', 'byobagn' ),
				),
				'dependents' => array( 'custom' ),
				'parent'     => array(
					'overlay' => 'add'
				)
			),
			'overlay_class'      => array(
				'type'    => 'text',
				'width'   => 'medium',
				'code'    => true,
				'label'   => __( 'Overlay Class', 'byobagn' ),
				'tooltip' => __( 'Enter a class name for the overlay section', 'byobagn' ),
				'parent'  => array(
					'overlay_skin_class' => 'custom'
				)
			)
		);

		return $options;
	}

	public function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function set_children() {
		$email_sign_up_boxes = array();
		foreach ( $this->template_options as $template => $options ) {

			if ( ! empty( $options['boxes'] ) ) {
				$boxes = $options['boxes'];
				// get the children of the current box -
				if ( ! empty( $boxes[ $this->_id ] ) ) {
					$current_box = $boxes[ $this->_id ];
//                                        var_dump($current_box);
					foreach ( $current_box as $child ) {
						foreach ( $boxes[ $child ] as $email_form_element ) {
//                                                        var_dump($email_form_element);
							$mailchimp = strpos( $email_form_element, 'mailchimp' );
							$aweber    = strpos( $email_form_element, 'aweber' );
							$submit    = strpos( $email_form_element, 'submit' );
							if ( ( $mailchimp || $aweber ) && $submit ) {
								$email_sign_up_boxes[] = $email_form_element;
							}
						}
					}
				}
			}
		}
//                var_dump($email_sign_up_boxes);
		$this->children = array_unique( $email_sign_up_boxes );
	}

	public function set_vendor( $child ) {
		$vendor    = 'aweber';
		$mailchimp = strpos( $child, 'mailchimp' );
		if ( $mailchimp ) {
			$vendor = 'mailchimp';
		}

		return $vendor;
	}

	public function set_parent( $vendor, $child ) {
		$suffix = '_thesis_aweber_submit';
		if ( $vendor == 'mailchimp' ) {
			$suffix = '_thesis_mailchimp_submit';
		}
		$parent = str_replace( $suffix, '', $child );

		return $parent;
	}

	public function set_submit_text() {
		global $thesis;
		if ( empty( $this->options['submit_text'] ) ) {
			return;
		} else {
			$submit_text = sanitize_text_field( ( $this->options['submit_text'] ) );
		}
		foreach ( $this->children as $child ) {
			$vendor = $this->set_vendor( $child );

			$priority_text = ! empty( $this->box_options[ $child ]['submit'] ) ? true : false;
//                        var_dump($priority_text);
			if ( ! $priority_text ) {
				$parent = $this->set_parent( $vendor, $child );
//                                unset($this->box_options[$child]['submit']);
				$this->box_options[ 'thesis_' . $vendor . '_submit' ][ $child ] = array(
					'submit'  => $submit_text,
					'_parent' => $parent
				);
//                                echo '***********options\n';
//                                var_dump($this->box_options['thesis_' . $vendor . '_submit']);
			}
		}
//                unset($this->box_options['thesis_aweber_form_1430779414_thesis_aweber_submit']);
//                unset($this->box_options['thesis_mailchimp_form_1430780137_thesis_mailchimp_submit']);
		update_option( 'byob_agility_nude_boxes', $this->box_options );
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		$tab   = str_repeat( "\t", $depth );

		$overlay       = ! empty( $this->options['overlay']['add'] ) ? true : false;
		$configuration = ! empty( $this->options['configuration'] ) ? esc_attr( $this->options['configuration'] ) : 'cta_tall';

		$overlay_skin_class = ( ! empty( $this->options['overlay_skin_class'] ) && $this->options['overlay_skin_class'] !== 'custom' ) ? ' ' . esc_attr( $this->options['overlay_skin_class'] ) : false;
		if ( $overlay_skin_class ) {
			$overlay_class = $overlay_skin_class;
		} else {
			$overlay_class = ! empty( $this->options['overlay_class'] ) ? ' ' . esc_attr( $this->options['overlay_class'] ) : '';
		}

		$style     = ! empty( $this->options['style'] ) ? ' ' . esc_attr( $this->options['style'] ) : '';
		$secondary = $configuration . $style;

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->secondary( 'call-to-action', false, $secondary );

		echo "$tab<div$class>";
		if ( $overlay ) {
			echo "$tab\t<div class=\"overlay\">\n";
		}
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		if ( $overlay ) {
			echo "$tab\t</div>\n";
		}

		echo "\n$tab</div>";
	}

}

class byobagn_page_post_box extends thesis_box {

	public $type = 'rotator';
	public $templates = array( 'page' );
	public $dependents = array(
		'byobagn_large_featured_image',
		'thesis_post_headline',
		'thesis_post_date',
		'thesis_post_content',
		'byobagn_bottom_social_media_extender',
		'thesis_post_image',
		'thesis_post_thumbnail',
		'thesis_wp_featured_image',
		'thesis_twitter_profile'
	);
	public $children = array(
		'byobagn_large_featured_image',
		'thesis_post_headline',
		'thesis_post_content',
		'byobagn_bottom_social_media_extender'
	);
	private $pb;

	protected function translate() {
		$this->title = $this->name = __( 'Agility Page Post Box', 'byobagn' );
	}

	public function construct() {
		$this->pb = new byobagn_post_box_helper( $this->options );
	}

	protected function html_options() {
		$options = $this->pb->html_options();

		return $options;
	}

	public function html( $args = array() ) {

		global $post;

		extract( $args = is_array( $args ) ? $args : array() );
		$schema         = $this->pb->setup_schema( $post->ID );
		$args['schema'] = $schema;

		$this->pb->open_html( $args, $this->_id );
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		$this->pb->close_html();
	}

}

class byobagn_archive_post_box extends thesis_box {

	public $type = 'rotator';
	public $templates = array( 'home', 'archive' );
	public $dependents = array(
		'byobagn_archive_post_heading_wrapper',
		'byobagn_thumbnail_featured_image',
		'byobagn_typical_excerpt',
		'byobagn_postfooter_wrapper',
		'thesis_post_author',
		'thesis_post_content',
		'thesis_post_author_avatar',
		'thesis_post_author_description',
		'thesis_post_image',
		'thesis_post_thumbnail',
		'thesis_wp_featured_image',
		'thesis_twitter_profile'
	);
	public $children = array(
		'byobagn_archive_post_heading_wrapper',
		'byobagn_thumbnail_featured_image',
		'byobagn_typical_excerpt',
		'byobagn_postfooter_wrapper'
	);
	private $pb;

	protected function translate() {
		$this->title = $this->name = __( 'Agility Home/Archive Post Box', 'byobagn' );
	}

	public function construct() {
		$this->pb = new byobagn_post_box_helper( $this->options );
	}

	protected function options() {
		$o = new byob_read_more_link();

		return $o->options();
	}

	protected function html_options() {
		$options = $this->pb->html_options();

		return $options;
	}

	public function html( $args = array() ) {
		global $post;
		extract( $args = is_array( $args ) ? $args : array() );
		$schema         = $this->pb->setup_schema( $post->ID );
		$args['schema'] = $schema;
		$type_class     = 'home_archive';

		$this->pb->open_html( $args, $this->_id, $type_class );
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ), $this->options );
		$this->pb->close_html();
	}

}

class byobagn_fluid_grid_post_box extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_featured_content_featured_image',
		'byobagn_featured_content_post_title',
		'thesis_post_date',
		'byobagn_typical_excerpt',
		'thesis_post_categories',
		'thesis_post_tags',
		'byobagn_featured_content_read_more'
	);
	public $children = array(
		'byobagn_featured_content_featured_image',
		'byobagn_featured_content_post_title',
		'byobagn_typical_excerpt',
		'byobagn_featured_content_read_more'
	);

	protected function translate() {
		$this->title = $this->name = __( 'Agility Fluid Grid Post Box', 'byobagn' );
	}

	public function construct() {
		$this->pb = new byobagn_post_box_helper( $this->options );
	}

	protected function options() {
		$o             = new byob_read_more_link();
		$width_options = array(
			'columns' => array(
				'type'    => 'select',
				'label'   => __( 'Number of Columns in the Grid', 'byobagn' ),
				'tooltip' => __( 'Choose the number of columns in the desktop view - this will change with varying size mobile devices', 'byobagn' ),
				'options' => array(
					'two_columns'   => __( '2 Columns', 'byobagn' ),
					'three_columns' => __( '3 Columns', 'byobagn' ),
					'four_columns'  => __( '4 Columns', 'byobagn' ),
					'five_columns'  => __( '5 Columns', 'byobagn' )
				)
			)
		);

		return array_merge( $width_options, $o->options() );
	}

	protected function html_options() {
		$options = $this->pb->html_options();

		return $options;
	}

	public function html( $args = array() ) {
		global $post;
		extract( $args = is_array( $args ) ? $args : array() );
		$schema         = $this->pb->setup_schema( $post->ID );
		$args['schema'] = $schema;
		$columns        = ! empty( $this->options['columns'] ) ? $this->options['columns'] : 'three_columns';
		$type_class     = 'fluid_grid item ' . $columns;

		$this->pb->open_html( $args, $this->_id, $type_class );
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ), $this->options );
		$this->pb->close_html();
	}

}

class byobagn_fluid_grid_wrapper extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->name = $this->title = __( 'Agility Fluid Grid Wrapper', 'byobagn' );
	}

	public function preload() {
		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
	}

	public function add_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'imagesLoaded', BYOBAGN_URL . '/js/imagesloaded.pkgd.min.js' );
		wp_enqueue_script( 'isotope', BYOBAGN_URL . '/js/isotope.pkgd.min.js', array( 'imagesLoaded' ) );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		$tab   = str_repeat( "\t", $depth );

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( 'isotope', false );

		echo "$tab<div id=\"$this->_id\" $class>\n";
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		echo "$tab</div>\n";
		?>
		<script type="text/javascript">
            var container = document.querySelector('#<?php echo $this->_id; ?>');
            var iso;
            // initialize Isotope after all images have loaded
            imagesLoaded(container, function () {
                iso = new Isotope(container, {
                    // options
                    itemSelector: '.fluid_grid',
                    layoutMode: 'fitRows'
                });
            });
		</script>
		<?php
	}

}

class byobagn_single_post_box extends thesis_box {

	public $type = 'rotator';
	public $templates = array( 'single' );
	public $dependents = array(
		'byobagn_large_featured_image',
		'byobagn_post_heading_wrapper',
		'byobagn_top_social_media_extender',
		'thesis_post_content',
		'byobagn_bottom_social_media_extender',
		'thesis_post_author',
		'thesis_post_author_avatar',
		'thesis_post_author_description',
		'thesis_post_image',
		'thesis_post_thumbnail',
		'thesis_wp_featured_image',
		'thesis_twitter_profile'
	);
	public $children = array(
		'byobagn_large_featured_image',
		'byobagn_post_heading_wrapper',
		'byobagn_top_social_media_extender',
		'thesis_post_content',
		'byobagn_bottom_social_media_extender'
	);
	private $pb;

	protected function translate() {
		$this->title = $this->name = __( 'Agility Single Post Box', 'byobagn' );
	}

	public function construct() {
		$this->pb = new byobagn_post_box_helper( $this->options );
	}

	protected function options() {
		$o = new byob_read_more_link();

		return $o->options();
	}

	protected function html_options() {
		$options = $this->pb->html_options();

		return $options;
	}

	public function html( $args = array() ) {
		global $post;
		extract( $args = is_array( $args ) ? $args : array() );
		$schema         = $this->pb->setup_schema( $post->ID );
		$args['schema'] = $schema;
		$type_class     = '';

		$this->pb->open_html( $args, $this->_id, $type_class );
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ), $this->options );
		$this->pb->close_html();
	}

}

class byobagn_post_heading_wrapper extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'thesis_post_headline',
		'byobagn_author_link',
		'thesis_post_date',
		'byobagn_category_link',
		'thesis_post_tags'
	);
	public $children = array(
		'thesis_post_headline',
		'byobagn_author_link',
		'thesis_post_date',
		'byobagn_category_link'
	);

	protected function translate() {
		$this->title = __( 'Post Headline', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		$tab   = str_repeat( "\t", $depth );

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( 'headline_area', false );

		$hook = trim( $thesis->api->esc( ! empty( $this->options['_id'] ) ?
			$this->options['_id'] : ( ! empty( $this->options['hook'] ) ?
				$this->options['hook'] : '' ) ) );

		! empty( $hook ) ? $thesis->api->hook( "hook_before_$hook" ) : '';
		echo "$tab<header $class>\n";
		! empty( $hook ) ? $thesis->api->hook( "hook_top_$hook" ) : '';
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		! empty( $hook ) ? $thesis->api->hook( "hook_bottom_$hook" ) : '';
		echo "$tab</header>\n";
		! empty( $hook ) ? $thesis->api->hook( "hook_after_$hook" ) : '';
	}

}

class byobagn_archive_post_heading_wrapper extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_featured_content_post_title',
		'byobagn_author_link',
		'thesis_post_date',
		'byobagn_category_link',
		'thesis_post_tags'
	);
	public $children = array(
		'byobagn_featured_content_post_title',
		'byobagn_author_link',
		'thesis_post_date',
		'byobagn_category_link'
	);

	protected function translate() {
		$this->title = __( 'Post Headline', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		$tab   = str_repeat( "\t", $depth );

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( 'headline_area', false );

		$hook = trim( $thesis->api->esc( ! empty( $this->options['_id'] ) ?
			$this->options['_id'] : ( ! empty( $this->options['hook'] ) ?
				$this->options['hook'] : '' ) ) );

		! empty( $hook ) ? $thesis->api->hook( "hook_before_$hook" ) : '';
		echo "$tab<header $class>\n";
		! empty( $hook ) ? $thesis->api->hook( "hook_top_$hook" ) : '';
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		! empty( $hook ) ? $thesis->api->hook( "hook_bottom_$hook" ) : '';
		echo "$tab</header>\n";
		! empty( $hook ) ? $thesis->api->hook( "hook_after_$hook" ) : '';
	}

}

class byobagn_postfooter_wrapper extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_dependent_read_more',
		'thesis_post_num_comments',
	);
	public $children = array(
		'byobagn_dependent_read_more',
		'thesis_post_num_comments',
	);

	protected function translate() {
		$this->title = __( 'Post Footer', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array(), $options = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		$tab   = str_repeat( "\t", $depth );

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( 'post_footer submit', false );

		echo "$tab<footer $class>\n";
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ), $options );
		echo "$tab</footer>\n";
	}

}

class byobagn_author_link extends thesis_box {

	protected function translate() {
		$this->title = __( 'Author', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$html                     = $thesis->api->html_options();
		$html['class']['tooltip'] = sprintf( __( 'This box already contains a %1$s of <code>post_author</code>. If you&#8217;d like to supply another %1$s, you can do that here.%2$s', 'byobagn' ), $thesis->api->base['class'], $thesis->api->strings['class_note'] );
		unset( $html['id'] );

		return array_merge( $html, array(
			'intro'    => array(
				'type'    => 'text',
				'width'   => 'short',
				'label'   => __( 'Author Intro Text', 'byobagn' ),
				'tooltip' => sprintf( __( 'Any text you supply here will be wrapped in %s, like so:<br /><code>&lt;span class="post_author_intro"&gt</code>your text<code>&lt;/span&gt;</code>.', 'byobagn' ), $thesis->api->base['html'] )
			),
			'link'     => array(
				'type'       => 'radio',
				'options'    => array(
					'on'  => __( 'Link author names to archives', 'byobagn' ),
					'off' => __( 'Don&apos;t link author names to archives', 'byobagn' )
				),
				'default'    => 'on',
				'dependents' => array( 'on' )
			),
			'nofollow' => array(
				'type'    => 'checkbox',
				'options' => array(
					'on' => __( 'Add <code>nofollow</code> to author link', 'byobagn' )
				),
				'parent'  => array(
					'link' => 'on'
				)
			)
		) );
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$depth  = isset( $depth ) ? $depth : 0;
		$tab    = str_repeat( "\t", $depth );
		$class  = ! empty( $this->options['class'] ) ? ' ' . trim( $thesis->api->esc( $this->options['class'] ) ) : '';
		$follow = ! empty( $this->options['nofollow']['on'] ) ? ' rel="nofollow"' : '';

		if ( empty( $this->options['link']['off'] ) ) {
			$author = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"' . $follow . '>' . get_the_author() . '</a>';
		} else {
			$author = get_the_author();
		}

		$intro      = ! empty( $this->options['intro'] ) ? $thesis->api->esch( $this->options['intro'] ) : 'By: ';
		$schema_att = ! empty( $schema ) ? ' itemprop="author"' : '';

		echo "$tab<span class=\"post_author_intro\">$intro</span>";
		echo apply_filters( 'byobagn', '<span class="post_author' . $class . '"' . $schema_att . ">$author</span>" ), "\n";
	}

}

class byobagn_category_link extends thesis_box {

	protected function translate() {
		$this->title = __( 'Categories', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$html = $thesis->api->html_options( array(
			'p'    => 'p',
			'div'  => 'div',
			'span' => 'span'
		), 'span' );
		unset( $html['id'], $html['class'] );

		return array_merge( $html, array(
			'intro'     => array(
				'type'    => 'text',
				'width'   => 'short',
				'label'   => $thesis->api->strings['intro_text'],
				'tooltip' => sprintf( __( 'Any intro text you provide will precede the post category output, and it will be wrapped in %s, like so: <code>&lt;span class="post_cats_intro"&gt;</code>your text<code>&lt;/span&gt;</code>.', 'byobagn' ), $thesis->api->base['html'] )
			),
			'separator' => array(
				'type'    => 'text',
				'width'   => 'tiny',
				'label'   => $thesis->api->strings['character_separator'],
				'tooltip' => __( 'If you&#8217;d like to separate your categories with a particular character (a comma, for instance), you can do that here.', 'byobagn' )
			),
			'nofollow'  => array(
				'type'    => 'checkbox',
				'options' => array(
					'on' => __( 'Add <code>nofollow</code> to category links', 'byobagn' )
				)
			)
		) );
	}

	public function html( $args = array() ) {
		global $thesis;
		if ( ! is_array( $categories = get_the_category() ) ) {
			return;
		}
		extract( $args = is_array( $args ) ? $args : array() );
		$tab        = str_repeat( "\t", ! empty( $depth ) ? $depth : 0 );
		$cats       = array();
		$html       = ! empty( $this->options['html'] ) ? $this->options['html'] : 'span';
		$nofollow   = ! empty( $this->options['nofollow']['on'] ) ? ' nofollow' : '';
		$intro      = ! empty( $this->options['intro'] ) ? $thesis->api->esch( $this->options['intro'] ) : ' - Posted in: ';
		$schema_att = ! empty( $schema ) ? ' itemprop="keywords"' : '';
		$separator  = ! empty( $this->options['separator'] ) ? trim( $thesis->api->esch( $this->options['separator'] ) ) : '';

		foreach ( $categories as $cat ) {
			$cats[] = "<a href=\"" . esc_url( get_category_link( $cat->term_id ) ) . "\" rel=\"category tag$nofollow\">$cat->name</a>"; #wp
		}

		if ( ! empty( $cats ) ) {
			echo "$tab<$html class=\"post_cats\"$schema_att>\n";
			echo "$tab\t<span class=\"post_cats_intro\">" . trim( $thesis->api->escht( $intro, true ) ) . "</span>\n";
			echo "$tab\t", implode( $separator . "\n$tab\t", $cats ), "\n";
			echo "$tab</$html>\n"; #wp
		}
	}

}

class byobagn_copyright_date extends thesis_box {

	protected function translate() {
		$this->name  = __( 'Agility Copyright Date', 'byobagn' );
		$this->title = __( 'Agility Copyright Date', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;

		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	protected function options() {
		global $thesis;

		return array(
			'company_name' => array(
				'type'    => 'text',
				'width'   => 'medium',
				'label'   => __( 'Company Name', 'byobagn' ),
				'tooltip' => __( 'Enter the company name you want displayed', 'byobagn' ),
				'default' => 'Your Company Name'
			),
			'start_date'   => array(
				'type'    => 'text',
				'width'   => 'short',
				'label'   => __( 'Begining Date', 'byobagn' ),
				'tooltip' => __( 'Enter the begining copyright date', 'byobagn' ),
				'default' => '1900'
			)
		);
	}

	public function html( $args = false ) {
		extract( $args = is_array( $args ) ? $args : array() );
		$tab          = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$company_name = ! empty( $this->options['company_name'] ) ? $this->options['company_name'] : 'Your Company Name';
		$start_date   = ! empty( $this->options['start_date'] ) ? $this->options['start_date'] : '';
		$classout     = new byobagn_config_classes( $this->options, 'class' );

		$class = $classout->given( 'copyright', false );

		echo $tab . '<p' . $class . '>Copyright &copy ' . ( ( $start_date != "" ) ? " $start_date&ndash;" : "" ) . date( 'Y' ) . ' ' . $company_name . '  All Rights Reserved.</p>';
	}

}

class byobagn_phone_number extends thesis_box {

	protected function translate() {
		$this->name = $this->title = __( 'Agility Phone Link', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;

		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	protected function options() {
		global $thesis;

		return array(
			'message'      => array(
				'type'        => 'text',
				'width'       => 'long',
				'code'        => true,
				'label'       => __( 'Heading Text', 'byobagn' ),
				'tooltip'     => __( 'Enter the heading text you want displayed above the phone number', 'byobagn' ),
				'placeholder' => 'Call Us Today'
			),
			'phone_number' => array(
				'type'        => 'text',
				'width'       => 'medium',
				'label'       => __( 'Actual Phone Number - numbers only', 'byobagn' ),
				'tooltip'     => __( 'This should be in the international system - country code, area code, phone number<br>examples - Germany 4917640206387, USA 12068015209 ', 'byobagn' ),
				'placeholder' => '12068015209'
			),
			'label'        => array(
				'type'        => 'text',
				'width'       => 'medium',
				'code'        => true,
				'label'       => __( 'Phone Number as it should be displayed', 'byobagn' ),
				'tooltip'     => __( 'This can be in any format you like<br>examples - Germany 49 (0)176 - 402 063 87, USA (206) 801-5209 ', 'byobagn' ),
				'placeholder' => '(206) 801-5209'
			)
		);
	}

	public function html( $args = false ) {
		extract( $args = is_array( $args ) ? $args : array() );
		$tab          = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$message      = ! empty( $this->options['message'] ) ? wp_kses_post( $this->options['message'] ) : false;
		$phone_number = ! empty( $this->options['phone_number'] ) ? (int) $this->options['phone_number'] : '12068015209';
		$label        = ! empty( $this->options['label'] ) ? wp_kses_post( $this->options['label'] ) : '(206) 801-5209';

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( 'phone_number', false );

		echo "$tab<div$class>\n";
		if ( $message ) {
			echo "$tab\t<p class=\"heading\">$message</p>";
		}
		echo "$tab\t<p class=\"phone_link\"><a href=\"tel:+$phone_number\">$label</a></p>";
		echo "$tab</div>\n";
	}

}

class byobagn_wp_featured_image extends thesis_box {

	protected function translate() {
		$this->title = $this->name = __( 'Agility Featured Image', 'byobagn' );
	}

	public function construct() {
		$this->fimage = new byobagn_featured_image( 'byobagn' );
	}

	protected function html_options() {

		$options                         = $this->fimage->html_options();
		$options['size']['default']      = 'thumbnail';
		$options['alignment']['default'] = 'left';
		$options['link']['default']      = 'yes';

		return $options;
	}

	public function html( $args = false ) {

		$size                  = ! empty( $this->options['size'] ) ? $this->options['size'] : 'thumbnail';
		$this->options['size'] = $size;

		$alignment                  = ! empty( $this->options['alignment'] ) ? $this->options['alignment'] : 'left';
		$this->options['alignment'] = $alignment;

		$link                  = ! empty( $this->options['link'] ) ? $this->options['link'] : 'yes';
		$this->options['link'] = $link;

		$this->fimage->html( $args, $this->options );
	}

}

class byobagn_thumbnail_featured_image extends thesis_box {

	protected function translate() {
		$this->title = __( 'Featured Image', 'byobagn' );
	}

	public function construct() {
		$this->fimage = new byobagn_featured_image( 'byobagn' );
	}

	protected function html_options() {

		$options                         = $this->fimage->html_options();
		$options['size']['default']      = 'thumbnail';
		$options['alignment']['default'] = 'left';
		$options['link']['default']      = 'yes';

		return $options;
	}

	public function html( $args = false ) {

		$size                  = ! empty( $this->options['size'] ) ? $this->options['size'] : 'thumbnail';
		$this->options['size'] = $size;

		$alignment                  = ! empty( $this->options['alignment'] ) ? $this->options['alignment'] : 'left';
		$this->options['alignment'] = $alignment;

		$link                  = ! empty( $this->options['link'] ) ? $this->options['link'] : 'yes';
		$this->options['link'] = $link;

		$this->fimage->html( $args, $this->options );
	}

}

class byobagn_featured_content_featured_image extends thesis_box {

	protected function translate() {
		$this->title = __( 'Featured Image', 'byobagn' );
	}

	public function construct() {
		$this->fimage = new byobagn_featured_image( 'byobagn' );
	}

	protected function html_options() {

		$options                         = $this->fimage->html_options();
		$options['size']['default']      = 'agility-featured-page';
		$options['alignment']['default'] = 'none';
		$options['link']['default']      = 'yes';

		return $options;
	}

	public function html( $args = false ) {

		$size                  = ! empty( $this->options['size'] ) ? $this->options['size'] : 'agility-featured-page';
		$this->options['size'] = $size;

		$alignment                  = ! empty( $this->options['alignment'] ) ? $this->options['alignment'] : 'none';
		$this->options['alignment'] = $alignment;

		$link                  = ! empty( $this->options['link'] ) ? $this->options['link'] : 'yes';
		$this->options['link'] = $link;

		$this->fimage->html( $args, $this->options );
	}

}

class byobagn_large_featured_image extends thesis_box {

	protected function translate() {
		$this->title = __( 'Featured Image', 'byobagn' );
	}

	public function construct() {
		$this->fimage = new byobagn_featured_image();
	}

	protected function html_options() {

		$options                         = $this->fimage->html_options();
		$options['size']['default']      = 'large';
		$options['alignment']['default'] = 'none';
		$options['link']['default']      = 'no';

		return $options;
	}

	public function html( $args = false ) {

		$size                  = ! empty( $this->options['size'] ) ? $this->options['size'] : 'large';
		$this->options['size'] = $size;

		$alignment                  = ! empty( $this->options['alignment'] ) ? $this->options['alignment'] : 'none';
		$this->options['alignment'] = $alignment;

		$link                  = ! empty( $this->options['link'] ) ? $this->options['link'] : 'no';
		$this->options['link'] = $link;

		$this->fimage->html( $args, $this->options );
	}

}

class byobagn_featured_content_post_title extends thesis_box {

	protected function translate() {
		$this->title = __( 'Page Title', 'byobagn' );
	}

	public function construct() {
		$this->post_title = new byob_post_title( 'byobagn' );
	}

	protected function html_options() {

		$options                    = $this->post_title->html_options();
		$options['link']['default'] = 'on';

		return $options;
	}

	public function html( $args = false ) {

		$link                  = ! empty( $this->options['link'] ) ? $this->options['link'] : 'on';
		$this->options['link'] = $link;

		$output = $this->post_title->html( $args, $this->options );
	}

}

class byobagn_small_headline_post_title extends thesis_box {

	protected function translate() {
		$this->title = __( 'Page Title', 'byobagn' );
	}

	public function construct() {
		$this->post_title = new byob_post_title( 'byobagn' );
	}

	protected function html_options() {

		$options                    = $this->post_title->html_options();
		$options['link']['default'] = 'on';
		$options['html']['default'] = 'p';

		return $options;
	}

	public function html( $args = false ) {

		$link                  = ! empty( $this->options['link'] ) ? $this->options['link'] : 'on';
		$this->options['link'] = $link;

		$html                  = ! empty( $this->options['html'] ) ? $this->options['html'] : 'p';
		$this->options['html'] = $html;

		$output = $this->post_title->small_headline_html( $args, $this->options );
	}

}

class byobagn_featured_content_query_box extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_featured_content_featured_image',
		'byobagn_featured_content_post_title',
		'thesis_post_date',
		'thesis_post_content',
		'byobagn_typical_excerpt',
		'thesis_post_categories',
		'thesis_post_tags',
		'byobagn_featured_content_read_more'
	);
	public $children = array(
		'byobagn_featured_content_featured_image',
		'byobagn_featured_content_post_title',
		'byobagn_typical_excerpt',
		'byobagn_featured_content_read_more'
	);
	public $exclude = array();
	private $query = false;
	public $post_id = '';

	protected function translate() {
		$this->title = $this->name = __( 'Agility Featured Content Box', 'byobagn' );
	}

	public function construct() {
		$this->qb = new byobagn_query_box_helper( 'byobagn' );
	}

	protected function html_options() {
		$options = $this->qb->html_options();
		unset( $options['id'] );

		return $options;
	}

	protected function options() {
		$o             = new byob_typical_query_options();
		$l             = new byob_read_more_link();
		$query_options = $o->single();
		$link_options  = $l->options();

//                var_dump($options);
		return array_merge( $query_options, $link_options );
	}

	public function make_query() {
		$q           = new byob_typical_query( $this->options );
		$query       = $q->single_query();
		$this->query = new WP_Query( $query ); // new or cached query object
	}

	public function html( $args = array() ) {
		global $thesis;
		if ( empty( $this->query ) ) {
			$this->make_query();
		}
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		$tab   = str_repeat( "\t", $depth );
		$html  = ! empty( $this->options['html'] ) ? $this->options['html'] : 'div';

		$classout = new byobagn_config_classes( $this->options, 'class' );
		if ( ! empty( $this->options['wp']['auto'] ) ) {
			$secondary = get_post_class();

			$class = $classout->secondary( 'query_box attention_box', false, $secondary );
		} else {

			$class = $classout->given( 'query_box attention_box', false );
		}

//                var_dump($this->options);
		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			$this->post_id = $this->query->post->ID;
			do_action( 'thesis_init_post_meta', $this->query->post->ID );
			$schema     = $this->qb->setup_schema( $this->query->post->ID );
			$schema_att = $schema ? ' itemscope itemtype="' . esc_url( $thesis->api->schema->types[ $schema ] ) . '"' : '';

			echo "$tab<$html$class$schema_att>\n";

			$this->rotator( array_merge( $args, array(
				'depth'   => $depth + 1,
				'schema'  => $schema,
				'post_id' => $this->post_id
			), $this->options ) );

			echo "$tab</$html>\n";
		}


		wp_reset_postdata();
	}

}

class byobagn_enhanced_query_box extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_featured_content_featured_image',
		'byobagn_dependent_icon_box',
		'byobagn_featured_content_post_title',
		'thesis_post_date',
		'byobagn_enhanced_query_box_content_wrapper',
		'thesis_post_categories',
		'thesis_post_tags',
		'byobagn_dependent_read_more',
		'thesis_post_author',
		'thesis_post_author_avatar',
		'thesis_post_author_description',
		'thesis_post_content',
		'thesis_post_num_comments',
		'thesis_post_image',
		'thesis_post_thumbnail',
		'thesis_twitter_profile'
	);
	public $children = array(
		'byobagn_featured_content_featured_image',
		'byobagn_featured_content_post_title',
		'byobagn_enhanced_query_box_content_wrapper',
		'byobagn_dependent_read_more'
	);
	public $exclude = array();
	private $query = false;

	protected function translate() {
		$this->title = $this->name = __( 'Agility Enhanced Query Box', 'byobagn' );
	}

	public function construct() {
		$this->qb = new byobagn_query_box_helper();
	}

	protected function html_options() {
		$options = $this->qb->expanded_html_options();
		unset( $options['id'] );
		$title_options = $this->qb->title_html_options();

		return array_merge( $options, $title_options );
	}

	protected function options() {
		$o = new byob_typical_query_options();
		$l = new byob_read_more_link();
		$i = new byobagn_icon_helper();

		$title_options = $this->qb->title_options();
		$query_options = $o->multiple();
		$link_options  = $l->options();
		$icon_options  = $i->options();
		unset( $icon_options['icon'] );

		return array_merge( $title_options, $query_options, $link_options, $icon_options );
	}

	public function make_query() {
		$q           = new byob_typical_query( $this->options );
		$query       = $q->multiple_query();
		$this->query = new WP_Query( $query ); // new or cached query object
	}

	public function html( $args = array() ) {
		global $thesis;
		if ( empty( $this->query ) ) {
			$this->make_query();
		}
		extract( $args = is_array( $args ) ? $args : array() );
		$depth          = isset( $depth ) ? $depth : 0;
		$tab            = str_repeat( "\t", $depth );
		$html           = ! empty( $this->options['html'] ) ? $this->options['html'] : 'div';
		$title_html     = ! empty( $this->options['title_html'] ) ? $this->options['title_html'] : 'p';
		$title_classout = new byobagn_config_classes( $this->options, 'title_class' );
		$title_class    = $title_classout->given( 'widget_title', true );

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$is_list  = ( $html === 'ul' || $html === 'ol' ) ? true : false;


		if ( ! empty( $this->options['wp']['auto'] ) ) {
			$secondary = get_post_class();
			if ( $is_list ) {
				$class = $classout->secondary( 'query_list', false, $secondary );
			} else {
				$class = $classout->secondary( 'query_box', false, $secondary );
			}
		} else {
			if ( $is_list ) {
				$class = $classout->given( 'query_list', false );
			} else {
				$class = $classout->given( 'query_box', false );
			}
		}
		if ( $is_list ) {
			echo "$tab<$html$class>\n";
		}

		if ( ! empty( $this->options['title_text'] ) ) {
			echo "$tab<$title_html$title_class>" . wp_kses_post( $this->options['title_text'] ) . "</$title_html>\n";
		}

		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			do_action( 'thesis_init_post_meta', $this->query->post->ID );
			$schema     = $this->qb->setup_schema( $this->query->post->ID );
			$schema_att = $schema ? ' itemscope itemtype="' . esc_url( $thesis->api->schema->types[ $schema ] ) . '"' : '';

			if ( $is_list ) {
				echo "$tab<li$schema_att>\n";
			} else {
				echo "$tab<$html$class$schema_att>\n";
			}
			$this->rotator( array_merge( $args, array(
				'depth'   => $depth + 1,
				'schema'  => $schema,
				'post_id' => $this->query->post->ID
			) ), $this->options );
			if ( $is_list ) {
				echo "$tab</li>\n";
			} else {
				echo "$tab</$html>\n";
			}
		}

		if ( $is_list ) {
			echo "$tab</$html>\n";
		}

		wp_reset_postdata();
	}

}


class byobagn_related_posts_query_box extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_featured_content_featured_image',
		'byobagn_dependent_icon_box',
		'byobagn_featured_content_post_title',
		'thesis_post_date',
		'byobagn_enhanced_query_box_content_wrapper',
		'thesis_post_categories',
		'thesis_post_tags',
		'byobagn_dependent_read_more',
		'thesis_post_author',
		'thesis_post_author_avatar',
		'thesis_post_author_description',
		'thesis_post_content',
		'thesis_post_num_comments',
		'thesis_post_image',
		'thesis_post_thumbnail',
		'thesis_twitter_profile'
	);
	public $children = array(
		'byobagn_featured_content_featured_image',
		'byobagn_featured_content_post_title',
		'byobagn_enhanced_query_box_content_wrapper',
		'byobagn_dependent_read_more'
	);
	public $exclude = array();
	private $query = false;

	protected function translate() {
		$this->title = $this->name = __( 'Agility Related Posts', 'byobagn' );
	}

	public function construct() {
		$this->qb = new byobagn_query_box_helper();
	}

	protected function html_options() {
		$options = $this->qb->html_options();
		unset( $options['id'] );
		$title_options = $this->qb->title_html_options();

		return array_merge( $options, $title_options );
	}

	protected function options() {
		$o = new byob_typical_query_options();
		$l = new byob_read_more_link();
		$i = new byobagn_icon_helper();

		$title_options = $this->qb->title_options();
		$query_options = $o->related();
		$link_options  = $l->options();
		$icon_options  = $i->options();
		unset( $icon_options['icon'] );

		return array_merge( $title_options, $query_options, $link_options, $icon_options );
	}

	public function make_query() {
		$q           = new byob_typical_query( $this->options );
		$query       = $q->related_query();
		$this->query = new WP_Query( $query ); // new or cached query object
	}

	public function html( $args = array() ) {
		global $thesis;
		if ( empty( $this->query ) ) {
			$this->make_query();
		}
		extract( $args = is_array( $args ) ? $args : array() );
		$depth          = isset( $depth ) ? $depth : 0;
		$tab            = str_repeat( "\t", $depth );
		$html           = ! empty( $this->options['html'] ) ? $this->options['html'] : 'div';
		$title_html     = ! empty( $this->options['title_html'] ) ? $this->options['title_html'] : 'p';
		$title_classout = new byobagn_config_classes( $this->options, 'title_class' );
		$title_class    = $title_classout->given( 'widget_title', true );

		$classout = new byobagn_config_classes( $this->options, 'class' );
		if ( ! empty( $this->options['wp']['auto'] ) ) {
			$secondary = get_post_class();
			$class     = $classout->secondary( 'query_box', false, $secondary );
		} else {
			$class = $classout->given( 'query_box', false );
		}

		if ( ! empty( $this->options['title_text'] ) ) {
			echo "$tab<$title_html$title_class>" . wp_kses_post( $this->options['title_text'] ) . "</$title_html>\n";
		}

		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			do_action( 'thesis_init_post_meta', $this->query->post->ID );
			$schema     = $this->qb->setup_schema( $this->query->post->ID );
			$schema_att = $schema ? ' itemscope itemtype="' . esc_url( $thesis->api->schema->types[ $schema ] ) . '"' : '';

			echo "$tab<$html$class$schema_att>\n";
			$this->rotator( array_merge( $args, array(
				'depth'   => $depth + 1,
				'schema'  => $schema,
				'post_id' => $this->query->post->ID
			) ), $this->options );
			echo "$tab</$html>\n";
		}

		wp_reset_postdata();
	}

}

class byobagn_related_posts_thumbnails extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_thumbnail_featured_image',
		'byobagn_small_headline_post_title',
		'thesis_post_categories',
		'thesis_post_tags',
		'thesis_post_image',
		'thesis_post_thumbnail'
	);
	public $children = array(
		'byobagn_thumbnail_featured_image',
		'byobagn_small_headline_post_title'
	);
	public $exclude = array();
	private $query = false;

	protected function translate() {
		$this->title = $this->name = __( 'Agility Related Posts Thumbnails', 'byobagn' );
	}

	public function construct() {
		$this->qb = new byobagn_query_box_helper();
	}

	protected function html_options() {
		$options = $this->qb->html_options();
		unset( $options['id'] );
		$title_options = $this->qb->title_html_options();

		return array_merge( $options, $title_options );
	}

	protected function options() {
		$columns       = array(
			'columns' => array(
				'type'    => 'select',
				'label'   => __( 'Number of related posts in each row', 'byobagn' ),
				'options' => array(
					''            => __( 'One Post', 'byobagn' ),
					'half'        => __( 'Two posts', 'byobagn' ),
					'one-third'   => __( 'Three posts', 'byobagn' ),
					'one-quarter' => __( 'Four posts', 'byobagn' )
				),
				'default' => ''
			)
		);
		$o             = new byob_typical_query_options();
		$title_options = $this->qb->title_options();
		$query_options = $o->related();

		return array_merge( $columns, $title_options, $query_options );
	}

	public function make_query() {
		$q           = new byob_typical_query( $this->options );
		$query       = $q->related_query();
		$this->query = new WP_Query( $query ); // new or cached query object
	}

	public function html( $args = array() ) {
		global $thesis;
		if ( empty( $this->query ) ) {
			$this->make_query();
		}
		extract( $args = is_array( $args ) ? $args : array() );
		$depth          = isset( $depth ) ? $depth : 0;
		$tab            = str_repeat( "\t", $depth );
		$html           = ! empty( $this->options['html'] ) ? $this->options['html'] : 'div';
		$title_html     = ! empty( $this->options['title_html'] ) ? $this->options['title_html'] : 'p';
		$columns        = ! empty( $this->options['columns'] ) ? $this->options['columns'] : '';
		$title_classout = new byobagn_config_classes( $this->options, 'title_class' );
		$title_class    = $title_classout->given( 'widget_title', true );

		$classout = new byobagn_config_classes( $this->options, 'class' );
		if ( ! empty( $this->options['wp']['auto'] ) ) {
			$secondary = get_post_class();
			$secondary .= ' ' . $columns;
			$class     = $classout->secondary( 'query_box', false, $secondary );
		} else {
			$class = $classout->secondary( 'query_box', false, $columns );
		}
		echo "$tab<section class=\"related_post_thumbnails\">\n";

		if ( ! empty( $this->options['title_text'] ) ) {
			echo "$tab\t<$title_html$title_class>" . wp_kses_post( $this->options['title_text'] ) . "</$title_html>\n";
		}

		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			do_action( 'thesis_init_post_meta', $this->query->post->ID );
			$schema     = $this->qb->setup_schema( $this->query->post->ID );
			$schema_att = $schema ? ' itemscope itemtype="' . esc_url( $thesis->api->schema->types[ $schema ] ) . '"' : '';

			echo "$tab\t<$html$class$schema_att>\n";
			$this->rotator( array_merge( $args, array(
				'depth'   => $depth + 2,
				'schema'  => $schema,
				'post_id' => $this->query->post->ID
			), $this->options ) );
			echo "$tab\t</$html>\n";
		}
		echo "$tab</section>\n";

		wp_reset_postdata();
	}

}

class byobagn_enhanced_query_box_content_wrapper extends thesis_box {

	public $type = 'rotator';
	public $dependents = array( 'byobagn_typical_excerpt' );
	public $children = array( 'byobagn_typical_excerpt' );

	protected function translate() {
		$this->title = __( 'Content Wrapper', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		$tab   = str_repeat( "\t", $depth );

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( 'content_wrapper', false );

		echo "$tab<div $class>\n";
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		echo "$tab</div>\n";
	}

}

class byobagn_dependent_icon_box extends thesis_box {

	public $type = 'box';
	public $icon_option = false;

	protected function translate() {
		$this->title = __( 'Icon', 'byobagn' );
		$this->icon  = new byobagn_icon_helper( 'byobagn' );
	}

	protected function html_options() {
		$options = $this->icon->html_options();

		return $options;
	}

	public function html( $args = false ) {
		extract( $args = is_array( $args ) ? $args : array() );
		if ( empty( $icon_option ) ) {
			$icon_option = false;
		}

		$post_meta = get_post_meta( $post_id, 'byob_post_icon', true );
		if ( ! empty( $post_meta ) ) {
			$this->options['icon'] = $post_meta;
		}

		$output = $this->icon->html( $args, $this->options, $icon_option );
	}

}

class byobagn_icon_query_box extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'byobagn_dependent_icon_box',
		'byobagn_featured_content_post_title',
		'byobagn_typical_short_excerpt',
		'byobagn_featured_content_read_more'
	);
	public $children = array(
		'byobagn_dependent_icon_box',
		'byobagn_featured_content_post_title',
		'byobagn_typical_short_excerpt',
		'byobagn_featured_content_read_more'
	);
	public $exclude = array();
	private $query = false;

	protected function translate() {
		$this->title = $this->name = __( 'Agility Icon Content Box', 'byobagn' );
	}

	public function construct() {
		$this->qb = new byobagn_query_box_helper( 'byobagn' );
	}

	protected function html_options() {
		$options = $this->qb->html_options();
		unset( $options['id'] );

		return $options;
	}

	protected function options() {
		$o             = new byob_typical_query_options();
		$l             = new byob_read_more_link();
		$i             = new byobagn_icon_helper();
		$query_options = $o->single();
		$link_options  = $l->options();
		$icon_options  = $i->options();
		unset( $icon_options['icon'] );

		return array_merge( $icon_options, $query_options, $link_options );
	}

	public function make_query() {
		$q           = new byob_typical_query( $this->options );
		$query       = $q->single_query();
		$this->query = new WP_Query( $query ); // new or cached query object
	}

	public function html( $args = array() ) {
		global $thesis;
		if ( empty( $this->query ) ) {
			$this->make_query();
		}
		extract( $args = is_array( $args ) ? $args : array() );
		$depth                       = isset( $depth ) ? $depth : 0;
		$tab                         = str_repeat( "\t", $depth );
		$html                        = ! empty( $this->options['html'] ) ? $this->options['html'] : 'div';
		$icon_size                   = ! empty( $this->options['icon_size'] ) ? $this->options['icon_size'] : 48;
		$this->options['icon_size']  = $icon_size;
		$icon_style                  = ! empty( $this->options['icon_style'] ) ? $this->options['icon_style'] : '';
		$this->options['icon_style'] = $icon_style;

		$classout = new byobagn_config_classes( $this->options, 'class' );
		if ( ! empty( $this->options['wp']['auto'] ) ) {
			$secondary = get_post_class();
			$class     = $classout->secondary( 'query_box icon_box', false, $secondary );
		} else {
			$class = $classout->given( 'query_box icon_box', false );
		}

		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			do_action( 'thesis_init_post_meta', $this->query->post->ID );
			$schema     = $this->qb->setup_schema( $this->query->post->ID );
			$schema_att = $schema ? ' itemscope itemtype="' . esc_url( $thesis->api->schema->types[ $schema ] ) . '"' : '';

			echo "$tab<$html$class$schema_att>\n";
			$this->rotator( array_merge( $args, array(
				'depth'   => $depth + 1,
				'schema'  => $schema,
				'post_id' => $this->query->post->ID
			), $this->options ) );
			echo "$tab</$html>\n";
		}

		wp_reset_postdata();
	}

}

class byobagn_icon_box extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Agility Icon', 'byobagn' );
		$this->icon  = new byobagn_icon_helper();
	}

	protected function html_options() {
		$options = $this->icon->html_options();

		return $options;
	}

	protected function options() {
		$options = $this->icon->options();

		return $options;
	}

	public function html( $args = false ) {
		$output = $this->icon->html( $args, $this->options );
	}

}

class byobagn_read_more extends thesis_box {

	protected function translate() {
		$this->name = $this->title = __( 'Agility Read More', 'byobagn' );
	}

	public function construct() {
		$this->link = new byob_read_more_link( 'byobagn' );
	}

	protected function html_options() {
		$hoptions                    = $this->link->html_options();
		$hoptions['html']['default'] = 'span';

		return $hoptions;
	}

	protected function options() {
		$options = $this->link->options();

		return $options;
	}

	public function html( $args = false ) {

		$html                     = ! empty( $this->options['html'] ) ? $this->options['html'] : 'span';
		$this->options['html']    = $html;
		$message                  = ! empty( $this->options['message'] ) ? $this->options['message'] : 'Read More';
		$this->options['message'] = $message;
		$this->link->html( $args, $this->options );
	}

}

class byobagn_featured_content_read_more extends thesis_box {

	protected function translate() {
		$this->title = __( 'Read More', 'byobagn' );
	}

	public function construct() {
		$this->link = new byob_read_more_link( 'byobagn' );
	}

	protected function html_options() {
		$hoptions                    = $this->link->html_options();
		$hoptions['html']['default'] = 'span';

		return $hoptions;
	}

	public function html( $args = false ) {

		extract( $args = is_array( $args ) ? $args : array() );
		$html                     = ! empty( $this->options['html'] ) ? $this->options['html'] : 'span';
		$this->options['html']    = $html;
		$message                  = ! empty( $message ) ? $message : 'Learn More';
		$this->options['message'] = $message;

		$this->link->html( $args, $this->options );
	}

}

class byobagn_dependent_read_more extends thesis_box {

	protected function translate() {
		$this->title = __( 'Read More', 'byobagn' );
	}

	public function construct() {
		$this->link = new byob_read_more_link( 'byobagn' );
	}

	protected function html_options() {
		$hoptions                    = $this->link->html_options();
		$hoptions['html']['default'] = 'span';

		return $hoptions;
	}

	public function html( $args = false, $options = array() ) {

		if ( ! empty( $options['message'] ) ) {
			$this->options['message'] = $options['message'];
		}

		extract( $args = is_array( $args ) ? $args : array() );
		$html                  = ! empty( $this->options['html'] ) ? $this->options['html'] : 'span';
		$this->options['html'] = $html;

		$this->link->html( $args, $this->options );
	}

}

class byobagn_typical_short_excerpt extends thesis_box {

	private $excerpt;

	protected function translate() {
		$this->title = __( 'Short Excerpt', 'byobagn' );
	}

	public function construct() {
		$length                  = ! empty( $this->options['length'] ) ? (int) $this->options['length'] : 25;
		$this->options['length'] = $length;
		$this->excerpt           = new byobagn_excerpt( $this->options );
	}

	protected function html_options() {
		$options                          = $this->excerpt->html_options();
		$options['length']['placeholder'] = '25';

		return $options;
	}

	public function html( $args = false ) {

		$this->excerpt->html( $args );
	}

}

class byobagn_typical_excerpt extends thesis_box {

	private $excerpt;

	protected function translate() {
		$this->title = __( 'Extended Excerpt', 'byobagn' );
	}

	public function construct() {
		$this->excerpt = new byobagn_excerpt( $this->options );
	}

	protected function html_options() {
		$options = $this->excerpt->html_options();

		return $options;
	}

	public function html( $args = false ) {
		$this->excerpt->html( $args );
	}

}

class byobagn_custom_post_nav extends thesis_box {
	/* Box properties and methods go here */

	public $type = 'box';
	public $templates = array( 'single' );

	protected function translate() {
		$this->title = $this->name = __( 'Agility Custom Post Nav', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$html = $thesis->api->html_options( array(
			'div'  => 'div',
			'span' => 'span',
			'p'    => 'p'
		), 'span' );
		unset( $html['id'] );

		return array_merge( $html, array(
			'link-type'      => array(
				'type'       => 'select',
				'label'      => __( 'Next or Previous Post Link?', 'byobagn' ),
				'options'    => array(
					'next'     => __( 'Next post', 'byobagn' ),
					'previous' => __( 'Previous post', 'byobagn' )
				),
				'default'    => 'next',
				'dependents' => array( 'next', 'previous' )
			),
			'next-intro'     => array(
				'type'        => 'text',
				'width'       => 'medium',
				'code'        => true,
				'label'       => __( 'Next Post Intro Text', 'byobagn' ),
				'tooltip'     => __( 'Enter text that will precede the actual link to the post - This is optional', 'byobagn' ),
				'placeholder' => __( 'Next Post:', 'byobagn' ),
				'parent'      => array( 'link-type' => 'next' )
			),
			'previous-intro' => array(
				'type'        => 'text',
				'width'       => 'medium',
				'code'        => true,
				'label'       => __( 'Previous Post Intro Text', 'byobagn' ),
				'tooltip'     => __( 'Enter text that will precede the actual link to the post - This is optional', 'byobagn' ),
				'placeholder' => __( 'Previous Post:', 'byobagn' ),
				'parent'      => array( 'link-type' => 'previous' )
			),
			'link'           => array(
				'type'       => 'select',
				'label'      => __( 'Choose the source of the link text', 'byobagn' ),
				'options'    => array(
					'title'  => __( 'Use the page title', 'byobagn' ),
					'custom' => __( 'Use your own custom text', 'byobagn' )
				),
				'default'    => 'title',
				'dependents' => array( 'custom' )
			),
			'custom-text'    => array(
				'type'   => 'text',
				'width'  => 'medium',
				'label'  => __( 'Enter your own custom text', 'byobagn' ),
				'parent' => array( 'link' => 'custom' )
			)
		) );
	}

	public function html( $args = array() ) {
		global $thesis, $wp_query;
		if ( ! $wp_query->is_single ) {
			return;
		}
		extract( $args = is_array( $args ) ? $args : array() );
		$tab      = str_repeat( "\t", ! empty( $depth ) ? $depth : 0 );
		$html     = ! empty( $this->options['html'] ) ? $this->options['html'] : 'span';
		$linktype = ! empty( $this->options['link-type'] ) ? $this->options['link-type'] : 'next';

		$classout = new byobagn_config_classes( $this->options, 'class' );


		if ( $linktype === 'previous' ) {
			$class = $classout->given( 'previous_post', false );
			$intro = ! empty( $this->options['previous-intro'] ) ? wp_kses_post( $this->options['previous-intro'] ) . ' ' : '';

			echo "$tab<$html$class>";
			previous_post_link( $intro . '%link', ! empty( $this->options['link'] ) && $this->options['link'] == 'custom' ? ( ! empty( $this->options['custom-text'] ) ? wp_kses_post( $this->options['custom-text'] ) : '%title' ) : '%title' ); #wp
			echo "</$html>\n";
		} else {
			$class = $classout->given( 'next_post', false );
			$intro = ! empty( $this->options['next-intro'] ) ? ' ' . wp_kses_post( $this->options['next-intro'] ) : '';

			echo "$tab<$html$class>";
			next_post_link( '%link' . $intro, ! empty( $this->options['link'] ) && $this->options['link'] == 'custom' ? ( ! empty( $this->options['custom-text'] ) ? wp_kses_post( $this->options['custom-text'] ) : '%title' ) : '%title' ); #wp
			echo "</$html>\n";
		}
	}

}

class byobagn_social_media_extender extends thesis_box {

	public $type = 'rotator';
	public $dependents = array();
	public $children = array();
	private $output = false;

	protected function translate() {
		global $thesis;
		$this->name = $this->title = __( 'Agility DIYThemes Social Media Extender', 'byobagn' );
	}

	protected function construct() {
		$this->options['_id'] = $this->_class;
		$this->sme            = new byobagn_social_media_extender_helper( $this->options );
		$this->dependents     = $this->sme->configure_dependents();
		$this->children       = $this->sme->configure_children();

		if ( ! empty( $this->dependents ) ) {
			$this->output = true;
		};
	}

	protected function html_options() {
		global $thesis;
		$html = $thesis->api->html_options();
		unset( $html['id'] );

		return $html;
	}

	public function html( $args = false ) {
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		if ( $this->output == false ) {
			return;
		}

		$this->sme->html_open( $args );
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		$this->sme->html_close();
	}

}

class byobagn_top_social_media_extender extends thesis_box {

	public $type = 'rotator';
	public $sharing_options = array();
	public $dependents = array(
		'byobagn_twitter_sharing_link',
		'byobagn_facebook_sharing_link',
		'byobagn_linkedin_sharing_link',
		'byobagn_stumbleupon_sharing_link',
		'byobagn_googleplus_sharing_link',
		'byobagn_pinterest_sharing_link',
		'byobagn_reddit_sharing_link',
		'byobagn_tumblr_sharing_link'
	);
	public $children = array(
		'byobagn_twitter_sharing_link',
		'byobagn_facebook_sharing_link',
		'byobagn_linkedin_sharing_link',
		'byobagn_stumbleupon_sharing_link',
		'byobagn_googleplus_sharing_link',
		'byobagn_pinterest_sharing_link',
		'byobagn_reddit_sharing_link',
		'byobagn_tumblr_sharing_link'
	);
	protected $filters = array(
		'menu'     => 'skin',
		'priority' => 2
	);

	protected function translate() {
		$this->title           = __( 'Top Social Sharing Links', 'byobagn' );
		$this->filters['text'] = __( 'Social Sharing Links', 'byobagn' );
	}

	public function construct() {
		global $thesis;
		if ( ! empty( $thesis->api->options['byobagn_social_sharing_links'] ) ) {
			$this->sharing_options = unserialize( $thesis->api->options['byobagn_social_sharing_links'] );
		}
	}

	protected function html_options() {
		global $thesis;
		$options           = $thesis->api->html_options();
		$options ['style'] = array(
			'type'    => 'select',
			'label'   => __( 'Choose a style', 'byobagn' ),
			'options' => array(
				''           => __( 'Social sharing colors for buttons', 'byobagn' ),
				'monochrome' => __( 'Monochrome buttons', 'byobagn' )
			)
		);

		return $options;
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );

		$style = ! empty( $this->options['style'] ) ? esc_attr( $this->options['style'] ) : '';

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->secondary( 'social_links', false, $style );

		$output = new byobagn_config_id( $this->options, 'id' );
		$id     = $output->simple();

		$intro_lable = false;
		if ( isset( $this->sharing_options['use_intro_label']['use_label'] ) ) {
			$intro_lable = ( ! empty( $this->sharing_options['intro_lable'] ) ) ? wp_kses_post( $this->sharing_options['intro_lable'] ) : 'Share This On: ';
		}

		echo "$tab<p$id$class>\n";
		if ( isset( $this->sharing_options['use_intro_label']['use_label'] ) && $intro_lable ) {
			echo "$tab<span class=\"intro_label\">$intro_lable</span>";
		}
		echo $this->rotator( array_merge( $args, array(
			'depth'   => $depth + 1,
			'options' => $this->sharing_options
		) ) );
		echo "$tab</p>\n";
	}

}

class byobagn_bottom_social_media_extender extends thesis_box {

	public $type = 'rotator';
	public $sharing_options = array();
	public $dependents = array(
		'byobagn_twitter_sharing_link',
		'byobagn_facebook_sharing_link',
		'byobagn_linkedin_sharing_link',
		'byobagn_stumbleupon_sharing_link',
		'byobagn_googleplus_sharing_link',
		'byobagn_pinterest_sharing_link',
		'byobagn_reddit_sharing_link',
		'byobagn_tumblr_sharing_link'
	);
	public $children = array(
		'byobagn_twitter_sharing_link',
		'byobagn_facebook_sharing_link',
		'byobagn_linkedin_sharing_link',
		'byobagn_stumbleupon_sharing_link',
		'byobagn_googleplus_sharing_link',
		'byobagn_pinterest_sharing_link',
		'byobagn_reddit_sharing_link',
		'byobagn_tumblr_sharing_link'
	);
	protected $filters = array(
		'menu'     => 'skin',
		'text'     => 'Social Sharing Links',
		'priority' => 10
	);

	protected function translate() {
		$this->title = __( 'Bottom Social Sharing Links', 'byobagn' );
	}

	public function construct() {
		global $thesis;
		if ( ! empty( $thesis->api->options['byobagn_social_sharing_links'] ) ) {
			$this->sharing_options = unserialize( $thesis->api->options['byobagn_social_sharing_links'] );
		}
	}

	protected function html_options() {
		global $thesis;
		$options           = $thesis->api->html_options();
		$options ['style'] = array(
			'type'    => 'select',
			'label'   => __( 'Choose a style', 'byobagn' ),
			'options' => array(
				''           => __( 'Social sharing colors for buttons', 'byobagn' ),
				'monochrome' => __( 'Monochrome buttons', 'byobagn' )
			)
		);

		return $options;
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );

		$style = ! empty( $this->options['style'] ) ? esc_attr( $this->options['style'] ) : '';

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->secondary( 'social_links', false, $style );

		$output = new byobagn_config_id( $this->options, 'id' );
		$id     = $output->simple();

		$intro_lable = false;
		if ( isset( $this->sharing_options['use_intro_label']['use_label'] ) ) {
			$intro_lable = ( ! empty( $this->sharing_options['intro_lable'] ) ) ? wp_kses_post( $this->sharing_options['intro_lable'] ) : 'Share This On: ';
		}

		echo "$tab<p$id$class>\n";
		if ( isset( $this->sharing_options['use_intro_label']['use_label'] ) && $intro_lable ) {
			echo "$tab<span class=\"intro_label\">$intro_lable</span>";
		}
		echo $this->rotator( array_merge( $args, array(
			'depth'   => $depth + 1,
			'options' => $this->sharing_options
		) ) );
		echo "$tab</p>\n";
	}

}

class byobagn_embed_width extends thesis_box {

	public $type = false;
	public $embed_width = 640;
	protected $filters = array(
		'menu'     => 'skin',
		'priority' => 3
	);

	protected function translate() {
		$this->title                  = __( 'Agility Global Embed Width', 'byobagn' );
		$this->filters['text']        = __( 'Agility Embed Width', 'byobagn' );
		$this->filters['description'] = __( 'Set the global default embed width.  This can be overridden by template options', 'byobagn' );
	}

	public function construct() {
		global $thesis;
		add_filter( 'embed_defaults', array( $this, 'set_embed_defaults' ) );
	}

	protected function class_options() {
		return array(
			'embed_width' => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Global Embed Width', 'byobagn' ),
				'description' => __( 'Set the width for media embeds globally  The default is 640', 'byobagn' ),
				'placeholder' => '640',
				'tooltip'     => __( 'Enter the width for media embeds globally. Enter numerals only.  This will override the default width of 640 and can be overridden for each template.', 'byobagn' )
			)
		);
	}

	protected function template_options() {
		return array(
			'title'  => __( 'Embed Width', 'byobagn' ),
			'fields' => array(
				'embed_width' => array(
					'type'        => 'text',
					'width'       => 'tiny',
					'label'       => __( 'Embed Width', 'byobagn' ),
					'description' => __( 'Set the width for media embeds for this template.  The default is 640', 'byobagn' ),
					'placeholder' => '640',
					'tooltip'     => __( 'Enter the width for media embeds for this template.  Enter numerals only.  This will override the global and default width.', 'byobagn' )
				)
			)
		);
	}

	public function set_embed_defaults( $defaults ) {

		if ( ! empty( $this->template_options['embed_width'] ) && is_numeric( $this->template_options['embed_width'] ) ) {
			$embed_width = $this->template_options['embed_width'];
		} elseif ( ! empty( $this->class_options['embed_width'] ) && is_numeric( $this->class_options['embed_width'] ) ) {
			$embed_width = $this->class_options['embed_width'];
		} else {
			$embed_width = $this->embed_width;
		}

		$defaults['width'] = $embed_width;

		return $defaults;
	}

}

class byobagn_schema_settings extends thesis_box {

	public $type = false;
	protected $filters = array(
		'menu'     => 'skin',
		'priority' => 3
	);
	private $schema_list;

	protected function translate() {
		$this->title                  = __( 'Agility Default Schema Settings', 'byobagn' );
		$this->filters['text']        = __( 'Agility Schema Settings', 'byobagn' );
		$this->filters['description'] = __( 'Set your default schema for each post type', 'byobagn' );
	}

	public function construct() {
		global $thesis;
		$s = new thesis_schema();
		$s->init();
		$this->schema_list = $s->select();
	}

	protected function class_options() {
		global $thesis;
		$schema_list         = $this->schema_list;
		$filtered_post_types = new byob_get_post_types();
		$post_types          = $filtered_post_types->post_types();

		foreach ( $post_types as $key => $label ) {
			$schema_list['label'] = __( 'Choose a default schema for the ' . $label . ' post type', 'byobagn' );
			$options[ $key ]      = $schema_list;
		}

		return $options;
	}

}

class byobagn_design_mode extends thesis_box {

	public $type = false;
	protected $filters = array(
		'menu' => 'skin'
	);

	protected function translate() {
		$this->title           = __( 'Agility Design Mode Settings - for high performance servers', 'byobagn' );
		$this->filters['text'] = __( 'Agility Design Mode', 'byobagn' );
	}

	protected function class_options() {
		$setting = ini_get( 'max_input_vars' );
		if ( $setting > 3499 ) {
			$label = 'Your <code>max_input_vars</code> is set to ' . $setting . ' which should be sufficient to run Agility in High Performance Mode<br>'
			         . 'Check this box to try it.  This may not be sufficient in all hosts.';
		} else {
			$label = 'Your <code>max_input_vars</code> is set to ' . $setting . ' <span class="alert">which is too low to run Agility in High Performance Mode</span><br>'
			         . 'It should be at least 3500.  <br>Ask your hosting company to increase it if you wish to work in High Performance Mode.';
		}

		return array(
			'design_mode' => array(
				'type'    => 'checkbox',
				'label'   => $label,
				'options' => array(
					'on' => __( 'Use High Performance Mode', 'thesis' )
				)
			)
		);
	}

	public function admin_init() {
		wp_enqueue_style( 'byob-admin-style', BYOBAGN_URL . "/css/byobagn-admin-styles.css" );
	}

}

class byobagn_background_design extends thesis_box {

	public $type = false;
	protected $filters = array(
		'menu' => 'skin'
	);

	protected function translate() {
		$this->title           = __( 'Agility Custom Background Style Options', 'byobagn' );
		$this->filters['text'] = __( 'Agility Background Styles', 'byobagn' );
	}

	protected function class_options() {
		$background_options             = new byobagn_design_alternate();
		$options['background_elements'] = $background_options->background_design();

		return $options;
	}

	public function admin_init() {
		wp_enqueue_style( 'byob-admin-style', BYOBAGN_URL . "/css/byobagn-admin-styles.css" );
		add_action( 'admin_footer', array( $this, 'return_script' ) );
	}

	public function return_script() {
		$site_url   = site_url();
		$full_url   = $site_url . '/wp-admin/admin.php?page=thesis&canvas=' . $this->_class;
		$return_url = $site_url . '/wp-admin/admin.php?page=thesis&canvas=byob_agility_nude__design';
		?>
		<script type="text/javascript">
            jQuery(function ($) {
                $('form.thesis_options_form').submit(function () {
                    $.post('<?php echo $full_url; ?>', function () {
                        window.location = '<?php echo $return_url; ?>';
                    });
                });
            });
		</script>
		<?php
	}

}

class byobagn_widget_design extends thesis_box {

	public $type = false;
	protected $filters = array(
		'menu' => 'skin'
	);

	protected function translate() {
		$this->title           = __( 'Agility Widget Style Options', 'byobagn' );
		$this->filters['text'] = __( 'Agility Widget Styles', 'byobagn' );
	}

	protected function class_options() {
		$background_options         = new byobagn_design_alternate();
		$options['widget_elements'] = $background_options->widget_design();

		return $options;
	}

	public function admin_init() {
		wp_enqueue_style( 'byob-admin-style', BYOBAGN_URL . "/css/byobagn-admin-styles.css" );
		add_action( 'admin_footer', array( $this, 'return_script' ) );
	}

	public function return_script() {
		$site_url   = site_url();
		$full_url   = $site_url . '/wp-admin/admin.php?page=thesis&canvas=' . $this->_class;
		$return_url = $site_url . '/wp-admin/admin.php?page=thesis&canvas=byob_agility_nude__design';
		?>
		<script type="text/javascript">
            jQuery(function ($) {
                $('form.thesis_options_form').submit(function () {
                    $.post('<?php echo $full_url; ?>', function () {
                        window.location = '<?php echo $return_url; ?>';
                    });
                });
            });
		</script>
		<?php
	}

}

class byobagn_text_area_design extends thesis_box {

	public $type = false;
	protected $filters = array(
		'menu' => 'skin'
	);

	protected function translate() {
		$this->title           = __( 'Agility Custom Text Area Style Options', 'byobagn' );
		$this->filters['text'] = __( 'Agility Text Area Styles', 'byobagn' );
	}

	protected function class_options() {
		$text_options                  = new byobagn_design_alternate();
		$options['text_area_elements'] = $text_options->text_area_design();

		return $options;
	}

	public function admin_init() {
		wp_enqueue_style( 'byob-admin-style', BYOBAGN_URL . "/css/byobagn-admin-styles.css" );
		add_action( 'admin_footer', array( $this, 'return_script' ) );
	}

	public function return_script() {
		$site_url   = site_url();
		$full_url   = $site_url . '/wp-admin/admin.php?page=thesis&canvas=' . $this->_class;
		$return_url = $site_url . '/wp-admin/admin.php?page=thesis&canvas=byob_agility_nude__design';
		?>
		<script type="text/javascript">
            jQuery(function ($) {
                $('form.thesis_options_form').submit(function () {
                    $.post('<?php echo $full_url; ?>', function () {
                        window.location = '<?php echo $return_url; ?>';
                    });
                });
            });
		</script>
		<?php
	}

}

class byobagn_icon_design extends thesis_box {

	public $type = false;
	protected $filters = array(
		'menu' => 'skin'
	);

	protected function translate() {
		$this->title           = __( 'Agility Icon Style Options', 'byobagn' );
		$this->filters['text'] = __( 'Agility Icon Styles', 'byobagn' );
	}

	protected function class_options() {
		$icon_options             = new byobagn_design_alternate();
		$options['icon_elements'] = $icon_options->icon_design();

		return $options;
	}

	public function admin_init() {
		wp_enqueue_style( 'byob-admin-style', BYOBAGN_URL . "/css/byobagn-admin-styles.css" );
		add_action( 'admin_footer', array( $this, 'return_script' ) );
	}

	public function filter_css( $css ) {
		return $css;
	}

	public function return_script() {
		$site_url   = site_url();
		$full_url   = $site_url . '/wp-admin/admin.php?page=thesis&canvas=' . $this->_class;
		$return_url = $site_url . '/wp-admin/admin.php?page=thesis&canvas=byob_agility_nude__design';
		?>
		<script type="text/javascript">
            jQuery(function ($) {
                $('form.thesis_options_form').submit(function () {
                    $.post('<?php echo $full_url; ?>', function () {
                        window.location = '<?php echo $return_url; ?>';
                    });
                });
            });
		</script>
		<?php
	}

}

class byobagn_cta_design extends thesis_box {

	public $type = false;
	protected $filters = array(
		'menu' => 'skin'
	);

	protected function translate() {
		$this->title           = __( 'Agility Call to Action Style Options', 'byobagn' );
		$this->filters['text'] = __( 'Agility Call to Action Styles', 'byobagn' );
	}

	protected function class_options() {
		$cta_options             = new byobagn_design_alternate();
		$options['cta_elements'] = $cta_options->cta_design();

		return $options;
	}

	public function admin_init() {
		wp_enqueue_style( 'byob-admin-style', BYOBAGN_URL . "/css/byobagn-admin-styles.css" );
		add_action( 'admin_footer', array( $this, 'return_script' ) );
	}

	public function filter_css( $css ) {
		return $css;
	}

	public function return_script() {
		$site_url   = site_url();
		$full_url   = $site_url . '/wp-admin/admin.php?page=thesis&canvas=' . $this->_class;
		$return_url = $site_url . '/wp-admin/admin.php?page=thesis&canvas=byob_agility_nude__design';
		?>
		<script type="text/javascript">
            jQuery(function ($) {
                $('form.thesis_options_form').submit(function () {
                    $.post('<?php echo $full_url; ?>', function () {
                        window.location = '<?php echo $return_url; ?>';
                    });
                });
            });
		</script>
		<?php
	}

}

class byobagn_media_query_design extends thesis_box {

	public $type = false;
	protected $filters = array(
		'menu' => 'skin'
	);

	protected function translate() {
		$this->title           = __( 'Agility Media Query Options', 'byobagn' );
		$this->filters['text'] = __( 'Agility Media Queries', 'byobagn' );
	}

	protected function class_options() {
		$mq_options                      = new byobagn_design_alternate();
		$options['media_query_elements'] = $mq_options->media_query_design();

		return $options;
	}

	public function admin_init() {
		wp_enqueue_style( 'byob-admin-style', BYOBAGN_URL . "/css/byobagn-admin-styles.css" );
		add_action( 'admin_footer', array( $this, 'return_script' ) );
	}

	public function filter_css( $css ) {
		return $css;
	}

	public function return_script() {
		$site_url   = site_url();
		$full_url   = $site_url . '/wp-admin/admin.php?page=thesis&canvas=' . $this->_class;
		$return_url = $site_url . '/wp-admin/admin.php?page=thesis&canvas=byob_agility_nude__design';
		?>
		<script type="text/javascript">
            jQuery(function ($) {
                $('form.thesis_options_form').submit(function () {
                    $.post('<?php echo $full_url; ?>', function () {
                        window.location = '<?php echo $return_url; ?>';
                    });
                });
            });
		</script>
		<?php
	}

}

class byobagn_comment_block extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'thesis_comments_intro',
		'byobagn_comment_list',
		'byobagn_comment_form'
	);
	public $children = array(
		'thesis_comments_intro',
		'byobagn_comment_list',
		'byobagn_comment_form'
	);
	public $abort = false;
	public $templates = array( 'single', 'page' );

	protected function translate() {
		$this->title = $this->name = __( 'Agility Comment Block', 'byobagn' );
	}

	public function construct() {
		$this->com = new thesis_comments();
	}

	protected function html_options() {
		global $thesis;
		$html = $thesis->api->html_options();
		unset( $html['id'] );
	}

	public function html( $args = array() ) {
		if ( class_exists( 'Thrive_Comments' ) ) {
			//apply_filters('comments_template');
			comments_template();
		} else {
			global $thesis;
			extract( $args = is_array( $args ) ? $args : array() );
			$depth = isset( $depth ) ? $depth : 0;
			$tab   = str_repeat( "\t", $depth );

			$classout = new byobagn_config_classes( $this->options, 'class' );
			$class    = $classout->given( 'comment_block_wrapper', false );

			echo "$tab<div id='comments' $class>\n";
			$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
			echo "$tab</div>\n";
		}
	}

}

class byobagn_comment_list extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'thesis_comment_author',
		'thesis_comment_avatar',
		'thesis_comment_date',
		'byobagn_comment_action_wrapper',
		'thesis_comment_number',
		'thesis_comment_permalink',
		'thesis_comment_edit',
		'thesis_comment_text',
		'thesis_comment_reply'
	);
	public $children = array(
		'thesis_comment_avatar',
		'thesis_comment_author',
		'thesis_comment_date',
		'byobagn_comment_action_wrapper',
		'thesis_comment_text'
	);
	public $override = false;
	public $templates = array( 'single', 'page' );

	protected function translate() {
		$this->title = __( 'Comment List', 'byobagn' );
	}

	public function construct() {
		$this->com = new thesis_comments();
	}

	protected function html_options() {
		global $thesis;
		$html = $thesis->api->html_options( array(
			'ul'      => 'ul',
			'ol'      => 'ol',
			'div'     => 'div',
			'section' => 'section'
		), 'ul' );
		unset( $html['id'], $html['class'] );

		return $html;
	}

	public function preload() {
		$this->com->preload();
	}

	public function html( $args = array() ) {
		global $thesis, $post;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab = str_repeat( "\t", ( $this->tab_depth = ! empty( $depth ) ? $depth : 0 ) );
		comments_template( false, true );
		if ( ! empty( $this->override ) ) {
			return;
		} elseif ( post_password_required() ) {
			echo "$tab\t<p class=\"password_required\">", __( 'This post is password protected. Enter the password to view comments.', 'thesis' ), "</p>\n";

			return;
		}
		if ( ( $comments = wp_count_comments( $post->ID ) ) && is_object( $comments ) && ! empty( $comments->approved ) && $comments->approved > 0 ) {
			$html             = ! empty( $this->options['html'] ) ? esc_attr( $this->options['html'] ) : 'ul';
			$this->child_html = in_array( $html, array( 'ul', 'ol' ) ) ? 'li' : 'div';
			$hook             = trim( esc_attr( ! empty( $this->options['_id'] ) ?
				$this->options['_id'] : ( ! empty( $this->options['hook'] ) ?
					$this->options['hook'] : '' ) ) );
			$args             = array(
				'walker'   => new thesis_comment_walker,
				'callback' => array( $this, 'start' ),
				'type'     => 'comment',
				'style'    => $html
			);
			/*				if ((bool) $thesis->api->get_option('page_comments'))
								$args['per_page'] = (int) !empty($this->options['per_page']) ? $this->options['per_page'] : $thesis->api->get_option('comments_per_page');
				*/
			if ( ! empty( $hook ) ) {
				$thesis->api->hook( "hook_before_$hook" );
			}
			echo "$tab<$html class=\"comment_list\">\n";
			if ( ! in_array( $html, array( 'ul', 'ol' ) ) && ! empty( $hook ) ) {
				$thesis->api->hook( "hook_top_$hook" );
			}
			wp_list_comments( $args );
			if ( ! in_array( $html, array( 'ul', 'ol' ) ) && ! empty( $hook ) ) {
				$thesis->api->hook( "hook_bottom_$hook" );
			}
			echo "$tab</$html>\n";
			if ( ! empty( $hook ) ) {
				$thesis->api->hook( "hook_after_$hook" );
			}
		}
	}

	public function start( $comment, $args, $depth ) {
		global $thesis;
		$GLOBALS['comment'] = $comment;
		echo
		str_repeat( "\t", $this->tab_depth + 1 ),
		"<$this->child_html class=\"", esc_attr( implode( ' ', get_comment_class() ) ), "\" id=\"comment-", get_comment_ID(), "\">\n";
		$this->rotator( array( 'depth' => $this->tab_depth + 2 ) );
	}

}

class byobagn_comment_form extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'thesis_comment_form_title',
		'byobagn_comment_form_left_column',
		'byobagn_comment_form_right_column',
		'thesis_comment_form_cancel',
		'thesis_comment_form_name',
		'thesis_comment_form_email',
		'thesis_comment_form_url',
		'thesis_comment_form_comment',
		'thesis_comment_form_submit'
	);
	public $children = array(
		'thesis_comment_form_title',
		'byobagn_comment_form_left_column',
		'byobagn_comment_form_right_column'
	);

	protected function translate() {
		$this->title = __( 'Comment Form', 'byobagn' );
	}

	public function html( $args = array() ) {
		global $thesis, $user_ID, $post; #wp
		if ( ! comments_open() ) {
			return;
		}
		extract( $args = is_array( $args ) ? $args : array() );
		$tab  = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$hook = trim( $thesis->api->esc( ! empty( $this->options['hook'] ) ? $this->options['hook'] : 'comment_form' ) );
		if ( get_option( 'comment_registration' ) && ! ! ! $user_ID ) #wp
		{
			echo
			"$tab<p class=\"login_alert\">",
			__( 'You must log in to post a comment.', 'byobagn' ),
			" <a href=\"", wp_login_url( get_permalink() ), "\" rel=\"nofollow\">", __( 'Log in now.', 'byobagn' ), "</a></p>\n";
		} else {
			do_action( "hook_before_$hook" );
			echo "$tab<form id=\"commentform\" method=\"post\" action=\"", site_url( 'wp-comments-post.php' ), "\">\n"; #wp
			do_action( "hook_top_$hook" );
			$args['depth'] = $depth + 1;
			$args['req']   = get_option( 'require_name_email' );
			$this->rotator( $args );
			do_action( "hook_bottom_$hook" );
			do_action( 'comment_form', $post->ID ); #wp
			comment_id_fields(); #wp
			if ( class_exists( 'InvisibleReCaptcha' ) ) {
				do_action( 'google_invre_render_widget_action' );
			}
			if ( class_exists( 'GdbcWordPressPublicModule' ) && is_callable( array(
					GdbcWordPressPublicModule::getInstance(),
					'renderTokenFieldIntoCommentsForm'
				) ) ) {
				GdbcWordPressPublicModule::getInstance()->renderTokenFieldIntoCommentsForm();
			}
			echo "$tab</form>\n";
			do_action( "hook_after_$hook" );
		}
	}

}

class byobagn_comment_action_wrapper extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'thesis_comment_reply',
		'thesis_comment_edit'
	);
	public $children = array(
		'thesis_comment_reply',
		'thesis_comment_edit'
	);

	protected function translate() {
		$this->title = __( 'Comment Action Wrapper', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );

		return $options;
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$depth = isset( $depth ) ? $depth : 0;
		$tab   = str_repeat( "\t", $depth );

		$classout = new byobagn_config_classes( $this->options, 'class' );
		$class    = $classout->given( 'comment_action', false );

		echo "$tab<nav $class>\n";
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		echo "$tab</nav>\n";
	}

}

class byobagn_comment_form_left_column extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'thesis_comment_form_name',
		'thesis_comment_form_email',
		'thesis_comment_form_url'
	);
	public $children = array(
		'thesis_comment_form_name',
		'thesis_comment_form_email',
		'thesis_comment_form_url'
	);

	protected function translate() {
		$this->title = __( 'Left Column', 'byobagn' );
	}

	public function construct() {
		$this->col = new byobagn_column_1();
	}

	protected function html_options() {
		return $this->col->html_options();
	}

	public function html( $args = array() ) {

		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$column_no               = 1;
		$this->options['layout'] = 'sub_columns_2';

		$hoptions = new byobagn_responsive_columns_helper( $this->options, $column_no );
		$config   = $hoptions->column_1();
		$start    = $hoptions->open_html( $args );
		$end      = $hoptions->close_html( $args );
//                var_dump($this->options);
		echo $start;
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 3 ) ) );
		echo $end;
	}

}

class byobagn_comment_form_right_column extends thesis_box {

	public $type = 'rotator';
	public $dependents = array(
		'thesis_comment_form_comment',
		'thesis_comment_form_submit',
		'thesis_comment_form_cancel'
	);
	public $children = array(
		'thesis_comment_form_comment',
		'thesis_comment_form_submit',
		'thesis_comment_form_cancel'
	);

	protected function translate() {
		$this->title = __( 'Right Column', 'byobagn' );
	}

	public function construct() {
		$this->col = new byobagn_column_2();
	}

	protected function html_options() {
		return $this->col->html_options();
	}

	public function html( $args = array() ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$column_no               = 2;
		$this->options['layout'] = 'sub_columns_2';

		$hoptions = new byobagn_responsive_columns_helper( $this->options, $column_no );
		$config   = $hoptions->column_2();
		$start    = $hoptions->open_html( $args );
		$end      = $hoptions->close_html( $args );
		echo $start;
		echo $this->rotator( array_merge( $args, array( 'depth' => $depth + 3 ) ) );
		echo $end;
	}

}

class byobagn_match_height extends thesis_box {

	public $type = false;

	public function construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
		add_action( 'hook_after_html', array( $this, 'footer_scripts' ), 99 );
	}

	protected function template_options() {
		$options = array(
			'title'  => __( 'MatchHeight', 'byobagn' ),
			'fields' => array(
				'use_matchheight' => array(
					'type'    => 'checkbox',
					'label'   => __( 'Check this box to add MatchHeight to this template', 'byobagn' ),
					'tooltip' => __( 'Checking this box will load the MatchHeight javascript', 'byobagn' ),
					'options' => array(
						'use' => 'Load MatchHeight in this template'
					)
				),
				'selector'        => array(
					'type'        => 'text',
					'width'       => 'full',
					'code'        => true,
					'label'       => __( 'Selectors used to equalize the heights of the items', 'byobagn' ),
					'tooltip'     => __( 'Enter the selectors shared by the items that will be equalized in height, separate multiple selectors with commas. Place them in the order in which they should be fired', 'byobagn' ),
					'placeholder' => __( '.equalize', 'byobagn' )
				)
			)
		);

		return $options;
	}

	public function load_scripts() {
		if ( ! empty( $this->template_options['use_matchheight']['use'] ) ) {
			wp_enqueue_script( 'matchheight', BYOBAGN_URL . '/js/jquery.matchHeight-min.js', array( 'jquery' ), '', true );
		}
	}

	public function footer_scripts() {
		if ( ! empty( $this->template_options['use_matchheight']['use'] ) ) {
			$raw_selectors = ! empty( $this->template_options['selector'] ) ? trim( esc_attr( $this->template_options['selector'] ) ) : '';
			if ( $raw_selectors ) {
				$selectors = explode( ',', $raw_selectors );
			}
			$selectors[] = '.equalize';
			?>
			<script>
                jQuery(document).ready(function ($) {
					<?php foreach ($selectors as $selector) { ?>
                    $('<?php echo trim( $selector ); ?>').matchHeight();
					<?php } ?>
                });
			</script>
			<?php
		}
	}

}

class byobagn_twitter_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Twitter Profile Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'twitter',
			'icon'   => 'fa-twitter',
			'label'  => 'Twitter'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_linkedin_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'LinkedIn Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'linkedin',
			'icon'   => 'fa-linkedin',
			'label'  => 'LinkedIn'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_facebook_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Facebook Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'facebook',
			'icon'   => 'fa-facebook',
			'label'  => 'Facebook'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_stumbleupon_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'StumbleUpon Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'stumbleupon',
			'icon'   => 'fa-stumbleupon',
			'label'  => 'StumbleUpon'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_googleplus_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Google+ Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'googleplus',
			'icon'   => 'fa-google-plus',
			'label'  => 'Google+'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_pinterest_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Pinterest Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'pinterest',
			'icon'   => 'fa-pinterest',
			'label'  => 'Pinterest'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_instagram_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Instagram Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'instagram',
			'icon'   => 'fa-instagram',
			'label'  => 'Instagram'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_vimeo_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Vimeo Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'vimeo',
			'icon'   => 'fa-vimeo-square',
			'label'  => 'Vimeo'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_vine_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Vine Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'vine',
			'icon'   => 'fa-vine',
			'label'  => 'Vine'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_youtube_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'YouTube Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'youtube',
			'icon'   => 'fa-youtube',
			'label'  => 'YouTube'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_flickr_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Flickr Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'flickr',
			'icon'   => 'fa-flickr',
			'label'  => 'Flickr'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_reddit_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Reddit Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'reddit',
			'icon'   => 'fa-reddit',
			'label'  => 'Reddit'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_tumblr_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Tumblr Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'tumblr',
			'icon'   => 'fa-tumblr',
			'label'  => 'Tumblr'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_slideshare_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Slideshare Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$labels = array(
			'suffix' => 'slideshare',
			'icon'   => 'fa-slideshare',
			'label'  => 'Slideshare'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_custom1_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'First Custom Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$icon   = ! empty( $options['custom1_icon'] ) ? esc_attr( $options['custom1_icon'] ) : 'fa-question';
		$labels = array(
			'suffix' => 'custom1',
			'icon'   => $icon,
			'label'  => 'First Custom'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

class byobagn_custom2_link extends thesis_box {

	public $type = 'box';

	protected function translate() {
		$this->title = __( 'Second Custom Page Link', 'byobagn' );
	}

	public function html( $args = false, $options = array() ) {
		$icon   = ! empty( $options['custom2_icon'] ) ? esc_attr( $options['custom2_icon'] ) : 'fa-question';
		$labels = array(
			'suffix' => 'custom2',
			'icon'   => $icon,
			'label'  => 'Second Custom'
		);
		$output = new byobagn_social_profile_helper();

		return $output->html( $args, $options, $labels );
	}

}

// Depricated Boxes - included for compatibility with earlier versions of the skin

class byobagn_widget_columns extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->title = $this->name = __( 'XDepricated - Agility Smart Widget Columns', 'byobagn' );
	}

	public function construct() {
		global $thesis;

		$sidebars           = $GLOBALS['wp_registered_sidebars'];
		$widget_areas       = isset( $this->options['widget_areas'] ) ? $this->options['widget_areas'] : 0;
		$widget_name        = ! empty( $this->options['widget_name'] ) ? trim( $thesis->api->esc( $this->options['widget_name'] ) ) : 'Un-named Widget Area';
		$widget_description = ! empty( $this->options['widget_description'] ) ? trim( $thesis->api->esc( $this->options['widget_description'] ) ) : '';
		$count              = 0;

		while ( $count < $widget_areas ) {
			$count ++;

			if ( ! in_array( $widget_name . ' ' . $count, $sidebars ) ) {
				register_sidebar( array(
					'name'          => $widget_name . ' ' . $count,
					'id'            => $this->_id . '_' . $count,
					'description'   => $widget_description,
					'before_widget' => '<div class="widget %2$s" id="%1$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget_title">',
					'after_title'   => '</h4>'
				) );
			}
		}
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['class'] );

		return $options;
	}

	protected function options() {
		return array(
			'widget_areas'       => array(
				'type'    => 'select',
				'label'   => __( 'Select the number of widget columns in thia box', 'byobagn' ),
				'tooltip' => __( 'This will select the number of widget columns that show up in the box', 'byobagn' ),
				'options' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4'
				),
				'default' => '4'
			),
			'widget_name'        => array(
				'type'        => 'text',
				'width'       => 'medium',
				'label'       => __( 'Enter a unique name for these widget areas', 'byobagn' ),
				'tooltip'     => __( 'The name you enter will be used to identify the widget areas in the Widgets panel', 'byobagn' ),
				'placeholder' => 'Enter a unique name'
			),
			'widget_description' => array(
				'type'        => 'text',
				'width'       => 'long',
				'label'       => __( 'Enter a description for these widget areas', 'byobagn' ),
				'tooltip'     => __( 'The description you enter will be displayed below the widget areas in the Widgets panel', 'byobagn' ),
				'placeholder' => 'Optional Description'
			),
		);
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab          = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$count        = 0;
		$id           = ! empty( $this->options['id'] ) ? ' id="' . trim( $thesis->api->esc( $this->options['id'] ) ) . '"' : '';
		$widget_areas = isset( $this->options['widget_areas'] ) ? $this->options['widget_areas'] : '4';
		$widget_name  = ! empty( $this->options['widget_name'] ) ? trim( $thesis->api->esc( $this->options['widget_name'] ) ) : 'Un-named Widget Area';

		switch ( $widget_areas ) {
			case 1:
				$class   = 'full';
				$columns = 'columns_1';
				break;
			case 2:
				$class   = 'half';
				$columns = 'columns_2';
				break;
			case 3:
				$class   = 'one-third';
				$columns = 'columns_3';
				break;
			default:
				$class   = 'one-quarter';
				$columns = 'columns_4';
		}

		echo "$tab<div" . $id . " class=\"" . $columns . "\">\n";

		while ( $count < $widget_areas ) {
			$count ++;

			echo "$tab\t<div class=\"" . $class . "\">\n";
			if ( ! dynamic_sidebar( $this->_id . '_' . $count ) && is_user_logged_in() ) {
				echo "$tab\t\t<p>" . sprintf( __( 'This is a widget box called %1$s, but there are no widgets in it yet. <a href="%2$s">Add a widget here</a>.', 'byobagn' ), $widget_name . ' ' . $count, admin_url( 'widgets.php' ) ) . "</p>\n";
			}
			echo "$tab\t</div>\n";
		}

		$this->rotator( $depth + 1 );

		echo "$tab\t<div style=\"clear:both;\"></div>\n$tab</div>\n";
	}

}

class byobagn_2_column_header extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->name = $this->title = __( 'XDeprecated - Agility 2 Column Header', 'byobagn' );
	}

	public function construct() {
		$sidebars = $GLOBALS['wp_registered_sidebars'];

		if ( ! empty( $this->options['left_column'] ) && $this->options['left_column'] == 'Widget area' && ! in_array( 'Header Left Widget Area', $sidebars ) ) {
			register_sidebar( array(
					'name'          => 'Header Left Widget Area',
					'id'            => 'header_left_widget_area',
					'description'   => 'This is the left Header Widget Area',
					'before_widget' => '<div class="header_widget %2$s" id="%1$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget_title">',
					'after_title'   => '</h4>'
				)
			);
		}
		if ( ! empty( $this->options['right_column'] ) && $this->options['right_column'] == 'Widget area' && ! in_array( 'Header Right Widget Area', $sidebars ) ) {
			register_sidebar( array(
				'name'          => 'Header Right Widget Area',
				'id'            => 'header_right_widget_area',
				'description'   => 'This is the right most Header Widget Area',
				'before_widget' => '<div class="header_widget %2$s" id="%1$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget_title">',
				'after_title'   => '</h4>'
			) );
		}
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['class'] );

		$options['id']['placeholder'] = 'header_columns';

		$content = array(
			'Site title and tagline' => 'Site title and tagline',
			'Header image'           => 'Header image',
			'Container'              => 'Empty container',
			'Widget area'            => 'Widget area',
			'Nav Menu'               => 'Nav Menu'
		);
		$menus   = array();

		foreach ( wp_get_nav_menus() as $menu ) {
			$menus[ (int) $menu->term_id ] = esc_attr( $menu->name );
		}

		return array_merge( $options, array(
			'layout'       => array(
				'type'    => 'select',
				'label'   => __( 'Select the column configuration for this header', 'byobagn' ),
				'options' => array(
					'columns_2'   => __( 'Two columns, equally sized', 'byobagn' ),
					'columns_321' => __( 'Two columns, two thirds - one third', 'byobagn' ),
					'columns_312' => __( 'Two columns, one third - two thirds', 'byobagn' ),
					'columns_431' => __( 'Two columns, three quarters - one quarter', 'byobagn' ),
					'columns_413' => __( 'Two columns, one quarter - three quarters', 'byobagn' )
				)
			),
			'left_column'  => array(
				'type'    => 'select',
				'label'   => __( 'Select Content for the Left Column', 'byobagn' ),
				'tooltip' => __( 'Choose 1 of the 4 options for the left column of the header', 'byobagn' ),
				'options' => $content
			),
			'right_column' => array(
				'type'    => 'select',
				'label'   => __( 'Select Content for the Right Column', 'byobagn' ),
				'tooltip' => __( 'Choose 1 of the 4 options for the right column of the header', 'byobagn' ),
				'options' => $content
			),
			'menu'         => array(
				'type'    => 'select',
				'label'   => __( 'Menu To Display in One of the Header Columns', 'byobagn' ),
				'tooltip' => __( 'If you have chosen to display a menu in this header, this menu will be displayed in the column chosen ', 'byobagn' ),
				'options' => $menus
			),
			'image_url'    => array(
				'type'    => 'text',
				'width'   => 'medium',
				'label'   => __( 'Header Image URL', 'byobagn' ),
				'tooltip' => __( 'If you are using a header image this is the URL of that image - probably from the Media Library', 'byobagn' )
			),
		) );
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab     = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$column1 = 'one-third';
		$column2 = 'two-thirds';

		$id     = ! empty( $this->options['id'] ) ? ' id="' . trim( $thesis->api->esc( $this->options['id'] ) ) . '"' : ' id="header_columns"';
		$layout = ! empty( $this->options['layout'] ) ? trim( $thesis->api->esc( $this->options['layout'] ) ) : 'columns_312';

		switch ( $layout ) {
			case "columns_2":
				$column1 = 'half';
				$column2 = 'half';
				break;
			case "columns_321":
				$column1 = 'two-thirds';
				$column2 = 'one-third';
				break;
			case "columns_312":
				$column1 = 'one-third';
				$column2 = 'two-thirds';
				break;
			case "columns_431":
				$column1 = 'three-quarters';
				$column2 = 'one-quarter';
				break;
			case "columns_413":
				$column1 = 'one-quarter';
				$column2 = 'three-quarters';
				break;
		}

		$full_layout = ' class="' . $layout . '"';

//		print_r($this->options);
		echo "$tab<div" . $id . $full_layout . ">\n";
		echo "$tab\t<div id=\"header-left\" class=\"$column1\">\n";

		switch ( $this->options['left_column'] ) {
			case "Site title and tagline":
				byobagn_site_title( $depth );
				break;
			case "Header image":
				byobagn_header_image( $depth, $this->options['image_url'] );
				break;
			case "Widget area":
				byobagn_header_widget_area( $depth, 'header_left_widget_area', 'Header Left Widget Area' );
				break;
			case "Container":
				$this->rotator( $depth + 1 );
				break;
			case "Nav Menu":
				byobagn_header_menu( $depth, $this->options['menu'] );
				break;
		}

		echo "$tab\t</div> \n";
		echo "$tab\t<div id=\"header-right\" class=\"$column2\">\n";

		switch ( $this->options['right_column'] ) {
			case "Site title and tagline":
				byobagn_site_title( $depth );
				break;
			case "Header image":
				byobagn_header_image( $depth, $this->options['image_url'] );
				break;
			case "Widget area":
				byobagn_header_widget_area( $depth, 'header_right_widget_area', 'Header Right Widget Area' );
				break;
			case "Container":
				$this->rotator( $depth + 1 );
				break;
			case "Nav Menu":
				byobagn_header_menu( $depth, $this->options['menu'] );
				break;
		}

		echo "$tab\t</div><div style=\"clear:both;\"></div>\n";
		if ( $this->options['left_column'] != 'Container' && $this->options['right_column'] != 'Container' ) {
			$this->rotator( $depth + 1 );
		}
		echo "$tab<div style=\"clear:both;\"></div></div>\n";
	}

}

class byobagn_1_column_header extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->title = $this->name = __( 'XDeprecated - Agility 1 Column Header', 'byobagn' );
	}

	public function construct() {
		$sidebars = $GLOBALS['wp_registered_sidebars'];

		if ( isset( $this->options['content'] ) && $this->options['content'] == 2 && ! in_array( 'Header Full Width Widget Area', $sidebars ) ) {
			register_sidebar( array(
				'name'          => 'Header Full Width Widget Area',
				'id'            => 'header_full_widget_area',
				'description'   => 'This is the Full Width Header Widget Area',
				'before_widget' => '<div class="header_widget %2$s" id="%1$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget_title">',
				'after_title'   => '</h4>'
			) );
		}
	}

	public function preload() {
		if ( ( isset( $this->options['tablet_image_url'] ) && $this->options['tablet_image_url'] ) ||
		     ( isset( $this->options['phone_image_url'] ) && $this->options['phone_image_url'] ) ) {
			add_action( 'wp_head', array( $this, 'head_css' ) );
		}
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['class'] );
		$options['id']['placeholder'] = 'header_columns';

		$content = array(
			'None'         => 'None - I\'ll drag content here',
			'Header image' => 'Header image',
			'Widget area'  => 'Widget area'
		);

		return array_merge( $options, array(
			'content'                    => array(
				'type'    => 'select',
				'label'   => __( 'Select Content for the Header', 'byobagn' ),
				'tooltip' => __( 'Choose 1 of the 3 options for the primary content of the header', 'byobagn' ),
				'options' => $content,
				'default' => 'None'
			),
			'full_image_url'             => array(
				'type'    => 'text',
				'width'   => 'medium',
				'label'   => __( 'Full Size Header Image URL', 'byobagn' ),
				'tooltip' => __( 'If you are using a header image this is the URL of that image - probably from the Media Library', 'byobagn' )
			),
			'tablet_landscape_image_url' => array(
				'type'    => 'text',
				'width'   => 'medium',
				'label'   => __( 'Header Image URL shown to Tablet devices in Landscape Mode', 'byobagn' ),
				'tooltip' => __( 'Enter the URL of the image you want displayed on devices between 1024 & 800 pixels wide', 'byobagn' )
			),
			'tablet_image_url'           => array(
				'type'    => 'text',
				'width'   => 'medium',
				'label'   => __( 'Header Image URL shown to Tablet devices in Portrait Mode', 'byobagn' ),
				'tooltip' => __( 'Enter the URL of the image you want displayed on devices between 800 & 500 pixels wide', 'byobagn' )
			),
			'phone_image_url'            => array(
				'type'    => 'text',
				'width'   => 'medium',
				'label'   => __( 'Header Image URL show to Smart Phones', 'byobagn' ),
				'tooltip' => __( 'Enter the URL of the image you want displayed on devices smaller than 500 pixels wide', 'byobagn' )
			),
		) );
	}

	public function html( $args = false ) {
		global $thesis;
		extract( $args = is_array( $args ) ? $args : array() );
		$tab = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$id  = ! empty( $this->options['id'] ) ? ' id="' . trim( $thesis->api->esc( $this->options['id'] ) ) . '"' : ' id="header_columns"';

		echo "$tab<div" . $id . " class=\"columns_1\">\n";
		echo "$tab\t <div class=\"header full\"> \n";

		if ( $this->options['content'] == 'Header image' || $this->options['content'] == 'Widget area' ) {

			if ( $this->options['content'] == 'Header image' ) { // if the Header image is chosen
				if ( ! empty( $this->options['tablet_landscape_image_url'] ) || ! empty( $this->options['tablet_image_url'] ) || ! empty( $this->options['phone_image_url'] ) ) {
					$this->responsive_image( $depth );
				} else {
					byobagn_header_image( $depth, $this->options['full_image_url'] );
				}
			} elseif ( $this->options['content'] == 'Widget area' ) { // if the widget area is chosen
				byobagn_header_widget_area( $depth, 'header_full_widget_area', 'Header Full Width Widget Area' );
			}
		}

		$this->rotator( $depth + 1 );
		echo "$tab\t </div> \n";
		echo "$tab</div>\n";
	}

	public function responsive_image( $depth ) {

		echo
			str_repeat( "\t", $depth ) .
			"<a class=\"header-image\" href=\"" . esc_url( site_url() ) . "\" title=\"Return to our Home Page\" > </a>\n";
	}

	public function head_css() {
		global $thesis;
		$full        = $tablet = $tablet1 = $phone = "";
		$full_url    = ! empty( $this->options['full_image_url'] ) ? $this->options['full_image_url'] : false;
		$tabletl_url = ! empty( $this->options['tablet_landscape_image_url'] ) ? $this->options['tablet_landscape_image_url'] : false;
		$tablet_url  = ! empty( $this->options['tablet_image_url'] ) ? $this->options['tablet_image_url'] : false;
		$phone_url   = ! empty( $this->options['phone_image_url'] ) ? $this->options['phone_image_url'] : false;
		$id          = ! empty( $this->options['id'] ) ? trim( $thesis->api->esc( $this->options['id'] ) ) : 'header_columns';
		$image_id    = new byobagn_get_attachment_id();

		if ( $full_url ) {
			$full_image_id = $image_id->get_attachment_id_from_url( $full_url );
			$full_meta     = wp_get_attachment_metadata( $full_image_id );
			$full_height   = $full_meta['height'];
			$full          = "\n #" . $id . " .full{padding-left:0; padding-right:0} #" . $id . " .full a.header-image{
                        display:block; background-image:url('" . $full_url . "'); background-position:top center; 
                        background-repeat:no-repeat; height:{$full_height}px; width:100%;} \n";
		}
		if ( $tabletl_url ) {
			$tabletl_image_id = $image_id->get_attachment_id_from_url( $tabletl_url );
			$tabletl_meta     = wp_get_attachment_metadata( $tabletl_image_id );
			$tabletl_height   = $tabletl_meta['height'];
			$tabletl          = "\n @media only screen and (max-width:1024px), screen and (max-device-width:1024px) 
                        and (orientation:landscape){ #" . $id . " .full a.header-image{display:block; 
                        background-image:url('" . $tabletl_url . "'); background-position:top center; background-repeat:no-repeat; 
                        height:{$tabletl_height}px; width:100%;} }\n";
		}
		if ( $tablet_url ) {
			$tablet_image_id = $image_id->get_attachment_id_from_url( $tablet_url );
			$tablet_meta     = wp_get_attachment_metadata( $tablet_image_id );
			$tablet_height   = $tablet_meta['height'];
			$tablet          = "\n @media only screen and (max-width:800px), screen and (max-device-width:800px) 
                        and (orientation:portrait){ #" . $id . " .full a.header-image{display:block; 
                        background-image:url('" . $tablet_url . "'); background-position:top center; 
                        background-repeat:no-repeat; height:{$tablet_height}px; width:100%;} }\n";
		}
		if ( $phone_url ) {
			$phone_image_id = $image_id->get_attachment_id_from_url( $phone_url );
			$phone_meta     = wp_get_attachment_metadata( $phone_image_id );
			$phone_height   = $phone_meta['height'];
			$phone          = "\n @media only screen and (max-width:500px), screen and (max-device-width:500px){
	                 #" . $id . " .full a.header-image{display:block; background-image:url('" . $phone_url . "'); 
	                 background-position:top center; background-repeat:no-repeat; height:{$phone_height}px; width:100%;} }\n";
		}
		echo "\n <style type=\"text/css\">" . $full . $tabletl . $tablet . $phone . "</style> \n";
	}

}

class byobagn_responsive_columns extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->title = $this->name = __( 'XDeprecated - Agility Column', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['id'] );
		$options['class']['tooltip'] = __( 'A class is only necessary here if you intend to set apply special custom styling to this column', 'byobagn' );

		return array_merge( $options, array(
			'width'     => array(
				'type'    => 'select',
				'label'   => 'Select the width for this column - Note you can not use column widths that add up to more than ONE',
				'options' => array(
					'full'           => __( 'Full width', 'byobagn' ),
					'half'           => __( 'Half the width of the column wrapper', 'byobagn' ),
					'one-third'      => __( 'One third the width of the column wrapper', 'byobagn' ),
					'two-thirds'     => __( 'Two thirds the width of the column wrapper', 'byobagn' ),
					'one-quarter'    => __( 'One quarter the width of the column wrapper', 'byobagn' ),
					'three-quarters' => __( 'Three quarters the width of the column wrapper', 'byobagn' ),
				)
			),
			'h_padding' => array(
				'type'   => 'group',
				'label'  => __( 'Remove left & right side padding', 'byobagn' ),
				'fields' => array(
					'h_padding' => array(
						'tooltip' => __( 'Theses options will remove default padding from the left and right sides of the column', 'byobagn' ),
						'type'    => 'checkbox',
						'options' => array(
							'padding-left'  => __( 'Remove left padding', 'byobagn' ),
							'padding-right' => __( 'Remove right padding', 'byobagn' ),
						)
					)
				)
			),
			'hook'      => array(
				'type'    => 'text',
				'width'   => 'medium',
				'code'    => true,
				'label'   => $thesis->api->strings['hook_label'],
				'tooltip' => $thesis->api->strings['hook_tooltip_1'] . '<br /><br /><code>thesis_hook_before_container_{name}</code><br /><code>thesis_hook_container_{name}_top</code><br /><code>thesis_hook_container_{name}_bottom</code><br /><code>thesis_hook_after_container_{name}</code><br /><br />' . $thesis->api->strings['hook_tooltip_2']
			)
		) );
	}

	public function html( $args = false ) {
		global $thesis;

		extract( $args = is_array( $args ) ? $args : array() );
		$tab           = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$width         = ! empty( $this->options['width'] ) ? $this->options['width'] : 'full';
		$custom_class  = ! empty( $this->options['class'] ) ? $this->options['class'] : false;
		$padding_left  = ! empty( $this->options['h_padding']['padding-left'] ) ? $this->options['h_padding']['padding-left'] : false;
		$padding_right = ! empty( $this->options['h_padding']['padding-right'] ) ? $this->options['h_padding']['padding-right'] : false;

		$style = "";
		if ( $padding_left || $padding_right ) {
			$style = ' style="';
			if ( $padding_left ) {
				$style .= 'padding-left:0; ';
			}
			if ( $padding_right ) {
				$style .= 'padding-right:0;';
			}
			$style .= '" ';
		}

		$class = $width;
		if ( $custom_class ) {
			$class .= ' ' . trim( $thesis->api->esc( $custom_class ) );
		}

		$hook = ! empty( $this->options['hook'] ) ? 'container_' . trim( $thesis->api->esc( $this->options['hook'] ) ) : $this->_id;
		do_action( "thesis_hook_before_$hook" );
		echo "$tab<div class=\"$class\"$style>\n";
		do_action( "thesis_hook_{$hook}_top" );
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		do_action( "thesis_hook_{$hook}_bottom" );
		echo "$tab</div>\n";
		do_action( "thesis_hook_after_$hook" );
	}

}

class byobagn_responsive_columns_wrapper extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->title = $this->name = __( 'XDeprecated - Agility Column Wrapper', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['class'] );

		return array_merge( $options, array(
			'layout'    => array(
				'type'    => 'select',
				'label'   => __( 'Select the column configuration for this column wrapper', 'byobagn' ),
				'options' => array(
					'columns_1'    => __( 'Single column', 'byobagn' ),
					'columns_2'    => __( 'Two columns, equally sized', 'byobagn' ),
					'columns_321'  => __( 'Two columns, two thirds - one third', 'byobagn' ),
					'columns_312'  => __( 'Two columns, one third - two thirds', 'byobagn' ),
					'columns_431'  => __( 'Two columns, three quarters - one quarter', 'byobagn' ),
					'columns_413'  => __( 'Two columns, one quarter - three quarters', 'byobagn' ),
					'columns_3'    => __( 'Three columns, equally sized', 'byobagn' ),
					'columns_4211' => __( 'Three columns, one half - one quarter - one quarter', 'byobagn' ),
					'columns_4121' => __( 'Three columns, one quarter - one half - one quarter', 'byobagn' ),
					'columns_4112' => __( 'Three columns, one quarter - one quarter - one half', 'byobagn' ),
					'columns_4'    => __( 'Four columns, equally sized', 'byobagn' )
				)
			),
			'v_padding' => array(
				'type'   => 'group',
				'label'  => __( 'Remove top & bottom padding', 'byobagn' ),
				'fields' => array(
					'v_padding' => array(
						'tooltip' => __( 'Theses options will remove default padding from the top and bottom of the column wrapper', 'byobagn' ),
						'type'    => 'checkbox',
						'options' => array(
							'padding-top'    => __( 'Remove top padding', 'byobagn' ),
							'padding-bottom' => __( 'Remove bottom padding', 'byobagn' ),
						)
					)
				)
			),
			'hook'      => array(
				'type'    => 'text',
				'width'   => 'medium',
				'code'    => true,
				'label'   => $thesis->api->strings['hook_label'],
				'tooltip' => $thesis->api->strings['hook_tooltip_1'] . '<br /><br /><code>thesis_hook_before_container_{name}</code><br /><code>thesis_hook_container_{name}_top</code><br /><code>thesis_hook_container_{name}_bottom</code><br /><code>thesis_hook_after_container_{name}</code><br /><br />' . $thesis->api->strings['hook_tooltip_2']
			)
		) );
	}

	public function html( $args = false ) {
		global $thesis;

		extract( $args = is_array( $args ) ? $args : array() );

		$tab            = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$class          = ! empty( $this->options['layout'] ) ? $this->options['layout'] : 'columns_1';
		$hook           = ! empty( $this->options['hook'] ) ? 'container_' . trim( $thesis->api->esc( $this->options['hook'] ) ) : $this->_id;
		$padding_top    = ! empty( $this->options['v_padding']['padding-top'] ) ? $this->options['v_padding']['padding-top'] : false;
		$padding_bottom = ! empty( $this->options['v_padding']['padding-bottom'] ) ? $this->options['v_padding']['padding-bottom'] : false;
		$style          = "";

		if ( $padding_top || $padding_bottom ) {
			$style = ' style="';
			if ( $padding_top ) {
				$style .= 'padding-top:0; ';
			}
			if ( $padding_bottom ) {
				$style .= 'padding-bottom:0;';
			}
			$style .= '" ';
		}

		do_action( "thesis_hook_before_$hook" );
		echo
			"$tab<div" . ( ! empty( $this->options['id'] ) ? ' id="' . trim( $thesis->api->esc( $this->options['id'] ) ) . '"' : '' ) .
			' class="' . $class . "\"$style>\n";
		do_action( "thesis_hook_{$hook}_top" );
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		do_action( "thesis_hook_{$hook}_bottom" );
		echo "$tab<div style=\"clear:both;\"></div>\n";
		echo "$tab</div>\n";
		do_action( "thesis_hook_after_$hook" );
	}

}

class byobagn_responsive_columns_reverse_wrapper extends thesis_box {

	public $type = 'rotator';

	protected function translate() {
		$this->title = $this->name = __( 'XDeprecated - Agility Column Reverse Wrapper', 'byobagn' );
	}

	protected function html_options() {
		global $thesis;
		$options = $thesis->api->html_options();
		unset( $options['class'] );

		return array_merge( $options, array(
			'id'   => array(
				'type'    => 'text',
				'width'   => 'medium',
				'code'    => true,
				'label'   => $thesis->api->strings['html_id'],
				'tooltip' => $thesis->api->strings['id_tooltip']
			),
			'hook' => array(
				'type'    => 'text',
				'width'   => 'medium',
				'code'    => true,
				'label'   => $thesis->api->strings['hook_label'],
				'tooltip' => $thesis->api->strings['hook_tooltip_1'] . '<br /><br /><code>thesis_hook_before_container_{name}</code><br /><code>thesis_hook_container_{name}_top</code><br /><code>thesis_hook_container_{name}_bottom</code><br /><code>thesis_hook_after_container_{name}</code><br /><br />' . $thesis->api->strings['hook_tooltip_2']
			)
		) );
	}

	public function html( $args = false ) {
		global $thesis;

		extract( $args = is_array( $args ) ? $args : array() );

		$class = 'reverse_wrapper';
		$tab   = str_repeat( "\t", $depth = ! empty( $depth ) ? $depth : 0 );
		$hook  = ! empty( $this->options['hook'] ) ? 'container_' . trim( $thesis->api->esc( $this->options['hook'] ) ) : $this->_id;

		do_action( "thesis_hook_before_$hook" );
		echo
			"$tab<div" . ( ! empty( $this->options['id'] ) ? ' id="' . trim( $thesis->api->esc( $this->options['id'] ) ) . '"' : '' ) .
			' class="' . $class . "\">\n";
		do_action( "thesis_hook_{$hook}_top" );
		$this->rotator( array_merge( $args, array( 'depth' => $depth + 1 ) ) );
		do_action( "thesis_hook_{$hook}_bottom" );
		echo "$tab<div style=\"clear:both;\"></div>\n";
		echo "$tab</div>\n";
		do_action( "thesis_hook_after_$hook" );
	}

}

function byobagn_site_title( $depth ) {
	global $thesis, $wp_query; #wp
	$html = $wp_query->is_home || is_front_page() ? 'h1' : 'p'; #wp
	echo
		str_repeat( "\t", $depth ) .
		"<$html id=\"site_title\"><a href=\"" . esc_url( site_url() ) . "\">" . get_bloginfo( 'name' ) . "</a></$html>\n" .
		str_repeat( "\t", $depth ) .
		"<p id=\"site_tagline\">" . get_bloginfo( 'description' ) . "</p>\n";
}

function byobagn_header_image( $depth, $url ) {
	echo
		str_repeat( "\t", $depth ) .
		"<a href=\"" . esc_url( site_url() ) . "\" title=\"Return to our Home Page\">" .
		"<img src=\"" . esc_url( $url ) . "\" alt=\"" . get_bloginfo( 'name' ) . "\" /></a>\n";
}

function byobagn_header_widget_area( $depth, $widget_id, $widget_name ) {
	$tab = str_repeat( "\t", $depth );
	if ( ! dynamic_sidebar( $widget_id ) && is_user_logged_in() ) {
		echo
			"$tab<div class=\"header_widget\">\n" .
			"$tab\t<p>" . sprintf( __( 'This is a widget box called %1$s, but there are no widgets in it yet. <a href="%2$s">Add a widget here</a>.', 'byobagn' ), $widget_name, admin_url( 'widgets.php' ) ) . "</p>\n" .
			"$tab</div>\n";
	}
}

function byobagn_header_menu( $depth, $menu ) {

	echo str_repeat( "\t", $depth ) . wp_nav_menu( array( 'menu' => $menu, 'echo' => false ) ) . "\n"; #wp
}
