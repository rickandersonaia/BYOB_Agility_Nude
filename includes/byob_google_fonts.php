<?php

/*
 * This class adds Google Fonts to the skin
 * Based on code developed by DIYThemes in the Pearsonified Skin
 * Version 1.5 - accomodates options of both "font-family" and "font_family, added
 * the ability to load fonts on the admin side
 * uses new webfontconfig
 */

class byob_google_fonts {

	public $google_fonts = array();
	private $vgf = array(); // verified Google fonts to be used in the design
	public $design = array(); // design elements that contain font family designations
	public $trigger = false; // switch used to print font loader scripts.

	public function __construct( $design = array(), $trigger = false ) {
		global $thesis;
		$this->trigger = $trigger;
		$this->design  = $design;
//                add_filter('thesis_font_script', array($this, 'webfont_js'));
		add_action( 'thesis_hook_head', array( $this, 'webfont_loader' ) );
	}

	// Google Web Fonts integration
	public function add_google_fonts() {
		$this->google_fonts = $this->google_fonts();
	}

	public function webfont_js() {
		$skin_fonts = false;
		$this->add_google_fonts();

		$design = $this->design; //
		if ( empty( $design ) ) {
			return;
		}

		foreach ( $design as $element ) {
			$skin_fonts[] = ! empty( $element['font_family'] ) ? $element['font_family'] : false;
			$skin_fonts[] = ! empty( $element['font-family'] ) ? $element['font-family'] : false;
		}
		if ( is_array( $skin_fonts ) ) {
			$this->verify_google_fonts( array_filter( $skin_fonts ) );
		}

		return ! empty( $this->vgf ) ? '//cdnjs.cloudflare.com/ajax/libs/webfont/1.3.0/webfont.js' : false;
	}

	public function webfont_loader() {

		$skin_fonts = false;
		$this->add_google_fonts();

		$design = $this->design; //
		if ( empty( $design ) ) {
			return;
		}

		foreach ( $design as $element ) {
			$skin_fonts[] = ! empty( $element['font_family'] ) ? $element['font_family'] : false;
			$skin_fonts[] = ! empty( $element['font-family'] ) ? $element['font-family'] : false;
		}
		if ( is_array( $skin_fonts ) ) {
			$this->verify_google_fonts( array_filter( $skin_fonts ) );
		}

		if ( ! empty( $this->trigger ) ) {
			return;
		}
		if ( empty( $this->vgf ) ) {
			return;
		}

		$families = array();
		foreach ( $this->vgf as $name => $font ) {
			if ( ! empty( $font['styles'] ) ) {
				$families[] = "'{$font['styles']}'";
			}
		}
		if ( empty( $families ) ) {
			return;
		}

		echo "<script>",
		"WebFontConfig = {",
		"google: { families: [", implode( ', ', $families ), "] },",
		"};",
		"(function() {",
		"var wf = document.createElement('script');",
		"wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.21/webfontloader.js';",
		"wf.type = 'text/javascript';",
		"wf.async = 'true';",
		"var s = document.getElementsByTagName('script')[0];",
		"s.parentNode.insertBefore(wf, s);",
		"})();",
		"</script>\n";
	}

