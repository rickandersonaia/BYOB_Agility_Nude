<?php

/**
 * Description of byobagn_design_options
 *
 * @author Rick
 */
class byobagn_design_options {

	public $font_family;
	public $design;

	public function __construct( $design = array() ) {
		global $thesis;
		$design_options = get_option( "byob_agility_nude__design" );
		$this->design   = ! empty( $design ) ? $design : $design_options;
//                $this->font_family = $thesis->api->css->properties['font-family'];
	}

	public function scripts() {
		return array(
			'responsive_jquery'     => array(
				'type'    => 'checkbox',
				'label'   => __( 'Add responsive jQuery', 'byobagn' ),
				'tooltip' => __( 'Check this box if your main content column fails to be responsive to smaller screens', 'byobagn' ),
				'options' => array(
					'use' => __( 'Add the responsive jQuery to all pages', 'byobagn' )
				)
			),
			'remove_menu_script'    => array(
				'type'    => 'checkbox',
				'label'   => __( 'Remove the responsive menu script', 'byobagn' ),
				'tooltip' => __( 'By default there is a responsive menu script that runs on all Thesis menus if the Responsive Menu Control option is selected, check this to remove it', 'byobagn' ),
				'options' => array(
					'remove' => __( 'Remove the responsive menu script', 'byobagn' )
				)
			),
			'jquery_footer'         => array(
				'type'    => 'checkbox',
				'label'   => __( 'Force jQuery to load in the footer', 'byobagn' ),
				'tooltip' => __( 'By default WordPress loads jQuery in the head, this slows down the rendering of the page - however some plugins require jQuery in the head', 'byobagn' ),
				'options' => array(
					'move' => __( 'Place jQuery in the footer', 'byobagn' )
				)
			),
			'remove_jquery_migrate' => array(
				'type'    => 'checkbox',
				'label'   => __( 'Remove jQuery Migrate script', 'byobagn' ),
				'tooltip' => __( 'By default this is enabled.  However if you dont have older scripts or plugins you can try to reduce your page load by checking this', 'byobagn' ),
				'options' => array(
					'remove' => __( 'Remove jQuery Migrate', 'byobagn' )
				)
			),
			'remove_emoji_script'   => array(
				'type'    => 'checkbox',
				'label'   => __( 'Remove emoji scripts & styles', 'byobagn' ),
				'tooltip' => __( 'If you do not need to use the WordPress emoji functionality - check this to rmove it', 'byobagn' ),
				'options' => array(
					'remove' => __( 'Remove emoji scripts & styles', 'byobagn' )
				)
			),
			'remove_oembed_script'  => array(
				'type'    => 'checkbox',
				'label'   => __( 'Remove oEmbed from the front of your site', 'byobagn' ),
				'tooltip' => __( 'This will disable the ability of other sites embedding your pages within theirs', 'byobagn' ),
				'options' => array(
					'remove' => __( 'Remove oEmbed', 'byobagn' )
				)
			)
		);
	}

	public function conversion() {
		return array(
			'reset'               => array(
				'type'    => 'checkbox',
				'label'   => __( 'Reset the conversion options', 'byobagn' ),
				'tooltip' => __( 'Check this box if you want to tell Agility that the old options have not been converted to the new options.  This will result the the old options being converted into new options again', 'byobagn' ),
				'options' => array(
					'reset' => __( 'Reset the options conversion switch', 'byobagn' )
				)
			),
			'display_old_options' => array(
				'type'    => 'checkbox',
				'label'   => __( 'Display the old options settings boxes', 'byobagn' ),
				'tooltip' => __( 'Check this box if you want to display the original Agility 3.0 settings for background styles, widget styles, text styles, icon styles, call to action styles and custom media queries', 'byobagn' ),
				'options' => array(
					'display' => __( 'Display the original 3.0 settingss', 'byobagn' )
				)
			),
			'delete_old_options'  => array(
				'type'    => 'checkbox',
				'label'   => __( 'Delete the old 3.0 settings', 'byobagn' ),
				'tooltip' => __( "Only do this if you are sure you don't need to restore your site back to a 3.0 version of Agility,", 'byobagn' ),
				'options' => array(
					'delete' => __( 'Permanently delete the old settings', 'byobagn' )
				)
			)
		);
	}

