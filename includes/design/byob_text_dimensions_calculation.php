<?php

/**
 * Description of byob_fonts_calculation
 *
 * @author Rick
 */
class byob_text_dimensions_calculation {

	public $phi;
	public $test;
	public $primary_font_size = 16;
	public $primary_font_family = 'arial';
	public $heading_font_family = 'arial';
	public $desktop_width = 1032;
	public $content_width = 'two-thirds';
	public $spacing_constant = false;
	public $design = array();
	public $column_fonts = array(// an array of font sizes and column widths by desktop width
		1920 => array(
			'full'           => array(
				'font_size'    => 30,
				'column_width' => 1836
			),
			'three-quarters' => array(
				'font_size'    => 28,
				'column_width' => 1360
			),
			'two-thirds'     => array(
				'font_size'    => 24,
				'column_width' => 1210
			),
			'half'           => array(
				'font_size'    => 20,
				'column_width' => 907
			),
			'one-third'      => array(
				'font_size'    => 17,
				'column_width' => 605
			),
			'one-quarter'    => array(
				'font_size'    => 16,
				'column_width' => 455
			)
		),
		1280 => array(
			'full'           => array(
				'font_size'    => 24,
				'column_width' => 1222
			),
			'three-quarters' => array(
				'font_size'    => 22,
				'column_width' => 906
			),
			'two-thirds'     => array(
				'font_size'    => 18,
				'column_width' => 806
			),
			'half'           => array(
				'font_size'    => 16,
				'column_width' => 604
			),
			'one-third'      => array(
				'font_size'    => 15,
				'column_width' => 402
			),
			'one-quarter'    => array(
				'font_size'    => 15,
				'column_width' => 302
			)
		),
		1140 => array(
			'full'           => array(
				'font_size'    => 22,
				'column_width' => 1086
			),
			'three-quarters' => array(
				'font_size'    => 19,
				'column_width' => 804
			),
			'two-thirds'     => array(
				'font_size'    => 17,
				'column_width' => 715
			),
			'half'           => array(
				'font_size'    => 16,
				'column_width' => 536
			),
			'one-third'      => array(
				'font_size'    => 15,
				'column_width' => 357
			),
			'one-quarter'    => array(
				'font_size'    => 15,
				'column_width' => 268
			)
		),
		1032 => array(
			'full'           => array(
				'font_size'    => 19,
				'column_width' => 980
			),
			'three-quarters' => array(
				'font_size'    => 16,
				'column_width' => 725
			),
			'two-thirds'     => array(
				'font_size'    => 16,
				'column_width' => 640
			),
			'half'           => array(
				'font_size'    => 16,
				'column_width' => 485
			),
			'one-third'      => array(
				'font_size'    => 15,
				'column_width' => 320
			),
			'one-quarter'    => array(
				'font_size'    => 15,
				'column_width' => 232
			)
		),
		1024 => array(
			'full'           => array(
				'font_size'    => 19,
				'column_width' => 980
			),
			'three-quarters' => array(
				'font_size'    => 16,
				'column_width' => 725
			),
			'two-thirds'     => array(
				'font_size'    => 16,
				'column_width' => 640
			),
			'half'           => array(
				'font_size'    => 16,
				'column_width' => 485
			),
			'one-third'      => array(
				'font_size'    => 15,
				'column_width' => 320
			),
			'one-quarter'    => array(
				'font_size'    => 15,
				'column_width' => 232
			)
		),
		960  => array(
			'full'           => array(
				'font_size'    => 18,
				'column_width' => 908
			),
			'three-quarters' => array(
				'font_size'    => 16,
				'column_width' => 680
			),
			'two-thirds'     => array(
				'font_size'    => 16,
				'column_width' => 600
			),
			'half'           => array(
				'font_size'    => 16,
				'column_width' => 455
			),
			'one-third'      => array(
				'font_size'    => 15,
				'column_width' => 300
			),
			'one-quarter'    => array(
				'font_size'    => 15,
				'column_width' => 225
			)
		),
		800  => array(
			'full'           => array(
				'font_size'    => 16,
				'column_width' => 748
			),
			'three-quarters' => array(
				'font_size'    => 16,
				'column_width' => 485
			),
			'two-thirds'     => array(
				'font_size'    => 16,
				'column_width' => 415
			),
			'half'           => array(
				'font_size'    => 16,
				'column_width' => 748
			),
			'one-third'      => array(
				'font_size'    => 15,
				'column_width' => 320
			),
			'one-quarter'    => array(
				'font_size'    => 15,
				'column_width' => 250
			)
		),
		699  => array(
			'full'           => array(
				'font_size'    => 16,
				'column_width' => 650
			),
			'three-quarters' => array(
				'font_size'    => 16,
				'column_width' => 650
			),
			'two-thirds'     => array(
				'font_size'    => 16,
				'column_width' => 650
			),
			'half'           => array(
				'font_size'    => 16,
				'column_width' => 650
			),
			'one-third'      => array(
				'font_size'    => 15,
				'column_width' => 325
			),
			'one-quarter'    => array(
				'font_size'    => 15,
				'column_width' => 325
			)
		),
		415  => array(
			'full'           => array(
				'font_size'    => 16,
				'column_width' => 389
			),
			'three-quarters' => array(
				'font_size'    => 16,
				'column_width' => 389
			),
			'two-thirds'     => array(
				'font_size'    => 16,
				'column_width' => 389
			),
			'half'           => array(
				'font_size'    => 16,
				'column_width' => 389
			),
			'one-third'      => array(
				'font_size'    => 15,
				'column_width' => 389
			),
			'one-quarter'    => array(
				'font_size'    => 15,
				'column_width' => 389
			)
		)
	);

