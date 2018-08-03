<?php

/**
 * Description of byob_generate_admin_css
 *
 * @author Rick
 */
class byob_generate_editor_css {

        public $design = array();

        public function __construct($design, $vars) {
                $this->design = $design;
                $this->vars = $vars;
                $this->styles = new byob_generate_css($design);
        }

        public function write_file() {
                $existing_location = BYOBAGN_PATH . '/css/editor-style.css';
                $static_location = BYOBAGN_PATH . '/css/static-editor.css';
                $new = $static = '';
                // Create the CSS Block
                $custom_css_block_start = '/*>>Start - BYOB Agility Nude Editor Custom CSS */';
                $custom_css_block_end = '/*>>End - BYOB Agility Nude Editor Custom CSS */';

                $default_css_block_start = '/*>>Start - BYOB Agility Nude Editor Default CSS */';
                $default_css_block_end = '/*>>BYOB Agility Nude Editor Default CSS */';

                $new .= $this->editor_width();
                $new .= $this->text_styles();
                $new .= $this->link_styles();
                $new .= $this->hover_styles();
                $new .= $this->list_styles();
                $new .= $this->list_item_styles();
                $new .= $this->list_item_icon_styles();
                $new .= $this->icon_fonts();
                $new .= $this->background_styles();

                $custom_css = $custom_css_block_start . "\n";
                $custom_css .= $new . "\n";
                $custom_css .= $custom_css_block_end . "\n";

                // Create the CSS Header Block
                $write_header_css = "/*\n";
                $write_header_css .= "File:		editor-style.css \n";
                $write_header_css .= "Description:	Styles for BYOB Agiltity Nude Editor \n";
                $write_header_css .= "More Info:	http://www.byobwebsite.com/member-benefits/ \n";
                $write_header_css .= "*/ \n\n";


                // Setup nonce & get credintials

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



                if (file_exists($static_location)) {
                        // Add the static CSS file
                        $default_css_file = file_get_contents($static_location);
                        $default_css = $this->swap_out_vars($default_css_file);
                        $default_css .= "\n\n";
                }


                if (!file_exists($existing_location)) {
                        // If this is the first instance of the byob-custom.css file beign written write the initial comment block
                        $write_final_css = $write_header_css . $default_css . $custom_css;
                } else {
                        // If the editor-style.css file has been written in the past just get the relevant content
                        // Initialize the variables with the existing content
                        $default_final_css = $existing_editor_css = file_get_contents($existing_location);

                        //first check and replace the "static" CSS
                        $start_pos = strpos($existing_editor_css, $default_css_block_start);

                        if ($start_pos) {
                                $front_piece = explode($default_css_block_start, $existing_editor_css, 2);
                                $end_piece = explode($default_css_block_end, $existing_editor_css, 2);
                                $default_final_css = $front_piece[0] . $default_css . $end_piece[1];
                        } else {
                                $default_final_css = $default_css_block_start . $default_css . $default_css_block_end;
                        }
//                        $write_final_css = $existing_editor_css . 'woops - no start_pos';
                        // Second check and replace the "Dynamic" CSS
                        $custom_start_pos = strpos($default_final_css, $custom_css_block_start);
                        if ($custom_start_pos) {
                                $cuatom_front_piece = explode($custom_css_block_start, $default_final_css, 2);
                                $custom_end_piece = explode($custom_css_block_end, $default_final_css, 2);
                                $write_final_css = $cuatom_front_piece[0] . $custom_css . $custom_end_piece[1];
                        } else {
                                $write_final_css = $custom_css_block_start . $custom_css . $custom_css_block_end;
                        }
                }


                // Remove the blank lines

                $write_final_css = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $write_final_css);

