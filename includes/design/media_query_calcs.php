<?php

/**
 * Description of media_query_calcs
 *
 * @author Rick
 */
class media_query_calcs {

        public $design = array();
        public $spacing_constant = 26;
        public $desktop_matrix = array();
        public $spacing_matrix = array();
        public $desktop_width = 1032;
        public $content_width = 640;
        public $full_content_width = 980;
        public $content_column_config = 'two-thirds';
        public $sidebar_column_config = 'one-third';
        public $primary_font_size = 16;
        public $fm = array(); // stands for "font matrix"

        public function __construct($design) {
                $this->design = $design;
                $sizes = new byob_text_dimensions_calculation($this->design);
                $this->desktop_matrix = $sizes->column_fonts;
                $this->fm = $sizes->setup();
                $this->desktop_width = !empty($this->design['desktop_width']['width']) ? $this->design['desktop_width']['width'] : 1032;
                $this->content_column_config = !empty($this->design['content_width']['width']) ? $this->design['content_width']['width'] : 'two-thirds';
                $this->sidebar_column_config = !empty($this->design['sidebar_width']['width']) ? $this->design['sidebar_width']['width'] : 'one-third';
                $this->full_content_width = !empty($this->desktop_matrix[$this->desktop_width]['full']['column_width']) ? $this->desktop_matrix[$this->desktop_width]['full']['column_width'] : 980;
                $this->content_width = !empty($this->desktop_matrix[$this->desktop_width][$this->content_column_config]['column_width']) ? $this->desktop_matrix[$this->desktop_width][$this->content_column_config]['column_width'] : 640;
                $this->primary_font_size = $sizes->primary_font_size;
                $this->primary_font_family = !empty($this->design['primary_font_family']) ? $this->design['primary_font_family'] : 'arial';
                $this->heading_font_family = !empty($this->design['heading_font_family']) ? $this->design['heading_font_family'] : 'arial';
        }

        public function media_query_list() {
                $mq = '';
                switch ($this->desktop_width) {
                        case 1920:
                                $mq .= $this->mq_1281();
                                $mq .= $this->mq_1141();
                                $mq .= $this->mq_1024();
                                break;
                        case 1280:
                                $mq .= $this->mq_1141();
                                $mq .= $this->mq_1024();
                                break;
                        case 1140:
                                $mq .= $this->mq_1024();
                                break;
                        case 1032:
                                $mq .= $this->mq_1024();
                                break;
                }
                $mq .= $this->mq_800();
                $mq .= $this->mq_699();
                $mq .= $this->mq_415();

                return $mq;
        }

        public function set_spacing_constant($custom_query_options, $desktop_width) {
                $custom = !empty($this->design[$custom_query_options]) ? $this->design[$custom_query_options] : false;
                $primary_sizes = new byob_text_dimensions_calculation($this->design);
                $matrix = $primary_sizes->setup($desktop_width);
                $default = $this->set_font_elements($matrix, $this->content_column_config, $this->sidebar_column_config);

                if (!empty($custom['mq_typ_p']) && is_numeric($custom['mq_typ_p'])) {
                        $primary_font_sizes['primary'] = $custom['mq_typ_p'];
                        $primary_font_sizes['primary_100'] = $custom['mq_typ_p'] + 2;
                } else {
                        $primary_font_sizes['primary'] = $default['paragraph']['font-size'];
                        $primary_font_sizes['primary_100'] = $default['paragraph_100']['font-size'];
                }
                if (!empty($custom['mq_sidebar_p']) && is_numeric($custom['mq_sidebar_p'])) {
                        $primary_font_sizes['sidebar'] = $custom['mq_sidebar_p'];
                } else {
                        $primary_font_sizes['sidebar'] = $default['sidebar']['font-size'];
                }

                foreach ($primary_font_sizes as $name => $size) {
                        $spacing[$name] = round($size * 1.616);
                }
                return $spacing;
        }

        public function mq_1281() {
                global $thesis;
                $use_default = false;
                $custom = !empty($this->design['mq_desktop_1280']) ? $this->design['mq_desktop_1280'] : false;
                $spacing_constants = $this->set_spacing_constant('mq_desktop_1280', 1280);

                $output = '';
                $output .= $this->content_font_rules($custom, $use_default, $desktop_width = 1280, $spacing_constants);
                $output .= $this->sidebar_font_rules($custom, $use_default, $desktop_width = 1280, $spacing_constants);
                $output .= $this->custom_code($custom);


                if (!empty($output)) {
                        $final_output = "\n@media only screen and (max-width:1281px), screen and (max-device-width:1281px){";
                        $final_output .= $output;
                        $final_output .= "\n}\n";
                        return $final_output;
                }
        }

        public function mq_1141() {
                global $thesis;
                $use_default = $this->desktop_width == 1920 ? true : false;
                $custom = !empty($this->design['mq_desktop_1140']) ? $this->design['mq_desktop_1140'] : false;
                $spacing_constants = $this->set_spacing_constant('mq_desktop_1140', 1140);

                $output = '';
                $output .= $this->content_font_rules($custom, $use_default, $desktop_width = 1140, $spacing_constants);
                $output .= $this->sidebar_font_rules($custom, $use_default, $desktop_width = 1140, $spacing_constants);
                $output .= $this->container_rules($spacing_constants);
                $output .= $this->custom_code($custom);


                if (!empty($output)) {
                        $final_output = "\n@media only screen and (max-width:1141px), screen and (max-device-width:1141px){";
                        $final_output .= $output;
                        $final_output .= "\n}\n";
                        return $final_output;
                }
        }

        public function mq_1024() {
                global $thesis;
                $use_default = ($this->desktop_width == 1920 || $this->desktop_width == 1280 ) ? true : false;
                $custom = !empty($this->design['mq_tablet_lanscape']) ? $this->design['mq_tablet_lanscape'] : false;
                $spacing_constants = $this->set_spacing_constant('mq_tablet_lanscape', 1024);

                $output = '';
                $output .= $this->static_media_query_1024($spacing_constants);
                $output .= $this->content_font_rules($custom, $use_default, $desktop_width = 1024, $spacing_constants);
                $output .= $this->sidebar_font_rules($custom, $use_default, $desktop_width = 1024, $spacing_constants);
                $output .= $this->container_rules($spacing_constants);
                $output .= $this->custom_code($custom);


                if (!empty($output)) {
                        $final_output = "\n@media only screen and (max-width:1024px), screen and (max-device-width:1024px) and (orientation:landscape){\n";
                        $final_output .= $output;
                        $final_output .= "\n}\n";
                        return $final_output;
                }
        }

        public function mq_800() {
                global $thesis;
                $use_default = true;
                $text_areas = array();
                $custom_text_areas = array(
                    'custom_1_typical_text' => 'custom_1_mq_800',
                    'custom_2_typical_text' => 'custom_2_mq_800',
                    'custom_3_typical_text' => 'custom_3_mq_800');
                $text_areas = $this->setup_text_areas($custom_text_areas);

                $custom = !empty($this->design['mq_tablet_portrait']) ? $this->design['mq_tablet_portrait'] : false;
                $spacing_constants = $this->set_spacing_constant('mq_tablet_portrait', 800);

                $output = '';
                $output .= $this->static_media_query_800($spacing_constants);
                $output .= $this->content_font_rules($custom, $use_default, $desktop_width = 800, $spacing_constants);
                $output .= $this->sidebar_font_rules($custom, $use_default, $desktop_width = 800, $spacing_constants);
                if (!empty($text_areas)) {
                        $output .= $this->custom_text_area_rules($text_areas, false, $desktop_width = 800, $spacing_constants);
                }
                $output .= $this->container_rules($spacing_constants);
                $output .= $this->custom_code($custom);

                if (!empty($output)) {
                        $final_output = "\n@media only screen and (max-width:800px), screen and (max-device-width:800px) and (orientation:portrait){\n";
                        $final_output .= $output;
                        $final_output .= "\n}\n";
                        return $final_output;
                }
        }