	public function images() {
		$default = array(
			'featured_page_h'  => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Featured Page - Horizontal', 'byobagn' ),
				'placeholder' => '415',
				'description' => 'numerals only'
			),
			'featured_page_v'  => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Featured Page - Vertical', 'byobagn' ),
				'placeholder' => '260',
				'description' => 'numerals only'
			),
			'tiny_thumbnail_h' => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Tiny Thumbnail - Horizontal', 'byobagn' ),
				'placeholder' => '75',
				'description' => 'numerals only'
			),
			'tiny_thumbnail_v' => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Tiny Thumbnail - Vertical', 'byobagn' ),
				'placeholder' => '75',
				'description' => 'numerals only'
			),
		);

		return $default;
	}

	public function font_size_color() {
		global $thesis;
		$default = array(
			'font-family' => array(
				'type'    => 'select',
				'label'   => __( 'Font Family', 'byobagn' ),
				'options' => $thesis->api->css->properties['font-family']
			),
			'font-size'   => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Font Size', 'byobagn' ),
				'description' => 'px'
			),
		);
		$color   = $this->color();

		return array_merge( $default, $color );
	}

	public function links() {
		global $thesis;
		$link = array(
			'link_decoration'  => array(
				'type'    => 'select',
				'label'   => __( 'Link Text Decoration', 'byobagn' ),
				'options' => $thesis->api->css->properties['text-decoration']
			),
			'hover_decoration' => array(
				'type'    => 'select',
				'label'   => __( 'Hover Text Decoration', 'byobagn' ),
				'options' => $thesis->api->css->properties['text-decoration']
			),
			'link_skin_color'  => array(
				'type'    => 'select',
				'label'   => __( 'Link Color - choose an existing skin color for the links', 'byobagn' ),
				'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
				'options' => $this->color_options()
			),
			'link_color'       => array(
				'type'  => 'color',
				'label' => __( 'Or enter a custom link color here', 'byobagn' )
			),
			'hover_skin_color' => array(
				'type'    => 'select',
				'label'   => __( 'Hover Color - choose an existing skin color for the link:hover', 'byobagn' ),
				'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
				'options' => $this->color_options()
			),
			'hover_color'      => array(
				'type'  => 'color',
				'label' => __( 'Or enter a custom hover color here', 'byobagn' )
			)
		);

		return $link;
	}

	public function fonts() {
		global $thesis;
		$fonts = array(
			'additional_styles' => array(
				'type'       => 'checkbox',
				'label'      => __( 'Show additional Font Style options', 'byobagn' ),
				'options'    => array(
					'show' => __( 'Check to show additional Font Style options', 'byobagn' ),
				),
				'dependents' => array( 'show' )
			),
			'font-weight'       => array(
				'type'    => 'select',
				'label'   => __( 'Font Weight', 'byobagn' ),
				'options' => $thesis->api->css->properties['font-weight'],
				'parent'  => array(
					'additional_styles' => 'show'
				)
			),
			'font-style'        => array(
				'type'    => 'select',
				'label'   => __( 'Font Style', 'byobagn' ),
				'options' => $thesis->api->css->properties['font-style'],
				'parent'  => array(
					'additional_styles' => 'show'
				)
			),
			'font-variant'      => array(
				'type'    => 'select',
				'label'   => __( 'Font Variant', 'byobagn' ),
				'options' => $thesis->api->css->properties['font-variant'],
				'parent'  => array(
					'additional_styles' => 'show'
				)
			),
			'text-transform'    => array(
				'type'    => 'select',
				'label'   => __( 'Font Text Transform', 'byobagn' ),
				'options' => $thesis->api->css->properties['text-transform'],
				'parent'  => array(
					'additional_styles' => 'show'
				)
			),
			'text-align'        => array(
				'type'    => 'select',
				'label'   => __( 'Font Text Align', 'byobagn' ),
				'options' => $thesis->api->css->properties['text-align'],
				'parent'  => array(
					'additional_styles' => 'show'
				)
			),
			'letter-spacing'    => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Letter Spacing', 'byobagn' ),
				'description' => 'px',
				'parent'      => array(
					'additional_styles' => 'show'
				)
			),
			'line-height'       => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Line Height', 'byobagn' ),
				'description' => 'Use this to over ride default settings',
				'parent'      => array(
					'additional_styles' => 'show'
				)
			)
		);

		return $fonts;
	}

	public function copyright() {
		$fsc   = $this->font_size_color();
		$fonts = $this->fonts();

		return array_merge( $fsc, $fonts );
	}

	public function labels() {
		$fsc   = $this->font_size_color();
		$fonts = $this->fonts();
		unset( $fonts['text-align'] );
		$vert   = $this->vertical_align();
		$margin = $this->margin_full();

		return array_merge( $fsc, $fonts, $vert, $margin );
	}

	public function headings() {
		$fsc    = $this->font_size_color();
		$fonts  = $this->fonts();
		$margin = $this->margin_v();

		return array_merge( $fsc, $fonts, $margin );
	}

	public function page_titles() {
		$fsc    = $this->font_size_color();
		$fonts  = $this->fonts();
		$link   = $this->links();
		$margin = $this->margin_v();

		return array_merge( $fsc, $fonts, $link, $margin );
	}

	public function site_title() {
		$fsc = $this->font_size_color();
		unset( $fsc['color'] );
		unset( $fsc['skin_color'] );
		$fonts  = $this->fonts();
		$link   = $this->links();
		$margin = $this->margin_v();

		return array_merge( $fsc, $fonts, $link, $margin );
	}

	public function paragraph() {
		$fonts  = $this->fonts();
		$fsc    = $this->font_size_color();
		$margin = $this->margin_v();
		unset( $fonts['letter-spacing'] );
		unset( $fonts['text-transform'] );
		unset( $fonts['font-variant'] );
		unset( $margin['margin-top'] );

		return array_merge( $fsc, $fonts, $margin );
	}

	public function paragraph_less_family() {
		$fonts  = $this->fonts();
		$fsc    = $this->font_size_color();
		$margin = $this->margin_v();
		unset( $fsc['font-family'] );
		unset( $fonts['letter-spacing'] );
		unset( $fonts['text-transform'] );
		unset( $fonts['font-variant'] );
		unset( $margin['margin-top'] );

		return array_merge( $fsc, $fonts, $margin );
	}

	public function text_area() {
		$fonts  = $this->fonts();
		$fsc    = $this->font_size_color();
		$margin = $this->margin_v();
		$width  = array(
			'column_width' => array(
				'type'    => 'select',
				'label'   => __( 'Typical Column Width', 'byobagn' ),
				'tooltip' => __( 'Choose Column Width that this style will most often be applied to - this will help set line heights properly', 'byobagn' ),
				'options' => array(
					''               => __( 'Choose a Column Width', 'byobagn' ),
					'full'           => __( 'Full Width', 'byobagn' ),
					'three-quarters' => __( 'Three Quarter Width', 'byobagn' ),
					'two-thirds'     => __( 'Two Thirds Width', 'byobagn' ),
					'half'           => __( 'Half Width', 'byobagn' ),
					'one-third'      => __( 'One Third Width', 'byobagn' ),
					'one-quarter'    => __( 'One Quarter Width', 'byobagn' ),
				)
			)
		);

		return array_merge( $fsc, $width, $fonts, $margin );
	}

	public function media_queries() {
		return array(
			'thesis_elements' => array(
				'type'   => 'group',
				'label'  => __( 'Thesis Text Elements', 'byobagn' ),
				'fields' => array(
					'mq_typ_p'          => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'Content Paragraph Font Size', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_sidebar_p'      => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'Sidebar Paragraph Font Size', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_page_titles'    => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'Page Titles', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_section_titles' => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'Section Titles', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_widget_titles'  => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'Widget Titles', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_site_title'     => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'Site Title Font', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_tagline'        => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'Site Tagline', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
				)
			),
			'html_headings'   => array(
				'type'   => 'group',
				'label'  => __( 'HTML Headings', 'byobagn' ),
				'fields' => array(
					'mq_h1'        => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'H1 - Headings', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_h2'        => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'H2 - Headings', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_h3'        => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'H3 - Headings', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_h4'        => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'H4 - Headings', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_h5'        => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'H5 - Headings', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_h6'        => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'H6 - Headings', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					),
					'mq_secondary' => array(
						'type'        => 'text',
						'width'       => 'tiny',
						'label'       => __( 'Secondary Font Size', 'byobagn' ),
						'description' => __( 'Use numerals only', 'byobagn' )
					)
				)
			),
			'code'            => array(
				'type'    => 'textarea',
				'rows'    => 10,
				'label'   => __( 'Enter any custom code for this media query', 'byobagn' ),
				'tooltip' => __( 'Add any additional custom code to add to this media query <code>#site_title{font-size:24px;}</code>', 'byobagn' )
			)
		);
	}

	public function custom_text_area_media_queries() {
		return array(
			'mq_custom_p'           => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Custom Text Area Font Size', 'byobagn' ),
				'description' => __( 'Use numerals only', 'byobagn' )
			),
			'mq_custom_page_titles' => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Custom Text Area Headings', 'byobagn' ),
				'description' => __( 'Use numerals only', 'byobagn' )
			),
			'mq_custom_h2'          => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Custom Text Area Subeadings', 'byobagn' ),
				'description' => __( 'Use numerals only', 'byobagn' )
			),
			'mq_custom_h3'          => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Custom Text Area Sub Subeadings', 'byobagn' ),
				'description' => __( 'Use numerals only', 'byobagn' )
			)
		);
	}

	public function blockquotes() {
		$fsc              = $this->font_size_color();
		$fonts            = $this->fonts();
		$margin           = $this->margin_full();
		$padding          = $this->padding_full();
		$background_color = $this->background_color();
		$border           = $this->border();

		return array_merge( $fsc, $fonts, $margin, $padding, $background_color, $border );
	}

	public function lists() {
		global $thesis;

		return array(
			'list-style-type'     => array(
				'type'       => 'select',
				'label'      => __( 'List Style', 'byobagn' ),
				'options'    => array(
					''                     => __( 'default', 'byobagn' ),
					'circle'               => __( 'circle', 'thesis' ),
					'decimal'              => __( 'decimal', 'thesis' ),
					'decimal-leading-zero' => __( 'decimal with leading zero', 'thesis' ),
					'disc'                 => __( 'disc', 'thesis' ),
					'lower-alpha'          => __( 'lower alpha', 'thesis' ),
					'lower-roman'          => __( 'lower Roman', 'thesis' ),
					'none'                 => __( 'none', 'byobagn' ),
					'square'               => __( 'square', 'thesis' ),
					'upper-alpha'          => __( 'upper alpha', 'thesis' ),
					'upper-roman'          => __( 'upper Roman', 'thesis' ),
					'icon'                 => __( 'Font Awesome Icon', 'byobagn' )
				),
				'dependents' => array( 'icon' )
			),
			'icon'                => array(
				'type'    => 'select',
				'label'   => __( 'Select a commonly used icon', 'byobagn' ),
				'tooltip' => __( 'Select the icon you want displayed from the dropdown list.', 'byobagn' ),
				'options' => array(
					''     => __( 'Select an Icon', 'byobagn' ),
					'f105' => 'Single Angle',
					'f101' => 'Double Angle',
					'f0a9' => 'Arrow - Circle',
					'f061' => 'Arrow',
					'f0da' => 'Caret',
					'f054' => 'Single Chevron',
					'f138' => 'Couble Chevron',
					'f0a4' => 'Finger Point',
					'f087' => 'Thumbs Up!',
					'f067' => 'Plus',
					'f128' => 'Question Mark',
					'f069' => 'Asterisk',
					'f00c' => 'Check Mark',
					'f058' => 'Check Mark - Circle',
					'f14a' => 'Check Mark - Square',
					'f0a3' => 'Certificate',
					'f013' => 'Cog'
				),
				'default' => '',
				'parent'  => array(
					'list-style-type' => 'icon'
				)
			),
			'more_icons'          => array(
				'type'       => 'checkbox',
				'options'    => array(
					'on' => __( 'Other Icons', 'thesis' )
				),
				'dependents' => array( 'on' ),
				'parent'     => array(
					'list-style-type' => 'icon'
				)
			),
			'custom_icon'         => array(
				'type'        => 'text',
				'width'       => 'medium',
				'code'        => true,
				'label'       => __( 'Custom Icon Unicode - e.g. <code>f00c</code>', 'byobagn' ),
				'tooltip'     => __( 'Enter the code for the icon you want displayed.  You can find all of the icons at <a href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a>', 'byobagn' ),
				'placeholder' => __( 'f00c', 'byobagn' ),
				'parent'      => array(
					'more_icons' => 'on'
				)
			),
			'list-style-position' => array(
				'type'    => 'select',
				'label'   => __( 'Bullet Position', 'byobagn' ),
				'options' => array(
					''       => __( 'outside (default)', 'thesis' ),
					'inside' => __( 'inside', 'thesis' )
				)
			),
			'list-indent'         => array(
				'type'       => 'checkbox',
				'options'    => array(
					'on' => __( 'Indent list (add left margin)', 'thesis' )
				),
				'dependents' => array( 'on' )
			),
			'indent_size'         => array(
				'type'    => 'text',
				'width'   => 'short',
				'code'    => true,
				'label'   => __( 'Indent Width', 'byobagn' ),
				'tooltip' => __( 'Enter the width of the ledt indent you wish to use.  You can use any CSS unit (px, em, % et)', 'byobagn' ),
				'parent'  => array(
					'list-indent' => 'on'
				)
			),
			'list-item-margin'    => array(
				'type'    => 'select',
				'label'   => __( 'List item spacing', 'byobagn' ),
				'options' => array(
					''       => __( 'No spacing', 'byobagn' ),
					'half'   => __( 'Half spacing', 'byobagn' ),
					'single' => __( 'Single spacing', 'byobagn' ),
				)
			)
		);
	}

	public function line_height() {
		$line_height = array(
			'line-height' => array(
				'type'        => 'text',
				'width'       => 'tiny',
				'label'       => __( 'Line Height', 'byobagn' ),
				'description' => 'Use this to over ride default settings'
			)
		);

		return $line_height;
	}

	public function main_navigation() {
		$nav['center_menu'] = array(
			'type'    => 'checkbox',
			'label'   => __( 'Center the Main Menu', 'byobagn' ),
			'options' => array(
				'center' => __( 'Check to center the menu', 'byobagn' ),
			)
		);

		return array_merge( $nav, $this->navigation() );
	}

	public function navigation() {
		global $thesis;

		$nav['customize_colors']              = array(
			'type'       => 'checkbox',
			'label'      => __( 'Show Menu Color options', 'byobagn' ),
			'options'    => array(
				'show' => __( 'Check to show the color options', 'byobagn' ),
			),
			'dependents' => array( 'show' )
		);
		$nav['link_text_skin_color']          = array(
			'type'    => 'select',
			'label'   => __( 'Link Text - <span class="note">choose an existing skin color for the link text</span>', 'byobagn' ),
			'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
			'options' => $this->color_options(),
			'parent'  => array(
				'customize_colors' => 'show'
			)
		);
		$nav['link_text_color']               = array(
			'type'   => 'color',
			'label'  => __( 'Link Text Color - <span class="note">or choose your own color</span>', 'byobagn' ),
			'parent' => array(
				'customize_colors' => 'show'
			)
		);
		$nav['link_background_skin_color']    = array(
			'type'    => 'select',
			'label'   => __( 'Link Background -  <span class="note">choose an existing skin color for the link background</span>', 'byobagn' ),
			'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
			'options' => $this->color_options(),
			'parent'  => array(
				'customize_colors' => 'show'
			)
		);
		$nav['link_background_color']         = array(
			'type'   => 'color',
			'label'  => __( 'Link Custom Background Color - <span class="note">or choose your own color</span>', 'byobagn' ),
			'parent' => array(
				'customize_colors' => 'show'
			)
		);
		$nav['link_background_opacity']       = array(
			'type'        => 'text',
			'width'       => 'short',
			'label'       => __( 'Link Background Color Opacity', 'byobagn' ),
			'tooltip'     => __( 'The value should be less than 1 - in decimal format', 'byobagn' ),
			'placeholder' => __( '0.9 - 0.1', 'byobagn' ),
			'parent'      => array(
				'customize_colors' => 'show'
			)
		);
		$nav['hover_text_skin_color']         = array(
			'type'    => 'select',
			'label'   => __( 'Hover Text - <span class="note">choose an existing skin color for the hover text</span>', 'byobagn' ),
			'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
			'options' => $this->color_options(),
			'parent'  => array(
				'customize_colors' => 'show'
			)
		);
		$nav['hover_text_color']              = array(
			'type'   => 'color',
			'label'  => __( 'Hover Text Color - <span class="note">or choose your own color</span>', 'byobagn' ),
			'parent' => array(
				'customize_colors' => 'show'
			)
		);
		$nav['hover_background_skin_color']   = array(
			'type'    => 'select',
			'label'   => __( 'Hover Background - <span class="note">choose an existing skin color for the hover background</span>', 'byobagn' ),
			'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
			'options' => $this->color_options(),
			'parent'  => array(
				'customize_colors' => 'show'
			)
		);
		$nav['hover_background_color']        = array(
			'type'   => 'color',
			'label'  => __( 'Hover Custom Background Color - <span class="note">or choose your own color</span>', 'byobagn' ),
			'parent' => array(
				'customize_colors' => 'show'
			)
		);
		$nav['hover_background_opacity']      = array(
			'type'        => 'text',
			'width'       => 'short',
			'label'       => __( 'Hover Background Color Opacity', 'byobagn' ),
			'tooltip'     => __( 'The value should be less than 1 - in decimal format', 'byobagn' ),
			'placeholder' => __( '0.9 - 0.1', 'byobagn' ),
			'parent'      => array(
				'customize_colors' => 'show'
			)
		);
		$nav['current_text_skin_color']       = array(
			'type'    => 'select',
			'label'   => __( 'Current Text - <span class="note">choose an existing skin color for the current text</span>', 'byobagn' ),
			'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
			'options' => $this->color_options(),
			'parent'  => array(
				'customize_colors' => 'show'
			)
		);
		$nav['current_text_color']            = array(
			'type'   => 'color',
			'label'  => __( 'Current Text Color - <span class="note">or choose your own color</span>', 'byobagn' ),
			'parent' => array(
				'customize_colors' => 'show'
			)
		);
		$nav['current_background_skin_color'] = array(
			'type'    => 'select',
			'label'   => __( 'Current Background - <span class="note">choose an existing skin color for the current background</span>', 'byobagn' ),
			'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
			'options' => $this->color_options(),
			'parent'  => array(
				'customize_colors' => 'show'
			)
		);
		$nav['current_background_color']      = array(
			'type'   => 'color',
			'label'  => __( 'Current Custom Background Color', 'byobagn' ),
			'parent' => array(
				'customize_colors' => 'show'
			)
		);
		$nav['current_background_opacity']    = array(
			'type'        => 'text',
			'width'       => 'short',
			'label'       => __( 'Current Background Color Opacity', 'byobagn' ),
			'tooltip'     => __( 'The value should be less than 1 - in decimal format', 'byobagn' ),
			'placeholder' => __( '0.9 - 0.1', 'byobagn' ),
			'parent'      => array(
				'customize_colors' => 'show'
			)
		);

		$nav['submenu_width']    = array(
			'type'        => 'text',
			'width'       => 'tiny',
			'label'       => __( 'Submenu Width', 'byobagn' ),
			'placeholder' => '150'
		);
		$nav['link_decoration']  = array(
			'type'    => 'select',
			'label'   => __( 'Menu Link Decoration', 'byobagn' ),
			'options' => $thesis->api->css->properties['text-decoration']
		);
		$nav['hover_decoration'] = array(
			'type'    => 'select',
			'label'   => __( 'Menu Hover Decoration', 'byobagn' ),
			'options' => $thesis->api->css->properties['text-decoration']
		);
		$nav['padding']          = $thesis->api->css->options['padding'];
		$nav['padding']['label'] = __( 'Menu Item Padding', 'byobagn' );

		$fsc   = $this->font_size_color();
		$fonts = $this->fonts();
		unset( $fonts['line-height'] );
		unset( $fsc['color'] );
		unset( $fsc['skin_color'] );

		return array_merge( $nav, $fsc, $fonts );
	}

	public function menu_supplement() {
		$image  = $this->background_image();
		$border = $this->border();

		return array_merge( $image, $border );
	}

	public function menu_link_supplement() {
		$applies_to = array(
			'applies_to' => array(
				'type'    => 'select',
				'label'   => __( 'Choose the menu this style applies to', 'byobagn' ),
				'options' => array(
					''                  => 'Main menu',
					'header_menu'       => 'Header menu',
					'supplemental_menu' => 'Supplemental menu'
				)
			)
		);
		$image      = $this->background_image();
		$width      = array(
			'width' => array(
				'type'  => 'text',
				'width' => 'tiny',
				'label' => __( 'Menu Item Width', 'byobagn' )
			)
		);
		$margin     = $this->margin_h();
		$border     = $this->border();

		return array_merge( $applies_to, $image, $width, $margin, $border );
	}

	public function submenu_supplement() {
		$image  = $this->background_image();
		$border = $this->border();

		unset( $border['border-radius'] );

		return array_merge( $image, $border );
	}

	public function submenu_link_supplement() {
		$applies_to = array(
			'applies_to' => array(
				'type'    => 'select',
				'label'   => __( 'Choose the menu this style applies to', 'byobagn' ),
				'options' => array(
					''                     => 'Main menu',
					'header_submenu'       => 'Header menu',
					'supplemental_submenu' => 'Supplemental menu'
				)
			)
		);
		$image      = $this->background_image();
		$margin     = $this->margin_h();
		$border     = $this->border();

		unset( $border['border-radius'] );

		return array_merge( $applies_to, $image, $margin, $border );
	}

	public function submit() {
		$fsc = $this->font_size_color();
		unset( $fsc['color'] );
		unset( $fsc['skin_color'] );
		$line_height = $this->line_height();
		$submit      = $this->navigation();
		unset( $submit['current_text_color'] );
		unset( $submit['current_text_skin_color'] );
		unset( $submit['current_background_color'] );
		unset( $submit['current_background_skin_color'] );
		unset( $submit['current_background_opacity'] );
		unset( $submit['submenu_width'] );
		unset( $submit['link_decoration'] );
		unset( $submit['hover_decoration'] );
		$submit['padding']['label']          = __( 'Submit Button Padding', 'byobagn' );
		$submit['customize_colors']['label'] = __( 'Show Submit Button Color options', 'byobagn' );
		$submit['display']                   = array(
			'type'    => 'select',
			'label'   => __( 'Display Property', 'byobagn' ),
			'options' => array(
				''             => 'default',
				'block'        => __( 'block', 'byobagn' ),
				'inline'       => __( 'inline', 'byobagn' ),
				'inline-block' => __( 'inline block', 'byobagn' ),
				'table'        => __( 'table', 'byobagn' ),
				'inline-table' => __( 'inline table', 'byobagn' ),
			)
		);
		$border                              = $this->border();

		return array_merge( $fsc, $line_height, $submit, $border );
	}

	public function color() {
		return array(
			'skin_color' => array(
				'type'    => 'select',
				'label'   => __( 'Choose an existing skin color', 'byobagn' ),
				'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
				'options' => $this->color_options()
			),
			'color'      => array(
				'type'  => 'color',
				'label' => __( 'Or enter your own color', 'byobagn' )
			)
		);
	}

	public function color_options() {
		$names = $this->color_names();

		return array(
			''                     => __( 'Select a skin color from this list', 'byobagn' ),
			'c_bg_dark'            => $names['swatch_1'],
			'c_bg_med_dark'        => $names['swatch_2'],
			'c_bg_med'             => $names['swatch_3'],
			'c_bg_light'           => $names['swatch_4'],
			'c_bg_very_light'      => $names['swatch_5'],
			'c_cont_bg_dark'       => $names['swatch_6'],
			'c_cont_bg_med_dark'   => $names['swatch_7'],
			'c_cont_bg_med'        => $names['swatch_8'],
			'c_cont_bg_light'      => $names['swatch_9'],
			'c_cont_bg_very_light' => $names['swatch_10'],
			'cg_black'             => __( 'Grayscale - Black', 'byobagn' ),
			'cg_darkest'           => __( 'Grayscale - Darkest', 'byobagn' ),
			'cg_very_dark'         => __( 'Grayscale - Very Dark', 'byobagn' ),
			'cg_dark'              => __( 'Grayscale - Dark', 'byobagn' ),
			'cg_med_dark'          => __( 'Grayscale - Medium Dark', 'byobagn' ),
			'cg_med'               => __( 'Grayscale - Medium', 'byobagn' ),
			'cg_med_light'         => __( 'Grayscale - Medium Light', 'byobagn' ),
			'cg_light'             => __( 'Grayscale - Light', 'byobagn' ),
			'cg_very_light'        => __( 'Grayscale - Very Light', 'byobagn' ),
			'cg_ligtest'           => __( 'Grayscale - Lightest', 'byobagn' ),
			'cg_white'             => __( 'Grayscale - White', 'byobagn' ),
		);
	}

	public function color_names() {
		$names['swatch_1']  = ! empty( $this->design['skin_color_names']['swatch_1'] ) ? $this->design['skin_color_names']['swatch_1'] : 'Dark Primary';
		$names['swatch_2']  = ! empty( $this->design['skin_color_names']['swatch_2'] ) ? $this->design['skin_color_names']['swatch_2'] : 'Medium Dark Primary';
		$names['swatch_3']  = ! empty( $this->design['skin_color_names']['swatch_3'] ) ? $this->design['skin_color_names']['swatch_3'] : 'Medium Primary';
		$names['swatch_4']  = ! empty( $this->design['skin_color_names']['swatch_4'] ) ? $this->design['skin_color_names']['swatch_4'] : 'Light Primary';
		$names['swatch_5']  = ! empty( $this->design['skin_color_names']['swatch_5'] ) ? $this->design['skin_color_names']['swatch_5'] : 'Very Light Primary';
		$names['swatch_6']  = ! empty( $this->design['skin_color_names']['swatch_6'] ) ? $this->design['skin_color_names']['swatch_6'] : 'Dark Contrast';
		$names['swatch_7']  = ! empty( $this->design['skin_color_names']['swatch_7'] ) ? $this->design['skin_color_names']['swatch_7'] : 'Medium Dark Contrast';
		$names['swatch_8']  = ! empty( $this->design['skin_color_names']['swatch_8'] ) ? $this->design['skin_color_names']['swatch_8'] : 'Medium Contrast';
		$names['swatch_9']  = ! empty( $this->design['skin_color_names']['swatch_9'] ) ? $this->design['skin_color_names']['swatch_9'] : 'Light Contrast';
		$names['swatch_10'] = ! empty( $this->design['skin_color_names']['swatch_10'] ) ? $this->design['skin_color_names']['swatch_10'] : 'Very Light Contrast';

		return $names;
	}

	public function skin_color_names() {
		return array(
			'swatch_1'  => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 1 - counting from the left', 'byobagn' ),
				'size'        => 'medium',
				'tooltip'     => __( 'You can customize the names of the skin colors so that they show up in options as you want them', 'byobagn' ),
				'placeholder' => __( 'Dark Primary', 'byobagn' )
			),
			'swatch_2'  => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 2', 'byobagn' ),
				'size'        => 'medium',
				'placeholder' => __( 'Medium Dark Primary', 'byobagn' )
			),
			'swatch_3'  => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 3', 'byobagn' ),
				'size'        => 'medium',
				'placeholder' => __( 'Medium Primary', 'byobagn' )
			),
			'swatch_4'  => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 4', 'byobagn' ),
				'size'        => 'medium',
				'placeholder' => __( 'Light Primary', 'byobagn' )
			),
			'swatch_5'  => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 5', 'byobagn' ),
				'size'        => 'medium',
				'placeholder' => __( 'Very Light Primary', 'byobagn' )
			),
			'swatch_6'  => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 6', 'byobagn' ),
				'size'        => 'medium',
				'placeholder' => __( 'Dark Contrast', 'byobagn' )
			),
			'swatch_7'  => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 7', 'byobagn' ),
				'size'        => 'medium',
				'placeholder' => __( 'Medium Dark Contrast', 'byobagn' )
			),
			'swatch_8'  => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 8', 'byobagn' ),
				'size'        => 'medium',
				'placeholder' => __( 'Medium Contrast', 'byobagn' )
			),
			'swatch_9'  => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 9', 'byobagn' ),
				'size'        => 'medium',
				'placeholder' => __( 'Light Contrast', 'byobagn' )
			),
			'swatch_10' => array(
				'type'        => 'text',
				'label'       => __( 'Custom name for Swatch 10', 'byobagn' ),
				'size'        => 'medium',
				'placeholder' => __( 'Very Light Contrast', 'byobagn' )
			)
		);
	}

	public function background_color() {
		$background = array(
			'customize_backgrpound_color' => array(
				'type'       => 'checkbox',
				'label'      => __( 'Customize background color', 'byobagn' ),
				'options'    => array(
					'show_color' => __( 'Check to show background color options', 'byobagn' ),
				),
				'dependents' => array( 'show_color' )
			),
			'background_skin_color'       => array(
				'type'    => 'select',
				'label'   => __( 'Choose an existing skin color for the background', 'byobagn' ),
				'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
				'options' => $this->color_options(),
				'parent'  => array(
					'customize_backgrpound_color' => 'show_color'
				)
			),
			'background-color'            => array(
				'type'   => 'color',
				'label'  => __( 'Or choose your own background color', 'byobagn' ),
				'parent' => array(
					'customize_backgrpound_color' => 'show_color'
				)
			),
			'opacity'                     => array(
				'type'        => 'text',
				'width'       => 'short',
				'label'       => __( 'Background Color Opacity', 'byobagn' ),
				'tooltip'     => __( 'The value should be less than 1 - in decimal format', 'byobagn' ),
				'placeholder' => __( '0.9 - 0.1', 'byobagn' ),
				'parent'      => array(
					'customize_backgrpound_color' => 'show_color'
				)
			)
		);

		return $background;
	}

	public function background_image() {
		$select     = array();
		$files      = array(
			'batthern.png'                 => 'Batthern - dark',
			'beige_paper.png'              => 'Beige Paper - dark',
			'black-lozenge.png'            => 'Black Lozenge',
			'bright_squares.png'           => 'Bright Squares - dark',
			'checkered-pattern.png'        => 'Checkered Pattern',
			'diamonds.png'                 => 'Diamonds - dark',
			'dimension.png'                => 'Dimension',
			'fake-luxury.png'              => 'Fake Luxury',
			'gold-scale.png'               => 'Gold Scale',
			'gold_scale.png'               => 'Gold Scale - dark',
			'graphy.png'                   => 'Graphy',
			'graphy-dark.png'              => 'Graphy - dark',
			'gridme.png'                   => 'Grid Me',
			'honeycomb-dark.png'           => 'Honeycomb - dark',
			'inflicted.png'                => 'Inflicted',
			'kuji.png'                     => 'Kuji',
			'light_checkered_tiles.png'    => 'Light Checkered Tiles - dark',
			'light_grey_floral_motif.png'  => 'Light Grey Floral Motif',
			'low-contrast-linen.png'       => 'Low Contrast Linen',
			'my-little-plaid-dark.png'     => 'My Little Plaid - dark',
			'nami.png'                     => 'Nami',
			'office-background-1.jpg'      => 'Office - Devices',
			'office-background-2.jpg'      => 'Office - Generic',
			'office-background-3.jpg'      => 'Office - Laptop/Window',
			'old_mathematics.png'          => 'Old Mathematics',
			'random-grey-variations.png'   => 'Random Grey Variations',
			'rocky-wall.png'               => 'Rocky Wall',
			'simple-dashed.png'            => 'Simple Dashed',
			'squared-metal.png'            => 'Squared Metal',
			'transparent-square-tiles.png' => 'Transparent Square Tiles',
			'vertical-cloth.png'           => 'Vertical Cloth - dark',
			'vichy.png'                    => 'Vichy',
			'washi.png'                    => 'Washi',
			'white-diamond-dark.png'       => 'White Diamond - dark',
			'white-tiles.png'              => 'White Tiles',
			'xv.png'                       => 'XV'
		);
		$select[''] = __( 'Choose one', 'byobagn' );
		foreach ( $files as $image => $label ) {
			$select[ BYOBAGN_URL . '/images/' . $image ] = $label;
		}
		$background = array(
			'add_backgrpound_image'      => array(
				'type'       => 'checkbox',
				'label'      => __( 'Add a background image', 'byobagn' ),
				'options'    => array(
					'show_image' => __( 'Check to show background image options', 'byobagn' ),
				),
				'dependents' => array( 'show_image' )
			),
			'background-image'           => array(
				'type'   => 'text',
				'width'  => 'long',
				'code'   => true,
				'label'  => __( 'Insert a Custom Background Image', 'byobagn' ),
				'parent' => array(
					'add_backgrpound_image' => 'show_image'
				)
			),
			'skin_image'                 => array(
				'type'    => 'select',
				'label'   => __( 'or Choose a Skin Image', 'byobagn' ),
				'options' => $select,
				'parent'  => array(
					'add_backgrpound_image' => 'show_image'
				)
			),
			'background-position'        => array(
				'type'    => 'select',
				'label'   => __( 'Background Image Position', 'byobagn' ),
				'options' => array(
					''              => 'left top',
					'left center'   => 'left center',
					'left bottom'   => 'left bottom',
					'right top'     => 'right top',
					'right center'  => 'right center',
					'right bottom'  => 'right bottom',
					'center top'    => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom',
				),
				'parent'  => array(
					'add_backgrpound_image' => 'show_image'
				)
			),
			'background-position-custom' => array(
				'type'   => 'text',
				'width'  => 'short',
				'label'  => __( 'Custom Background Image Position', 'byobagn' ),
				'parent' => array(
					'add_backgrpound_image' => 'show_image'
				)
			),
			'background-attachment'      => array(
				'type'    => 'select',
				'label'   => __( 'Background Image Attachment', 'byobagn' ),
				'options' => array(
					false    => __( 'default', 'byobagn' ),
					'scroll' => __( 'scrolls with page', 'byobagn' ),
					'fixed'  => __( 'fixed&#8212;does not scroll', 'byobagn' )
				),
				'parent'  => array(
					'add_backgrpound_image' => 'show_image'
				)
			),
			'background-repeat'          => array(
				'type'    => 'select',
				'label'   => __( 'Background Image Repeat', 'byobagn' ),
				'options' => array(
					false       => __( 'repeat', 'byobagn' ),
					'no-repeat' => __( 'no repeat', 'byobagn' ),
					'repeat-x'  => __( 'repeat-x', 'byobagn' ),
					'repeat-y'  => __( 'repeat-y', 'byobagn' )
				),
				'parent'  => array(
					'add_backgrpound_image' => 'show_image'
				)
			)
		);

		return $background;
	}

	public function icon_styles() {
		$icon_color                        = $this->color();
		$icon_color['skin_color']['label'] = __( 'Icon Color - Choose an existing skin color', 'byobagn' );
		$icon_color['color']['label']      = __( 'Icon Color - Or enter your own color', 'byobagn' );
		$color                             = $this->background_color();
		$image                             = $this->background_image();
		$border                            = $this->border();
		$padding                           = $this->padding_full();
		$margin                            = $this->margin_full();

		return array_merge( $icon_color, $color, $image, $border, $padding, $margin );
	}

	public function social_icon_styles() {
		$icon = $this->font_size_color();
		unset( $icon['font-family'] );
		$color   = $this->background_color();
		$border  = $this->border();
		$padding = $this->padding_full();
		$margin  = $this->margin_full();

		return array_merge( $icon, $color, $border, $padding, $margin );
	}

	public function simple_background() {
		$color = $this->background_color();
		$image = $this->background_image();

		return array_merge( $color, $image );
	}

	public function area_background() {
		$color   = $this->background_color();
		$image   = $this->background_image();
		$padding = $this->padding_v();
		$margin  = $this->margin_v();
		$border  = $this->border();

		return array_merge( $color, $image, $padding, $margin, $border );
	}

	public function page_background() {
		$color   = $this->background_color();
		$image   = $this->background_image();
		$padding = $this->padding_full();
		$margin  = $this->margin_v();
		$border  = $this->border();

		return array_merge( $color, $image, $padding, $margin, $border );
	}

	public function text_area_background() {
		$color   = $this->background_color();
		$image   = $this->background_image();
		$padding = $this->padding_full();
		$margin  = $this->margin_full();
		$border  = $this->border();

		return array_merge( $color, $image, $padding, $margin, $border );
	}

	public function full_background() {
		$color   = $this->background_color();
		$image   = $this->background_image();
		$padding = $this->padding_full();
		$margin  = $this->margin_full();
		$border  = $this->border();
		$height  = array(
			'height' => array(
				'type'  => 'text',
				'width' => 'tiny',
				'label' => __( 'Fixed height for this area', 'byobagn' )
			)
		);

		return array_merge( $color, $image, $height, $padding, $margin, $border );
	}

	public function cta_background() {
		$color   = $this->background_color();
		$image   = $this->background_image();
		$padding = $this->padding_full();
		$margin  = $this->margin_full();
		$border  = $this->border();
		$height  = array(
			'height' => array(
				'type'  => 'text',
				'width' => 'tiny',
				'label' => __( 'Fixed height for this area', 'byobagn' )
			)
		);
		$applies = array(
			'apply_to' => array(
				'type'    => 'checkbox',
				'label'   => __( 'Apply this style to the Content Area call to action ', 'byobagn' ),
				'options' => array(
					'apply_to_content' => __( 'Check to apply to Content Area call to action', 'byobagn' ),
				)
			)
		);

		return array_merge( $applies, $color, $image, $height, $padding, $margin, $border );
	}

	public function border() {
		global $thesis;
		$border = array(
			'add_border'           => array(
				'type'       => 'checkbox',
				'label'      => __( 'Add a border', 'byobagn' ),
				'options'    => array(
					'show_border' => __( 'Check to show border style options', 'byobagn' ),
				),
				'dependents' => array( 'show_border' )
			),
			'border-style'         => array(
				'type'    => 'select',
				'label'   => __( 'Border Style', 'byobagn' ),
				'options' => $thesis->api->css->properties['border-style'],
				'parent'  => array(
					'add_border' => 'show_border'
				)
			),
			'border-width'         => array(
				'type'   => 'text',
				'width'  => 'short',
				'label'  => __( 'Border Width', 'byobagn' ),
				'parent' => array(
					'add_border' => 'show_border'
				)
			),
			'skin_border_color'    => array(
				'type'    => 'select',
				'label'   => __( 'Choose an existing skin color for the border', 'byobagn' ),
				'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
				'options' => $this->color_options(),
				'parent'  => array(
					'add_border' => 'show_border'
				)
			),
			'border-color'         => array(
				'type'   => 'color',
				'label'  => __( 'Border Color', 'byobagn' ),
				'parent' => array(
					'add_border' => 'show_border'
				)
			),
			'border-radius'        => array(
				'type'   => 'text',
				'width'  => 'short',
				'label'  => __( 'Border Radius', 'byobagn' ),
				'parent' => array(
					'add_border' => 'show_border'
				)
			),
			'skin_shadow_color'    => array(
				'type'    => 'select',
				'label'   => __( 'Choose an existing skin color for the drop shadow', 'byobagn' ),
				'tooltip' => __( 'Choose one of the existing skin colors or set a color below', 'byobagn' ),
				'options' => $this->color_options(),
				'parent'  => array(
					'add_border' => 'show_border'
				)
			),
			'shadow-color'         => array(
				'type'   => 'color',
				'label'  => __( 'Drop Shadow Color', 'byobagn' ),
				'parent' => array(
					'add_border' => 'show_border'
				)
			),
			'shadow-offsets'       => array(
				'type'        => 'text',
				'width'       => 'short',
				'label'       => __( 'Drop Shadow Offsets & Blur', 'byobagn' ),
				'parent'      => array(
					'add_border' => 'show_border'
				),
				'placeholder' => '3px 3px 3px'
			),
			'shadow_color_opacity' => array(
				'type'        => 'text',
				'width'       => 'short',
				'label'       => __( 'Shadow Color Opacity', 'byobagn' ),
				'tooltip'     => __( 'The value should be less than 1 - in decimal format', 'byobagn' ),
				'placeholder' => __( '0.9 - 0.1', 'byobagn' ),
				'parent'      => array(
					'add_border' => 'show_border'
				)
			)
		);

		return $border;
	}

	public function text_align() {
		global $thesis;

		return array(
			'text-align' => array(
				'type'    => 'select',
				'label'   => __( 'Content Alignment', 'byobagn' ),
				'options' => $thesis->api->css->properties['text-align']
			)
		);
	}

	public function header() {
		$line    = array(
			'zero_line_height' => array(
				'type'    => 'checkbox',
				'label'   => __( 'Make Line Height Zero', 'byobagn' ),
				'options' => array(
					'zero_line_height' => __( 'Check to make the line height 0px', 'byobagn' ),
				)
			)
		);
		$line    = array(
			'zero_widget_margin' => array(
				'type'    => 'checkbox',
				'label'   => __( 'Remove the bottom margin from widgets inthis column', 'byobagn' ),
				'options' => array(
					'zero_widget_margin' => __( 'Check to make widget bottom margin 0px', 'byobagn' ),
				)
			)
		);
		$padding = $this->padding_full();
		$align   = $this->text_align();

		return array_merge( $line, $padding, $align );
	}

	public function padding_full() {
		return array(
			'customize_padding' => array(
				'type'       => 'checkbox',
				'label'      => __( 'Customize the padding', 'byobagn' ),
				'options'    => array(
					'show_padding' => __( 'Check to show padding options', 'byobagn' ),
				),
				'dependents' => array( 'show_padding' )
			),
			'padding-top'       => array(
				'type'   => 'text',
				'width'  => 'tiny',
				'label'  => __( 'Top Padding', 'byobagn' ),
				'parent' => array(
					'customize_padding' => 'show_padding'
				)
			),
			'padding-bottom'    => array(
				'type'   => 'text',
				'width'  => 'tiny',
				'label'  => __( 'Bottom Padding', 'byobagn' ),
				'parent' => array(
					'customize_padding' => 'show_padding'
				)
			),
			'padding-left'      => array(
				'type'   => 'text',
				'width'  => 'tiny',
				'label'  => __( 'Left Padding', 'byobagn' ),
				'parent' => array(
					'customize_padding' => 'show_padding'
				)
			),
			'padding-right'     => array(
				'type'   => 'text',
				'width'  => 'tiny',
				'label'  => __( 'Right Padding', 'byobagn' ),
				'parent' => array(
					'customize_padding' => 'show_padding'
				)
			)
		);
	}

	public function padding_h() {

		$padding = $this->padding_full();
		unset( $padding['padding-top'] );
		unset( $padding['padding-bottom'] );

		return $padding;
	}

	public function padding_v() {

		$padding = $this->padding_full();
		unset( $padding['padding-left'] );
		unset( $padding['padding-right'] );

		return $padding;
	}

	public function margin_full() {
		return array(
			'customize_margin' => array(
				'type'       => 'checkbox',
				'label'      => __( 'Customize the margin', 'byobagn' ),
				'options'    => array(
					'show_margin' => __( 'Check to show margin options', 'byobagn' ),
				),
				'dependents' => array( 'show_margin' )
			),
			'margin-top'       => array(
				'type'   => 'text',
				'width'  => 'tiny',
				'label'  => __( 'Top Margin', 'byobagn' ),
				'parent' => array(
					'customize_margin' => 'show_margin'
				)
			),
			'margin-bottom'    => array(
				'type'   => 'text',
				'width'  => 'tiny',
				'label'  => __( 'Bottom Margin', 'byobagn' ),
				'parent' => array(
					'customize_margin' => 'show_margin'
				)
			),
			'margin-left'      => array(
				'type'   => 'text',
				'width'  => 'tiny',
				'label'  => __( 'Left Margin', 'byobagn' ),
				'parent' => array(
					'customize_margin' => 'show_margin'
				)
			),
			'margin-right'     => array(
				'type'   => 'text',
				'width'  => 'tiny',
				'label'  => __( 'Right Margin', 'byobagn' ),
				'parent' => array(
					'customize_margin' => 'show_margin'
				)
			)
		);
	}

	public function margin_h() {

		$margin = $this->margin_full();
		unset( $margin['margin-top'] );
		unset( $margin['margin-bottom'] );

		return $margin;
	}

	public function margin_v() {

		$margin = $this->margin_full();
		unset( $margin['margin-left'] );
		unset( $margin['margin-right'] );

		return $margin;
	}

	public function remove_margin() {
		$remove_margin = array(
			'remove_margin' => array(
				'type'    => 'checkbox',
				'options' => array(
					'remove' => __( 'Remove bottom margin from <code>paragraph</code> tags', 'byobagn' ),
				),
				'default' => false
			)
		);

		return $remove_margin;
	}

	public function paddingh_marginv() {
		$padding = $this->padding_h();
		$margin  = $this->margin_v();

		return array_merge( $padding, $margin );
	}

	public function width() {
		return array(
			'width' => array(
				'type'  => 'text',
				'width' => 'tiny',
				'label' => __( 'Item width', 'byobagn' )
			)
		);
	}

	public function height() {
		return array(
			'height' => array(
				'type'  => 'text',
				'width' => 'tiny',
				'label' => __( 'Item height', 'byobagn' )
			)
		);
	}

	public function vertical_align() {
		return array(
			'vertical-align' => array(
				'type'    => 'select',
				'label'   => __( 'Vertical Alignment', 'byobagn' ),
				'options' => array(
					''            => __( 'Default (baseline)', 'byobagn' ),
					'top'         => __( 'Top', 'byobagn' ),
					'text-top'    => __( 'Text Top', 'byobagn' ),
					'middle'      => __( 'Middle', 'byobagn' ),
					'bottom'      => __( 'Bottom', 'byobagn' ),
					'text-bottom' => __( 'Text Bottom', 'byobagn' ),
					'sub'         => __( 'Sub', 'byobagn' ),
					'super'       => __( 'Super', 'byobagn' )
				)
			)
		);
	}

}