                // Write the CSS to the file
                // by this point, the $wp_filesystem global should be working, so let's use it to create a file
                global $wp_filesystem;
                if (!$wp_filesystem->put_contents($existing_location, $write_final_css, FS_CHMOD_FILE)) {
                        echo "error saving file!";
                }
        }

        public function text_styles() {
                $output = '';
                $text_areas = array(
                        'typ_p' => array(
                                'selector' => '#tinymce p',
                                'full_selector' => '#tinymce .full p',
                                'default_width' => 'two-thirds',
                                'scale' => 'f7'
                        ),
                        'blockquote' => array(
                                'selector' => '#tinymce blockquote, #tinymce blockquote p',
                                'full_selector' => '#tinymce .full blockquote, #tinymce .full blockquote p',
                                'default_width' => 'two-thirds',
                                'scale' => 'f7'
                        ),
                        'typ_h1' => array(
                                'selector' => '#tinymce h1',
                                'full_selector' => '#tinymce .full h1',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f2'
                        ),
                        'typ_h2' => array(
                                'selector' => '#tinymce h2',
                                'full_selector' => '#tinymce .full h2',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f3'
                        ),
                        'typ_h3' => array(
                                'selector' => '#tinymce h3',
                                'full_selector' => '#tinymce .full h3',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f4'
                        ),
                        'typ_h4' => array(
                                'selector' => '#tinymce h4',
                                'full_selector' => '#tinymce .full h4',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f5'
                        ),
                        'typ_h5' => array(
                                'selector' => '#tinymce h5',
                                'full_selector' => '#tinymce .full h5',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f6'
                        ),
                        'typ_h6' => array(
                                'selector' => '#tinymce h6',
                                'full_selector' => '#tinymce .full h6',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f7'
                        ),
                );
                $output = $this->styles->text_styles($text_areas);
                return $output;
        }

        public function link_styles() {
                $output = '';
                $text_area_links = array(
                        'typ_links' => '#tinymce a');
                $output = $this->styles->link_styles($text_area_links);
                return $output;
        }

        public function hover_styles() {
                $output = '';
                $text_area_links = array(
                        'typ_links' => '#tinymce a:hover');
                $output = $this->styles->hover_styles($text_area_links);
                return $output;
        }

        public function list_styles() {
                $output = '';
                $text_area_lists = array(
                        'typ_lists' => '#tinymce ul');
                $output = $this->styles->list_styles($text_area_lists);
                return $output;
        }

        public function list_item_styles() {
                $output = '';
                $text_area_lists = array(
                        'typ_lists' => '#tinymce li');
                $output = $this->styles->list_item_styles($text_area_lists);
                return $output;
        }

        public function list_item_icon_styles() {
                $output = '';
                $text_area_lists = array(
                        'typ_lists' => '#tinymce li:before');
                $output = $this->styles->list_item_icon_styles($text_area_lists);
                return $output;
        }

        public function icon_fonts() {

                $output = '';
                $fonts = file_get_contents(BYOBAGN_PATH . '/css/font-awesome.min.css');
                $output = str_replace("url('../", "url('" . BYOBAGN_URL . "/", $fonts);

                return $output;
        }

        public function background_styles() {
                $output = '';
                $backgrounds = array(
                        'blockquote' => '#tinymce blockquote',
                        'plain_icon' => '#tinymce i.fa',
                        'circle_positive' => '#tinymce i.fa.fa-fw.circle.positive',
                        'circle_negative' => '#tinymce i.fa.fa-fw.circle.negative',
                        'square_positive' => '#tinymce i.fa.fa-fw.square.positive',
                        'square_negative' => '#tinymce i.fa.fa-fw.square.negative',
                        'rounded_square_positive' => '#tinymce i.fa.fa-fw.rounded_square.positive',
                        'rounded_square_negative' => '#tinymce i.fa.fa-fw.rounded_square.negative'
                );
                $output = $this->styles->background_styles($backgrounds);
                return $output;
        }

        public function editor_width() {
                global $thesis;
                $desktop_width = !empty($this->design['desktop_width']['width']) ? $this->design['desktop_width']['width'] : 1032;
                $content_width = !empty($this->design['content_width']['width']) ? $this->design['content_width']['width'] : 'two-thirds';
                $table = new byob_text_dimensions_calculation();
                $content_widths = $table->column_fonts;
                $raw_width = $content_widths[$desktop_width][$content_width]['column_width'];

                $output = ".mce-content-body{max-width:" . $thesis->api->css->number($raw_width) . ";}\n";
                return $output;
        }

        public function get_static_styles() {

                $output = '';
                $output = file_get_contents(BYOBAGN_PATH . '/css/static-editor.css');
                return $output;
        }

        public function swap_out_vars($default_css_file) {
                $vars = get_option('byob_agility_nude_vars');

                $output = $default_css_file;
                if ($vars) {
                        foreach ($vars as $id => $data) {
                                $output = str_replace("$" . $data['ref'], $data['css'], $output);
                        }
                        return $output;
                }
        }

}
