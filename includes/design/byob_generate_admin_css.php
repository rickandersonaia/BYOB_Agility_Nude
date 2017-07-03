<?php

/**
 * Description of byob_generate_admin_css
 *
 * @author Rick
 */
class byob_generate_admin_css {

        public $design = array();
        public $icon_options_list = array(
            'byob_agility_nude_typ_lists_icon',
            'byob_agility_nude_custom_1_lists_icon',
            'byob_agility_nude_custom_2_lists_icon',
            'byob_agility_nude_custom_3_lists_icon',
            'byob_agility_nude_sidebar_widget_lists_icon',
            'byob_agility_nude_footer_widget_lists_icon',
            'byob_agility_nude_header_widget_lists_icon',
            'byob_agility_nude_feature_box_widget_lists_icon',
            'byob_agility_nude_attention_box_widget_lists_icon',
            'byob_agility_nude_supplemental_widget_lists_icon',
            'byob_agility_nude_supplemental_2_widget_lists_icon'
        );
        public $icons = array(
            'f105' => 2,
            'f101' => 3,
            'f0a9' => 4,
            'f061' => 5,
            'f0da' => 6,
            'f054' => 7,
            'f138' => 8,
            'f0a4' => 9,
            'f067' => 10,
            'f128' => 11,
            'f069' => 12,
            'f00c' => 13,
            'f058' => 14,
            'f14a' => 15,
            'f0a3' => 16,
            'f013' => 17
        );

        public function __construct($design) {
                $this->design = $design;
//                var_dump($this->colors);
        }

        public function format_color_selection() {
                global $thesis;
                $output = '';
                $fonts = file_get_contents(BYOBAGN_PATH . '/css/font-awesome.min.css');
                $output = str_replace("url('../", "url('", $fonts);

                return $output;
        }

        public function write_file() {
                $location = BYOBAGN_PATH . '/css/byobagn-admin-styles.css';

                $color_selectors = $this->format_color_selection();

                // Create the CSS Block
                $css_block_start = '/*>>Start - BYOB Agility Nude Dynamic Admin CSS */';
                $css_block_end = '/*>>End - BYOB Agility Nude Dynamic Admin CSS */';

                $write_css = $css_block_start . "\n";
                $write_css .= $color_selectors . "\n";
                $write_css .= $css_block_end . "\n";

                // Create the CSS Header Block
                $write_header_css = "/*\n";
                $write_header_css .= "File:		byobagn-admin-styles.css \n";
                $write_header_css .= "Description:	Styles for BYOB Agiltity Nude Admin Options \n";
                $write_header_css .= "More Info:	http://www.byobwebsite.com/member-benefits/ \n";
                $write_header_css .= "*/ \n\n";

                // Setup the CSS sheet creation
                // Setup the CSS sheet creation

                $url = wp_nonce_url('admin.php?page=thesis&canvas=byob_agility_nude__design');

                if (false === ($creds = request_filesystem_credentials($url) )) {

                        // if we get here, then we don't have credentials yet,
                        // but have just produced a form for the user to fill in,
                        // so stop processing for now

                        return true; // stop the normal page form from displaying
                }

                // now we have some credentials, try to get the wp_filesystem running
                if (!WP_Filesystem($creds)) {
                        // our credentials were no good, ask the user for them again
                        request_filesystem_credentials($url);
                        return true;
                }


                if (!file_exists($location)) {
                        // If this is the first instance of the byob-custom.css file beign written write the initial comment block
                        $write_final_css = $write_header_css . $write_css;
                } else {
                        // If the byob-custom.css file has been written in the past just get the relevant content
                        $byob_css_file = file_get_contents($location);
                        $start_pos = strpos($byob_css_file, $css_block_start);

                        if ($start_pos) {
                                $front_piece = explode($css_block_start, $byob_css_file, 2);
                                $end_piece = explode($css_block_end, $byob_css_file, 2);
                                $write_final_css = $front_piece[0] . $write_css . $end_piece[1];
                        } else {
                                $write_final_css = $byob_css_file . $write_css;
                        }
                }
                // Remove the blank lines

                $write_final_css = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $write_final_css);

                // Write the CSS to the file
                // by this point, the $wp_filesystem global should be working, so let's use it to create a file
                global $wp_filesystem;
                if (!$wp_filesystem->put_contents($location, $write_final_css, FS_CHMOD_FILE)) {
                        echo "error saving file!";
                }
        }

}