	public function __construct( $design = array() ) {
		$this->phi                 = ( 1 + sqrt( 5 ) ) / 2; // 1.618
		$this->design              = $design;
		$this->desktop_width       = ! empty( $this->design['desktop_width']['width'] ) ? $this->design['desktop_width']['width'] : 1032;
		$this->content_width       = ! empty( $this->design['content_width']['width'] ) ? $this->design['content_width']['width'] : 'two-thirds';
		$this->spacing_constant    = ! empty( $this->design['spacing_constant']['width'] ) ? $this->design['spacing_constant']['width'] : false;
		$this->primary_font_size   = ! empty( $this->design['typ_p']['font-size'] ) ? $this->design['typ_p']['font-size'] : $this->column_fonts[ $this->desktop_width ][ $this->content_width ]['font_size'];
		$this->primary_font_family = ! empty( $this->design['primary_font_family']['family'] ) ? $this->design['primary_font_family']['family'] : 'arial';
		$this->heading_font_family = ! empty( $this->design['heading_font_family']['family'] ) ? $this->design['heading_font_family']['family'] : 'arial';

		$this->set_column_fonts();
	}

	// returns an array of font sizes and line heights for each scale element in each column configuration for both headings and primary tezt
	// for a given primary font size and desktop width
	// these form the defaults based on the primary font size
	// eg - $heading['full']['f2']["font_size"]