        public function mq_699() {
                global $thesis;
                $use_default = true;
                $custom = !empty($this->design['mq_phone_lanscape']) ? $this->design['mq_phone_lanscape'] : false;
                $spacing_constants = $this->set_spacing_constant('mq_phone_lanscape', 699);
                $text_areas = array();
                $custom_text_areas = array(
                    'custom_1_typical_text' => 'custom_1_mq_699',
                    'custom_2_typical_text' => 'custom_2_mq_699',
                    'custom_3_typical_text' => 'custom_3_mq_699');
                $text_areas = $this->setup_text_areas($custom_text_areas);

                $output = '';
                $output .= $this->static_media_query_699($spacing_constants);
                $output .= $this->content_font_rules($custom, $use_default, $desktop_width = 699, $spacing_constants);
                $output .= $this->sidebar_font_rules($custom, $use_default, $desktop_width = 699, $spacing_constants);
                if (!empty($text_areas)) {
                        $output .= $this->custom_text_area_rules($text_areas, false, $desktop_width = 699, $spacing_constants);
                }
                $output .= $this->custom_code($custom);

                if (!empty($output)) {
                        $final_output = "\n@media only screen and (max-width:699px),  screen and (max-device-width:699px){\n";
                        $final_output .= $output;
                        $final_output .= "\n}\n";
                        return $final_output;
                }
        }

        public function mq_415() {
                global $thesis;
                $use_default = true;
                $custom = !empty($this->design['mq_phone_portrait']) ? $this->design['mq_phone_portrait'] : false;
                $spacing_constants = $this->set_spacing_constant('mq_phone_portrait', 415);
                $text_areas = array();
                $custom_text_areas = array(
                    'custom_1_typical_text' => 'custom_1_mq_415',
                    'custom_2_typical_text' => 'custom_2_mq_415',
                    'custom_3_typical_text' => 'custom_3_mq_415');
                $text_areas = $this->setup_text_areas($custom_text_areas);

                $output = '';
                $output .= $this->static_media_query_415($spacing_constants);
                $output .= $this->content_font_rules($custom, $use_default, $desktop_width = 415, $spacing_constants);
                $output .= $this->sidebar_font_rules($custom, $use_default, $desktop_width = 415, $spacing_constants);
                if (!empty($text_areas)) {
                        $output .= $this->custom_text_area_rules($text_areas, false, $desktop_width = 415, $spacing_constants);
                }
                $output .= $this->custom_code($custom);

                if (!empty($output)) {
                        $final_output = "\n@media only screen and (max-width:415px), screen and (max-device-width:415px) and (orientation:landscape){\n";
                        $final_output .= $output;
                        $final_output .= "\n\t.page_wrapper .full, .half, .page_wrapper .one-quarter, .page_wrapper .one-third, .page_wrapper .two-thirds, .page_wrapper .three-quarters{padding:0;}\n";
                        $final_output .= "\n}\n";
                        return $final_output;
                }
        }

        public function setup_text_areas($custom_text_areas) {
                $text_areas = array();
                $count = 0;
                foreach ($custom_text_areas as $text_area => $mq) {
                        $count ++;
                        $column_config = !empty($this->design[$text_area]['column_width']) ? $this->design[$text_area]['column_width'] : 'one-third';
                        $context = 'primary';
                        switch ($column_config) {
                                case 'full':
                                        $context = 'primary_100';
                                        break;
                                case 'one-third':
                                case 'one-quarter':
                                        $context = 'sidebar';
                                        break;
                        }
                        if (!empty($this->design[$mq])) {
                                $text_areas[$mq] = $this->design[$mq];
                                $text_areas[$mq]['column_config'] = $column_config;
                                $text_areas[$mq]['context'] = $context;
                                $text_areas[$mq]['prefix'] = substr($text_area, 0, 9);
                                $text_areas[$mq]['no'] = $count;
                        }
                }
                return $text_areas;
        }

        public function custom_code($custom) {
                $custom_code = !empty($custom['code']) ? stripslashes($custom['code']) : '';
                return $custom_code;
        }

        public function container_rules($spacing_constants) {
                global $thesis;
                $container = new byob_text_dimensions_calculation();
                $typ_spacing_matrix = $container->space($spacing_constants['primary']);
                $full_spacing_matrix = $container->space($spacing_constants['primary_100']);
                $margin_half = $thesis->api->css->number($typ_spacing_matrix['x05']);
                $margin_full = $thesis->api->css->number($typ_spacing_matrix['x1']);
                $margin_32 = $thesis->api->css->number($typ_spacing_matrix['x15']);
                $margin_double = $thesis->api->css->number($typ_spacing_matrix['x2']);
                $full_margin_half = $thesis->api->css->number($full_spacing_matrix['x05']);
                $full_margin_full = $thesis->api->css->number($full_spacing_matrix['x1']);
                $full_margin_32 = $thesis->api->css->number($full_spacing_matrix['x15']);
                $full_margin_double = $thesis->api->css->number($full_spacing_matrix['x2']);

                $output = "\n\t.columns_1, .columns_2, .columns_3, .columns_4, .columns_321, .columns_312, .columns_431, .columns_413, .sub_columns_2, .sub_columns_3, .sub_columns_4{padding:$margin_full 0;}\n";
                $output .= "\n\t.full{padding:0 $margin_full;}\n";
                $output .= "\n\t.half, .one-quarter, .columns_4112 .reverse_wrapper, .one-third, .columns_4121 .reverse_wrapper .one-quarter, .columns_4112 .reverse_wrapper .one-quarter{padding:0 $margin_half;}\n";
                $output .= "\n\t.two-thirds, .columns_4121 .reverse_wrapper .half, .three-quarters {padding:0 $margin_full 0 $margin_half;}\n";
                $output .= "\n\t.headline_area{margin-bottom:$margin_full;}\n";
                $output .= "\n\t.post_box .left, .post_box .alignleft, .post_box .ad_left{margin-bottom:$margin_full; margin-right: $margin_full;}\n";
                $output .= "\n\t.post_box .right, .post_box .alignright, .post_box .ad {margin-bottom:$margin_full; margin-left: $margin_full;}\n";
                $output .= "\n\t.post_box .center, .post_box .aligncenter, .post_box .block, .post_box .alignnone, blockquote {margin-bottom:$margin_full;}\n";
                $output .= "\n\t.post_box .stack {margin-left:$margin_full;}\n";
                $output .= "\n\t.home_archive.post_box p.post_cats, .home_archive.post_box .headline_area{margin-bottom:$margin_half;}\n";
                $output .= "\n\t.home_archive.post_box .post_footer{margin-top:$margin_full;}\n";
                $output .= "\n\t.home_archive.post_box{margin-bottom:$margin_32;}\n";
                $output .= "\n\t.full .post_box .left, .full .post_box .alignleft, .full .post_box .ad_left {margin-bottom:$full_margin_full; margin-right: $full_margin_full;}\n";
                $output .= "\n\t.full .post_box .right, .full .post_box .alignright, .full .post_box .ad {margin-bottom:$full_margin_full; margin-left: $full_margin_full;}\n";
                $output .= "\n\t.full .post_box .center, .full .post_box .aligncenter, .full .post_box .block, .full .post_box .alignnone {margin-bottom:$full_margin_full;}\n";
                $output .= "\n\t.full .post_box .stack{margin-left:$full_margin_full;}\n";

                // Misc
                $output .= "\n\t.comment{margin-top:$margin_full;}\n";
                $output .= "\n\t.children .comment{padding-left:$margin_half;}\n";
                $output .= "\n\t.comment .comment_text ul, .comment .comment_text ol { margin-left: $margin_full; }\n";
                $output .= "\n\t.comment p, .comment .comment_text ul, .comment .comment_text ol, .comment .comment_text blockquote, .comment .comment_text pre { margin-bottom: $margin_full; }\n";
                $output .= "\n\t.comment .comment_text li ul, .comment .comment_text li ol { margin-left: $margin_full;}\n";
                $output .= "\n\t.comment .comment_text .left, .comment .comment_text .alignleft { margin-bottom: $margin_full; 	margin-right: $margin_full; }\n";
                $output .= "\n\t.comment .comment_text .right, .comment .comment_text .alignright { margin-bottom: $margin_full; margin-left: $margin_full; }\n";
                $output .= "\n\t.comment .comment_text .center, .comment .comment_text .aligncenter, .comment .comment_text .block, .comment .comment_text .alignnone { margin-bottom:$margin_full; }\n";
                $output .= "\n\t.comment .avatar{margin-right:$margin_half; margin-bottom:$margin_half;}\n";
                $output .= "\n\t#commentform input[type=\"text\"], #commentform textarea{margin-bottom:$margin_half;}\n";
                $output .= "\n\t.social_wrapper{padding-left:$margin_full;}\n";
                $output .= "\n\t.thesis_email_form{margin-bottom:$margin_32;}\n";
                $output .= "\n\t.two-thirds .email_form_intro, .one-half .email_form_intro, .three-quarters .email_form_intro{ margin-bottom: $margin_half;}\n";

                return $output;
        }