	public function admin_webfont_loader() {
		// rather than using the font loader this prepares a url for inclusion into the editor styles
		// similar to TwentyFifteen and http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
		$skin_fonts = false;
		$this->add_google_fonts();
		$design = $this->design; //

		if ( empty( $design ) ) {
			return;
		}
		foreach ( $design as $element ) {
			$skin_fonts[] = ! empty( $element['font_family'] ) ? $element['font_family'] : false;
			$skin_fonts[] = ! empty( $element['font-family'] ) ? $element['font-family'] : false;
		}

		if ( is_array( $skin_fonts ) ) {
			$this->verify_google_fonts( array_filter( $skin_fonts ) );
		}

//                var_dump();

		if ( empty( $this->vgf ) ) {
			return;
		}

		$families = array();
		foreach ( $this->vgf as $name => $font ) {
			if ( ! empty( $font['styles'] ) ) {
				$families[] = "{$font['styles']}";
			}
		}

		if ( empty( $families ) ) {
			return;
		}

		if ( $families ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $families ) )
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}

	public function verify_google_fonts( $fonts ) { // array of fonts selected in Design options
		if ( ! is_array( $fonts ) || ! is_array( $this->google_fonts ) ) {
			return false;
		}
		foreach ( $fonts as $font ) {
			if ( ! empty( $this->google_fonts[ $font ] ) && ! empty( $this->google_fonts[ $font ]['styles'] ) ) {
				$this->vgf[ $font ] = $this->google_fonts[ $font ];
			}
		}
	}

	function google_fonts() {
		// Each of the following Google Fonts contains 400, 400 italic, and 700 (bold) styles, making it suitable for use in primary content.
		// If a font has a large x-height that requires correction, it will contain 'x' => true
		$primary_fonts = array(
			'Alegreya'           => array(
				'type' => 'serif',
				'mu'   => 2.47
			),
			'Alegreya Sans'      => array(
				'type' => 'sans-serif',
				'mu'   => 2.65
			),
			'Almendra'           => array(
				'type' => 'serif',
				'mu'   => 2.49
			),
			'Amaranth'           => array(
				'type' => 'sans-serif',
				'mu'   => 2.36
			),
			'Anonymous Pro'      => array(
				'type' => 'sans-serif',
				'mu'   => 1.83,
				'x'    => true
			),
			'Arimo'              => array(
				'type' => 'sans-serif',
				'mu'   => 2.26
			),
			'Asap'               => array(
				'type' => 'sans-serif',
				'mu'   => 2.28
			),
			'Averia Libre'       => array(
				'type' => 'sans-serif',
				'mu'   => 2.25
			),
			'Averia Sans Libre'  => array(
				'type' => 'sans-serif',
				'mu'   => 2.29
			),
			'Averia Serif Libre' => array(
				'type' => 'serif',
				'mu'   => 2.2
			),
			'Bitter'             => array(
				'type' => 'serif',
				'mu'   => 2.08,
				'x'    => true
			),
			'Cabin'              => array(
				'type' => 'sans-serif',
				'mu'   => 2.41
			),
			'Cantarell'          => array(
				'type' => 'sans-serif',
				'mu'   => 2.16
			),
			'Cardo'              => array(
				'type' => 'serif',
				'mu'   => 2.37
			),
			'Caudex'             => array(
				'type' => 'serif',
				'mu'   => 2.23
			),
			'Cousine'            => array(
				'type' => 'sans-serif',
				'mu'   => 1.67,
				'x'    => true
			),
			'Crimson Text'       => array(
				'type' => 'serif',
				'mu'   => 2.57
			),
			'Cuprum'             => array(
				'type' => 'sans-serif',
				'mu'   => 2.63
			),
			'Droid Serif'        => array(
				'type' => 'serif',
				'mu'   => 2.1,
				'x'    => true
			),
			'Economica'          => array(
				'type' => 'sans-serif',
				'mu'   => 3.28
			),
			'Exo'                => array(
				'type' => 'sans-serif',
				'mu'   => 2.24
			),
			'Exo 2'              => array(
				'type' => 'sans-serif',
				'mu'   => 2.22
			),
			'Expletus Sans'      => array(
				'type' => 'sans-serif',
				'mu'   => 2.19
			),
			'Gentium Basic'      => array(
				'type' => 'serif',
				'mu'   => 2.44
			),
			'Gentium Book Basic' => array(
				'type' => 'serif',
				'mu'   => 2.38
			),
			'Gudea'              => array(
				'type' => 'sans-serif',
				'mu'   => 2.37
			),
			'Istok Web'          => array(
				'type' => 'sans-serif',
				'mu'   => 2.23
			),
			'Josefin Sans'       => array(
				'type' => 'sans-serif',
				'mu'   => 2.51
			),
			'Josefin Slab'       => array(
				'type' => 'serif',
				'mu'   => 2.38
			),
			'Judson'             => array(
				'type' => 'serif',
				'mu'   => 2.37
			),
			'Karla'              => array(
				'type' => 'sans-serif',
				'mu'   => 2.2
			),
			'Lato'               => array(
				'type' => 'sans-serif',
				'mu'   => 2.33
			),
			'Lekton'             => array(
				'type' => 'sans-serif',
				'mu'   => 2
			),
			'Libre Baskerville'  => array(
				'type' => 'serif',
				'mu'   => 1.96,
				'x'    => true
			),
			'Lobster Two'        => array(
				'type' => 'serif',
				'mu'   => 2.78
			),
			'Lora'               => array(
				'type' => 'serif',
				'mu'   => 2.16
			),
			'Marvel'             => array(
				'type' => 'sans-serif',
				'mu'   => 2.92
			),
			'Merriweather'       => array(
				'type' => 'serif',
				'mu'   => 2,
				'x'    => true
			),
			'Merriweather Sans'  => array(
				'type' => 'sans-serif',
				'mu'   => 2.05,
				'x'    => true
			),
			'Neuton'             => array(
				'type' => 'serif',
				'mu'   => 2.64
			),
			'Nobile'             => array(
				'type' => 'sans-serif',
				'mu'   => 2.1,
				'x'    => true
			),
			'Noticia Text'       => array(
				'type' => 'serif',
				'mu'   => 2.14,
				'x'    => true
			),
			'Noto Sans'          => array(
				'type' => 'sans-serif',
				'mu'   => 2.14,
				'x'    => true
			),
			'Noto Serif'         => array(
				'type' => 'serif',
				'mu'   => 2.1,
				'x'    => true
			),
			'Old Standard TT'    => array(
				'type' => 'serif',
				'mu'   => 2.3,
				'x'    => true
			),
			'Open Sans'          => array(
				'type' => 'sans-serif',
				'mu'   => 2.17,
				'x'    => true
			),
			'Overlock'           => array(
				'type' => 'sans-serif',
				'mu'   => 2.5
			),
			'Philosopher'        => array(
				'type' => 'sans-serif',
				'mu'   => 2.36
			),
			'Playfair Display'   => array(
				'type' => 'serif',
				'mu'   => 2.24,
				'x'    => true
			),
			'PT Sans'            => array(
				'type' => 'sans-serif',
				'mu'   => 2.35
			),
			'PT Serif'           => array(
				'type' => 'serif',
				'mu'   => 2.25
			),
			'Puritan'            => array(
				'type' => 'sans-serif',
				'mu'   => 2.38
			),
			'Quantico'           => array(
				'type' => 'sans-serif',
				'mu'   => 2.12
			),
			'Quattrocento Sans'  => array(
				'type' => 'sans-serif',
				'mu'   => 2.33,
				'x'    => true
			),
			'Rambla'             => array(
				'type' => 'sans-serif',
				'mu'   => 2.47,
				'x'    => true
			),
			'Roboto'             => array(
				'type' => 'sans-serif',
				'mu'   => 2.24,
				'x'    => true
			),
			'Roboto Condensed'   => array(
				'type' => 'sans-serif',
				'mu'   => 2.6,
				'x'    => true
			),
			'Roboto Slab'        => array(
				'type' => 'serif',
				'mu'   => 2.12,
				'x'    => true
			),
			'Rosario'            => array(
				'type' => 'sans-serif',
				'mu'   => 2.41
			),
			'Scada'              => array(
				'type' => 'sans-serif',
				'mu'   => 2.3
			),
			'Share'              => array(
				'type' => 'sans-serif',
				'mu'   => 2.5
			),
			'Source Sans Pro'    => array(
				'type' => 'sans-serif',
				'mu'   => 2.42
			),
			'Tinos'              => array(
				'type' => 'serif',
				'mu'   => 2.48
			),
			'Titillium Web'      => array(
				'type' => 'sans-serif',
				'mu'   => 2.4
			),
			'Trochut'            => array(
				'type' => 'sans-serif',
				'mu'   => 2.86
			),
			'Ubuntu'             => array(
				'type' => 'sans-serif',
				'mu'   => 2.22,
				'x'    => true
			),
			'Ubuntu Mono'        => array(
				'type' => 'sans-serif',
				'mu'   => 2
			),
			'Volkhov'            => array(
				'type' => 'serif',
				'mu'   => 2.09,
				'x'    => true
			),
			'Vollkorn'           => array(
				'type' => 'serif',
				'mu'   => 2.32
			)
		);
		foreach ( $primary_fonts as $name => $font ) {
			$fonts[ $name ] = array_filter( array(
				'name'   => "$name (G)",
				'family' => "\"$name\", {$font['type']}",
				'mu'     => $font['mu'],
				'styles' => "$name:400,400italic,700",
				'x'      => ! empty( $font['x'] ) ? $font['x'] : false
			) );
		}

		return apply_filters( 'byob_fonts', $fonts );
	}

}