	public function setup( $desktop_width = false ) {
		if ( ! $desktop_width ) {
			$desktop_width = $this->desktop_width;
		}

		$name = array();
		foreach ( array( 'primary', 'heading' ) as $type ) {
			$font_family = $this->primary_font_family;

			if ( $type == 'heading' ) {
				$font_family = $this->heading_font_family;
				foreach ( $this->column_fonts[ $desktop_width ] as $width => $columns ) {

					$name[ $type ][ $width ]['tags']    = $this->scale( $columns['font_size'], $desktop_width );
					$name[ $type ][ $width ]['line']    = $line = $this->height_headings( $columns['font_size'], $width, $font_family, $desktop_width );
					$name[ $type ][ $width ]['spacing'] = $this->space( $line );

					foreach ( $name[ $type ][ $width ]['tags'] as $tag => $fs ) {
						$name[ $type ][ $width ][ $tag ]['font_size']   = $fs;
						$name[ $type ][ $width ][ $tag ]['line_height'] = round( $this->height_headings( $fs, $width, $font_family, $desktop_width ) );
					}
				}
			} else {
				foreach ( $this->column_fonts[ $desktop_width ] as $width => $columns ) {

					$name[ $type ][ $width ]['tags']    = $this->scale( $columns['font_size'], $desktop_width );
					$name[ $type ][ $width ]['line']    = $line = $this->height_text( $columns['font_size'], $width, $font_family, $desktop_width );
					$name[ $type ][ $width ]['spacing'] = $this->space( $line );

					foreach ( $name[ $type ][ $width ]['tags'] as $tag => $fs ) {
						$name[ $type ][ $width ][ $tag ]['font_size']   = $fs;
						$name[ $type ][ $width ][ $tag ]['line_height'] = round( $this->height_text( $fs, $width, $font_family, $desktop_width ) );
					}
				}
			}
		}
//                update_option('byob_agility', $this->test);
//
		//retuns an array of font size and line spacing based on primary font size and desktop width
		// structue is $text-type[column configuration][scale element (f1-f8)][property - font size, line height]
		// eg - $heading['full']['f2']["font_size"]
		return $name;
	}

	public function line_height( $font_size, $font = false ) {
		$grid = aray();
		foreach ( $this->column_fonts[ $this->desktop_width ] as $width => $columns ) {
			$grid[ $width ] = $this->height_text( $columns['font_size'], $columns['column_width'], $font );
		}

		return $grid;
	}

	// calculates the appropriate line height for regular reading text (primary) based on
	// font size($size), column configuration ($width), font family ($font) and desktop width - if any
	// returns an float number
	public function height_text( $size, $width = 'two-thirds', $font = false, $desktop_width = false ) {
		global $thesis;

		// if a desktop width is passed then use it in the calculations - otherwise use the design option
		// for desktop width
		if ( ! $desktop_width ) {
			$desktop_width = $this->desktop_width;
		}

		$mu = 2.25;     // default mu if one isn't found -
		// the number of charachters that can fit in a space the width of the font size
		// in other words, give a font size of 16px, 2.25 letters can fit in 16 px of width

		$correction = 0; // default correction if one isn't needed
		$font_list  = false; // initialize the font list array to empty
		$font_list  = $thesis->api->fonts->list; // add the Thesis font list to the font list array
		// get the integer value of the column configuration.
		// This is found by looking at the $column_fonts array and selecting the width
		// from the the desktop width and column configuration
		// $column_width is an integer
		$column_width = $this->column_fonts[ $desktop_width ][ $width ]['column_width'];

		// Correction factor is for fonts with large x-heights and/or large size footprints
		if ( $font_list && $font ) {
			if ( array_key_exists( (string) $font, $font_list ) ) {
				if ( array_key_exists( 'x', $font_list[ $font ] ) ) {
					// if applicable set a correction value
					$correction = 0.5;
				}
				if ( ! empty( $font_list[ $font ]['mu'] ) ) {
					// get the mu from the list and add the correction value
					$mu = $font_list[ $font ]['mu'] + $correction;
				}
			}
		}

		// make sure the font size is an integer value - if it isn't - return nothing.
		if ( ! empty( $size ) && is_numeric( $size ) ) {
			// characters per lin = width of the column / (font size / mu)
			// ie - $cpl = 90 = 640 / ( 16 / 2.25)
			$cpl = $column_width / ( $size / $mu );
			if ( $cpl < 90 ) {
				// by my calculations 90 is the ideal cpl and will have the highest line height
				// less than 90 and the line height is reduced
				$factor = ( ( $cpl ) * .0033 ) + 1.3;
			} else {
				$factor = 1.61 - ( ( $cpl - 89 ) * .0033 );
				// greater than 90 and the line height is reduced
			}

			$height = $size * $factor;

			return $height;
		}
	}

