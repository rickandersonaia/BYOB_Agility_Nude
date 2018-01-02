<?php

/**
 * Description of byobagn_design
 *
 * @author Rick
 */
class byobagn_design {

	public function fonts_design( $design ) {
		global $thesis;
		$css     = $thesis->api->css->options;
		$o       = new byobagn_design_options( $design );
		$options = array(
			'elements' => array(// this is an object set containing all other design options for this Skin
				'type'    => 'object_set',
				'label'   => __( 'Typical Font Styles', 'byobagn' ),
				'select'  => __( 'Select a design element to edit:', 'byobagn' ),
				'objects' => array(
					'primary_font_family' => array(
						'type'   => 'group',
						'label'  => __( 'Typical Text Font Family', 'byobagn' ),
						'fields' => array(
							'font_family' => array_merge( $css['font']['fields']['font-family'], array( 'default' => 'arial' ) )
						)
					),
					'heading_font_family' => array(
						'type'   => 'group',
						'label'  => __( 'Typical Heading Font Family', 'byobagn' ),
						'fields' => array(
							'font_family' => array_merge( $css['font']['fields']['font-family'], array( 'default' => 'arial' ) )
						)
					),
					'typ_p'               => array(
						'type'   => 'group',
						'label'  => __( 'Paragraph Text', 'byobagn' ),
						'fields' => $o->paragraph_less_family()
					),
					'typ_h1'              => array(
						'type'   => 'group',
						'label'  => __( 'Headings - H1', 'byobagn' ),
						'fields' => $o->headings()
					),
					'typ_h2'              => array(
						'type'   => 'group',
						'label'  => __( 'Headings - H2', 'byobagn' ),
						'fields' => $o->headings()
					),
					'typ_h3'              => array(
						'type'   => 'group',
						'label'  => __( 'Headings - H3', 'byobagn' ),
						'fields' => $o->headings()
					),
					'typ_h4'              => array(
						'type'   => 'group',
						'label'  => __( 'Headings - H4', 'byobagn' ),
						'fields' => $o->headings()
					),
					'typ_h5'              => array(
						'type'   => 'group',
						'label'  => __( 'Headings - H5', 'byobagn' ),
						'fields' => $o->headings()
					),
					'typ_h6'              => array(
						'type'   => 'group',
						'label'  => __( 'Headings - H6', 'byobagn' ),
						'fields' => $o->headings()
					),
					'typ_lists'           => array(
						'type'   => 'group',
						'label'  => __( 'Typical List Style', 'byobagn' ),
						'fields' => $o->lists()
					),
					'typ_links'           => array(
						'type'   => 'group',
						'label'  => __( 'Typical Link Style', 'byobagn' ),
						'fields' => $o->links()
					),
					'secondary_font'      => array(
						'type'   => 'group',
						'label'  => __( 'Secondary Font', 'byobagn' ),
						'fields' => $o->paragraph()
					),
					'headline'            => array(
						'type'   => 'group',
						'label'  => __( 'Page Titles', 'byobagn' ),
						'fields' => $o->page_titles()
					),
					'query_box_headline'  => array(
						'type'   => 'group',
						'label'  => __( 'Query Box Headline', 'byobagn' ),
						'fields' => $o->page_titles()
					),
					'fc_box_headline'     => array(
						'type'   => 'group',
						'label'  => __( 'Featured Content Box Headline', 'byobagn' ),
						'fields' => $o->page_titles()
					),
					'icon_box_headline'   => array(
						'type'   => 'group',
						'label'  => __( 'Icon Box Headline', 'byobagn' ),
						'fields' => $o->page_titles()
					),
					'blockquote'          => array(
						'type'   => 'group',
						'label'  => __( 'Blockquotes', 'byobagn' ),
						'fields' => $o->blockquotes()
					),
					'code'                => array(
						'type'   => 'group',
						'label'  => __( 'Code: Inline &lt;code&gt;', 'byobagn' ),
						'fields' => $o->font_size_color()
					),
					'pre'                 => array(
						'type'   => 'group',
						'label'  => __( 'Code: Pre-formatted &lt;pre&gt;', 'byobagn' ),
						'fields' => $o->font_size_color()
					),
					'title'               => array(
						'type'   => 'group',
						'label'  => __( 'Site Title', 'byobagn' ),
						'fields' => $o->site_title()
					),
					'tagline'             => array(
						'type'   => 'group',
						'label'  => __( 'Site Tagline', 'byobagn' ),
						'fields' => $o->headings()
					),
					'section_title'       => array(
						'type'   => 'group',
						'label'  => __( 'Section Title', 'byobagn' ),
						'fields' => $o->blockquotes()
					),
					'copyright'           => array(
						'type'   => 'group',
						'label'  => __( 'Copyright', 'byobagn' ),
						'fields' => $o->copyright()
					),
					'phone_container'     => array(
						'type'   => 'group',
						'label'  => __( 'Phone_Number Container', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'phone_link'          => array(
						'type'   => 'group',
						'label'  => __( 'Phone Number Link Style', 'byobagn' ),
						'fields' => $o->links()
					),
					'phone_heading'       => array(
						'type'   => 'group',
						'label'  => __( 'Phone Number Heading', 'byobagn' ),
						'fields' => $o->headings()
					),
					'typ_submit'          => array(
						'type'   => 'group',
						'label'  => __( 'Typical Submit Buttons', 'byobagn' ),
						'fields' => $o->submit()
					),
					'read_more_submit'    => array(
						'type'   => 'group',
						'label'  => __( 'Typical Read More Buttons', 'byobagn' ),
						'fields' => $o->submit()
					),
					'cta_submit'          => array(
						'type'   => 'group',
						'label'  => __( 'Call to Action Submit Buttons', 'byobagn' ),
						'fields' => $o->submit()
					),
				)
			)
		);

		return $options;
	}

	public function menu_design( $design ) {
		global $thesis;
		$css     = $thesis->api->css->options;
		$o       = new byobagn_design_options( $design );
		$options = array(
			'menu_elements' => array(
				'type'    => 'object_set',
				'label'   => __( 'Menus', 'byobagn' ),
				'select'  => __( 'Select a menu to edit:', 'byobagn' ),
				'objects' => array(
					'main_menu'                  => array(
						'type'   => 'group',
						'label'  => __( 'Main Menu', 'byobagn' ),
						'fields' => $o->main_navigation()
					),
					'main_submenu'               => array(
						'type'   => 'group',
						'label'  => __( 'Main Menu Submenu', 'byobagn' ),
						'fields' => $o->navigation()
					),
					'header_menu'                => array(
						'type'   => 'group',
						'label'  => __( 'Header Menu', 'byobagn' ),
						'fields' => $o->navigation()
					),
					'header_submenu'             => array(
						'type'   => 'group',
						'label'  => __( 'Header Sub Menu', 'byobagn' ),
						'fields' => $o->navigation()
					),
					'footer_menu'                => array(
						'type'   => 'group',
						'label'  => __( 'Footer Menu', 'byobagn' ),
						'fields' => $o->navigation()
					),
					'secondary_menu'             => array(
						'type'   => 'group',
						'label'  => __( 'Secondary Menu', 'byobagn' ),
						'fields' => $o->navigation()
					),
					'secondary_submenu'          => array(
						'type'   => 'group',
						'label'  => __( 'Secondary Sub Menu', 'byobagn' ),
						'fields' => $o->navigation()
					),
					'link_supplement'            => array(
						'type'   => 'group',
						'label'  => __( 'Menu - Link Supplemental Styles', 'byobagn' ),
						'fields' => $o->menu_link_supplement()
					),
					'hover_supplement'           => array(
						'type'   => 'group',
						'label'  => __( 'Menu - Hover Supplemental Styles', 'byobagn' ),
						'fields' => $o->menu_supplement()
					),
					'current_supplement'         => array(
						'type'   => 'group',
						'label'  => __( 'Menu - Current Supplemental Styles', 'byobagn' ),
						'fields' => $o->menu_supplement()
					),
					'submenu_link_supplement'    => array(
						'type'   => 'group',
						'label'  => __( 'Submenu - Link Supplemental Styles', 'byobagn' ),
						'fields' => $o->submenu_link_supplement()
					),
					'submenu_hover_supplement'   => array(
						'type'   => 'group',
						'label'  => __( 'Submenu - Hover Supplemental Styles', 'byobagn' ),
						'fields' => $o->submenu_supplement()
					),
					'submenu_current_supplement' => array(
						'type'   => 'group',
						'label'  => __( 'Submenu - Current Supplemental Styles', 'byobagn' ),
						'fields' => $o->submenu_supplement()
					)
				)
			)
		);

		return $options;
	}

	public function background_design( $design ) {
		global $thesis;
		$css     = $thesis->api->css->options;
		$o       = new byobagn_design_options( $design );
		$options = array(
			'background_elements' => array(
				'type'    => 'object_set',
				'label'   => __( 'Backgrounds', 'byobagn' ),
				'select'  => __( 'Select a background area to edit:', 'byobagn' ),
				'objects' => array(
					'body_background'                       => array(
						'type'   => 'group',
						'label'  => __( 'Main Body Background', 'byobagn' ),
						'fields' => $o->simple_background()
					),
					'top_header_area_background'            => array(
						'type'   => 'group',
						'label'  => __( 'Top Header Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'top_header_area_page_background'       => array(
						'type'   => 'group',
						'label'  => __( 'Top Header Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'header_area_background'                => array(
						'type'   => 'group',
						'label'  => __( 'Header Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'header_area_page_background'           => array(
						'type'   => 'group',
						'label'  => __( 'Header Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'top_menu_area_background'              => array(
						'type'   => 'group',
						'label'  => __( 'Top Menu Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'top_menu_area_page_background'         => array(
						'type'   => 'group',
						'label'  => __( 'Top Menu Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'feature_box_area_background'           => array(
						'type'   => 'group',
						'label'  => __( 'Feature Box Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'feature_box_area_page_background'      => array(
						'type'   => 'group',
						'label'  => __( 'Feature Box Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'content_area_background'               => array(
						'type'   => 'group',
						'label'  => __( 'Content Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'content_area_page_background'          => array(
						'type'   => 'group',
						'label'  => __( 'Content Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'attention_area_background'             => array(
						'type'   => 'group',
						'label'  => __( 'Attention Box Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'attention_area_page_background'        => array(
						'type'   => 'group',
						'label'  => __( 'Attention Box Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'featured_content_area_background'      => array(
						'type'   => 'group',
						'label'  => __( 'Featured Content Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'featured_content_area_page_background' => array(
						'type'   => 'group',
						'label'  => __( 'Featured Content Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'notice_bar_area_background'            => array(
						'type'   => 'group',
						'label'  => __( 'Notice Bar Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'notice_bar_area_page_background'       => array(
						'type'   => 'group',
						'label'  => __( 'Notice Bar Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'footer_top_area_background'            => array(
						'type'   => 'group',
						'label'  => __( 'Top Footer Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'footer_top_area_page_background'       => array(
						'type'   => 'group',
						'label'  => __( 'Top Footer Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'footer_bottom_area_background'         => array(
						'type'   => 'group',
						'label'  => __( 'Bottom Footer Area Background', 'byobagn' ),
						'fields' => $o->area_background()
					),
					'footer_bottom_area_page_background'    => array(
						'type'   => 'group',
						'label'  => __( 'Bottom Footer Area Page Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'overlay_1_background'                  => array(
						'type'   => 'group',
						'label'  => __( 'Overlay Style 1 Background (overlay-1)', 'byobagn' ),
						'fields' => $o->simple_background()
					),
					'overlay_2_background'                  => array(
						'type'   => 'group',
						'label'  => __( 'Overlay Style 2 Background (overlay-2)', 'byobagn' ),
						'fields' => $o->simple_background()
					),
					'overlay_3_background'                  => array(
						'type'   => 'group',
						'label'  => __( 'Overlay Style 3 Background (overlay-3)', 'byobagn' ),
						'fields' => $o->simple_background()
					),
					'style_1_background'                    => array(
						'type'   => 'group',
						'label'  => __( 'Extra Style 1 Background (style-1)', 'byobagn' ),
						'fields' => $o->full_background()
					),
					'style_2_background'                    => array(
						'type'   => 'group',
						'label'  => __( 'Extra Style 2 Background (style-2)', 'byobagn' ),
						'fields' => $o->full_background()
					),
					'style_3_background'                    => array(
						'type'   => 'group',
						'label'  => __( 'Extra Style 3 Background (style-3)', 'byobagn' ),
						'fields' => $o->full_background()
					),
					'style_4_background'                    => array(
						'type'   => 'group',
						'label'  => __( 'Extra Style 4 Background (style-4)', 'byobagn' ),
						'fields' => $o->full_background()
					),
					'style_5_background'                    => array(
						'type'   => 'group',
						'label'  => __( 'Extra Style 5 Background (style-5)', 'byobagn' ),
						'fields' => $o->full_background()
					)
				)
			)
		);

		return $options;
	}

	public function widget_design( $design ) {
		$o       = new byobagn_design_options();
		$options = array(
			'widget_elements' => array(
				'type'    => 'object_set',
				'label'   => __( 'Widget Areas', 'byobagn' ),
				'select'  => __( 'Select a widget area to edit:', 'byobagn' ),
				'objects' => array(
					'sidebar'                          => array(
						'type'   => 'group',
						'label'  => __( 'Main Sidebar Widget Text', 'byobagn' ),
						'fields' => $o->paragraph()
					),
					'sidebar_widget_links'             => array(
						'type'   => 'group',
						'label'  => __( '- Main Sidebar Widget Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'sidebar_widget_lists'             => array(
						'type'   => 'group',
						'label'  => __( '- Main Sidebar Widget Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'sidebar_heading'                  => array(
						'type'   => 'group',
						'label'  => __( '- Main Sidebar Widget Headings', 'byobagn' ),
						'fields' => $o->headings()
					),
					'sidebar_background'               => array(
						'type'   => 'group',
						'label'  => __( '- Main Sidebar Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'footer_widget'                    => array(
						'type'   => 'group',
						'label'  => __( 'Footer Widget Text', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'footer_widget_links'              => array(
						'type'   => 'group',
						'label'  => __( '- Footer Widget Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'footer_widget_lists'              => array(
						'type'   => 'group',
						'label'  => __( '- Footer Widget Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'footer_widget_heading'            => array(
						'type'   => 'group',
						'label'  => __( '- Footer Widget Headings', 'byobagn' ),
						'fields' => $o->headings()
					),
					'footer_widget_background'         => array(
						'type'   => 'group',
						'label'  => __( '- Footer Widget Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'header_widget'                    => array(
						'type'   => 'group',
						'label'  => __( 'Header Widget Text', 'byobagn' ),
						'fields' => $o->paragraph()
					),
					'header_widget_links'              => array(
						'type'   => 'group',
						'label'  => __( '- Header Widget Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'header_widget_lists'              => array(
						'type'   => 'group',
						'label'  => __( '- Header Widget Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'header_widget_heading'            => array(
						'type'   => 'group',
						'label'  => __( '- Header Widget Headings', 'byobagn' ),
						'fields' => $o->headings()
					),
					'header_widget_background'         => array(
						'type'   => 'group',
						'label'  => __( '- Header Widget Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'feature_box_widget'               => array(
						'type'   => 'group',
						'label'  => __( 'Feature Box Widget Text', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'feature_box_widget_links'         => array(
						'type'   => 'group',
						'label'  => __( '- Feature Box Widget Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'feature_box_widget_lists'         => array(
						'type'   => 'group',
						'label'  => __( '- Feature Box Widget Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'feature_box_widget_heading'       => array(
						'type'   => 'group',
						'label'  => __( '- Feature Box Widget Headings', 'byobagn' ),
						'fields' => $o->headings()
					),
					'feature_box_widget_background'    => array(
						'type'   => 'group',
						'label'  => __( '- Feature Box Widget Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'attention_box_widget'             => array(
						'type'   => 'group',
						'label'  => __( 'Attention Box Widget Text', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'attention_box_widget_links'       => array(
						'type'   => 'group',
						'label'  => __( '- Attention Box Widget Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'attention_box_widget_lists'       => array(
						'type'   => 'group',
						'label'  => __( '- Attention Box Widget Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'attention_box_widget_heading'     => array(
						'type'   => 'group',
						'label'  => __( '- Attention Box Widget Headings', 'byobagn' ),
						'fields' => $o->headings()
					),
					'attention_box_widget_background'  => array(
						'type'   => 'group',
						'label'  => __( '- Attention Box Widget Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'supplemental_widget'              => array(
						'type'   => 'group',
						'label'  => __( 'Supplemental Widget Text (supplemental)', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'supplemental_widget_links'        => array(
						'type'   => 'group',
						'label'  => __( '- Supplemental Widget Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'supplemental_widget_lists'        => array(
						'type'   => 'group',
						'label'  => __( '- Supplemental Widget Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'supplemental_widget_heading'      => array(
						'type'   => 'group',
						'label'  => __( '- Supplemental Widget Headings', 'byobagn' ),
						'fields' => $o->headings()
					),
					'supplemental_widget_background'   => array(
						'type'   => 'group',
						'label'  => __( '- Supplemental Widget Background', 'byobagn' ),
						'fields' => $o->page_background()
					),
					'supplemental_2_widget'            => array(
						'type'   => 'group',
						'label'  => __( 'Supplemental 2 Widget Text (supplemental-2)', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'supplemental_2_widget_links'      => array(
						'type'   => 'group',
						'label'  => __( '- Supplemental 2 Widget Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'supplemental_2_widget_lists'      => array(
						'type'   => 'group',
						'label'  => __( '- Supplemental 2 Widget Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'supplemental_2_widget_heading'    => array(
						'type'   => 'group',
						'label'  => __( '- Supplemental 2 Widget Headings', 'byobagn' ),
						'fields' => $o->headings()
					),
					'supplemental_2_widget_background' => array(
						'type'   => 'group',
						'label'  => __( '- Supplemental 2 Widget Background', 'byobagn' ),
						'fields' => $o->page_background()
					)
				)
			)
		);

		return $options;
	}

	public function text_area_design( $design ) {
		global $thesis;
		$css     = $thesis->api->css->options;
		$o       = new byobagn_design_options();
		$options = array(
			'text_area_elements' => array(
				'type'    => 'object_set',
				'label'   => __( 'Custom Text Areas', 'byobagn' ),
				'select'  => __( 'Select a custom text area to edit:', 'byobagn' ),
				'objects' => array(
					'custom_1_typical_text'  => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 Typical Text (custom-1)', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'custom_1_links'         => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'custom_1_lists'         => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'custom_1_heading'       => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 Headings', 'byobagn' ),
						'fields' => $o->page_titles()
					),
					'custom_1_subheading'    => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 Sub Headings (h2)', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_1_subsubheading' => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 Sub Sub Headings (h3, h4)', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_1_section_title' => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 Section Title', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_1_background'    => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 Background', 'byobagn' ),
						'fields' => $o->text_area_background()
					),
					'custom_1_mq_800'        => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 - Tablet Portrait Adjustments', 'byobagn' ),
						'fields' => $o->custom_text_area_media_queries()
					),
					'custom_1_mq_699'        => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 - Phone Landscape Adjustments', 'byobagn' ),
						'fields' => $o->custom_text_area_media_queries()
					),
					'custom_1_mq_415'        => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 1 - Phone Portrait Adjustments', 'byobagn' ),
						'fields' => $o->custom_text_area_media_queries()
					),
					'custom_2_typical_text'  => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 Typical Text (custom-2)', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'custom_2_links'         => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'custom_2_lists'         => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'custom_2_heading'       => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 Headings', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_2_subheading'    => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 Sub Headings (h2)', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_2_subsubheading' => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 Sub Sub Headings (h3, h4)', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_2_section_title' => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 Section Title', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_2_background'    => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 Background', 'byobagn' ),
						'fields' => $o->text_area_background()
					),
					'custom_2_mq_800'        => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 - Tablet Portrait Adjustments', 'byobagn' ),
						'fields' => $o->custom_text_area_media_queries()
					),
					'custom_2_mq_699'        => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 - Phone Landscape Adjustments', 'byobagn' ),
						'fields' => $o->custom_text_area_media_queries()
					),
					'custom_2_mq_415'        => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 2 - Phone Portrait Adjustments', 'byobagn' ),
						'fields' => $o->custom_text_area_media_queries()
					),
					'custom_3_typical_text'  => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 Typical Text (custom-3)', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'custom_3_links'         => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 Links', 'byobagn' ),
						'fields' => $o->links()
					),
					'custom_3_lists'         => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 Lists', 'byobagn' ),
						'fields' => $o->lists()
					),
					'custom_3_heading'       => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 Headings', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_3_subheading'    => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 Sub Headings (h2)', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_3_subsubheading' => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 Sub Sub Headings (h3, h4)', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_3_section_title' => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 Section Title', 'byobagn' ),
						'fields' => $o->headings()
					),
					'custom_3_background'    => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 Background', 'byobagn' ),
						'fields' => $o->text_area_background()
					),
					'custom_3_mq_800'        => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 - Tablet Portrait Adjustments', 'byobagn' ),
						'fields' => $o->custom_text_area_media_queries()
					),
					'custom_3_mq_699'        => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 - Phone Landscape Adjustments', 'byobagn' ),
						'fields' => $o->custom_text_area_media_queries()
					),
					'custom_3_mq_415'        => array(
						'type'   => 'group',
						'label'  => __( 'Custom Text Area 3 - Phone Portrait Adjustments', 'byobagn' ),
						'fields' => $o->custom_text_area_media_queries()
					),
				)
			)
		);

		return $options;
	}

	public function icon_design( $design ) {
		global $thesis;
		$css     = $thesis->api->css->options;
		$o       = new byobagn_design_options();
		$options = array(
			'icon_elements' => array(
				'type'    => 'object_set',
				'label'   => __( 'Icon Styles', 'byobagn' ),
				'select'  => __( 'Select an Icon style to edit:', 'byobagn' ),
				'objects' => array(
					'social_icon_style_1'     => array(
						'type'   => 'group',
						'label'  => __( 'Social Icon Style 1', 'byobagn' ),
						'fields' => $o->social_icon_styles()
					),
					'social_icon_style_2'     => array(
						'type'   => 'group',
						'label'  => __( 'Social Icon Style 2', 'byobagn' ),
						'fields' => $o->social_icon_styles()
					),
					'plain_icon'              => array(
						'type'   => 'group',
						'label'  => __( 'Plain Icon Style', 'byobagn' ),
						'fields' => $o->icon_styles()
					),
					'circle_positive'         => array(
						'type'   => 'group',
						'label'  => __( 'Circle Positive Icon Style', 'byobagn' ),
						'fields' => $o->icon_styles()
					),
					'circle_negative'         => array(
						'type'   => 'group',
						'label'  => __( 'Circle Negative Icon Style', 'byobagn' ),
						'fields' => $o->icon_styles()
					),
					'square_positive'         => array(
						'type'   => 'group',
						'label'  => __( 'Square Positive Icon Style', 'byobagn' ),
						'fields' => $o->icon_styles()
					),
					'square_negative'         => array(
						'type'   => 'group',
						'label'  => __( 'Square Negative Style', 'byobagn' ),
						'fields' => $o->icon_styles()
					),
					'rounded_square_positive' => array(
						'type'   => 'group',
						'label'  => __( 'Rounded Square Positive Icon Style', 'byobagn' ),
						'fields' => $o->icon_styles()
					),
					'rounded_square_negative' => array(
						'type'   => 'group',
						'label'  => __( 'Rounded Square Negative Style', 'byobagn' ),
						'fields' => $o->icon_styles()
					)
				)
			)
		);

		return $options;
	}

	public function cta_design( $design ) {
		global $thesis;
		$css     = $thesis->api->css->options;
		$o       = new byobagn_design_options();
		$options = array(
			'cta_elements' => array(
				'type'    => 'object_set',
				'label'   => __( 'Call to Action Styles', 'byobagn' ),
				'select'  => __( 'Select a Call to Action style element to edit:', 'byobagn' ),
				'objects' => array(
					'cta_1_background' => array(
						'type'   => 'group',
						'label'  => __( 'Style 1 Background', 'byobagn' ),
						'fields' => $o->cta_background()
					),
					'cta_1_heading'    => array(
						'type'   => 'group',
						'label'  => __( 'Style 1 Heading', 'byobagn' ),
						'fields' => $o->headings()
					),
					'cta_1_message'    => array(
						'type'   => 'group',
						'label'  => __( 'Style 1 Message', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'cta_1_link'       => array(
						'type'   => 'group',
						'label'  => __( 'Style 1 Submit Button', 'byobagn' ),
						'fields' => $o->submit()
					),
					'cta_1_label'      => array(
						'type'   => 'group',
						'label'  => __( 'Style 1 Email Form Labels', 'byobagn' ),
						'fields' => $o->labels()
					),
					'cta_2_background' => array(
						'type'   => 'group',
						'label'  => __( 'Style 2 Background', 'byobagn' ),
						'fields' => $o->cta_background()
					),
					'cta_2_heading'    => array(
						'type'   => 'group',
						'label'  => __( 'Style 2 Heading', 'byobagn' ),
						'fields' => $o->headings()
					),
					'cta_2_message'    => array(
						'type'   => 'group',
						'label'  => __( 'Style 2 Message', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'cta_2_link'       => array(
						'type'   => 'group',
						'label'  => __( 'Style 2 Submit Button', 'byobagn' ),
						'fields' => $o->submit()
					),
					'cta_2_label'      => array(
						'type'   => 'group',
						'label'  => __( 'Style 2 Email Form Labels', 'byobagn' ),
						'fields' => $o->labels()
					),
					'cta_3_background' => array(
						'type'   => 'group',
						'label'  => __( 'Style 3 Background', 'byobagn' ),
						'fields' => $o->cta_background()
					),
					'cta_3_heading'    => array(
						'type'   => 'group',
						'label'  => __( 'Style 3 Heading', 'byobagn' ),
						'fields' => $o->headings()
					),
					'cta_3_message'    => array(
						'type'   => 'group',
						'label'  => __( 'Style 3 Message', 'byobagn' ),
						'fields' => $o->text_area()
					),
					'cta_3_link'       => array(
						'type'   => 'group',
						'label'  => __( 'Style 3 Submit Button', 'byobagn' ),
						'fields' => $o->submit()
					),
					'cta_3_label'      => array(
						'type'   => 'group',
						'label'  => __( 'Style 3 Email Form Labels', 'byobagn' ),
						'fields' => $o->labels()
					)
				)
			)
		);

		return $options;
	}

	public function dimension_design( $design ) {
		global $thesis;
		$o       = new byobagn_design_options();
		$header  = $o->header();
		$options = array(
			'dimensions' => array(// this is an object set containing all other design options for this Skin
				'type'    => 'object_set',
				'label'   => __( 'Primary Dimensions', 'byobagn' ),
				'select'  => __( 'Select a design element to edit:', 'byobagn' ),
				'objects' => array(
					'desktop_width'          => array(
						'type'   => 'group',
						'label'  => __( 'Typical Desktop Width', 'byobagn' ),
						'fields' => array(
							'width' => array(
								'type'    => 'select',
								'label'   => __( 'Typical desktop width', 'byobagn' ),
								'options' => array(
									1920 => __( 'Full Screen - As big or small as the desktop screen', 'byobagn' ),
									1280 => __( '1280 px - full HD Video', 'byobagn' ),
									1140 => __( '1140 px', 'byobagn' ),
									1032 => __( '1032 px - 3/4 HD Video', 'byobagn' ),
									960  => __( '960 px', 'byobagn' ),
								),
								'default' => 1032
							)
						)
					),
					'content_width'          => array(
						'type'   => 'group',
						'label'  => __( 'Typical Content Width', 'byobagn' ),
						'fields' => array(
							'width' => array(
								'type'    => 'select',
								'label'   => __( 'Typical content width', 'byobagn' ),
								'options' => array(
									''               => __( 'Choose a Column Width', 'byobagn' ),
									'full'           => __( 'Full Width', 'byobagn' ),
									'three-quarters' => __( 'Three Quarter Width', 'byobagn' ),
									'two-thirds'     => __( 'Two Thirds Width', 'byobagn' ),
									'half'           => __( 'Half Width', 'byobagn' ),
								),
								'default' => 'two-thirds'
							)
						)
					),
					'sidebar_width'          => array(
						'type'   => 'group',
						'label'  => __( 'Typical Sidebar Width', 'byobagn' ),
						'fields' => array(
							'width' => array(
								'type'    => 'select',
								'label'   => __( 'Typical sidebar width', 'byobagn' ),
								'options' => array(
									''            => __( 'Choose a Column Width', 'byobagn' ),
									'half'        => __( 'Half Width', 'byobagn' ),
									'one-third'   => __( 'One Third Width', 'byobagn' ),
									'one-quarter' => __( 'One Quarter Width', 'byobagn' ),
								),
								'default' => 'one-third'
							)
						)
					),
					'spacing_constant_width' => array(
						'type'   => 'group',
						'label'  => __( 'Spacing Constant (Primary)', 'byobagn' ),
						'fields' => array(
							'width' => array(
								'type'        => 'text',
								'label'       => __( 'Typical spacing', 'byobagn' ),
								'width'       => 'tiny',
								'description' => 'numerals only',
								'tooltip'     => __( 'This number will be used to calculate padding and margin sitewide', 'byobagn' ),
								'placeholder' => '26'
							)
						)
					),
					'col_1_top_header'       => array(
						'type'   => 'group',
						'label'  => __( 'Top Header Bar Column 1', 'byobagn' ),
						'fields' => $header
					),
					'col_2_top_header'       => array(
						'type'   => 'group',
						'label'  => __( 'Top Header Bar  Column 2', 'byobagn' ),
						'fields' => $header
					),
					'col_3_top_header'       => array(
						'type'   => 'group',
						'label'  => __( 'Top Header Bar  Column 3', 'byobagn' ),
						'fields' => $header
					),
					'col_4_top_header'       => array(
						'type'   => 'group',
						'label'  => __( 'Top Header Bar  Column 4', 'byobagn' ),
						'fields' => $header
					),
					'col_1_main_header'      => array(
						'type'   => 'group',
						'label'  => __( 'Main Header Column 1', 'byobagn' ),
						'fields' => $header
					),
					'col_2_main_header'      => array(
						'type'   => 'group',
						'label'  => __( 'Main Header Column 2', 'byobagn' ),
						'fields' => $header
					),
					'col_3_main_header'      => array(
						'type'   => 'group',
						'label'  => __( 'Main Header Column 3', 'byobagn' ),
						'fields' => $header
					),
					'col_4_main_header'      => array(
						'type'   => 'group',
						'label'  => __( 'Main Header Column 4', 'byobagn' ),
						'fields' => $header
					),
					'col_1_top_menu'         => array(
						'type'   => 'group',
						'label'  => __( 'Top Menu Area Column 1', 'byobagn' ),
						'fields' => $header
					),
					'col_2_top_menu'         => array(
						'type'   => 'group',
						'label'  => __( 'Top Menu Area  Column 2', 'byobagn' ),
						'fields' => $header
					),
					'col_3_top_menu'         => array(
						'type'   => 'group',
						'label'  => __( 'Top Menu Area  Column 3', 'byobagn' ),
						'fields' => $header
					),
					'col_4_top_menu'         => array(
						'type'   => 'group',
						'label'  => __( 'Top Menu Area  Column 4', 'byobagn' ),
						'fields' => $header
					),
					'header_1_col'           => array(
						'type'   => 'group',
						'label'  => __( 'Depricated - 1 Column Header', 'byobagn' ),
						'fields' => $header
					),
					'header_2_col_left'      => array(
						'type'   => 'group',
						'label'  => __( 'Depricated - 2 Column Header - Left Column', 'byobagn' ),
						'fields' => $header
					),
					'header_2_col_right'     => array(
						'type'   => 'group',
						'label'  => __( 'Depricated - 2 Column Header - Right Column', 'byobagn' ),
						'fields' => $header
					)
				)
			)
		);

		return $options;
	}

	public function configuration_design( $design ) {
		global $thesis;
		$o              = new byobagn_design_options();
		$scheme         = new byob_determine_options_scheme();
		$options_scheme = $scheme->determine_current_options_scheme();

		$options = array(
			'configuration' => array(
				'type'    => 'object_set',
				'label'   => __( 'Configuration Options', 'byobagn' ),
				'select'  => __( 'Select an option to edit:', 'byobagn' ),
				'objects' => array(
					'skin_color_names' => array(
						'type'   => 'group',
						'label'  => __( 'Skin Color Names', 'byobagn' ),
						'fields' => $o->skin_color_names()
					),
					'scripts'          => array(
						'type'   => 'group',
						'label'  => __( 'Scripts', 'byobagn' ),
						'fields' => $o->scripts()
					),
					'image_sizes'      => array(
						'type'   => 'group',
						'label'  => __( 'Image Sizes', 'byobagn' ),
						'fields' => $o->images()
					)
				)
			)
		);

		if ( $options_scheme !== 'new' ) {
			$options['configuration']['objects']['convert'] = array(
				'type'   => 'group',
				'label'  => __( 'Convert 3.0 Settings', 'byobagn' ),
				'fields' => $o->conversion()
			);
		}

		return $options;
	}

	public function media_query_design( $design ) {
		global $thesis;
		$css     = $thesis->api->css->options;
		$o       = new byobagn_design_options();
		$options = array(
			'media_query_elements' => array(
				'type'    => 'object_set',
				'label'   => __( 'Custom Media Queries', 'byobagn' ),
				'select'  => __( 'Select an media query to edit:', 'byobagn' ),
				'objects' => array(
					'mq_desktop_1280'    => array(
						'type'   => 'group',
						'label'  => __( 'Media Query - Desktop - 1280px wide', 'byobagn' ),
						'fields' => $o->media_queries()
					),
					'mq_desktop_1140'    => array(
						'type'   => 'group',
						'label'  => __( 'Media Query - Desktop - 1140px wide', 'byobagn' ),
						'fields' => $o->media_queries()
					),
					'mq_tablet_lanscape' => array(
						'type'   => 'group',
						'label'  => __( 'Media Query - Tablet Devices, Landscape', 'byobagn' ),
						'fields' => $o->media_queries()
					),
					'mq_tablet_portrait' => array(
						'type'   => 'group',
						'label'  => __( 'Media Query - Tablet Devices, Portrait', 'byobagn' ),
						'fields' => $o->media_queries()
					),
					'mq_phone_lanscape'  => array(
						'type'   => 'group',
						'label'  => __( 'Media Query - Smart Phone Devices, Landscape', 'byobagn' ),
						'fields' => $o->media_queries()
					),
					'mq_phone_portrait'  => array(
						'type'   => 'group',
						'label'  => __( 'Media Query - Smart Phone Devices, Portrait', 'byobagn' ),
						'fields' => $o->media_queries()
					)
				)
			)
		);

		return $options;
	}

}
