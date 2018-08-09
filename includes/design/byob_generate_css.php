<?php

/**
 * Description of byob_generate_css
 *
 * @author Rick Anderson
 */
class byob_generate_css {

        public $design = array();

        public function __construct($design) {
                $this->design = $design;
                $this->css = $this->generate_css();
        }

        public function generate_css() {
                global $thesis;

                $new = "\n/* Begin Agility Text Styles */";
                $new .= $this->text_styles();
                $new .= $this->link_styles();
                $new .= $this->hover_styles();
                $new .= $this->list_styles();
                $new .= $this->list_item_styles();
                $new .= $this->list_item_icon_styles();
                $new .= $this->label_styles();
                $new .= "\n/* End Agility Text Styles */";

                $new .= "\n/* Begin Agility Icon Styles */";
                $new .= $this->icon_styles();
                $new .= $this->social_icon_styles();
                $new .= "\n/* End Agility Icon Styles */";

                $new .= "\n/* Begin Agility Background Styles */";
                $new .= $this->background_styles();
                $new .= "\n/* End Agility Background Styles */";

                $new .= "\n/* Begin Agility Agility Submit Styles */";
                $new .= $this->submit_styles();
                $new .= "\n/* End Agility Agility Submit Styles */";

                $new .= "\n/* Begin Agility Header Column Styles */";
                $new .= $this->header_column_styles();
                $new .= "\n/* End Agility Header Column Styles */";

                $new .= "\n/* Begin Agility Agility Media Queries */";
                $mq = new media_query_calcs($this->design);
                $new .= $mq->media_query_list();
                $new .= "\n/* End Agility Agility Media Queries */";

                return $new;
        }

        public function header_column_styles() {
                $backgrounds = new byob_background_values($this->design);
                $header_columns = array(
                    'col_1_top_header' => '#top_header_columns > div:nth-of-type(1)',
                    'col_2_top_header' => '#top_header_columns > div:nth-of-type(2)',
                    'col_3_top_header' => '#top_header_columns > div:nth-of-type(3)',
                    'col_4_top_header' => '#top_header_columns > div:nth-of-type(4)',
                    'col_1_main_header' => '#header_columns > div:nth-of-type(1)',
                    'col_2_main_header' => '#header_columns > div:nth-of-type(2)',
                    'col_3_main_header' => '#header_columns > div:nth-of-type(3)',
                    'col_4_main_header' => '#header_columns > div:nth-of-type(4)',
                    'col_1_top_menu' => '#top_menu_columns > div:nth-of-type(1)',
                    'col_2_top_menu' => '#top_menu_columns > div:nth-of-type(2)',
                    'col_3_top_menu' => '#top_menu_columns > div:nth-of-type(3)',
                    'col_4_top_menu' => '#top_menu_columns > div:nth-of-type(4)',
                    'header_1_col' => '.header.full',
                    'header_2_col_left' => '#header-left',
                    'header_2_col_right' => '#header-right'
                );

                $final_output = '';
                foreach ($header_columns as $name => $selector) {
                        $output = '';
                        if (!empty($this->design[$name])) {
                                $output .= $backgrounds->background_padding($name);

                                if (!empty($this->design[$name]['text-align'])) {
                                        $output .= 'text-align:' . $this->design[$name]['text-align'] . ';';
                                }

                                if (!empty($this->design[$name]['zero_line_height']['zero_line_height'])) {
                                        $output .= 'line-height:0px;';
                                }

                                if ($output) {
                                        $final_output .= "\n$selector{" . $output . "}";
                                }
                        }
                }
                foreach ($header_columns as $name => $selector) {
                        $output = '';
                        if (!empty($this->design[$name])) {

                                if (!empty($this->design[$name]['zero_widget_margin']['zero_widget_margin'])) {
                                        $output .= 'margin-bottom:0px;';
                                }

                                if ($output) {
                                        $final_output .= "\n$selector .widget{" . $output . "}";
                                }
                        }
                }
                return $final_output;
        }

