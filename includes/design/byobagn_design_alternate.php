<?php

/**
 * Design options for use with design options boxes.
 *
 * @author Rick
 */
class byobagn_design_alternate {

        public function background_design() {
                global $thesis;
                $css = $thesis->api->css->options;
                $design_options = get_option("byob_agility_nude__design");

                $o = new byobagn_design_options($design_options);
                $options = array(
                    'type' => 'object_set',
                    'label' => __('Backgrounds', 'byobagn'),
                    'select' => __('Select a background area to edit:', 'byobagn'),
                    'objects' => array(
                        'body_background' => array(
                            'type' => 'group',
                            'label' => __('Main Body Background', 'byobagn'),
                            'fields' => $o->simple_background()),
                        'top_header_area_background' => array(
                            'type' => 'group',
                            'label' => __('Top Header Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'top_header_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Top Header Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'header_area_background' => array(
                            'type' => 'group',
                            'label' => __('Header Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'header_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Header Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'top_menu_area_background' => array(
                            'type' => 'group',
                            'label' => __('Top Menu Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'top_menu_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Top Menu Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'feature_box_area_background' => array(
                            'type' => 'group',
                            'label' => __('Feature Box Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'feature_box_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Feature Box Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'content_area_background' => array(
                            'type' => 'group',
                            'label' => __('Content Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'content_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Content Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'attention_area_background' => array(
                            'type' => 'group',
                            'label' => __('Attention Box Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'attention_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Attention Box Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'featured_content_area_background' => array(
                            'type' => 'group',
                            'label' => __('Featured Content Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'featured_content_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Featured Content Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'notice_bar_area_background' => array(
                            'type' => 'group',
                            'label' => __('Notice Bar Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'notice_bar_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Notice Bar Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'footer_top_area_background' => array(
                            'type' => 'group',
                            'label' => __('Top Footer Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'footer_top_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Top Footer Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'footer_bottom_area_background' => array(
                            'type' => 'group',
                            'label' => __('Bottom Footer Area Background', 'byobagn'),
                            'fields' => $o->area_background()),
                        'footer_bottom_area_page_background' => array(
                            'type' => 'group',
                            'label' => __('Bottom Footer Area Page Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'overlay_1_background' => array(
                            'type' => 'group',
                            'label' => __('Overlay Style 1 Background (overlay-1)', 'byobagn'),
                            'fields' => $o->simple_background()),
                        'overlay_2_background' => array(
                            'type' => 'group',
                            'label' => __('Overlay Style 2 Background (overlay-2)', 'byobagn'),
                            'fields' => $o->simple_background()),
                        'overlay_3_background' => array(
                            'type' => 'group',
                            'label' => __('Overlay Style 3 Background (overlay-3)', 'byobagn'),
                            'fields' => $o->simple_background()),
                        'style_1_background' => array(
                            'type' => 'group',
                            'label' => __('Extra Style 1 Background (style-1)', 'byobagn'),
                            'fields' => $o->full_background()),
                        'style_2_background' => array(
                            'type' => 'group',
                            'label' => __('Extra Style 2 Background (style-2)', 'byobagn'),
                            'fields' => $o->full_background()),
                        'style_3_background' => array(
                            'type' => 'group',
                            'label' => __('Extra Style 3 Background (style-3)', 'byobagn'),
                            'fields' => $o->full_background()),
                        'style_4_background' => array(
                            'type' => 'group',
                            'label' => __('Extra Style 4 Background (style-4)', 'byobagn'),
                            'fields' => $o->full_background()),
                        'style_5_background' => array(
                            'type' => 'group',
                            'label' => __('Extra Style 5 Background (style-5)', 'byobagn'),
                            'fields' => $o->full_background())
                    )
                );

                return $options;
        }

        public function widget_design() {
                global $thesis;
                $css = $thesis->api->css->options;
                $o = new byobagn_design_options();
                $options = array(
                    'type' => 'object_set',
                    'label' => __('Widget Areas', 'byobagn'),
                    'select' => __('Select a widget area to edit:', 'byobagn'),
                    'objects' => array(
                        'sidebar' => array(
                            'type' => 'group',
                            'label' => __('Main Sidebar Widget Text', 'byobagn'),
                            'fields' => $o->paragraph()),
                        'sidebar_widget_links' => array(
                            'type' => 'group',
                            'label' => __('- Main Sidebar Widget Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'sidebar_widget_lists' => array(
                            'type' => 'group',
                            'label' => __('- Main Sidebar Widget Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'sidebar_heading' => array(
                            'type' => 'group',
                            'label' => __('- Main Sidebar Widget Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'sidebar_background' => array(
                            'type' => 'group',
                            'label' => __('- Main Sidebar Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'footer_widget' => array(
                            'type' => 'group',
                            'label' => __('Footer Widget Text', 'byobagn'),
                            'fields' => $o->text_area()),
                        'footer_widget_links' => array(
                            'type' => 'group',
                            'label' => __('- Footer Widget Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'footer_widget_lists' => array(
                            'type' => 'group',
                            'label' => __('- Footer Widget Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'footer_widget_heading' => array(
                            'type' => 'group',
                            'label' => __('- Footer Widget Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'footer_widget_background' => array(
                            'type' => 'group',
                            'label' => __('- Footer Widget Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'header_widget' => array(
                            'type' => 'group',
                            'label' => __('Header Widget Text', 'byobagn'),
                            'fields' => $o->paragraph()),
                        'header_widget_links' => array(
                            'type' => 'group',
                            'label' => __('- Header Widget Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'header_widget_lists' => array(
                            'type' => 'group',
                            'label' => __('- Header Widget Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'header_widget_heading' => array(
                            'type' => 'group',
                            'label' => __('- Header Widget Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'header_widget_background' => array(
                            'type' => 'group',
                            'label' => __('- Header Widget Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'feature_box_widget' => array(
                            'type' => 'group',
                            'label' => __('Feature Box Widget Text', 'byobagn'),
                            'fields' => $o->text_area()),
                        'feature_box_widget_links' => array(
                            'type' => 'group',
                            'label' => __('- Feature Box Widget Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'feature_box_widget_lists' => array(
                            'type' => 'group',
                            'label' => __('- Feature Box Widget Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'feature_box_widget_heading' => array(
                            'type' => 'group',
                            'label' => __('- Feature Box Widget Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'feature_box_widget_background' => array(
                            'type' => 'group',
                            'label' => __('- Feature Box Widget Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'attention_box_widget' => array(
                            'type' => 'group',
                            'label' => __('Attention Box Widget Text', 'byobagn'),
                            'fields' => $o->text_area()),
                        'attention_box_widget_links' => array(
                            'type' => 'group',
                            'label' => __('- Attention Box Widget Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'attention_box_widget_lists' => array(
                            'type' => 'group',
                            'label' => __('- Attention Box Widget Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'attention_box_widget_heading' => array(
                            'type' => 'group',
                            'label' => __('- Attention Box Widget Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'attention_box_widget_background' => array(
                            'type' => 'group',
                            'label' => __('- Attention Box Widget Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'supplemental_widget' => array(
                            'type' => 'group',
                            'label' => __('Supplemental Widget Text (supplemental)', 'byobagn'),
                            'fields' => $o->text_area()),
                        'supplemental_widget_links' => array(
                            'type' => 'group',
                            'label' => __('- Supplemental Widget Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'supplemental_widget_lists' => array(
                            'type' => 'group',
                            'label' => __('- Supplemental Widget Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'supplemental_widget_heading' => array(
                            'type' => 'group',
                            'label' => __('- Supplemental Widget Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'supplemental_widget_background' => array(
                            'type' => 'group',
                            'label' => __('- Supplemental Widget Background', 'byobagn'),
                            'fields' => $o->page_background()),
                        'supplemental_2_widget' => array(
                            'type' => 'group',
                            'label' => __('Supplemental 2 Widget Text (supplemental-2)', 'byobagn'),
                            'fields' => $o->text_area()),
                        'supplemental_2_widget_links' => array(
                            'type' => 'group',
                            'label' => __('- Supplemental 2 Widget Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'supplemental_2_widget_lists' => array(
                            'type' => 'group',
                            'label' => __('- Supplemental 2 Widget Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'supplemental_2_widget_heading' => array(
                            'type' => 'group',
                            'label' => __('- Supplemental 2 Widget Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'supplemental_2_widget_background' => array(
                            'type' => 'group',
                            'label' => __('- Supplemental 2 Widget Background', 'byobagn'),
                            'fields' => $o->page_background())
                    ),
                );

                return $options;
        }

        public function text_area_design() {
                global $thesis;
                $css = $thesis->api->css->options;
                $o = new byobagn_design_options();
                $options = array(
                    'type' => 'object_set',
                    'label' => __('Custom Text Areas', 'byobagn'),
                    'select' => __('Select a custom text area to edit:', 'byobagn'),
                    'objects' => array(
                        'custom_1_typical_text' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 Typical Text (custom-1)', 'byobagn'),
                            'fields' => $o->text_area()),
                        'custom_1_links' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'custom_1_lists' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'custom_1_heading' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_1_subheading' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 Sub Headings (h2)', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_1_subsubheading' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 Sub Sub Headings (h3, h4)', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_1_section_title' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 Section Title', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_1_mq_800' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 - Tablet Portrait Adjustments', 'byobagn'),
                            'fields' => $o->custom_text_area_media_queries()),
                        'custom_1_mq_699' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 - Phone Landscape Adjustments', 'byobagn'),
                            'fields' => $o->custom_text_area_media_queries()),
                        'custom_1_mq_415' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 1 - Phone Portrait Adjustments', 'byobagn'),
                            'fields' => $o->custom_text_area_media_queries()),
                        'custom_2_typical_text' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 Typical Text (custom-2)', 'byobagn'),
                            'fields' => $o->text_area()),
                        'custom_2_links' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'custom_2_lists' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'custom_2_heading' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_2_subheading' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 Sub Headings (h2)', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_2_subsubheading' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 Sub Sub Headings (h3, h4)', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_2_section_title' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 Section Title', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_2_mq_800' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 - Tablet Portrait Adjustments', 'byobagn'),
                            'fields' => $o->custom_text_area_media_queries()),
                        'custom_2_mq_699' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 - Phone Landscape Adjustments', 'byobagn'),
                            'fields' => $o->custom_text_area_media_queries()),
                        'custom_2_mq_415' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 2 - Phone Portrait Adjustments', 'byobagn'),
                            'fields' => $o->custom_text_area_media_queries()),
                        'custom_3_typical_text' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 Typical Text (custom-3)', 'byobagn'),
                            'fields' => $o->text_area()),
                        'custom_3_links' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 Links', 'byobagn'),
                            'fields' => $o->links()
                        ),
                        'custom_3_lists' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 Lists', 'byobagn'),
                            'fields' => $o->lists()
                        ),
                        'custom_3_heading' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 Headings', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_3_subheading' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 Sub Headings (h2)', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_3_subsubheading' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 Sub Sub Headings (h3, h4)', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_3_section_title' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 Section Title', 'byobagn'),
                            'fields' => $o->headings()),
                        'custom_3_mq_800' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 - Tablet Portrait Adjustments', 'byobagn'),
                            'fields' => $o->custom_text_area_media_queries()),
                        'custom_3_mq_699' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 - Phone Landscape Adjustments', 'byobagn'),
                            'fields' => $o->custom_text_area_media_queries()),
                        'custom_3_mq_415' => array(
                            'type' => 'group',
                            'label' => __('Custom Text Area 3 - Phone Portrait Adjustments', 'byobagn'),
                            'fields' => $o->custom_text_area_media_queries()),
                    )
                );

                return $options;
        }

        public function icon_design() {
                global $thesis;
                $css = $thesis->api->css->options;
                $o = new byobagn_design_options();
                $options = array(
                    'type' => 'object_set',
                    'label' => __('Icon Styles', 'byobagn'),
                    'select' => __('Select an Icon style to edit:', 'byobagn'),
                    'objects' => array(
                        'social_icon_style_1' => array(
                            'type' => 'group',
                            'label' => __('Social Icon Style 1', 'byobagn'),
                            'fields' => $o->social_icon_styles()),
                        'social_icon_style_2' => array(
                            'type' => 'group',
                            'label' => __('Social Icon Style 2', 'byobagn'),
                            'fields' => $o->social_icon_styles()),
                        'plain_icon' => array(
                            'type' => 'group',
                            'label' => __('Plain Icon Style', 'byobagn'),
                            'fields' => $o->icon_styles()),
                        'circle_positive' => array(
                            'type' => 'group',
                            'label' => __('Circle Positive Icon Style', 'byobagn'),
                            'fields' => $o->icon_styles()),
                        'circle_negative' => array(
                            'type' => 'group',
                            'label' => __('Circle Negative Icon Style', 'byobagn'),
                            'fields' => $o->icon_styles()),
                        'square_positive' => array(
                            'type' => 'group',
                            'label' => __('Square Positive Icon Style', 'byobagn'),
                            'fields' => $o->icon_styles()),
                        'square_negative' => array(
                            'type' => 'group',
                            'label' => __('Square Negative Style', 'byobagn'),
                            'fields' => $o->icon_styles()),
                        'rounded_square_positive' => array(
                            'type' => 'group',
                            'label' => __('Rounded Square Positive Icon Style', 'byobagn'),
                            'fields' => $o->icon_styles()),
                        'rounded_square_negative' => array(
                            'type' => 'group',
                            'label' => __('Rounded Square Negative Style', 'byobagn'),
                            'fields' => $o->icon_styles())
                    )
                );

                return $options;
        }

        public function cta_design() {
                global $thesis;
                $css = $thesis->api->css->options;
                $o = new byobagn_design_options();
                $options = array(
                    'type' => 'object_set',
                    'label' => __('Call to Action Styles', 'byobagn'),
                    'select' => __('Select a Call to Action style element to edit:', 'byobagn'),
                    'objects' => array(
                        'cta_1_background' => array(
                            'type' => 'group',
                            'label' => __('Style 1 Background', 'byobagn'),
                            'fields' => $o->cta_background()),
                        'cta_1_heading' => array(
                            'type' => 'group',
                            'label' => __('Style 1 Heading', 'byobagn'),
                            'fields' => $o->headings()),
                        'cta_1_message' => array(
                            'type' => 'group',
                            'label' => __('Style 1 Message', 'byobagn'),
                            'fields' => $o->text_area()),
                        'cta_1_link' => array(
                            'type' => 'group',
                            'label' => __('Style 1 Submit Button', 'byobagn'),
                            'fields' => $o->submit()),
                        'cta_1_label' => array(
                            'type' => 'group',
                            'label' => __('Style 1 Email Form Labels', 'byobagn'),
                            'fields' => $o->labels()),
                        'cta_2_background' => array(
                            'type' => 'group',
                            'label' => __('Style 2 Background', 'byobagn'),
                            'fields' => $o->cta_background()),
                        'cta_2_heading' => array(
                            'type' => 'group',
                            'label' => __('Style 2 Heading', 'byobagn'),
                            'fields' => $o->headings()),
                        'cta_2_message' => array(
                            'type' => 'group',
                            'label' => __('Style 2 Message', 'byobagn'),
                            'fields' => $o->text_area()),
                        'cta_2_link' => array(
                            'type' => 'group',
                            'label' => __('Style 2 Submit Button', 'byobagn'),
                            'fields' => $o->submit()),
                        'cta_2_label' => array(
                            'type' => 'group',
                            'label' => __('Style 2 Email Form Labels', 'byobagn'),
                            'fields' => $o->labels()),
                        'cta_3_background' => array(
                            'type' => 'group',
                            'label' => __('Style 3 Background', 'byobagn'),
                            'fields' => $o->cta_background()),
                        'cta_3_heading' => array(
                            'type' => 'group',
                            'label' => __('Style 3 Heading', 'byobagn'),
                            'fields' => $o->headings()),
                        'cta_3_message' => array(
                            'type' => 'group',
                            'label' => __('Style 3 Message', 'byobagn'),
                            'fields' => $o->text_area()),
                        'cta_3_link' => array(
                            'type' => 'group',
                            'label' => __('Style 3 Submit Button', 'byobagn'),
                            'fields' => $o->submit()),
                        'cta_3_label' => array(
                            'type' => 'group',
                            'label' => __('Style 3 Email Form Labels', 'byobagn'),
                            'fields' => $o->labels())
                    )
                );

                return $options;
        }

        public function media_query_design() {
                global $thesis;
                $css = $thesis->api->css->options;
                $o = new byobagn_design_options();
                $options = array(
                    'type' => 'object_set',
                    'label' => __('Custom Media Queries', 'byobagn'),
                    'select' => __('Select an media query to edit:', 'byobagn'),
                    'objects' => array(
                        'mq_desktop_1280' => array(
                            'type' => 'group',
                            'label' => __('Media Query - Desktop - 1280px wide', 'byobagn'),
                            'fields' => $o->media_queries()
                        ),
                        'mq_desktop_1140' => array(
                            'type' => 'group',
                            'label' => __('Media Query - Desktop - 1140px wide', 'byobagn'),
                            'fields' => $o->media_queries()
                        ),
                        'mq_tablet_lanscape' => array(
                            'type' => 'group',
                            'label' => __('Media Query - Tablet Devices, Landscape', 'byobagn'),
                            'fields' => $o->media_queries()
                        ),
                        'mq_tablet_portrait' => array(
                            'type' => 'group',
                            'label' => __('Media Query - Tablet Devices, Portrait', 'byobagn'),
                            'fields' => $o->media_queries()
                        ),
                        'mq_phone_lanscape' => array(
                            'type' => 'group',
                            'label' => __('Media Query - Smart Phone Devices, Landscape', 'byobagn'),
                            'fields' => $o->media_queries()
                        ),
                        'mq_phone_portrait' => array(
                            'type' => 'group',
                            'label' => __('Media Query - Smart Phone Devices, Portrait', 'byobagn'),
                            'fields' => $o->media_queries()
                        )
                    )
                );

                return $options;
        }

}