	// calculates the appropriate line height for heading text (heading) based on
	// font size($size), column configuration ($width), font family ($font) and desktop width - if any
	// returns an float number
	public function height_headings( $size, $width = 'two-thirds', $font = false, $desktop_width = false ) {

		global $thesis;
		// if a desktop width is passed then use it in the calculations - otherwise use the design option
		// for desktop width
		if ( ! $desktop_width ) {
			$desktop_width = $this->desktop_width;
		}

		$a          = 1 / ( 2 * $this->phi ); // 0.31 Chris's calculation - used to reduce the line height from 1.62 * font size
		$correction = 0; // initialize correction
		$mu         = 2.25; // default mu -  see note above
		$font_list  = false; // initialize the font list array to empty
		$font_list  = $thesis->api->fonts->list; // add the Thesis font list to the font list array
		// get the integer value of the column configuration.
		// This is found by looking at the $column_fonts array and selecting the width
		// from the the desktop width and column configuration
		// $column_width is an integer
		$column_width = $this->column_fonts[ $desktop_width ][ $width ]['column_width'];

		// Correction factor is for fonts with large x-heights and/or large size footprints
		if ( $font_list && $font ) {
			if ( array_key_exists( (string) $font, $font_list ) ) {
				if ( array_key_exists( 'x', $font_list[ $font ] ) ) {
					// if applicable set a correction value
					$correction = 0.5;
				}
				if ( ! empty( $font_list[ $font ]['mu'] ) ) {
					// get the mu from the list and add the correction value
					$mu = $font_list[ $font ]['mu'] + $correction;
				}
			}
		}

		// I found that the original Pearsonified calculation didn't yield the same results for headings as the Pearsonified
		// Golden Ratio Typography Calculator.  So I revised it to reduce the line heights for headings
		// This very closely approximates the results given by the Pearsonified Calculator

		$cpl = $column_width / ( $size / $mu );
		if ( $size < 43 ) {
			if ( $cpl < 90 ) {
				$factor = ( ( $cpl ) * .0033 ) + 1.3;
			} else {
				$factor = 1.61 - ( ( $cpl - 89 ) * .0033 );
			}
		} else {
			if ( $cpl < 90 ) {
				$factor = ( ( $cpl ) * .0033 ) + 1.1;
			} else {
				$factor = 1.3 - ( ( $cpl - 89 ) * .0033 );
			}
		}

		if ( $size ) {
			$height = $size * $factor;
			if ( $size > 20 && $size < 27 ) {
				$height = $size * $factor - 2;
			}
			if ( $size > 26 && $size < 37 ) {
				$height = $size * $factor - 3;
			}
			if ( $size > 36 && $size < 43 ) {
				$height = $size * $factor - 4;
			}
			// I'm happy with this result
//                        if ($size > 42) {
//                                $difference = $size - 42;
//                        }
//
			// returna a float
			return $height;
		}
	}

	// returns an array of sizes used for default font sizes
	// based on a given font size and potentially a desktip width
	public function scale( $size, $desktop_width = false ) {
		$phi = $this->phi; // Chris' golden constant - 1.618
		// ititialize the return value
		$scale = false;
		if ( $desktop_width ) {
			// the smaller the desktop width, the smaller the $phi
			// this has the effect of reducing the font sizes for smaller devices
			switch ( $desktop_width ) {
				case 800:
					$phi = $this->phi * 0.95; // 1.537
					break;
				case 699:
					$phi = $this->phi * 0.9; // 1.456
					break;
				case 415:
					$phi = $this->phi * 0.85; // 1.375
					break;
			}
		}
		if ( ! empty( $size ) && is_numeric( $size ) ) {
			$scale = array(
				'f1' => round( $size * pow( $phi, 1.75 ) ), // site title - 2.32 * font size
				'f2' => round( $size * pow( $phi, 1.62 ) ), // Main headline - h1 - 2.18 * font size
				'f3' => round( $size * pow( $phi, 1.5 ) ), // H2 - 2.058 * font size
				'f4' => round( $size * pow( $phi, 1.25 ) ), // H3 - 1.82 * font size
				'f5' => round( $size * $phi ), // H4 - 1.618 * font size
				'f6' => round( $size * sqrt( $phi ) ), // h5 - 1.34 * font size
				'f7' => $size, // p - font size
				'f8' => round( $size * ( 1 / sqrt( $this->phi ) ) )
			); // p small - 0.75 * font size
		}

		// return an array of whole numbers
		return $scale;
	}