        public function background_styles($editor_selectors = array()) {
                global $thesis;
                $design = $this->design;
                $colors = new byob_color_values($this->design);
                $backgrounds = new byob_background_values($this->design);
                if (!empty($editor_selectors)) {
                        $selectors = $editor_selectors;
                } else {
                        $selectors = array(
                            'body_background' => 'body',
                            'top_header_area_background' => '#top_header_area',
                            'top_header_area_page_background' => '#top_header_area .page_wrapper',
                            'header_area_background' => '#header_area',
                            'header_area_page_background' => '#header_area .page_wrapper',
                            'top_menu_area_background' => '#top_menu_area',
                            'top_menu_area_page_background' => '#top_menu_area .page_wrapper',
                            'feature_box_area_background' => '#feature_box_area',
                            'feature_box_area_page_background' => '#feature_box_area .page_wrapper',
                            'content_area_background' => '#content_area',
                            'content_area_page_background' => '#content_area .page_wrapper',
                            'attention_area_background' => '#attention_area',
                            'attention_area_page_background' => '#attention_area .page_wrapper',
                            'featured_content_area_background' => '#featured_content_area',
                            'featured_content_area_page_background' => '#featured_content_area .page_wrapper',
                            'notice_bar_area_background' => '#notice_bar_area',
                            'notice_bar_area_page_background' => '#notice_bar_area .page_wrapper',
                            'phone_container' => '.phone_number',
                            'footer_top_area_background' => '#footer_area_top',
                            'footer_top_area_page_background' => '#footer_area_top .page_wrapper',
                            'footer_bottom_area_background' => '#footer_area_bottom',
                            'footer_bottom_area_page_background' => '#footer_area_bottom .page_wrapper',
                            'blockquote' => 'blockquote',
                            'sidebar_background' => '.sidebar .widget',
                            'footer_widget_background' => '#footer_area_top .widget',
                            'header_widget_background' => '#header_area .widget',
                            'feature_box_widget_background' => '#feature_box_area .widget',
                            'attention_box_widget_background' => '#attention_area .widget',
                            'supplemental_widget_background' => '.supplemental.widget',
                            'supplemental_2_widget_background' => '.supplemental-2.widget',
                            'section_title' => 'p.section_title',
                            'overlay_1_background' => '.overlay-1 .overlay',
                            'overlay_2_background' => '.overlay-2 .overlay',
                            'overlay_3_background' => '.overlay-3 .overlay',
                            'custom_1_background' => '.custom-1',
                            'custom_2_background' => '.custom-2',
                            'custom_3_background' => '.custom-3',
                            'style_1_background' => '.style-1',
                            'style_2_background' => '.style-2',
                            'style_3_background' => '.style-3',
                            'style_4_background' => '.style-4',
                            'style_5_background' => '.style-5',
                            'social_icon_style_1' => '.social_icons.style_1 i.fa.fa-fw',
                            'social_icon_style_2' => '.social_icons.style_2 i.fa.fa-fw',
                            'plain_icon' => 'i.fa',
                            'circle_positive' => 'i.fa.fa-fw.circle.positive',
                            'circle_negative' => 'i.fa.fa-fw.circle.negative',
                            'square_positive' => 'i.fa.fa-fw.square.positive',
                            'square_negative' => 'i.fa.fa-fw.square.negative',
                            'rounded_square_positive' => 'i.fa.fa-fw.rounded_square.positive',
                            'rounded_square_negative' => 'i.fa.fa-fw.rounded_square.negative',
                            'cta_1_background' => '.call-to-action.cta_1',
                            'cta_2_background' => '.call-to-action.cta_2',
                            'cta_3_background' => '.call-to-action.cta_3');
                }


                $final_output = '';
                foreach ($selectors as $name => $selector) {
                        $output = '';
                        if (!empty($this->design[$name])) {
                                if ($name === 'cta_1_background') {
                                        if (!empty($this->design[$name]['apply_to']['apply_to_content'])) {
                                                $selector .= ', #content_area .call-to-action.cta_1';
                                        }
                                }
                                if ($name === 'cta_2_background') {
                                        if (!empty($this->design[$name]['apply_to']['apply_to_content'])) {
                                                $selector .= ', #content_area .call-to-action.cta_2';
                                        }
                                }
                                if ($name === 'cta_3_background') {
                                        if (!empty($this->design[$name]['apply_to']['apply_to_content'])) {
                                                $selector .= ', #content_area .call-to-action.cta_3';
                                        }
                                }

                                if (!empty($design[$name]['background_skin_color']) || !empty($design[$name]['background-color'])) {
                                        $color = $colors->set_background_colors($name, 'background_skin_color', 'background-color');
                                        $output .= 'background-color:' . $color . ';';
                                }
                                $output .= $backgrounds->background_image($name);
                                $output .= $backgrounds->background_padding($name);
                                $output .= $backgrounds->background_margin($name);
                                $output .= $backgrounds->background_borders($name);

                                if (!empty($design[$name]['height'])) {
                                        $output .= 'height:' . $thesis->api->css->number($design[$name]['height']) . ';';
                                }

                                if ($output) {
                                        $final_output .= "\n$selector{" . $output . "}";
                                }
                        }
                }
                return $final_output;
        }