        public function content_font_rules($custom, $use_default, $desktop_width, $spacing_constants) {
                global $thesis;
                $content_fonts = new byob_text_dimensions_calculation();
                $typ_spacing_matrix = $content_fonts->space($spacing_constants['primary']);
                $full_spacing_matrix = $content_fonts->space($spacing_constants['primary_100']);
                $margin_half = $thesis->api->css->number($typ_spacing_matrix['x05']);
                $margin_full = $thesis->api->css->number($typ_spacing_matrix['x1']);
                $margin_32 = $thesis->api->css->number($typ_spacing_matrix['x15']);
                $margin_double = $thesis->api->css->number($typ_spacing_matrix['x2']);
                $full_margin_half = $thesis->api->css->number($full_spacing_matrix['x05']);
                $full_margin_full = $thesis->api->css->number($full_spacing_matrix['x1']);
                $full_margin_32 = $thesis->api->css->number($full_spacing_matrix['x15']);
                $full_margin_double = $thesis->api->css->number($full_spacing_matrix['x2']);

                if ($use_default) {
                        $content_sizes = new byob_text_dimensions_calculation($this->design);
                        $matrix = $content_sizes->setup($desktop_width);
                        $default = $this->set_font_elements($matrix, $this->content_column_config, $this->sidebar_column_config);
//                        var_dump($matrix);
//                        update_option('byob_agility', $matrix);
                }
                $output = '';

                // Content Paragraph - Full
                $font_size = false;
                $font_family = !empty($this->design['typ_p']['font-family']) ? $this->design['typ_p']['font-family'] : $this->primary_font_family;
                if (!empty($custom['mq_typ_p']) && is_numeric($custom['mq_typ_p'])) {
                        $font_size = $custom['mq_typ_p'] + 2;
                        $line_height = round($content_fonts->height_headings($font_size, 'full', $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['paragraph_100']['font-size'];
                        $line_height = round($default['paragraph_100']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.full p, .full .post_content, .full .post_content p, .full .query_box .post_content, .full .query_box .post_content p, .full .query_list{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";}\n";
                        $output .= "\n\t.full .post_box p, .full .post_box ul, .full .post_box ol, .full .post_box blockquote, .full .post_box pre, .full .post_box dl, .full .post_box dd { margin-bottom: $full_margin_full; }\n";
                        $output .= "\n\t.full .query_box p, .full .query_box ul, .full .query_box ol, .full .query_box blockquote, .full .query_box pre, .full .query_box dl, .full .query_box dd { margin-bottom: $full_margin_full; }\n";
                        $output .= "\n\t.full .email_form_intro { margin-bottom: $full_margin_half; }\n";
                }

                // Content Paragraph - Typical
                $font_size = false;
                if (!empty($custom['mq_typ_p']) && is_numeric($custom['mq_typ_p'])) {
                        $font_size = $custom['mq_typ_p'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['paragraph']['font-size'];
                        $line_height = round($default['paragraph']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\tbody{font-size:" . $thesis->api->css->number($font_size) . ";}\n";
                        $output .= "\n\tp, .post_content, .post_content p, .query_box .post_content, .query_box .post_content p, .query_list, .copyright{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";}\n";
                        $output .= "\n\t.post_box p, .post_box ul, .post_box ol, .post_box blockquote, .post_box pre, .post_box dl, .post_box dd { margin-bottom: $margin_full; }\n";
                        $output .= "\n\t.query_box p, .query_box ul, .query_box ol, .query_box blockquote, .query_box pre, .query_box dl, .query_box dd { margin-bottom: $margin_full; }\n";
                }

                // Site Title
                $font_size = false;
                $font_family = !empty($this->design['title']['font-family']) ? $this->design['title']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_site_title']) && is_numeric($custom['mq_site_title'])) {
                        $font_size = $custom['mq_site_title'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['title']['font-size'];
                        $line_height = round($default['title']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t#site_title{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin-top:$full_margin_half;}\n";
                }

                // Site Tagline
                $font_size = false;
                $font_family = !empty($this->design['tagline']['font-family']) ? $this->design['tagline']['font-family'] : $this->primary_font_family;
                if (!empty($custom['mq_tagline']) && is_numeric($custom['mq_tagline'])) {
                        $font_size = $custom['mq_tagline'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['tagline']['font-size'];
                        $line_height = round($default['tagline']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t#site_tagline{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";}\n";
                }

                // Section Title
                $font_size = false;
                $font_family = !empty($this->design['section_title']['font-family']) ? $this->design['section_title']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_section_titles']) && is_numeric($custom['mq_section_titles'])) {
                        $font_size = $custom['mq_section_titles'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['section_title']['font-size'];
                        $line_height = round($default['section_title']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\tp.section_title{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";}\n";
                }

                // Page Title Full
                $font_size = false;
                $font_family = !empty($this->design['headline']['font-family']) ? $this->design['headline']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_page_titles']) && is_numeric($custom['mq_page_titles'])) {
                        $font_size = $custom['mq_page_titles'] + 2;
                        $line_height = round($content_fonts->height_headings($font_size, 'full', $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['page_titles_100']['font-size'];
                        $line_height = round($default['page_titles_100']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.full .post_box .headline, .full .query_box .headline, .full .email_form_title{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$full_margin_half 0px;}\n";
                }

                // Page Title Typical
                $font_size = false;
                if (!empty($custom['mq_page_titles']) && is_numeric($custom['mq_page_titles'])) {
                        $font_size = $custom['mq_page_titles'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['page_titles_typ']['font-size'];
                        $line_height = round($default['page_titles_typ']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.post_box .headline, .query_box .headline, .home_archive.post_box h2.headline a{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:" . $thesis->api->css->number($margin_half) . " 0px;}\n";
                        $output .= "\n\t.headline_area{margin-bottom:$margin_half;}\n";
                        $output .= "\n\tp.comments_intro, p#comment_form_title{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";}\n";
                        $output .= "\n\t.two-thirds .email_form_title, .one-half .email_form_title, .three-quarters .email_form_title{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";}\n";
                }

                // Content H1 - Full
                $font_size = false;
                $font_family = !empty($this->design['typ_h1']['font-family']) ? $this->design['typ_h1']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_h1']) && is_numeric($custom['mq_h1'])) {
                        $font_size = $custom['mq_h1'] + 2;
                        $line_height = round($content_fonts->height_headings($font_size, 'full', $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h1_100']['font-size'];
                        $line_height = round($default['h1_100']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.full h1, .full .post_content h1 {font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$full_margin_32 0px $full_margin_half 0px;}\n";
                }

                // Content H1 - Typical
                $font_size = false;
                if (!empty($custom['mq_h1']) && is_numeric($custom['mq_h1'])) {
                        $font_size = $custom['mq_h1'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h1_typ']['font-size'];
                        $line_height = round($default['h1_typ']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\th1, .post_content h1{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$margin_32 0px $margin_half 0px;}\n";
                }

                // Page Subtitle - H2 Full
                $font_size = false;
                $font_family = !empty($this->design['typ_h2']['font-family']) ? $this->design['typ_h2']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_h2']) && is_numeric($custom['mq_h2'])) {
                        $font_size = $custom['mq_h2'] + 2;
                        $line_height = round($content_fonts->height_headings($font_size, 'full', $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h2_100']['font-size'];
                        $line_height = round($default['h2_100']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.full h2, .full .post_box .post_content h2, .full .query_box .post_content h2{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$full_margin_32 0px $full_margin_half 0px;}\n";
                }

                // Page Subtitle - H2 Typical
                $font_size = false;
                if (!empty($custom['mq_h2']) && is_numeric($custom['mq_h2'])) {
                        $font_size = $custom['mq_h2'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h2_typ']['font-size'];
                        $line_height = round($default['h2_typ']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\th2, .post_box .post_content h2, .query_box .post_content h2{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$margin_32 0px $margin_half 0px;}\n";
                }

                // Page Subsubtitle - H3 Full
                $font_size = false;
                $font_family = !empty($this->design['typ_h3']['font-family']) ? $this->design['typ_h3']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_h3']) && is_numeric($custom['mq_h3'])) {
                        $font_size = $custom['mq_h3'] + 2;
                        $line_height = round($content_fonts->height_headings($font_size, 'full', $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h3_100']['font-size'];
                        $line_height = round($default['h3_100']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.full h3, .full .post_box h3, .full .query_box h3{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$full_margin_32 0px $full_margin_half 0px;}\n";
                }

                // Page Subsubtitle - H3 Typical
                $font_size = false;
                if (!empty($custom['mq_h3']) && is_numeric($custom['mq_h3'])) {
                        $font_size = $custom['mq_h3'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h3_typ']['font-size'];
                        $line_height = round($default['h3_typ']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\th3, .post_box h3, .query_box h3{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$margin_32 0px $margin_half 0px;}\n";
                }

                // Page Subsubtitle - H4 Full
                $font_size = false;
                $font_family = !empty($this->design['typ_h4']['font-family']) ? $this->design['typ_h4']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_h4']) && is_numeric($custom['mq_h4'])) {
                        $font_size = $custom['mq_h4'] + 2;
                        $line_height = round($content_fonts->height_headings($font_size, 'full', $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h4_100']['font-size'];
                        $line_height = round($default['h4_100']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.full h4, .full .post_box h4, .full .query_box h4{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$full_margin_full 0px $full_margin_half 0px;}\n";
                }

                // Page Subsubtitle - H4 Typical
                $font_size = false;
                if (!empty($custom['mq_h4']) && is_numeric($custom['mq_h4'])) {
                        $font_size = $custom['mq_h4'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h4_typ']['font-size'];
                        $line_height = round($default['h4_typ']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\th4, .post_box h4, .query_box h4{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$margin_full 0px $margin_full 0px;}\n";
                }

                // Page Subsubtitle - H5 Full
                $font_size = false;
                $font_family = !empty($this->design['typ_h5']['font-family']) ? $this->design['typ_h5']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_h5']) && is_numeric($custom['mq_h5'])) {
                        $font_size = $custom['mq_h5'] + 2;
                        $line_height = round($content_fonts->height_headings($font_size, 'full', $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h5_100']['font-size'];
                        $line_height = round($default['h5_100']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.full h5, .full .post_box h5, .full .query_box h5{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$full_margin_half 0px $full_margin_half 0px;}\n";
                }

                // Page Subsubtitle - H5 Typical
                $font_size = false;
                if (!empty($custom['mq_h5']) && is_numeric($custom['mq_h4'])) {
                        $font_size = $custom['mq_h5'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h5_typ']['font-size'];
                        $line_height = round($default['h5_typ']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\th5, .post_box h5, .query_box h5{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$margin_half 0px $margin_half 0px;}\n";
                }

                // Page Subsubtitle - H6 Full
                $font_size = false;
                $font_family = !empty($this->design['typ_h6']['font-family']) ? $this->design['typ_h6']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_h6']) && is_numeric($custom['mq_h6'])) {
                        $font_size = $custom['mq_h6'] + 2;
                        $line_height = round($content_fonts->height_headings($font_size, 'full', $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h6_100']['font-size'];
                        $line_height = round($default['h6_100']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.full h6, .full .post_box h6, .full .query_box h6{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$full_margin_half 0px $full_margin_half 0px;}\n";
                }

                // Page Subsubtitle - H6 Typical
                $font_size = false;
                if (!empty($custom['mq_h6']) && is_numeric($custom['mq_h6'])) {
                        $font_size = $custom['mq_h6'];
                        $line_height = round($content_fonts->height_headings($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['h6_typ']['font-size'];
                        $line_height = round($default['h6_typ']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\th6, .post_box h6, .query_box h6{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin:$margin_half 0px $margin_half 0px;}\n";
                }

                // Secondary Font - Full
                $font_size = false;
                $font_family = !empty($this->design['secondary_font']['font-family']) ? $this->design['secondary_font']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_secondary']) && is_numeric($custom['mq_secondary'])) {
                        $font_size = $custom['mq_secondary'] + 2;
                        $line_height = round($content_fonts->height_text($font_size, 'full', $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['secondary_100']['font-size'];
                        $line_height = round($default['secondary_100']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.full .headline_area, .full .comment .comment_aux{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin-bottom:$margin_half;}\n";
                        $output .= "\n\t.full .post_box .small{font-size:" . $thesis->api->css->number($font_size) . ";}\n";
                }

                // Secondary Font - Typical
                $font_size = false;
                if (!empty($custom['mq_secondary']) && is_numeric($custom['mq_secondary'])) {
                        $font_size = $custom['mq_secondary'];
                        $line_height = round($content_fonts->height_text($font_size, $this->content_column_config, $font_family, $desktop_width));
                } elseif ($use_default) {
                        $font_size = $default['secondary_typ']['font-size'];
                        $line_height = round($default['secondary_typ']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.headline_area, .comment .comment_aux{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin-bottom:$margin_half;}\n";
                        $output .= "\n\t.post_box .small{font-size:" . $thesis->api->css->number($font_size) . ";}\n";
                }


                return $output;
        }

        public function custom_text_area_rules($text_areas, $use_default = false, $desktop_width, $spacing_constants) {
                global $thesis;
                $output = '';

                foreach ($text_areas as $mq => $options) {

                        $prefix = $options['prefix'];
                        $column_config = $options['column_config'];
                        $context = $options['context'];
                        $no = $options['no'];
                        $text_area_fonts = new byob_text_dimensions_calculation();
                        $text_area_spacing_matrix = $text_area_fonts->space($spacing_constants[$context]);
                        $margin_half = $thesis->api->css->number($text_area_spacing_matrix['x05']);
                        $margin_full = $thesis->api->css->number($text_area_spacing_matrix['x1']);
                        $margin_32 = $thesis->api->css->number($text_area_spacing_matrix['x15']);
                        $margin_double = $thesis->api->css->number($text_area_spacing_matrix['x2']);


                        // Custom Text Area paragraph
                        $font_size = false;
                        $font_family = !empty($this->design[$prefix . 'typical_text']['font-family']) ? $this->design[$prefix . 'typical_text']['font-family'] : $this->primary_font_family;
                        if (!empty($options['mq_custom_p']) && is_numeric($options['mq_custom_p'])) {
                                $font_size = $options['mq_custom_p'];
                                $line_height = round($text_area_fonts->height_text($font_size, $column_config, $font_family, $desktop_width));
                        }

                        if ($font_size) {
                                $output .= "\n\t.custom-$no, .custom-$no p{font-size:" . $thesis->api->css->number($font_size) . ";";
                                $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                                $output .= "margin-bottom:$margin_full;}\n";
                                $output .= "\n\t.custom-1 ul{margin-bottom:$margin_full;}\n";
                        }

                        // Custom Text Area Heading
                        $font_size = false;
                        $font_family = !empty($this->design[$prefix . 'heading']['font-family']) ? $this->design[$prefix . 'heading']['font-family'] : $this->heading_font_family;
                        if (!empty($options['mq_custom_page_titles']) && is_numeric($options['mq_custom_page_titles'])) {
                                $font_size = $options['mq_custom_page_titles'];
                                $line_height = round($text_area_fonts->height_headings($font_size, $column_config, $font_family, $desktop_width));
                        }
                        if ($font_size) {
                                $output .= "\n\t.custom-$no .headline{font-size:" . $thesis->api->css->number($font_size) . ";";
                                $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                                $output .= "margin-bottom:$margin_half;}\n";
                        }

                        // Custom Text Area Subeading
                        $font_size = false;
                        $font_family = !empty($this->design[$prefix . 'subheading']['font-family']) ? $this->design[$prefix . 'subheading']['font-family'] : $this->heading_font_family;
                        if (!empty($options['mq_custom_h2']) && is_numeric($options['mq_custom_h2'])) {
                                $font_size = $options['mq_custom_h2'];
                                $line_height = round($text_area_fonts->height_headings($font_size, $column_config, $font_family, $desktop_width));
                        }
                        if ($font_size) {
                                $output .= "\n\t.custom-$no .post_content h2{font-size:" . $thesis->api->css->number($font_size) . ";";
                                $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                                $output .= "margin-top: $margin_full; margin-bottom: $margin_half;}\n";
                        }

                        // Custom Text Area Sub Subeading
                        $font_size = false;
                        $font_family = !empty($this->design[$prefix . 'subsubheading']['font-family']) ? $this->design[$prefix . 'subsubheading']['font-family'] : $this->heading_font_family;
                        if (!empty($options['mq_custom_h3']) && is_numeric($options['mq_custom_h3'])) {
                                $font_size = $options['mq_custom_h3'];
                                $line_height = round($text_area_fonts->height_headings($font_size, $column_config, $font_family, $desktop_width));
                        }
                        if ($font_size) {
                                $output .= "\n\t.custom-$no h3, .custom-$no h4{font-size:" . $thesis->api->css->number($font_size) . ";";
                                $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                                $output .= "margin-top: $margin_full; margin-bottom: $margin_half;}\n";
                        }
                }
                return $output;
        }

        public function sidebar_font_rules($custom, $use_default, $desktop_width, $spacing_constants) {
                global $thesis;
                $sidebar_fonts = new byob_text_dimensions_calculation();
                $typ_spacing_matrix = $sidebar_fonts->space($spacing_constants['sidebar']);
                $margin_half = $thesis->api->css->number($typ_spacing_matrix['x05']);
                $margin_full = $thesis->api->css->number($typ_spacing_matrix['x1']);
                $margin_32 = $thesis->api->css->number($typ_spacing_matrix['x15']);
                $margin_double = $thesis->api->css->number($typ_spacing_matrix['x2']);

                if ($use_default) {
                        $sidebar_sizes = new byob_text_dimensions_calculation($this->design);
                        $matrix = $sidebar_sizes->setup($desktop_width);
                        $default = $this->set_font_elements($matrix, $this->content_column_config, $this->sidebar_column_config);
                }
                $output = '';
                // Sidebar paragraph
                $font_size = false;
                $font_family = !empty($this->design['sidebar']['font-family']) ? $this->design['sidebar']['font-family'] : $this->primary_font_family;
                if (!empty($custom['mq_sidebar_p']) && is_numeric($custom['mq_sidebar_p'])) {
                        $font_size = $custom['mq_sidebar_p'];
                        $line_height = round($sidebar_fonts->height_text($font_size, $this->sidebar_column_config, $font_family));
                } elseif ($use_default) {
                        $font_size = $default['sidebar']['font-size'];
                        $line_height = round($default['sidebar']['line-height']);
                }

                if ($font_size) {
                        $output .= "\n\t.widget, .widget p{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin-bottom:$margin_full;}\n";
                        $output .= "\n\t.widget ul{margin-bottom:$margin_full;}\n";
                        $output .= "\n\t.one-third .email_form_intro, .one-quarter .email_form_intro{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin-bottom:$margin_half;}\n";
                        $output .= "\n\t.one-third .email_form_title, .one-quarter .email_form_title, .one-third .thesis_email_form .input_text, .one-quarter .thesis_email_form .input_text  { margin-bottom: $margin_half;}\n";
                        $output .= "\n\t.thesis_email_form_submit.input_submit{ margin-top: $margin_half;}\n";
                }



                // Sidebar Heading
                $font_size = false;
                $font_family = !empty($this->design['sidebar_heading']['font-family']) ? $this->design['sidebar_heading']['font-family'] : $this->heading_font_family;
                if (!empty($custom['mq_widget_titles']) && is_numeric($custom['mq_widget_titles'])) {
                        $font_size = $custom['mq_widget_titles'];
                        $line_height = round($sidebar_fonts->height_headings($font_size, $this->sidebar_column_config, $font_family));
                } elseif ($use_default) {
                        $font_size = $default['sidebar_heading']['font-size'];
                        $line_height = round($default['sidebar_heading']['line-height']);
                }
                if ($font_size) {
                        $output .= "\n\t.widget .widget_title, .one-third .email_form_title, .one-quarter .email_form_title{font-size:" . $thesis->api->css->number($font_size) . ";";
                        $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                        $output .= "margin-bottom:$margin_half;}\n";
                }
                return $output;
        }

        public function query_box_rules($text_areas, $use_default = false, $spacing_constants) {
                global $thesis;
                $output = '';
                foreach ($text_areas as $mq => $options) {

                        $prefix = $options['prefix'];
                        $column_config = $options['context'];
                        $text_area_fonts = new byob_text_dimensions_calculation();
                        $text_area_spacing_matrix = $text_area_fonts->space($spacing_constants[$column_config]);
                        $margin_half = $thesis->api->css->number($text_area_spacing_matrix['x05']);
                        $margin_full = $thesis->api->css->number($text_area_spacing_matrix['x1']);
                        $margin_32 = $thesis->api->css->number($text_area_spacing_matrix['x15']);
                        $margin_double = $thesis->api->css->number($text_area_spacing_matrix['x2']);


                        // Custom Text Area paragraph
                        $font_size = false;
                        $font_family = !empty($this->design[$prefix . 'typical_text']['font-family']) ? $this->design[$prefix . 'typical_text']['font-family'] : $this->primary_font_family;
                        if (!empty($mq['mq_custom_p']) && is_numeric($mq['mq_custom_p'])) {
                                $font_size = $mq['mq_custom_p'];
                                $line_height = round($text_area_fonts->height_text($font_size, $column_config, $font_family));
                        }

                        if ($font_size) {
                                $output .= "\n\t.custom-1, .custom-1 p{font-size:" . $thesis->api->css->number($font_size) . ";";
                                $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                                $output .= "margin-bottom:$margin_full;}\n";
                                $output .= "\n\t.custom-1 ul{margin-bottom:$margin_full;}\n";
                        }

                        // Custom Text Area Heading
                        $font_size = false;
                        $font_family = !empty($this->design[$prefix . 'heading']['font-family']) ? $this->design[$prefix . 'heading']['font-family'] : $this->heading_font_family;
                        if (!empty($mq['mq_custom_page_titles']) && is_numeric($mq['mq_custom_page_titles'])) {
                                $font_size = $custom['mq_custom_page_titles'];
                                $line_height = round($text_area_fonts->height_headings($font_size, $column_config, $font_family));
                        }
                        if ($font_size) {
                                $output .= "\n\t.query_box .headline, .query_list .headline{font-size:" . $thesis->api->css->number($font_size) . ";";
                                $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                                $output .= "margin-bottom:$margin_half;}\n";
                        }

                        // Custom Text Area Subeading
                        $font_size = false;
                        $font_family = !empty($this->design[$prefix . 'subheading']['font-family']) ? $this->design[$prefix . 'subheading']['font-family'] : $this->heading_font_family;
                        if (!empty($mq['mq_custom_h2']) && is_numeric($mq['mq_custom_h2'])) {
                                $font_size = $custom['mq_custom_h2'];
                                $line_height = round($text_area_fonts->height_headings($font_size, $column_config, $font_family));
                        }
                        if ($font_size) {
                                $output .= "\n\t.query_box .post_content h2, .query_list .post_content h2{font-size:" . $thesis->api->css->number($font_size) . ";";
                                $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                                $output .= "margin-top: $margin_full; margin-bottom: $margin_half;}\n";
                        }

                        // Custom Text Area Sub Subeading
                        $font_size = false;
                        $font_family = !empty($this->design[$prefix . 'subsubheading']['font-family']) ? $this->design[$prefix . 'subsubheading']['font-family'] : $this->heading_font_family;
                        if (!empty($mq['mq_custom_h3']) && is_numeric($mq['mq_custom_h3'])) {
                                $font_size = $custom['mq_custom_h3'];
                                $line_height = round($text_area_fonts->height_headings($font_size, $column_config, $font_family));
                        }
                        if ($font_size) {
                                $output .= "\n\t.query_box h3, .query_box h4, .query_list h3, .query_list h4 {font-size:" . $thesis->api->css->number($font_size) . ";";
                                $output .= "line-height:" . $thesis->api->css->number($line_height) . ";";
                                $output .= "margin-top: $margin_full; margin-bottom: $margin_half;}\n";
                        }
                }
                return $output;
        }

        public function set_font_elements($font_matrix, $content_width, $sidebar_width) {
                $font_elements = array(
                    'title' => array(
                        'font-size' => $font_matrix['heading'][$content_width]['f1']['font_size'],
                        'line-height' => $font_matrix['heading'][$content_width]['f1']['line_height']),
                    'tagline' => array(
                        'font-size' => $font_matrix['primary'][$content_width]['f6']['font_size'],
                        'line-height' => $font_matrix['primary'][$content_width]['f6']['line_height']),
                    'page_titles_100' => array(
                        'font-size' => $font_matrix['heading']['full']['f2']['font_size'],
                        'line-height' => $font_matrix['heading']['full']['f2']['line_height']),
                    'section_title' => array(
                        'font-size' => $font_matrix['heading']['full']['f2']['font_size'],
                        'line-height' => $font_matrix['heading']['full']['f2']['line_height']),
                    'page_titles_typ' => array(
                        'font-size' => $font_matrix['heading'][$content_width]['f2']['font_size'],
                        'line-height' => $font_matrix['heading'][$content_width]['f2']['line_height']),
                    'h1_100' => array(
                        'font-size' => $font_matrix['heading']['full']['f2']['font_size'],
                        'line-height' => $font_matrix['heading']['full']['f2']['line_height']),
                    'h1_typ' => array(
                        'font-size' => $font_matrix['heading'][$content_width]['f2']['font_size'],
                        'line-height' => $font_matrix['heading'][$content_width]['f2']['line_height']),
                    'h2_100' => array(
                        'font-size' => $font_matrix['heading']['full']['f3']['font_size'],
                        'line-height' => $font_matrix['heading']['full']['f3']['line_height']),
                    'h2_typ' => array(
                        'font-size' => $font_matrix['heading'][$content_width]['f3']['font_size'],
                        'line-height' => $font_matrix['heading'][$content_width]['f3']['line_height']),
                    'h3_100' => array(
                        'font-size' => $font_matrix['heading']['full']['f4']['font_size'],
                        'line-height' => $font_matrix['heading']['full']['f4']['line_height']),
                    'h3_typ' => array(
                        'font-size' => $font_matrix['heading'][$content_width]['f4']['font_size'],
                        'line-height' => $font_matrix['heading'][$content_width]['f4']['line_height']),
                    'h4_100' => array(
                        'font-size' => $font_matrix['heading']['full']['f5']['font_size'],
                        'line-height' => $font_matrix['heading']['full']['f5']['line_height']),
                    'h4_typ' => array(
                        'font-size' => $font_matrix['heading'][$content_width]['f5']['font_size'],
                        'line-height' => $font_matrix['heading'][$content_width]['f5']['line_height']),
                    'h5_100' => array(
                        'font-size' => $font_matrix['heading']['full']['f6']['font_size'],
                        'line-height' => $font_matrix['heading']['full']['f6']['line_height']),
                    'h5_typ' => array(
                        'font-size' => $font_matrix['heading'][$content_width]['f6']['font_size'],
                        'line-height' => $font_matrix['heading'][$content_width]['f6']['line_height']),
                    'h6_100' => array(
                        'font-size' => $font_matrix['heading']['full']['f7']['font_size'],
                        'line-height' => $font_matrix['heading']['full']['f7']['line_height']),
                    'h6_typ' => array(
                        'font-size' => $font_matrix['heading'][$content_width]['f7']['font_size'],
                        'line-height' => $font_matrix['heading'][$content_width]['f7']['line_height']),
                    'secondary_100' => array(
                        'font-size' => $font_matrix['primary']['full']['f8']['font_size'],
                        'line-height' => $font_matrix['primary']['full']['f8']['line_height']),
                    'secondary_typ' => array(
                        'font-size' => $font_matrix['primary'][$content_width]['f8']['font_size'],
                        'line-height' => $font_matrix['primary'][$content_width]['f8']['line_height']),
                    'paragraph_100' => array(
                        'font-size' => $font_matrix['primary']['full']['f7']['font_size'],
                        'line-height' => $font_matrix['primary']['full']['f7']['line_height']),
                    'paragraph' => array(
                        'font-size' => $font_matrix['primary'][$content_width]['f7']['font_size'],
                        'line-height' => $font_matrix['primary'][$content_width]['f7']['line_height']),
                    'sidebar' => array(
                        'font-size' => $font_matrix['primary'][$sidebar_width]['f7']['font_size'],
                        'line-height' => $font_matrix['primary'][$sidebar_width]['f7']['line_height']),
                    'sidebar_heading' => array(
                        'font-size' => $font_matrix['heading'][$sidebar_width]['f4']['font_size'],
                        'line-height' => $font_matrix['heading'][$sidebar_width]['f4']['line_height'])
                );
                return $font_elements;
        }

        public function static_media_query_1024($spacing_constants) {

                $output = ".page_wrapper{ width:auto; padding:0 8px; margin:0; }\n";
                $output .= ".columns_321 .two-thirds { width:auto; margin-right:320px; }\n";
                $output .= ".columns_321 .one-third {float:left;width:320px;margin-left:-320px;}\n";
                $output .= ".columns_312 .two-thirds {width:auto;float:right;margin-left:320px;}\n";
                $output .= ".columns_312 .one-third {width:320px;float:left;margin-right:-100%;}\n";
                $output .= ".columns_431 .three-quarters { width:auto; margin-right:250px; }\n";
                $output .= ".columns_431 .one-quarter { float:left; width:250px; margin-left:-250px; }\n";
                $output .= ".columns_413 .three-quarters { width:auto; float:right; margin-left:250px; }\n";
                $output .= ".columns_413 .one-quarter { width:250px; float:left; margin-right:-100%; }\n";
                $output .= ".columns_413 .three-quarters { width:auto; float:right; margin-left:250px; }\n";
                $output .= ".columns_4121 .reverse_wrapper .half{width:65.666%; }\n";
                $output .= "input#searchsubmit{display:inline-block;margin-top:10px;}\n";

                return $output;
        }

        public function static_media_query_800($spacing_constants) {
                global $thesis;
                $container = new byob_text_dimensions_calculation();
                $typ_spacing_matrix = $container->space($spacing_constants['primary']);
                $margin_half = $thesis->api->css->number($typ_spacing_matrix['x05']);
                $margin_full = $thesis->api->css->number($typ_spacing_matrix['x1']);
                $c_bg_med = $thesis->api->colors->css($this->design['c_bg_med']);
                $sidebar_heading = '';

                $vars = get_option('byob_agility_nude_vars');
                if ($vars) {
                        foreach ($vars as $id => $data) {
                                if ($data['ref'] == 'sidebar_heading') {
                                        $sidebar_heading = $data['css'];
                                }
                        }
                }

                $output = ".columns_321 .two-thirds,"
                        . ".columns_321 .one-third,"
                        . ".columns_312 .two-thirds,"
                        . ".columns_312 .one-third { float:none; width:100%; margin-left:0px;  margin-right:0px;}\n";
                $output .= ".columns_3 .one-third { width:50%; padding-bottom:" . $margin_full . "; margin-bottom:" . $margin_full . ";}\n";
                $output .= ".columns_3 .one-third:last-child {width:400px;float:none;margin:0 auto;clear:both;}\n";
                $output .= ".columns_4112 .one-quarter,"
                        . ".columns_4 .one-quarter {width:50%; min-width:250px; padding-bottom:" . $margin_full . "; }";
                $output .= ".columns_4211 .half,"
                        . ".columns_4112 .half,"
                        . ".columns_4121 .half,"
                        . ".columns_4121 .reverse_wrapper,"
                        . ".columns_4112 .reverse_wrapper,"
                        . ".columns_4112 .reverse_wrapper .half,"
                        . ".columns_4112 .inner_reverse{ width:100%; padding-bottom:" . $margin_full . "; float:none; clear:both; }";
                $output .= ".columns_321 .two-thirds:after,"
                        . ".columns_321 .one-third:after,"
                        . ".columns_312 .two-thirds:after,"
                        . ".columns_312 .one-third:after,"
                        . ".columns_4211 .half:after,"
                        . ".columns_4112 .half:after,"
                        . ".columns_4121 .half:after,"
                        . ".columns_4121 .reverse_wrapper:after,"
                        . ".columns_4112 .reverse_wrapper:after{content:' ' ; display: block; height: 0; clear: both; visibility: hidden;}\n";
                $output .= ".columns_4211 .one-quarter,"
                        . ".columns_4112 .reverse_wrapper .one-quarter{ width:50%; min-width:250px; padding-bottom:" . $margin_full . "; }";
                $output .= ".columns_4121 .one-quarter{width:100%;}\n";
                $output .= ".fluid_grid.three_columns{width:50%;}\n";
                $output .= ".fluid_grid.four_columns{width:33%;}\n";
                $output .= ".fluid_grid.five_columns{width:25%;}\n";
                $output .= ".post_box.fluid_grid img{margin-bottom:0;}\n";
                $output .= "#site_title, #site_title a{font-size:32px; line-height:32px; padding-bottom:0;}\n";
                $output .= "#post_nav{margin-bottom:0px;}\n";
                $output .= ".menu{float:none; text-align:center;}\n";
                $output .= ".menu li{float:none; display:inline-block;}\n";
                $output .= ".menu .current-menu-item a, .menu .current-menu-item a:hover{color:#fff; background-color:transparent;}\n";
                $output .= ".menu_control {display: block;width: 100%;padding: 1em 26px;cursor: pointer;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;}\n";
                $output .= "#header_columns .responsive.menu,"
                        . ".responsive.menu { display: none; width: 100%;  border-top: 1px solid #ddd; clear: both; box-sizing:border-box;}\n";
                $output .= "#header_columns .responsive.show_menu,"
                        . ".responsive.show_menu {display: block;}\n";
                $output .= "#header_columns .responsive.menu .sub-menu,"
                        . ".responsive.menu .sub-menu {position: static;display: block;margin: 0;border-top: 1px solid #ddd;padding-left: 26px;}\n";
                $output .= "#header_columns .responsive.menu.show_menu li,"
                        . ".responsive.menu.show_menu li {width: 100%; box-sizing:border-box; float:none; margin-bottom:0;}\n";
                $output .= "#header_columns .responsive.menu.show_menu ul,"
                        . ".responsive.menu.show_menu ul{visibility:visible;}\n";
                $output .= "#header_columns .responsive.menu.show_menu ul.sub-menu,"
                        . "#header_columns .responsive.menu.show_menu .sub-menu li,"
                        . ".responsive.menu.show_menu ul.sub-menu,"
                        . ".responsive.menu.show_menu .sub-menu li {width: 100%;box-sizing:border-box;}\n";
                $output .= "#header_columns .responsive.menu a,"
                        . ".responsive.menu a {border-width: 1px 1px 0 0;padding: 1em 26px;}\n";
                $output .= "#header_columns .responsive.menu > li > a ,"
                        . ".responsive.menu > li > a {border-left-width: 1px;}\n";
                $output .="#header_columns .responsive.menu li:first-child > a:first-child,
                        .responsive.menu li:first-child > a:first-child {border-top-width: 0;}\n";
                $output .= ".post_box .headline{margin-bottom:" . $margin_half . ";}\n";
                $output .="#header_area .one-third,
                        #header_area .two-thirds,
                        #header_area .one-quarter,
                        #header_area .three-quarters,
                        #header_area .half,
                        #footer_area_bottom .one-third,
                        #footer_area_bottom .two-thirds,
                        #footer_area_bottom .one-quarter,
                        #footer_area_bottom .three-quarters,
                        #footer_area_bottom .half{margin-bottom:0px;}
                        #header_area .one-third,
                        #header_area .two-thirds,
                        #header_area .one-quarter,
                        #header_area .three-quarters,
                        #header_area .half{padding-left:0;padding-right:0;}\n";
                $output .="#header_area .page_wrapper{padding:0;}\n";
                $output .="#content_area .columns_321,
                        #content_area .columns_312,
                        #content_area .columns_4211,
                        #content_area .columns_4121,
                        #content_area .columns_4112{padding-bottom:0;}\n";
                $output .="#content_area .two-thirds,
                        #content_area .three-quarters{
                                border-bottom:1px solid $c_bg_med;
                                margin-bottom:" . $margin_full . ";
                                padding-bottom:" . $margin_full . ";
                        }";
                $output .= "#content_area .one-third,
                        #content_area .one-quarter{
                                border-bottom:1px solid " . $c_bg_med . ";
                                margin-bottom:0;
                                padding-bottom:0;
                        }";
                $output .= "h1.archive_title{margin-top:0;}\n";
                $output .= ".call-to-action.cta_short .message{	" . $sidebar_heading . "}";
                $output .= ".call-to-action.cta_short a{display:inline-block;}\n";
                $output .= ".cta_short .thesis_email_form{max-width:400px;margin:0 auto;font-size:16px;}\n";
                $output .= ".cta_short .thesis_email_form input{margin-bottom:" . $margin_half . ";}\n";
                $output .= ".cta_short .thesis_email_form label{display:inline-block;width:100px;font-size:22px;}\n";

                return $output;
        }

        /* Agility Media Query */

        public function static_media_query_699($spacing_constants) {
                global $thesis;
                $container = new byob_text_dimensions_calculation();
                $typ_spacing_matrix = $container->space($spacing_constants['primary']);
                $margin_half = $thesis->api->css->number($typ_spacing_matrix['x05']);
                $margin_full = $thesis->api->css->number($typ_spacing_matrix['x1']);
                $c_bg_med = $thesis->api->colors->css($this->design['c_bg_med']);

                $output = ".full,
                        .half,
                        .two-thirds,
                        .three-quarters,
                        .columns_2 .half,
                        .columns_321 .two-thirds,
                        .columns_312 .one-third,
                        .columns_321 .one-third,
                        .columns_312 .two-thirds,
                        .columns_431 .three-quarters,
                        .columns_413 .one-quarter,
                        .columns_431 .one-quarter,
                        .columns_413 .three-quarters,
                        .columns_4121 .one-quarter,
                        .columns_4121 .half,
                        .columns_4121 .reverse_wrapper .half,
                        .columns_4121 .reverse_wrapper .one-quarter,
                        .columns_4112 .reverse_wrapper .half{ clear:both; float:none;  padding:12px 8px; width:100%;  margin-right:0; margin-left:0; }";
                $output .= ".full:after,
                        .half:after,
                        .two-thirds:after,
                        .three-quarters:after,
                        .columns_2 .half:after,
                        .columns_321 .two-thirds:after,
                        .columns_312 .one-third:after,
                        .columns_321 .one-third:after,
                        .columns_312 .two-thirds:after,
                        .columns_431 .three-quarters:after,
                        .columns_413 .one-quarter:after,
                        .columns_431 .one-quarter:after,
                        .columns_413 .three-quarters:after,
                        .columns_4121 .one-quarter:after,
                        .columns_4121 .half:after,
                        .columns_4121 .reverse_wrapper .half:after,
                        .columns_4121 .reverse_wrapper .one-quarter:after,
                        .columns_4112 .reverse_wrapper .half:after,
                        .columns_4112 .reverse_wrapper .one-quarter:after{content:' ' ; display: block; height: 0; clear: both; visibility: hidden;}\n";
                $output .= ".one-third,
                        .one-quarter{padding:12px 8px; width:50%; }";
                $output .= "#post_nav .half{  width:50%; float:left; clear:none; }
                        #post_nav{padding:0px;}\n";
                $output .= ".fluid_grid.two_columns,
                        .fluid_grid.three_columns,
                        .fluid_grid.four_columns{width:50%;min-width:250px;}
                        .fluid_grid.five_columns{width:33%;}
                        .related_post_thumbnails{text-align:center;}
                        .related_post_thumbnails img{display:inline-block;float:none;}\n";
                $output .= "#top_header_area .half{width:50%;float:left;clear:none;margin-bottom:0px;}
                        #top_header_area input#searchsubmit{display:inline-block;margin-top:10px;}
                        #header_columns{text-align:center; padding:0;}\n";
                $output .= ".menu a {border-right-width: 0;}\n";
                $output .= ".menu > li > a {border-left-width: 0;}\n";
                $output .= "#top_menu_area .full{margin:0;}\n";
                $output .= "#content_area .columns_1,
                        .columns_321, .columns_4{padding:0;}\n";
                $output .= "#attention_area .page_wrapper {margin-bottom:0;}\n";
                $output .= ".post_box h1,
                        .full .post_box h1,
                        .post_box .headline,
                        .full .post_box .headline {font-size:32px;line-height:40px;text-align:center;}\n";
                $output .= ".post_box,
                        .full .post_box{line-height:24px;}\n";
                $output .= ".home_archive.post_box{border-bottom:2px solid " . $c_bg_med . ";padding-bottom:" . $margin_full . ";}\n";
                $output .= ".headline_area{text-align:center;}\n";
                $output .= ".copyright{text-align:center;}\n";

                return $output;
        }

        /* Agility Media Query */

        public function static_media_query_415($spacing_constants) {
                global $thesis;
                $container = new byob_text_dimensions_calculation();
                $typ_spacing_matrix = $container->space($spacing_constants['primary']);
                $margin_half = $thesis->api->css->number($typ_spacing_matrix['x05']);
                $margin_full = $thesis->api->css->number($typ_spacing_matrix['x1']);

                $output = ".one-third,
                        .one-quarter,
                        .columns_3 .one-third,
                        .columns_3 .one-third:last-child,
                        .columns_4 .one-quarter,
                        .columns_4211 .one-quarter,
                        .columns_4112 .one-quarter,
                        .columns_4112 .reverse_wrapper .one-quarter,
                        #post_nav .half{clear:both; float:none;width:100%; padding-bottom:0; margin-bottom:" . $margin_full . ";}\n";
                $output .= ".one-third:after,
                        .one-quarter:after,
                        .columns_3 .one-third:after,
                        .columns_4 .one-quarter:after,
                        .columns_4211 .one-quarter:after,
                        .columns_4112 .one-quarter:after,
                        #post_nav .half:after{content:' ' ; display: block; height: 0; clear: both; visibility: hidden;}\n";
                $output .= ".page_wrapper .full,
                        .page_wrapper .half,
                        .page_wrapper .one-quarter,
                        .page_wrapper .one-third,
                        .page_wrapper .two-thirds,
                        .page_wrapper .three-quarters{padding:0;}\n";
                $output .= ".fluid_grid.two_columns,
                        .fluid_grid.three_columns,
                        .fluid_grid.four_columns,
                        .fluid_grid.five_columns{width:100%;}\n";
                $output .= "#top_header_area .half{width:100%;float:none; clear:both; text-align:center; margin-bottom:" . $margin_half . "; }";
                $output .= "#top_header_area .half .social_icons{text-align:center;}\n";
                $output .= "#site_tagline{line-height:inherit;}\n";
                $output .= ".home_archive.post_box img.alignleft,
                        .home_archive.post_box img.alignright,
                        .post_box img.alignleft,
                        .post_box img.alignright{float:none;display:block;margin-left:auto;margin-right:auto;}\n";
                $output .= ".one-third .widget{float:none;width:100%;}\n";
                $output .= ".cta_short .thesis_email_form,
                        .home_archive.post_box .post_footer,
                        .post_footer{text-align:center;}\n";
                $output .= ".cta_short .thesis_email_form label,
                        .cta_short .thesis_email_form input_text{display:block;	width:auto;}\n";
                $output .= ".cta_short .thesis_email_form input{margin-right:0px;}\n";
                $output .= ".cta_tall .thesis_email_form input{margin-bottom:" . $margin_half . ";}
                        .social_links{text-align:center;}\n";
                return $output;
        }

}