	public function space( $height ) {
		return empty( $height ) || ! is_numeric( $height ) ? false : array(
			'x1'  => ( $height = round( $height ) ),
			'x05' => ( $half = round( $height / 2 ) ),
			'x15' => $height + $half,
			'x2'  => $height * 2
		);
	}

	public function set_column_fonts() {
		if ( $this->column_fonts[ $this->desktop_width ][ $this->content_width ] != $this->primary_font_size ) {

			switch ( $this->content_width ) {
				case 'full':
					$this->set_defaults_from_full();
					break;
				case 'three-quarters':
					$this->set_defaults_from_three_quarters();
					break;
				case 'two-thirds':
					$this->set_defaults_from_two_thirds();
					break;
				case 'half':
					$this->set_defaults_from_half();
					break;
			}
		}
	}

	public function set_defaults_from_full() {
		// this sets all of the default values based on the content width of full and the primary font size
		$desktop_width = $this->desktop_width;

		// set the new three-quarters
		$decrease                                                            = $this->column_fonts[ $desktop_width ]['full']['font_size'] - $this->column_fonts[ $desktop_width ]['three-quarters']['font_size'];
		$this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] = $this->primary_font_size - $decrease;

		// set the new two-thirds
		$decrease                                                        = $this->column_fonts[ $desktop_width ]['full']['font_size'] - $this->column_fonts[ $desktop_width ]['two-thirds']['font_size'];
		$this->column_fonts[ $desktop_width ]['two-thirds']['font_size'] = $this->primary_font_size - $decrease;

		// set the new half
		$decrease                                                  = $this->column_fonts[ $desktop_width ]['full']['font_size'] - $this->column_fonts[ $desktop_width ]['half']['font_size'];
		$this->column_fonts[ $desktop_width ]['half']['font_size'] = $this->primary_font_size - $decrease;

		// set the new one-third
		$decrease                                                       = $this->column_fonts[ $desktop_width ]['full']['font_size'] - $this->column_fonts[ $desktop_width ]['one-third']['font_size'];
		$this->column_fonts[ $desktop_width ]['one-third']['font_size'] = $this->primary_font_size - $decrease;

		// set the new one-quarter
		$decrease                                                         = $this->column_fonts[ $desktop_width ]['full']['font_size'] - $this->column_fonts[ $desktop_width ]['one-quarter']['font_size'];
		$this->column_fonts[ $desktop_width ]['one-quarter']['font_size'] = $this->primary_font_size - $decrease;