        public function submit_styles($editor_selectors = array(), $editor_hover_selectors = array()) {
                global $thesis;
                if (!empty($this->design['typ_submit']) || !empty($this->design['read_more_submit']) || !empty($this->design['cta_submit']) || !empty($this->design['cta_1_link']) || !empty($this->design['cta_3_link']) || !empty($this->design['cta_2_link'])) {
                        $fonts = new byob_font_style_values($this->design);
                        $backgrounds = new byob_background_values($this->design);
                        $colors = new byob_color_values($this->design);

                        if (empty($editor_selectors)) {
                                $submit_selectors = array(
                                    'typ_submit' => 'input#searchsubmit, input#submit, input.wpcf7-submit, input.gform_button, button, .button-primary',
                                    'read_more_submit' => '.submit a, a.read-more, .submit a.num_comments_link',
                                    'cta_submit' => '.thesis_email_form_submit, .call-to-action a, a.call-to-action',
                                    'cta_1_link' => '.call-to-action.cta_1 .cta_submit a, .call-to-action.cta_1 .thesis_email_form_submit',
                                    'cta_2_link' => '.call-to-action.cta_2 .cta_submit a, .call-to-action.cta_2 .thesis_email_form_submit',
                                    'cta_3_link' => '.call-to-action.cta_3 .cta_submit a, .call-to-action.cta_3 .thesis_email_form_submit'
                                );
                        } else {
                                $submit_selectors = $editor_selectors;
                        }
                        $final_output = '';
                        foreach ($submit_selectors as $name => $selector) {
                                $font_size = $family = false;
                                $output = '';
                                if (!empty($this->design[$name])) {
                                        // font family
                                        if (!empty($this->design[$name]['font-family'])) {
                                                $family = $fonts->font_family($name);
                                                $output .= "\n\tfont-family:$family;";
                                        }
                                        // font size
                                        if (!empty($this->design[$name]['font-size'])) {
                                                $font_size = $fonts->font_size($name, false);
                                                $output .= "\n\tfont-size:$font_size;";
                                        }
                                        // line-height
                                        if (!empty($this->design[$name]['line-height'])) {
                                                $output .= "\n\tline-height:" . $thesis->api->css->number($this->design[$name]['line-height']) . ";";
                                        }
                                        // display
                                        if (!empty($this->design[$name]['display'])) {
                                                $output .= "\n\tdisplay:" . esc_attr($this->design[$name]['display']) . ";";
                                        }
                                        // other font styles
                                        $output .= $fonts->additional_styles($name);
                                        // link styles
                                        if (!empty($this->design[$name]['link_text_skin_color']) || !empty($this->design[$name]['link_text_color'])) {
                                                $color = $colors->set_link_colors($name, 'link_text_skin_color', 'link_text_color');
                                                $output .= 'color:' . $color . ';';
                                        }
                                        if (!empty($this->design[$name]['link_background_skin_color']) || !empty($this->design[$name]['link_background_color'])) {
                                                $color = $colors->set_background_colors($name, 'link_background_skin_color', 'link_background_color');
                                                $output .= 'background-color:' . $color . ';';
                                        }

                                        $output .= $backgrounds->background_padding($name);
                                        $output .= $backgrounds->background_borders($name);

                                        if ($output) {
                                                $final_output .= "\n$selector{" . $output . "}";
                                        }
                                }
                        }
                        if (empty($editor_hover_selectors)) {
                                $submit_hover_selectors = array(
                                    'typ_submit' => 'input#searchsubmit:hover, input#submit:hover, input.wpcf7-submit:hover, input.gform_button:hover, button:hover, .button-primary:hover',
                                    'read_more_submit' => '.submit a:hover, a.read-more:hover, .submit a.num_comments_link:hover',
                                    'cta_submit' => '.thesis_email_form_submit.input_submit:hover, .call-to-action a:hover, a.call-to-action:hover',
                                    'cta_1_link' => '.call-to-action.cta_1 .cta_submit a:hover, .call-to-action.cta_1 .thesis_email_form_submit:hover',
                                    'cta_2_link' => '.call-to-action.cta_2 .cta_submit a:hover, .call-to-action.cta_2 .thesis_email_form_submit:hover',
                                    'cta_3_link' => '.call-to-action.cta_3 .cta_submit a:hover, .call-to-action.cta_3 .thesis_email_form_submit:hover'
                                );
                        } else {
                                $submit_hover_selectors = $editor_hover_selectors;
                        }

                        foreach ($submit_hover_selectors as $name => $selector) {
                                $output = '';

                                if (!empty($this->design[$name]['hover_text_skin_color']) || !empty($this->design[$name]['hover_text_color'])) {
                                        $color = $colors->set_link_colors($name, 'hover_text_skin_color', 'hover_text_color');
                                        $output .= 'color:' . $color . ';';
                                }
                                if (!empty($this->design[$name]['hover_background_skin_color']) || !empty($this->design[$name]['hover_background_color'])) {
                                        $color = $colors->set_background_colors($name, 'hover_background_skin_color', 'hover_background_color');
                                        $output .= 'background-color:' . $color . ';';
                                }

                                if ($output) {
                                        $final_output .= "\n$selector{" . $output . "}";
                                }
                        }
                        return $final_output;
                }
        }