		// set the new full
		$this->column_fonts[ $desktop_width ]['full']['font_size'] = $this->primary_font_size;
	}

	public function set_defaults_from_three_quarters() {
		// this sets all of the default values based on the content width of three-quarters and the primary font size
		$desktop_width = $this->desktop_width;
		// set the new full
		$increase_to_full                                          = $this->column_fonts[ $desktop_width ]['full']['font_size'] - $this->column_fonts[ $desktop_width ]['three-quarters']['font_size'];
		$this->column_fonts[ $desktop_width ]['full']['font_size'] = $this->primary_font_size + $increase_to_full;

		// set the new two-thirds
		$decrease                                                        = $this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] - $this->column_fonts[ $desktop_width ]['two-thirds']['font_size'];
		$this->column_fonts[ $desktop_width ]['two-thirds']['font_size'] = $this->primary_font_size - $decrease;

		// set the new half
		$decrease                                                  = $this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] - $this->column_fonts[ $desktop_width ]['half']['font_size'];
		$this->column_fonts[ $desktop_width ]['half']['font_size'] = $this->primary_font_size - $decrease;

		// set the new one-third
		$decrease                                                       = $this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] - $this->column_fonts[ $desktop_width ]['one-third']['font_size'];
		$this->column_fonts[ $desktop_width ]['one-third']['font_size'] = $this->primary_font_size - $decrease;

		// set the new one-quarter
		$decrease                                                         = $this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] - $this->column_fonts[ $desktop_width ]['one-quarter']['font_size'];
		$this->column_fonts[ $desktop_width ]['one-quarter']['font_size'] = $this->primary_font_size - $decrease;

		// set the new three-quarters
		$this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] = $this->primary_font_size;
	}

	public function set_defaults_from_two_thirds() {
		// this sets all of the default values based on the content width of two-thirds and the primary font size
		$desktop_width = $this->desktop_width;
		// set the new full
		$increase_to_full                                          = $this->column_fonts[ $desktop_width ]['full']['font_size'] - $this->column_fonts[ $desktop_width ]['two-thirds']['font_size'];
		$this->column_fonts[ $desktop_width ]['full']['font_size'] = $this->primary_font_size + $increase_to_full;

		// set the new three-quarters
		$increase                                                            = $this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] - $this->column_fonts[ $desktop_width ]['two-thirds']['font_size'];
		$this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] = $this->primary_font_size + $increase;

		// set the new half
		$decrease                                                  = $this->column_fonts[ $desktop_width ]['two-thirds']['font_size'] - $this->column_fonts[ $desktop_width ]['half']['font_size'];
		$this->column_fonts[ $desktop_width ]['half']['font_size'] = $this->primary_font_size - $decrease;

		// set the new one-third
		$decrease                                                       = $this->column_fonts[ $desktop_width ]['two-thirds']['font_size'] - $this->column_fonts[ $desktop_width ]['one-third']['font_size'];
		$this->column_fonts[ $desktop_width ]['one-third']['font_size'] = $this->primary_font_size - $decrease;

		// set the new one-quarter
		$decrease                                                         = $this->column_fonts[ $desktop_width ]['two-thirds']['font_size'] - $this->column_fonts[ $desktop_width ]['one-quarter']['font_size'];
		$this->column_fonts[ $desktop_width ]['one-quarter']['font_size'] = $this->primary_font_size - $decrease;

		// set the new two-thirds
		$this->column_fonts[ $desktop_width ]['two-thirds']['font_size'] = $this->primary_font_size;
	}

	public function set_defaults_from_half() {
		// this sets all of the default values based on the content width of half and the primary font size
		$desktop_width = $this->desktop_width;
		// set the new full
		$increase_to_full                                          = $this->column_fonts[ $desktop_width ]['full']['font_size'] - $this->column_fonts[ $desktop_width ]['half']['font_size'];
		$this->column_fonts[ $desktop_width ]['full']['font_size'] = $this->primary_font_size + $increase_to_full;

		// set the new three-quarters
		$increase                                                            = $this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] - $this->column_fonts[ $desktop_width ]['half']['font_size'];
		$this->column_fonts[ $desktop_width ]['three-quarters']['font_size'] = $this->primary_font_size + $increase;

		// set the two-thirds
		$increase                                                        = $this->column_fonts[ $desktop_width ]['two-thirds']['font_size'] - $this->column_fonts[ $desktop_width ]['half']['font_size'];
		$this->column_fonts[ $desktop_width ]['two-thirds']['font_size'] = $this->primary_font_size + $increase;

		// set the new one-third
		$decrease                                                       = $this->column_fonts[ $desktop_width ]['half']['font_size'] - $this->column_fonts[ $desktop_width ]['one-third']['font_size'];
		$this->column_fonts[ $desktop_width ]['one-third']['font_size'] = $this->primary_font_size - $decrease;

		// set the new one-quarter
		$decrease                                                         = $this->column_fonts[ $desktop_width ]['half']['font_size'] - $this->column_fonts[ $desktop_width ]['one-quarter']['font_size'];
		$this->column_fonts[ $desktop_width ]['one-quarter']['font_size'] = $this->primary_font_size - $decrease;

		// set the new half
		$this->column_fonts[ $desktop_width ]['half']['font_size'] = $this->primary_font_size;
	}

}