        public function text_styles($editor_selectors = array()) {
                global $thesis;
                $fonts = new byob_font_style_values($this->design);
                $colors = new byob_color_values($this->design);
                $font_sizes = new byob_text_dimensions_calculation($this->design);
                $fm = $font_sizes->setup();
                if (!empty($editor_selectors)) {
                        $text_areas = $editor_selectors;
                } else {
                        $text_areas = array(
                            'typ_p' => array(
                                'selector' => 'p, .post_content, .post_content p, .query_list',
                                'full_selector' => '.full p, .full .post_content, .full .post_content p, .full .query_list',
                                'default_width' => 'two-thirds',
                                'scale' => 'f7'
                            ),
                            'blockquote' => array(
                                'selector' => 'blockquote, blockquote p',
                                'full_selector' => '.full blockquote, .full blockquote p',
                                'default_width' => 'two-thirds',
                                'scale' => 'f7'
                            ),
                            'section_title' => array(
                                'selector' => 'p.section_title',
                                'full_selector' => '.full p.section_title',
                                'default_width' => 'full',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'copyright' => array(
                                'selector' => '.copyright, p.copyright, .one-third .copyright, .full .copyright',
                                'default_width' => 'half',
                                'scale' => 'f7'
                            ),
                            'typ_h1' => array(
                                'selector' => 'h1, .post_content h1',
                                'full_selector' => '.full h1, .full .post_content h1',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'typ_h2' => array(
                                'selector' => 'h2, .post_content h2',
                                'full_selector' => '.full h2, .full .post_content h2, .full .post_box .post_content h2',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f3'
                            ),
                            'typ_h3' => array(
                                'selector' => 'h3, .post_content h3',
                                'full_selector' => '.full h3, .full .post_content h3',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'typ_h4' => array(
                                'selector' => 'h4, .post_content h4',
                                'full_selector' => '.full h4, .full .post_content h4',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f5'
                            ),
                            'typ_h5' => array(
                                'selector' => 'h5, .post_content h5',
                                'full_selector' => '.full h5, .full .post_content h5',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f6'
                            ),
                            'typ_h6' => array(
                                'selector' => 'h6, .post_content h6',
                                'full_selector' => '.full h6, .full .post_content h6',
                                'default_width' => 'two-thirds',
                                'heading' => true,
                                'scale' => 'f7'
                            ),
                            'custom_1_typical_text' => array(
                                'selector' => '.custom-1 p, .custom-1.post_content, .custom-1.post_content p, .custom-1.query_list, .custom-1 .post_content, .custom-1 .post_content p, .custom-1 .query_list',
                                'default_width' => 'one-third',
                                'scale' => 'f7'
                            ),
                            'custom_2_typical_text' => array(
                                'selector' => '.custom-2 p, .custom-2.post_content, .custom-2.post_content p, .custom-2.query_list, .custom-2 .post_content, .custom-2 .post_content p, .custom-2 .query_list',
                                'default_width' => 'one-third',
                                'scale' => 'f7'
                            ),
                            'custom_3_typical_text' => array(
                                'selector' => '.custom-3 p, .custom-3.post_content, .custom-3.post_content p, .custom-3.query_list, .custom-3 .post_content, .custom-3 .post_content p, .custom-3 .query_list',
                                'default_width' => 'one-third',
                                'scale' => 'f7'
                            ),
                            'custom_1_heading' => array(
                                'selector' => '.custom-1 h1, .custom-1 .headline',
                                'default_width' => 'one-third',
                                'parent' => 'custom_1_typical_text',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'custom_2_heading' => array(
                                'selector' => '.custom-2 h1, .custom-2 .headline',
                                'default_width' => 'one-third',
                                'parent' => 'custom_2_typical_text',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'custom_3_heading' => array(
                                'selector' => '.custom-3 h1, .custom-3 .headline',
                                'default_width' => 'one-third',
                                'parent' => 'custom_3_typical_text',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'custom_1_subheading' => array(
                                'selector' => '.custom-1 h2, .custom-1.post_content h2, .custom-1 .post_content h2',
                                'default_width' => 'one-third',
                                'parent' => 'custom_1_typical_text',
                                'heading' => true,
                                'scale' => 'f3'
                            ),
                            'custom_2_subheading' => array(
                                'selector' => '.custom-2 h2, .custom-2.post_content h2, .custom-2 .post_content h2',
                                'default_width' => 'one-third',
                                'parent' => 'custom_2_typical_text',
                                'heading' => true,
                                'scale' => 'f3'
                            ),
                            'custom_3_subheading' => array(
                                'selector' => '.custom-3 h2, .custom-3.post_content h2, .custom-3 .post_content h2',
                                'default_width' => 'two-thirds',
                                'parent' => 'custom_3_typical_text',
                                'heading' => true,
                                'scale' => 'f3'
                            ),
                            'custom_1_subsubheading' => array(
                                'selector' => '.custom-1 h3, .custom-1.post_content h3, .custom-1 .post_content h3',
                                'default_width' => 'one-third',
                                'parent' => 'custom_1_typical_text',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'custom_2_subsubheading' => array(
                                'selector' => '.custom-2 h3, .custom-2.post_content h3, .custom-2 .post_content h3',
                                'default_width' => 'one-third',
                                'parent' => 'custom_2_typical_text',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'custom_3_subsubheading' => array(
                                'selector' => '.custom-3 h3, .custom-3.post_content h3, .custom-3 .post_content h3',
                                'default_width' => 'one-third',
                                'parent' => 'custom_3_typical_text',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'custom_1_section_title' => array(
                                'selector' => '.custom-1 p.section_title',
                                'default_width' => 'full',
                                'parent' => 'custom_1_typical_text',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'custom_2_section_title' => array(
                                'selector' => '.custom-2 p.section_title',
                                'default_width' => 'full',
                                'parent' => 'custom_1_typical_text',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'custom_3_section_title' => array(
                                'selector' => '.custom-3 p.section_title',
                                'default_width' => 'full',
                                'parent' => 'custom_1_typical_text',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'sidebar' => array(
                                'selector' => '.widget, .widget p',
                                'default_width' => 'one-third',
                                'scale' => 'f7'
                            ),
                            'sidebar_heading' => array(
                                'selector' => '.widget .widget_title',
                                'default_width' => 'one-third',
                                'parent' => 'sidebar',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'footer_widget' => array(
                                'selector' => '#footer_area_top .widget, #footer_area_top .widget p, #footer_area_bottom .widget, #footer_area_bottom .widget p',
                                'default_width' => 'one-quarter',
                                'scale' => 'f7'
                            ),
                            'footer_widget_heading' => array(
                                'selector' => '#footer_area_top .widget .widget_title, #footer_area_bottom .widget .widget_title',
                                'default_width' => 'one-quarter',
                                'parent' => 'footer_widget',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'header_widget' => array(
                                'selector' => '#header_area .header_widget, #header_area .header_widget p, #header_area .widget, #header_area .widget p',
                                'default_width' => 'one-third',
                                'scale' => 'f7'
                            ),
                            'header_widget_heading' => array(
                                'selector' => '#header_area .widget .widget_title',
                                'default_width' => 'one-third',
                                'parent' => 'header_widget',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'feature_box_widget' => array(
                                'selector' => '#feature_box_area .widget, #feature_box_area .widget p',
                                'default_width' => 'one-third',
                                'scale' => 'f7'
                            ),
                            'feature_box_widget_heading' => array(
                                'selector' => '#feature_box_area .widget .widget_title',
                                'default_width' => 'one-third',
                                'parent' => 'feature_box_widget',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'attention_box_widget' => array(
                                'selector' => '#attention_area .widget, #attention_area .widget p',
                                'default_width' => 'one-third',
                                'scale' => 'f7'
                            ),
                            'attention_box_widget_heading' => array(
                                'selector' => '#attention_area .widget .widget_title',
                                'default_width' => 'one-third',
                                'parent' => 'attention_box_widget',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'query_box_headline' => array(
                                'selector' => '.query_box .headline',
                                'default_width' => 'one-third',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'fc_box_headline' => array(
                                'selector' => '.query_box.attention_box .headline',
                                'default_width' => 'one-third',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'icon_box_headline' => array(
                                'selector' => '.query_box.icon_box .headline',
                                'default_width' => 'one-third',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'phone_heading' => array(
                                'selector' => '.phone_number .heading',
                                'default_width' => 'one-third',
                                'parent' => 'sidebar',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'supplemental_widget' => array(
                                'selector' => '.supplemental.widget, .supplemental.widget p',
                                'default_width' => 'one-third',
                                'scale' => 'f7'
                            ),
                            'supplemental_widget_heading' => array(
                                'selector' => '.supplemental.widget .widget_title',
                                'default_width' => 'one-third',
                                'parent' => 'supplemental_widget',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'supplemental_2_widget' => array(
                                'selector' => '.supplemental-2.widget, .supplemental-2.widget p',
                                'default_width' => 'one-third',
                                'scale' => 'f7'
                            ),
                            'supplemental_2_widget_heading' => array(
                                'selector' => '.supplemental-2.widget .widget_title',
                                'default_width' => 'one-third',
                                'parent' => 'supplemental_widget',
                                'heading' => true,
                                'scale' => 'f4'
                            ),
                            'cta_1_message' => array(
                                'selector' => '.cta_1.call-to-action p.message, .cta_1 .thesis_email_form, .cta_1 .email_form_intro',
                                'default_width' => 'two-thirds',
                                'scale' => 'f5'
                            ),
                            'cta_1_heading' => array(
                                'selector' => '.call-to-action.cta_1 .heading, .overlay .call-to-action.cta_1 .heading, .cta_1 .email_form_title',
                                'default_width' => 'two-thirds',
                                'parent' => 'cta_1_message',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'cta_1_label' => array(
                                'selector' => '.cta_1 .thesis_email_form label',
                                'default_width' => 'two-thirds',
                                'parent' => 'cta_1_message',
                                'scale' => 'f5'
                            ),
                            'cta_2_message' => array(
                                'selector' => '.cta_2.call-to-action p.message, .cta_2 .thesis_email_form, .cta_2 .email_form_intro',
                                'default_width' => 'two-thirds',
                                'scale' => 'f5'
                            ),
                            'cta_2_heading' => array(
                                'selector' => '.call-to-action.cta_2 .heading, .overlay .call-to-action.cta_2 .heading, .cta_2 .email_form_title',
                                'default_width' => 'two-thirds',
                                'parent' => 'cta_2_message',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'cta_2_label' => array(
                                'selector' => '.cta_2 .thesis_email_form label',
                                'default_width' => 'two-thirds',
                                'parent' => 'cta_2_message',
                                'scale' => 'f5'
                            ),
                            'cta_3_message' => array(
                                'selector' => '.cta_3.call-to-action p.message, .cta_3 .thesis_email_form, .cta_3 .email_form_intro',
                                'default_width' => 'two-thirds',
                                'scale' => 'f5'
                            ),
                            'cta_3_heading' => array(
                                'selector' => '.call-to-action.cta_3 .heading, .overlay .call-to-action.cta_3 .heading, .cta_3 .email_form_title',
                                'default_width' => 'two-thirds',
                                'parent' => 'cta_3_message',
                                'heading' => true,
                                'scale' => 'f2'
                            ),
                            'cta_3_label' => array(
                                'selector' => '.cta_3 .thesis_email_form label',
                                'default_width' => 'two-thirds',
                                'parent' => 'cta_3_message',
                                'scale' => 'f5'
                            )
                        );
                }

                $final_output = '';
                foreach ($text_areas as $area => $settings) {
                        $output = $full_output = '';
                        $font_size = $line_height = $default_line_height = $family = false;
                        $column_width = 'one-third';

                        // determine if heading or text
                        // set both type and default font family
                        if (!empty($settings['heading'])) {
                                $type = 'heading';
                                $default_font_family = $font_sizes->heading_font_family;
                        } else {
                                $type = 'primary';
                                $default_font_family = $font_sizes->primary_font_family;
                        }


                        // set the column width
                        //first - is there a setting for this area
                        if (!empty($this->design[$area]['column_width'])) {
                                $column_width = $this->design[$area]['column_width'];
                        } elseif (!empty($settings['parent']) && !empty($this->design[$settings['parent']]['column_width'])) {
                                //second - is there a setting for this area's parent
                                $column_width = $this->design[$settings['parent']]['column_width'];
                        } elseif (!empty($settings['default_width'])) {
                                // third is there a default for this area
                                $column_width = $settings['default_width'];
                        }

                        if (!empty($this->design[$area]['font-family']) || !empty($this->design[$area]['font-size']) || !empty($this->design[$area]['line-height'])) {

                                // set the font family variable & output the specified font family
                                if (!empty($this->design[$area]['font-family'])) {
                                        $font_family = $this->design[$area]['font-family'];
                                        $formatted_family = $thesis->api->fonts->family($font_family);

                                        $output .= "\n\tfont-family:$formatted_family;";
                                } else {
                                        $font_family = $default_font_family;
                                }

                                // set the font size.
                                // If a font size is specified use it, otherwise
                                // if a font family is specified - get the default font size for the column width
                                if (!empty($this->design[$area]['font-size']) && is_numeric($this->design[$area]['font-size'])) {
                                        $font_size = $this->design[$area]['font-size'];
                                        $formatted_font_size = $thesis->api->css->number($font_size);

                                        // calculate the full font size
                                        // pass the font matrix ($fm), column width, scale, specified font size -
                                        // returns an integer
                                        $full_font_size = $this->get_full_font_size($fm, $type, $column_width, $settings['scale'], $this->design[$area]['font-size']);
                                        $formatted_full_font_size = $thesis->api->css->number($full_font_size);
                                        $default_line_height = $fm[$type][$column_width][$settings['scale']]['line_height'];

                                        $output .= "\n\tfont-size:$formatted_font_size;";
                                        $full_output .= "\n\tfont-size:$formatted_full_font_size;";

                                        // if there is no font size specified but there is a font family specified
                                        // get the default font size and use it
                                } elseif (!empty($this->design[$area]['font-family'])) {
                                        $font_size = $fm[$type][$column_width][$settings['scale']]['font_size'];
                                        $formatted_font_size = $thesis->api->css->number($font_size);

                                        // calculate the full font size,
                                        // pass the font matrix ($fm), column width, scale, specified font size -
                                        // returns an integer
                                        $full_font_size = $fm[$type]['full'][$settings['scale']]['font_size'];
                                        $formatted_full_font_size = $thesis->api->css->number($full_font_size);

                                        $default_line_height = $fm[$type][$column_width][$settings['scale']]['line_height'];

                                        $output .= "\n\tfont-size:$formatted_font_size;";
                                        $full_output .= "\n\tfont-size:$formatted_full_font_size;";
                                }



                                // get the line height
                                // send the design option id ($area), the default line height, the column configuration and
                                // the type of line height calculation to use
                                // returns a formatted line height

                                if (!empty($this->design[$area]['line-height'])) {

                                        $line_height = $thesis->api->css->number($this->design[$area]['line-height']);
                                        $full_line_height = $thesis->api->css->number($fonts->calculate_line_height_from_givens($font_family, $full_font_size, 'full', $type));
                                } else {

                                        $line_height = $fonts->line_height($area, $default_line_height, $column_width, $type, $font_size);
                                        $full_line_height = $thesis->api->css->number($fonts->calculate_line_height_from_givens($font_family, $full_font_size, 'full', $type));
                                }

                                if ($line_height) {
                                        $output .= "\n\tline-height: $line_height;";
                                }
                                if ($full_line_height) {
                                        $full_output .= "\n\tline-height: $full_line_height;";
                                }
                        }

                        $default_color = !empty($settings['default_color']) ? $settings['default_color'] : false;
                        $color = $colors->set_color($area, $default_color);
                        if ($color) {
                                $output .= "\n\tcolor: $color;";
                        }


                        $output .= $fonts->additional_styles($area);


                        if ($output) {
                                $selector = $settings['selector'];
                                $final_output .= "\n$selector{" . $output . "}";
                        }
                        if ($full_output && !empty($settings['full_selector'])) {
                                $selector = $settings['full_selector'];
                                $final_output .= "\n$selector{" . $full_output . "}";
                        }
                }
//                update_option('byob_agility', $test);
                return $final_output;
        }

        public function get_full_font_size($fm, $type, $column_width, $scale, $specified_font_size) {
                $default_font_size = $fm[$type][$column_width][$scale]['font_size'];
                $default_full_font_size = $fm[$type]['full'][$scale]['font_size'];

                //calculate the ratio of the difference between the default font size and the default full font size
                $ratio = $default_full_font_size / $default_font_size;

                // apply that ratio to the specified font size to proportionally increase the font for full width situations
                $new_full_font_size = round($specified_font_size * $ratio);
                return $new_full_font_size;
        }

        public function link_styles($editor_selectors = array()) {
                $links = new byob_font_style_values($this->design);
                if (empty($editor_selectors)) {
                        $text_area_links = array(
                            'typ_links' => 'a',
                            'custom_1_links' => '.custom-1 a, .custom-1.post_content a, .custom-1.query_list a',
                            'custom_2_links' => '.custom-2 a, .custom-2.post_content a, .custom-2.query_list a',
                            'custom_3_links' => '.custom-3 a, .custom-1.post_content a, .custom-3.query_list a,',
                            'custom_1_heading' => '.custom-1 h1 a, .custom-1 .headline a',
                            'custom_2_heading' => '.custom-2 h1 a, .custom-2 .headline a',
                            'custom_3_heading' => '.custom-3 h1 a, .custom-3 .headline a',
                            'sidebar_widget_links' => '.widget a',
                            'footer_widget_links' => '#footer_area_top .widget a, #footer_area_bottom .widget a',
                            'header_widget_links' => '#header_area .header_widget a, #header_area .widget a',
                            'feature_box_widget_links' => '#feature_box_area .widget a',
                            'attention_box_widget_links' => '#attention_area .widget a',
                            'phone_link' => '.phone_link a',
                            'supplemental_widget_links' => '.supplemental.widget a',
                            'supplemental_2_widget_links' => '.supplemental-2.widget a',
                            'headline' => '.home_archive.post_box .headline a, .post_box .headline a',
                            'query_box_headline' => '.query_box .headline a',
                            'fc_box_headline' => '.query_box.attention_box .headline a',
                            'icon_box_headline' => '.query_box.icon_box .headline a'
                        );
                } else {
                        $text_area_links = $editor_selectors;
                }
                $final_output = '';
                foreach ($text_area_links as $area => $selector) {
                        $output = '';
                        $output .= $links->link_styles($area, 'link');
                        if ($output) {
                                $final_output .= "\n$selector{" . $output . "}";
                        }
                }
                return $final_output;
        }

        public function hover_styles($editor_selectors = array()) {
                $links = new byob_font_style_values($this->design);
                if (empty($editor_selectors)) {
                        $text_area_links = array(
                            'typ_links' => 'a:hover',
                            'custom_1_links' => '.custom-1 a:hover, .custom-1.post_content a:hover, .custom-1.query_list a:hover',
                            'custom_2_links' => '.custom-2 a:hover, .custom-2.post_content a:hover, .custom-2.query_list a:hover',
                            'custom_3_links' => '.custom-3 a:hover, .custom-1.post_content a:hover, .custom-3.query_list a:hover,',
                            'sidebar_widget_links' => '.widget a:hover',
                            'footer_widget_links' => '#footer_area_top .widget a:hover, #footer_area_bottom .widget a:hover',
                            'header_widget_links' => '#header_area .header_widget a:hover, #header_area .widget a:hover',
                            'feature_box_widget_links' => '#feature_box_area .widget a:hover',
                            'attention_box_widget_links' => '#attention_area .widget a:hover',
                            'phone_link' => '.phone_link a:hover',
                            'supplemental_widget_links' => '.supplemental.widget a:hover',
                            'supplemental_2_widget_links' => '.supplemental-2.widget a:hover',
                            'headline' => '.home_archive.post_box .headline a:hover, .post_box .headline a:hover'
                        );
                } else {
                        $text_area_links = $editor_selectors;
                }
                $final_output = '';
                foreach ($text_area_links as $area => $selector) {
                        $output = '';
                        $output .= $links->link_styles($area, 'hover');
                        if ($output) {
                                $final_output .= "\n$selector{" . $output . "}";
                        }
                }
                return $final_output;
        }

        public function list_styles($editor_selectors = array()) {
                $lists = new byob_font_style_values($this->design);
                if (empty($editor_selectors)) {
                        $text_area_lists = array(
                            'typ_lists' => '.post_box ul',
                            'custom_1_lists' => '.custom-1 ul, .custom-1.post_content ul',
                            'custom_2_lists' => '.custom-2 ul, .custom-2.post_content ul',
                            'custom_3_lists' => '.custom-2 ul, .custom-2.post_content ul',
                            'sidebar_widget_lists' => '.widget ul',
                            'footer_widget_lists' => '#footer_area_top .widget ul, #footer_area_bottom .widget ul',
                            'header_widget_lists' => '#header_area .header_widget ul, #header_area .widget ul',
                            'feature_box_widget_lists' => '#feature_box_area .widget ul',
                            'attention_box_widget_lists' => '#attention_area .widget ul',
                            'supplemental_widget_lists' => '.supplemental.widget ul',
                            'supplemental_widget_lists' => '.supplemental-2.widget ul',
                        );
                } else {
                        $text_area_lists = $editor_selectors;
                }
                $final_output = '';
                foreach ($text_area_lists as $area => $selector) {
                        $output = '';
                        $output .= $lists->list_styles($area);
                        if ($output) {
                                $final_output .= "\n$selector{" . $output . "}";
                        }
                }
                return $final_output;
        }

        public function list_item_styles($editor_selectors = array()) {
                $list_items = new byob_font_style_values($this->design);
                if (empty($editor_selectors)) {
                        $text_area_lists = array(
                            'typ_lists' => '.post_box li',
                            'custom_1_lists' => '.custom-1 li, .custom-1.post_content li',
                            'custom_2_lists' => '.custom-2 li, .custom-2.post_content li',
                            'custom_3_lists' => '.custom-2 li, .custom-2.post_content li',
                            'sidebar_widget_lists' => '.widget li',
                            'footer_widget_lists' => '#footer_area_top .widget li, #footer_area_bottom .widget li',
                            'header_widget_lists' => '#header_area .header_widget li, #header_area .widget li',
                            'feature_box_widget_lists' => '#feature_box_area .widget li',
                            'attention_box_widget_lists' => '#attention_area .widget li',
                            'supplemental_widget_lists' => '.supplemental.widget li',
                            'supplemental_widget_lists' => '.supplemental-2.widget li',
                        );
                } else {
                        $text_area_lists = $editor_selectors;
                }
                $final_output = '';
                foreach ($text_area_lists as $area => $selector) {
                        $output = '';
                        $output .= $list_items->list_item_styles($area);
                        if ($output) {
                                $final_output .= "\n$selector{" . $output . "}";
                        }
                }

                return $final_output;
        }

        public function list_item_icon_styles($editor_selectors = array()) {
                $list_items = new byob_font_style_values($this->design);
                if (empty($editor_selectors)) {
                        $text_area_lists = array(
                            'typ_lists' => '.post_box li:before',
                            'custom_1_lists' => '.custom-1 li:before, .custom-1.post_content li:before',
                            'custom_2_lists' => '.custom-2 li:before, .custom-2.post_content li:before',
                            'custom_3_lists' => '.custom-2 li:before, .custom-2.post_content li:before',
                            'sidebar_widget_lists' => '.widget li:before',
                            'footer_widget_lists' => '#footer_area_top .widget li:before, #footer_area_bottom .widget li:before',
                            'header_widget_lists' => '#header_area .header_widget li:before, #header_area .widget li:before',
                            'feature_box_widget_lists' => '#feature_box_area .widget li:before',
                            'attention_box_widget_lists' => '#attention_area .widget li:before',
                            'supplemental_widget_lists' => '.supplemental.widget li:before',
                            'supplemental_widget_lists' => '.supplemental-2.widget li:before',
                        );
                } else {
                        $text_area_lists = $editor_selectors;
                }
                $final_output = '';

                foreach ($text_area_lists as $area => $selector) {
                        $output = '';
                        $output .= $list_items->list_item_icon_styles($area);
                        if ($output) {
                                $final_output .= "\n$selector{" . $output . "}";
                        }
                }
                return $final_output;
        }

        public function label_styles() {
                $margin = new byob_background_values($this->design);
                $align = new byob_font_style_values($this->design);
                $labels = array(
                    'cta_1_label' => '.cta_1 .thesis_email_form label',
                    'cta_2_label' => '.cta_2 .thesis_email_form label',
                    'cta_3_label' => '.cta_3 .thesis_email_form label',
                );
                $final_output = '';
                foreach ($labels as $area => $selector) {
                        $output = '';
                        $output .= $margin->background_margin($area);
                        $output .= $align->vertical_alignment_styles($area);
                        if ($output) {
                                $final_output .= "\n$selector{" . $output . "}";
                        }
                }
                return $final_output;
        }

        public function icon_styles() {

                $color = new byob_color_values($this->design);
                $icons = array(
                    'plain_icon' => 'i.fa',
                    'circle_positive' => 'i.fa.fa-fw.circle.positive',
                    'circle_negative' => 'i.fa.fa-fw.circle.negative',
                    'square_positive' => 'i.fa.fa-fw.square.positive',
                    'square_negative' => 'i.fa.fa-fw.square.negative',
                    'rounded_square_positive' => 'i.fa.fa-fw.rounded_square.positive',
                    'rounded_square_negative' => 'i.fa.fa-fw.rounded_square.negative'
                );
                $final_output = '';
                foreach ($icons as $area => $selector) {
                        $output = '';
                        $output .= $color->set_color($area);
                        if ($output) {
                                $final_output .= "\n$selector{color:" . $output . "}";
                        }
                }
                return $final_output;
        }

        public function social_icon_styles() {
                global $thesis;

                $colors = new byob_color_values($this->design);
                $icons = array(
                    'social_icon_style_1' => '.social_icons.style_1 i.fa.fa-fw',
                    'social_icon_style_2' => '.social_icons.style_2 i.fa.fa-fw',
                );
                $final_output = '';
                foreach ($icons as $area => $selector) {
                        $output = '';

                        $font_size = !empty($this->design[$area]['font-size']) ? $thesis->api->css->number($this->design[$area]['font-size']) : false;
                        if ($font_size) {
                                $output .= "\n\tfont-size:$font_size;";
                        }

                        $color = $colors->set_color($area, false);
                        if ($color) {
                                $output .= "\n\tcolor: $color;";
                        }

                        if ($output) {
                                $final_output .= "\n$selector{" . $output . "}";
                        }
                }
                return $final_output;
        }

}
