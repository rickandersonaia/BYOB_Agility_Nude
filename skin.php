<?php
/*
  Name: BYOB Agility Nude
  Author: Rick Anderson BYOBWebsite.com
  Description: The Nude Version of BYOB Agility Skin. A responsive full width multi column layout skin. This version requires Thesis 2.2 or above
  Version:  3.2.1.4
  Requires: 2.3
  Class: byob_agility_nude
  Docs: https://www.byobwebsite.com/plugins/skins-for-thesis-theme-2-0/byob-agility-a-responsive-2-column-skin-for-thesis-2/
  License: MIT

  Copyright 2015 BYOBWebsite.
  DIYthemes, Thesis, and the Thesis Theme are registered trademarks of DIYthemes, LLC.

 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the
 * Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A P
 * ARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

class byob_agility_nude extends thesis_skin {

        public $menu_vars;
        public $vars = array();
        public $design = array();
        private $display_elements = array(// Associated filters for selected display options
            'global' => array(
                'top_bar' => 'byobagn_easy_header_top_header_bar_show',
                'top_menu' => 'byobagn_easy_header_top_menu_area_show',
                'top_footer' => 'byobagn_content_grid_top_footer_show',
                'bottom_footer' => 'byobagn_content_grid_bottom_footer_show'
            ),
            'front' => array(
                'feature_box' => 'byobagn_content_grid_feature_box_show',
                'attention_area' => 'byobagn_content_grid_attention_area_show',
                'featured_content' => 'byobagn_content_grid_featured_content_show',
            ),
            'page' => array(
                'large_featured_image' => 'byobagn_large_featured_image_page_show',
                'social_sharing' => 'byobagn_bottom_social_media_extender_page_show',
            ),
            'single' => array(
                'large_featured_image' => 'byobagn_large_featured_image_post_show',
                'author' => 'byobagn_author_link_post_show',
                'date' => 'thesis_post_date_post_show',
                'cats' => 'byobagn_category_link_post_show',
                'social_sharing_top' => 'byobagn_top_social_media_extender_post_show',
                'social_sharing_bottom' => 'byobagn_bottom_social_media_extender_post_show',
                'related_posts' => 'byobagn_related_posts_thumbnails_post_show',
                'prev_next' => 'byobagn_sub_columns_post_nav_show',
                'comments_intro' => 'thesis_comments_intro_show',
                'comments' => 'byobagn_comment_block_post_show',
                'comment_date' => 'thesis_comment_date_post_show',
                'comment_avatar' => 'thesis_comment_avatar_post_show'),
            'home' => array(
                'feature_box' => 'byobagn_content_grid_home_show',
                'thumbnail' => 'byobagn_thumbnail_featured_image_home_show',
                'author' => 'byobagn_author_link_home_show',
                'date' => 'thesis_post_date_home_show',
                'cats' => 'byobagn_category_link_home_show',
                'num_comments' => 'thesis_post_num_comments_home_show'),
            'archive' => array(
                'thumbnail' => 'byobagn_thumbnail_featured_image_archive_show',
                'author' => 'byobagn_author_link_archive_show',
                'date' => 'thesis_post_date_archive_show',
                'cats' => 'byobagn_category_link_archive_show',
                'num_comments' => 'thesis_post_num_comments_archive_show')
        );
        private $shared_display_elements = array(// Associated filters for selected display options

            'front' => array(
                'notice_bar' => 'byobagn_content_grid_notice_bar_show',
                'front_sharing' => 'byobagn_easy_responsive_columns_front_sharing_show',
            ),
            'single' => array(
                'social_sharing' => 'byobagn_bottom_social_media_extender_show',
                'social_icons_sidebar' => 'byobagn_social_profile_links_sidebar_show',
                'email_signup_form_sidebar' => 'byobagn_thesis_email_signup_call_to_action_sidebar_show',
                'email_signup_form_content' => 'byobagn_thesis_email_signup_call_to_action_content_show'),
            'page' => array(
                'social_icons_sidebar' => 'byobagn_social_profile_links_sidebar_show',
                'email_signup_form_sidebar' => 'byobagn_thesis_email_signup_call_to_action_sidebar_show',
                'email_signup_form_content' => 'byobagn_thesis_email_signup_call_to_action_content_show'),
            'home' => array(
                'social_icons_sidebar' => 'byobagn_social_profile_links_sidebar_show',
                'email_signup_form_sidebar' => 'byobagn_thesis_email_signup_call_to_action_sidebar_show',
                'email_signup_form_content' => 'byobagn_thesis_email_signup_call_to_action_content_show',
                'notice_bar' => 'byobagn_content_grid_notice_bar_show',
                'front_sharing' => 'byobagn_easy_responsive_columns_front_sharing_show'),
            'archive' => array(
                'social_icons_sidebar' => 'byobagn_social_profile_links_sidebar_show',
                'email_signup_form_sidebar' => 'byobagn_thesis_email_signup_call_to_action_sidebar_show',
                'email_signup_form_content' => 'byobagn_thesis_email_signup_call_to_action_content_show',
                'notice_bar' => 'byobagn_content_grid_notice_bar_show',
                'front_sharing' => 'byobagn_easy_responsive_columns_front_sharing_show')
        );
        public $options_scheme = '';
        public $alternate_design = array();
        public $full_design_options = array();
        public $functionality = array(
            'header_image' => true,
            'design_admin' => 'design_admin'
        );

        function construct() {

                global $thesis;
                global $byob_ah;

                if (!defined('BYOBAGN_PATH')) {
                        define('BYOBAGN_PATH', THESIS_USER_SKIN);
                }
                if (!defined('BYOBAGN_URL')) {
                        define('BYOBAGN_URL', THESIS_USER_SKIN_URL);
                }

                include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // this is needed to check for is_plugin_active()

                include_once(BYOBAGN_PATH . '/admin/byob_format_content.php');
                include_once(BYOBAGN_PATH . '/admin/byobagn_system_status.php');
                include_once(BYOBAGN_PATH . '/admin/byobagn_flatten_box_list.php');
                include_once(BYOBAGN_PATH . '/admin/byobagn_default_template_restore.php');

                include_once(BYOBAGN_PATH . '/includes/byob_widget_classes.php');
                include_once(BYOBAGN_PATH . '/includes/byob_yoast_compatibility.php');
                include_once(BYOBAGN_PATH . '/includes/byob_google_fonts.php');
                include_once(BYOBAGN_PATH . '/includes/byob_page_specific_content_widget.php');
	            include_once(BYOBAGN_PATH . '/includes/byob_get_post_types.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_config_id.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_config_classes.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_responsive_columns_helper.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_sidebars.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_featured_image.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byob_read_more_link.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byob_typical_query_options.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byob_typical_query.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_query_box_helper.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byob_post_title.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_excerpt.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_icon_helper.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_post_box_helper.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_social_media_extender_helper.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_post_meta_definitions.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_grid_content_patterns.php');
                include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_social_profile_helper.php');
	            include_once(BYOBAGN_PATH . '/includes/boxes/byobagn_get_attachment_id.php');

                include_once( BYOBAGN_PATH . '/includes/design/byobagn_original_font_spacing_calculation.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_text_dimensions_calculation.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_column_width_calculations.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_color_scheme.php');
                include_once( BYOBAGN_PATH . '/includes/design/byobagn_design_options.php');
                include_once( BYOBAGN_PATH . '/includes/design/byobagn_design.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_font_style_values.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_background_values.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_color_values.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_menu_style_vars.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_spacing_vars.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_font_style_vars.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_generate_css.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_generate_admin_css.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_generate_editor_css.php');
                include_once( BYOBAGN_PATH . '/includes/design/media_query_calcs.php');
                include_once( BYOBAGN_PATH . '/includes/design/byobagn_design_alternate.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_aggregate_alternate_options.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_determine_options_scheme.php');
                include_once( BYOBAGN_PATH . '/includes/design/byob_convert_options.php');

                $this->remove_emoji_scripts();

                //Types initializing post types
                add_action('after_setup_theme', array($this, 'initialize_types_toolset'));


                $byobagn_widget_class = new BYOBAgilityWidgetClasses;
                add_action('widgets_init', array($this, 'initialize_widgets'));

                add_filter('thesis_html_body_class', array($this, 'body_class'));
                add_filter('widget_text', 'do_shortcode');
                add_filter('wp_video_shortcode_class', array($this, 'video_widget_class'));// needed for mediaelement.js
                add_filter('mce_css', array($this, 'editor_css'));
                add_filter('wp_default_scripts', array($this, 'remove_jquery_migrate'));

                add_action('template_redirect', array($this, 'template_tag_functions'));
                add_action('template_redirect', array($this, 'add_responsive_video_script'));

                add_action('byobagn_header_image_hook', array($this, 'header_image'));

                add_action('wp_head', array($this, 'ie_filter_fix'));

                // determine if the skin is using the old or new options scheme
                // the old options scheme moved a bunch of options into boxes
                // the new options scheme keeps all options in $this->design

                $design_options = get_option("{$this->_class}__design", array());
//                var_dump($design_options);
                $scheme = new byob_determine_options_scheme();
                $this->options_scheme = $scheme->determine_current_options_scheme();

                // if the design options haven't been converted then combine them for the time being
                // conversion takes place at the initial save of Skin Design
                if ($this->options_scheme == 'old') {
                        $alt_options = new byob_aggregate_alternate_options();
                        $this->alternate_options = $alt_options->all_options();
                        $options = array_merge($design_options, $this->alternate_options);
                } else {
                        $options = $design_options;
                }
                $this->full_design_options = $options;

                if (!empty($options['convert']['reset']['reset'])) {
                        delete_option('byobagn_design_converted');
                }

                if (!empty($options['convert']['delete_old_options']['delete'])) {
                        delete_option('byobagn_design_converted');
                        $delete = new byob_convert_options();
                        $delete->delete_options();
                }

                // Setup Agility Image Sizes

                $fpwidth = !empty($options['image_sizes']['featured_page_h']) ? (int) $options['image_sizes']['featured_page_h'] : 415;
                $fpheight = !empty($options['image_sizes']['featured_page_v']) ? (int) $options['image_sizes']['featured_page_v'] : 260;
                add_image_size('agility-featured-page', $fpwidth, $fpheight, true);

                $ttwidth = !empty($options['image_sizes']['tiny_thumbnail_h']) ? (int) $options['image_sizes']['tiny_thumbnail_h'] : 75;
                $ttheight = !empty($options['image_sizes']['tiny_thumbnail_v']) ? (int) $options['image_sizes']['tiny_thumbnail_v'] : 75;
                add_image_size('agility-tiny-thumbnail', $ttwidth, $ttheight, true);

                add_post_type_support('page', 'excerpt');
                add_post_type_support('post', 'page-attributes');

                load_theme_textdomain('byobagn', BYOBAGN_PATH . '/languages');

                add_action('wp_default_scripts', array($this, 'move_jquery_into_footer'));
                add_action('after_setup_theme', array($this, 'remove_wp_embed'));

                add_action('wp_enqueue_scripts', array($this, 'add_scripts_and_styles'));


                if (is_admin()) {

                        if (!class_exists('byob_asset_handler'))
                                include_once( BYOBAGN_PATH . '/byob_asset_handler.php');
                        if (!isset($byob_ah)) {
                                $byob_ah = new byob_asset_handler;
                        }

                        if (!empty($_GET['canvas']) && ( $_GET['canvas'] == 'byob_agility_nude__design')) {
                                add_action('admin_footer', array($this, 'design_script'));
//                                add_action('admin_init', array($this, 'admin_scripts_and_styles'), 1);
                        }

                        new byobagn_system_status();
                        new byobagn_default_template_restore();
//                        var_dump(get_option('byob_agility_nude_templates'));

                        if (!empty($_GET['canvas']) && $_GET['canvas'] == 'agility_system_status') {
                                add_action('admin_enqueue_scripts', array($this, 'admin_scripts_and_styles'));
                        }

                        if ($thesis->environment == 'admin') {
                                add_action('init', array($this, 'init_wp'));
                        }
                }

                if (is_plugin_active('wordpress-seo/wp-seo.php') && version_compare($thesis->version, '2.2', '<')) {
                        $yoast = new byob_yoast_compatibility();
                }

                add_action('init', array($this, 'initialize_cmb_meta_boxes'), 9999);
                add_filter('cmb_meta_boxes', 'byobagn_metaboxes');
                add_filter('thesis_post_box_dependents', array($this, 'add_post_box_dependents'));
                add_filter('thesis_query_box_dependents', array($this, 'add_query_box_dependents'));

                // Google Web Fonts integration
                $byob_fonts = new byob_google_fonts($options);
                add_action('after_setup_theme', array($this, 'add_google_fonts_to_editor_styles'));

                // shared display elements set in template_tag_functions() below
                $this->set_display_elements();

//                $box_options = get_option('byob_boxes');
//                $template_options = get_option('byob_agility_nude_templates');
//                $sharing_options = unserialize($thesis->api->options['byobagn_social_sharing_links']);
//                var_dump($box_options);
//                var_dump($template_optiovar_dump($this->vars);
//                var_dump($options);
//                var_dump($thesis);
//                delete_option('byobagn_design_converted');
//                var_dump(get_option('byob_post_test'));
//                var_dump(get_option('byob_test'));
//                var_dump(get_option('byob_agility_nude_restore_templates'));
//                var_dump(get_option('byob_agility_nude_boxes'));
//                var_dump(get_option('byob_agility_nude_templates'));
        }

        /**
         * Initialize the metabox class.
         */
        public function initialize_cmb_meta_boxes() {
                if (!class_exists('cmb_Meta_Box'))
                        require_once BYOBAGN_PATH . '/includes/Custom-Metaboxes-and-Fields-for-WordPress-master/init.php';
        }

        public function initialize_widgets() {
                register_widget('byob_page_specific_content_widget');
        }

        // for the custom save design routine
        public function init_wp() {
                global $thesis;
                add_action("admin_post_{$this->_class}__design", array($this, 'save_design'));
        }

        public function initialize_types_toolset() {
                if (function_exists('wpcf_init_custom_types_taxonomies')) {
                        add_action('init', 'wpcf_init_custom_types_taxonomies', 1);
                }
        }

        public function header_image() {
                $this->header_image->html();
        }

        function init_design_admin() {
                wp_enqueue_style('byob-admin-style', BYOBAGN_URL . "/css/byobagn-admin-styles.css");
                wp_enqueue_style('thesis-options');
        }

        public function move_jquery_into_footer($wp_scripts) {

                if (is_admin()) {
                        return;
                }
                $options = get_option("{$this->_class}__design");
                if (!empty($options['scripts']['jquery_footer']['move'])) {
                        $wp_scripts->add_data('jquery', 'group', 1);
                        $wp_scripts->add_data('jquery-core', 'group', 1);
                        $wp_scripts->add_data('jquery-migrate', 'group', 1);
                }
        }

        public function remove_jquery_migrate(&$scripts) {
                $options = get_option("{$this->_class}__design");
                if (!is_admin() && !empty($options['scripts']['remove_jquery_migrate']['remove'])) {
                        $scripts->remove('jquery');
                        $scripts->add('jquery', false, array('jquery-core'));
                }
        }

        public function remove_wp_embed() {
                $options = get_option("{$this->_class}__design");
                if (!is_admin() && !empty($options['scripts']['remove_oembed_script']['remove'])) {
                        // Turn off oEmbed auto discovery.
                        add_filter('embed_oembed_discover', '__return_false');

                        // Don't filter oEmbed results.
                        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

                        // Remove oEmbed discovery links.
                        remove_action('wp_head', 'wp_oembed_add_discovery_links');

                        // Remove oEmbed-specific JavaScript from the front-end and back-end.
                        remove_action('wp_head', 'wp_oembed_add_host_js');

                        // Remove all embeds rewrite rules.
                        add_filter('rewrite_rules_array', 'disable_embeds_rewrites');
                }
        }

        public function remove_emoji_scripts() {
                $options = get_option("{$this->_class}__design");
                if (!empty($options['scripts']['remove_emoji_script']['remove'])) {
                        remove_action('wp_head', 'print_emoji_detection_script', 7);
                        remove_action('admin_print_scripts', 'print_emoji_detection_script');
                        remove_action('wp_print_styles', 'print_emoji_styles');
                        remove_action('admin_print_styles', 'print_emoji_styles');
                }
        }

        public function add_scripts_and_styles() {
                $options = get_option("{$this->_class}__design");
                if (!empty($options['scripts']['responsive_jquery']['use'])) {
                        wp_enqueue_script('jquery');
                        add_action('hook_after_html', array($this, 'footer_scripts'));
                }
                if (empty($options['scripts']['remove_menu_script']['remove'])) {
                        wp_enqueue_script('jquery');
                        add_action('hook_after_html', array($this, 'responsive_menu_scripts'));
                }
                if (!empty($options['main_menu']['center_menu']['center'])) {
                        wp_enqueue_script('jquery');
                        add_action('hook_after_html', array($this, 'center_menu_scripts'));
                }
                if (is_home() || is_archive()) {
                        wp_enqueue_script('jquery');
                        add_action('hook_after_html', array($this, 'archive_page_scripts'));
                }
        }

        public function add_video_script() {
                wp_enqueue_script('fitvids', BYOBAGN_URL . "/js/jquery.fitvids.js", array('jquery'), '', true);
        }

        // the following function required for the new video widgets - I don't know why yet
        // it adds a class name to the widget output that the mediaelement.js is looking for.

        public function video_widget_class(){
            return "wp-video-shortcode";
        }

        public function design_script() {
                global $thesis;
                $colors = array(
                    'c_bg_dark' => '#fff',
                    'c_bg_med_dark' => '#fff',
                    'c_bg_med' => '#fff',
                    'c_bg_light' => '#000',
                    'c_bg_very_light' => '#000',
                    'c_cont_bg_dark' => '#fff',
                    'c_cont_bg_med_dark' => '#000',
                    'c_cont_bg_med' => '#000',
                    'c_cont_bg_light' => '#000',
                    'c_cont_bg_very_light' => '#000',
                    'cg_black' => '#fff',
                    'cg_darkest' => '#fff',
                    'cg_very_dark' => '#fff',
                    'cg_dark' => '#fff',
                    'cg_med_dark' => '#000',
                    'cg_med' => '#000',
                    'cg_med_light' => '#000',
                    'cg_light' => '#000',
                    'cg_very_light' => '#000',
                    'cg_ligtest' => '#000',
                    'cg_white' => '#000');
                ?>
                <script>
                        jQuery( document ).ready( function ( $ ) {
                <?php foreach ($colors as $background => $text) { ?>
                                    $( "option[value='<?php echo $background; ?>']" ).css( { "background-color": "<?php echo $thesis->api->colors->css($this->design[$background]); ?>", "color": "<?php echo $text; ?>" } );

                <?php } ?>


                        } );
                </script>
                <?php
        }

        public function editor_css($mce_css) {
                if (!empty($mce_css))
                        $mce_css .= ',';

                $mce_css .= BYOBAGN_URL . '/css/editor-style.css';
                return $mce_css;
        }

        function add_google_fonts_to_editor_styles() {
                $trigger = 'do not print';

                $byob_fonts = new byob_google_fonts($this->full_design_options, $trigger);
                $font_url = $byob_fonts->admin_webfont_loader();

                add_editor_style($font_url);
        }

        public function template_tag_functions() {
                // functions to perform once the query has been set
                $this->set_shared_display_elements();
        }

        public function add_responsive_video_script() {
                global $wp_query;

                $post_meta = get_post_meta($wp_query->queried_object_id, 'byob_fit_vids');
                if (!$post_meta) {
                        $post_meta = get_post_meta($wp_query->post->ID, 'byob_fit_vids'); // trying to get property of a non-object
                }
                if ($post_meta) {
                        add_action('wp_enqueue_scripts', array($this, 'add_video_script'));
                        add_action('hook_after_html', array($this, 'video_footer_scripts'));
                }
        }

        public function add_post_box_dependents($dependents) {
                $dependents[] = 'byobagn_dependent_icon_box';
                $dependents[] = 'byobagn_dependent_read_more';
                $dependents[] = 'byobagn_typical_excerpt';
                return $dependents;
        }

        public function add_query_box_dependents($dependents) {
                $dependents[] = 'byobagn_dependent_icon_box';
                $dependents[] = 'byobagn_dependent_read_more';
                $dependents[] = 'byobagn_typical_excerpt';
                return $dependents;
        }

        public function boxes() {
                $retain_options = true;
                $converted = get_option('byobagn_design_converted');
                $design_options = get_option("byob_agility_nude__design");
                $display_old = !empty($design_options['convert']['reset']['reset']) || !empty($design_options['convert']['display_old_options']['display']) ? true : false;
//                var_dump($design_options);

                $boxes = array(
                    'byobagn_hook',
                    'byobagn_easy_header',
                    'byobagn_easy_responsive_columns',
                    'byobagn_sub_columns',
                    'byobagn_page_post_box',
                    'byobagn_archive_post_box',
                    'byobagn_single_post_box',
                    'byobagn_fluid_grid_post_box',
                    'byobagn_fluid_grid_wrapper',
                    'byobagn_enhanced_query_box',
                    'byobagn_featured_content_query_box',
                    'byobagn_icon_query_box',
                    'byobagn_related_posts_query_box',
                    'byobagn_related_posts_thumbnails',
                    'byobagn_content_grid',
                    'byobagn_call_to_action',
                    'byobagn_copyright_date',
                    'byobagn_phone_number',
                    'byobagn_wp_featured_image',
                    'byobagn_comment_block',
                    'byobagn_2_column_header',
                    'byobagn_1_column_header',
                    'byobagn_responsive_columns',
                    'byobagn_responsive_columns_wrapper',
                    'byobagn_responsive_columns_reverse_wrapper',
                    'byobagn_widget_columns',
                    'byobagn_read_more',
                    'byobagn_social_media_extender',
                    'byobagn_social_profile_links',
                    'byobagn_custom_post_nav',
                    'byobagn_embed_width',
                    'byobagn_schema_settings',
                    'byobagn_match_height',
                    'byobagn_title_and_tagline',
                    'byobagn_responsive_images',
                    'byobagn_header_image',
                    'byobagn_social_sharing_links',
                    'byobagn_thesis_email_signup_call_to_action'
                );

                if ($this->options_scheme !== 'new' && $display_old === true) {
                        $boxes[] = 'byobagn_design_mode';
                        $boxes[] = 'byobagn_background_design';
                        $boxes[] = 'byobagn_widget_design';
                        $boxes[] = 'byobagn_text_area_design';
                        $boxes[] = 'byobagn_icon_design';
                        $boxes[] = 'byobagn_cta_design';
                        $boxes[] = 'byobagn_media_query_design';
                }

                if (class_exists('thesis_facebook_like') || class_exists('thesis_google_plus_one') || class_exists('thesis_tweet_button') || class_exists('thesis_linkedin_share') || class_exists('thesis_pinterest_pin_it')) {
                        $boxes[] = 'byobagn_social_media_extender';
                };
                return $boxes;
        }

        public function packages() {
                return array(
                    'byobagn_columns_style',
                    'byobagn_two_column_header_style',
                    'byobagn_one_column_header_style',
                    'byobagn_skin_options_styles',
                    'byobagn_widget_styles',
                    'byobagn_extended_menu_styles',
                    'byobagn_media_queries');
        }

        public function meta_viewport() {
                return "initial-scale=1,width=device-width";
        }

        // Use Skin API method to enable Google Fonts in options dropdowns
        public function fonts() { // only runs on admin side
                $gfonts = new byob_google_fonts($this->design);
                $gfonts->add_google_fonts();
                $fonts = $gfonts->google_fonts;
                return !empty($fonts) ? $fonts : false;
        }

        public function add_a_font($fonts) {
//                var_dump($fonts);
                $fonts['Pacifico'] = array(
                    'name' => 'Pacifico',
                    'family' => '"Pacifico", cursive',
                    'styles' => 'Pacifico:700'
                );
                return $fonts;
        }

        public function set_display_elements() {
                // implement display options
                foreach ($this->display_elements as $settings_section => $filter_rules) {
                        foreach ($filter_rules as $name => $filter) {
                                if (empty($this->display[$settings_section]['display'][$name])) {
                                        add_filter($filter, '__return_false');
                                }
                        }
                }
        }

        public function set_shared_display_elements() {
                foreach ($this->shared_display_elements as $template => $filter_rules) {
                        if (is_page() && $template === 'page') {
                                foreach ($filter_rules as $name => $filter) {
                                        if (empty($this->display[$template]['display'][$name])) {
                                                add_filter($filter, '__return_false');
                                        }
                                }
                        } elseif (is_single() && $template === 'single') {
                                foreach ($filter_rules as $name => $filter) {
                                        if (empty($this->display[$template]['display'][$name])) {
                                                add_filter($filter, '__return_false');
                                        }
                                }
                        } elseif (is_front_page() && $template === 'front') {
                                update_option('byob_boxes', $this->shared_display_elements);
                                foreach ($filter_rules as $name => $filter) {
                                        if (empty($this->display[$template]['display'][$name])) {
                                                add_filter($filter, '__return_false');
                                        }
                                }
                        } elseif (is_home() && $template === 'home') {
                                foreach ($filter_rules as $name => $filter) {
                                        if (empty($this->display[$template]['display'][$name])) {
                                                add_filter($filter, '__return_false');
                                        }
                                }
                        } elseif (is_archive() && $template === 'archive') {
                                foreach ($filter_rules as $name => $filter) {
                                        if (empty($this->display[$template]['display'][$name])) {
                                                add_filter($filter, '__return_false');
                                        }
                                }
                        }
                }
        }

        public function _content_admin() {
                global $thesis;

                $li = '';
                $display = array();
                if (!empty($this->_instances))
                        foreach ($this->_instances as $name => $link) {
                                $this->_instances[$name]['li'] = "\t\t\t\t<li><a href=\"" . esc_url($link['url']) . "\">{$link['text']}</a></li>";
                                $instances[$name] = $link['text'];
                        }
                natcasesort($instances);

                $format = new byob_format_content($instances);
                $matrix = $format->format_instance_array();
//                var_dump($matrix);

                $li .=!empty($this->_instances['skin_thesis_attribution']) ? $this->_instances['skin_thesis_attribution']['li'] : '';

                if (method_exists($this, 'display')) {
                        $display = $thesis->api->form->fields($this->_display(), $this->_display, "{$this->_class}_", $this->_class, 10, 3);
                        echo
                        (!empty($_GET['saved']) ? $thesis->api->alert(wptexturize($_GET['saved'] === 'yes' ?
                                                        __('Display options saved!', 'thesis') :
                                                        __('Display options not saved. Please try again.', 'thesis')), 'options_saved', true, false, 3) : ''),
                        (is_array($display) && !empty($display) ?
                                "\t\t<h3 id=\"display_options\">" . sprintf(__('%s Skin Display Options', 'thesis'), $this->_name) . "</h3>\n" .
                                "\t\t<p>" . __('You can control the display of some of this Skin&#8217;s content via the options below.', 'thesis') . "</p>\n" .
                                "\t\t<form class=\"thesis_options_form\" method=\"post\" action=\"" . admin_url("admin-post.php?action={$this->_class}__display") . "\" enctype=\"multipart/form-data\">\n" .
                                $display['output'] .
                                "\t\t\t<input type=\"submit\" data-style=\"button save\" class=\"t_save\" id=\"save_options\" value=\"" . esc_attr(wptexturize(strip_tags(sprintf(__('Save Display Options', 'thesis'), $this->_name)))) . "\" />\n" .
                                "\t\t\t" . wp_nonce_field("{$this->_class}_display", "_wpnonce-{$this->_class}_display", true, false) . "\n" .
                                "\t\t</form>\n" : '');
                }

                echo "\t\t<h3 id=\"skin_content\">", sprintf(__('%s Skin Content', 'thesis'), $this->_name), "</h3>\n",
                "\t\t<div class=\"skin_content\">\n",
                "\t\t\t<p>", __('You can customize some of this Skin&#8217;s content by editing the following Boxes:', 'thesis'), "</p>\n";

                if (!empty($matrix)) {
                        foreach ($matrix as $section) {
                                if (!empty($section['instances'])) {
                                        echo "<br>\t\t\t<h4>{$section['label']}</h4>\n";
                                        echo "\t\t\t<p>{$section['description']}</p>\n";
                                        echo "\t\t\t<ul>\n";
                                        foreach ($section['instances'] as $name => $instance) {
                                                echo $format->open($instance);
                                                echo $this->_instances[$name]['li'];
                                                echo $format->close($instance);
                                        }
                                        echo "\t\t\t</ul>\n";
                                }
                        }
                }

                echo "\t\t</div>\n";
        }

        public function _save_box() {
                global $thesis;
                $thesis->wp->check('edit_theme_options');
                parse_str(stripslashes($_POST['form']), $form);
                if ($thesis->wp->nonce($form['_wpnonce-thesis-save-box'], 'thesis-save-box', true)) {
                        if (isset($form['byobagn_easy_header']) || isset($form['byobagn_content_grid'])) {
                                if (isset($form['byobagn_easy_header'])) {
                                        $box['byobagn_easy_header'] = $form['byobagn_easy_header'];
                                } else {
                                        $box['byobagn_content_grid'] = $form['byobagn_content_grid'];
                                }
                                $config_content_box = new byobagn_grid_content_patterns($box);
                                $boxes = $config_content_box->build_column_content(); // this is the fully modified box list
                        } else {
                                $boxes = $this->_boxes->save($form);
//                                var_dump($boxes);
                        }
                        if (is_array($boxes) && empty($boxes)) {
                                delete_option("{$this->_class}_boxes");
                        } elseif (is_array($boxes)) {
                                update_option("{$this->_class}_boxes", $boxes);
                        }

                        wp_cache_flush();
                        echo $thesis->api->alert(__('Whopee Box options saved!', 'thesis'), 'options_saved', true);
                } else
                        echo $thesis->api->alert(__('Box options not saved.', 'thesis'), 'options_saved', true);
                if ($thesis->environment == 'ajax')
                        die();
        }

        protected function display() {
                return array(// use an options object set for simplified display controls
                    'display' => array(
                        'type' => 'object_set',
                        'select' => __('Select content to display:', 'byobagn'),
                        'objects' => array(
                            'global' => array(
                                'type' => 'object',
                                'label' => __('Global Settings - These are site wide', 'byobagn'),
                                'fields' => array(
                                    'display' => array(
                                        'type' => 'checkbox',
                                        'options' => array(
                                            'top_bar' => __('Top bar', 'byobagn'),
                                            'top_menu' => __('Main top menu', 'byobagn'),
                                            'top_footer' => __('Top footer area', 'byobagn'),
                                            'bottom_footer' => __('Bottom footer area', 'byobagn')),
                                    ))),
                            'front' => array(
                                'type' => 'object',
                                'label' => __('Front Page (Front template)', 'byobagn'),
                                'fields' => array(
                                    'display' => array(
                                        'type' => 'checkbox',
                                        'options' => array(
                                            'feature_box' => __('Feature Box', 'byobagn'),
                                            'attention_area' => __('Attention Box Area', 'byobagn'),
                                            'featured_content' => __('Featured Content Area', 'byobagn'),
                                            'notice_bar' => __('Notice Bar', 'byobagn'),
                                            'front_sharing' => __('Social Sharing links', 'byobagn'))
                                    ))),
                            'page' => array(
                                'type' => 'object',
                                'label' => __('Pages', 'byobagn'),
                                'fields' => array(
                                    'display' => array(
                                        'type' => 'checkbox',
                                        'options' => array(
                                            'large_featured_image' => __('featured image', 'byobagn'),
                                            'social_sharing' => __('Social Sharing Links - bottom of page', 'byobagn'),
                                            'social_icons_sidebar' => __('Social Profile Icons - sidebar', 'byobagn'),
                                            'email_signup_form_sidebar' => __('Email sign up form - sidebar', 'byobagn'),
                                            'email_signup_form_content' => __('Email sign up form - bottom of content', 'byobagn'),
                                        )))),
                            'single' => array(
                                'type' => 'object',
                                'label' => __('Single Posts', 'byobagn'),
                                'fields' => array(
                                    'display' => array(
                                        'type' => 'checkbox',
                                        'options' => array(
                                            'author' => __('Author', 'byobagn'),
                                            'date' => __('Date', 'byobagn'),
                                            'cats' => __('Categories', 'byobagn'),
                                            'large_featured_image' => __('featured image', 'byobagn'),
                                            'prev_next' => __('Previous/next post links (Single template)', 'byobagn'),
                                            'comments_intro' => __('Number of comments link', 'byobagn'),
                                            'comments' => __('Comments', 'byobagn'),
                                            'comment_date' => __('Comment Date', 'byobagn'),
                                            'comment_avatar' => __('Comment Avatar', 'byobagn'),
                                            'social_sharing_top' => __('Social Sharing Links - top of post', 'byobagn'),
                                            'social_sharing_bottom' => __('Social Sharing Links - bottom of post', 'byobagn'),
                                            'social_icons_sidebar' => __('Social Profile Icons - sidebar', 'byobagn'),
                                            'email_signup_form_sidebar' => __('Email sign up form - sidebar', 'byobagn'),
                                            'email_signup_form_content' => __('Email sign up form - bottom of content', 'byobagn'),
                                            'related_posts' => __('Related Posts', 'byobagn'),
                                        )))),
                            'home' => array(
                                'type' => 'object',
                                'label' => __('Posts Page (Home template)', 'byobagn'),
                                'fields' => array(
                                    'display' => array(
                                        'type' => 'checkbox',
                                        'options' => array(
                                            'author' => __('Author', 'byobagn'),
                                            'date' => __('Date', 'byobagn'),
                                            'cats' => __('Categories', 'byobagn'),
                                            'thumbnail' => __('featured image', 'byobagn'),
                                            'num_comments' => __('Number of comments link', 'byobagn'),
                                            'social_icons_sidebar' => __('Social Profile Icons - sidebar', 'byobagn'),
                                            'email_signup_form_sidebar' => __('Email sign up form - sidebar', 'byobagn'),
                                            'email_signup_form_content' => __('Email sign up form - bottom of content', 'byobagn'),
                                            'notice_bar' => __('Notice Bar', 'byobagn'),
                                            'front_sharing' => __('Social Sharing links', 'byobagn')),
                                    ))),
                            'archive' => array(
                                'type' => 'object',
                                'label' => __('Archive Pages (Categories & Tags)', 'byobagn'),
                                'fields' => array(
                                    'display' => array(
                                        'type' => 'checkbox',
                                        'options' => array(
                                            'author' => __('Author', 'byobagn'),
                                            'date' => __('Date', 'byobagn'),
                                            'cats' => __('Categories', 'byobagn'),
                                            'thumbnail' => __('featured image', 'byobagn'),
                                            'num_comments' => __('Number of comments link', 'byobagn'),
                                            'social_icons_sidebar' => __('Social Profile Icons - sidebar', 'byobagn'),
                                            'email_signup_form_sidebar' => __('Email sign up form - sidebar', 'byobagn'),
                                            'email_signup_form_content' => __('Email sign up form - bottom of content', 'byobagn'),
                                            'notice_bar' => __('Notice Bar', 'byobagn'),
                                            'front_sharing' => __('Social Sharing links', 'byobagn')
                                        )))
                            )
                )));
        }

        public function design_admin() { // Skin API method for initiating alternate design options; return an array in Thesis Options API array format
                global $thesis;

                // start up the color system & initialize the $design property
                $this->init_skin_colors();
//                var_dump($this->design);
//
                // Get the skin color names
                $o = new byobagn_design_options($this->design);
                $names = $o->color_names();

                $design_colors = array(
                    'mode' => array(
                        'type' => 'radio',
                        'label' => __('Color Scheme Mode', 'byobagn'),
                        'options' => array(
                            '' => __('Set or adjust your own colors', 'byobagn'),
                            'complementary' => __('Complementary', 'byobagn'),
                            'split' => __('Split Complementary', 'byobagn'),
                            'triadic' => __('Triadic', 'byobagn'),
                            'analogous' => __('Analogous', 'byobagn'),
                            'monochrome' => __('Monochromatic', 'byobagn'),
                            'default' => __('Back to Default', 'byobagn'))),
                    'base_color' => $thesis->skin->color_scheme(array(// the Skin API contains a color_scheme() method for easy implementation
                        'id' => 'colors',
                        'label' => __('Base Color used to generate a color scheme', 'byobagn'),
                        'colors' => array(
                            'c_base' => __('Primary', 'byobagn')),
                        'default' => array(// use this section to set the default colors
                            'c_base' => 'ccab68'
                        )
                    )),
                    'flip' => array(
                        'type' => 'checkbox',
                        'label' => __('Flip the color calculation', 'byobagn'),
                        'tooltip' => __('Check this box when the Split Complementary or Triadic modes are not producing 3 distict colors', 'byobagn'),
                        'options' => array(
                            'flip' => __('Flip it & try again', 'byobagn'),
                        )
                    ),
                    'colors' => $thesis->skin->color_scheme(array(// the Skin API contains a color_scheme() method for easy implementation
                        'id' => 'colors',
                        'label' => __('Color Scheme used in the skin', 'byobagn'),
                        'colors' => array(
                            'c_bg_dark' => $names['swatch_1'],
                            'c_bg_med_dark' => $names['swatch_2'],
                            'c_bg_med' => $names['swatch_3'],
                            'c_bg_light' => $names['swatch_4'],
                            'c_bg_very_light' => $names['swatch_5'],
                            'c_cont_bg_dark' => $names['swatch_6'],
                            'c_cont_bg_med_dark' => $names['swatch_7'],
                            'c_cont_bg_med' => $names['swatch_8'],
                            'c_cont_bg_light' => $names['swatch_9'],
                            'c_cont_bg_very_light' => $names['swatch_10']
                        ),
                        'default' => array(
                            'c_bg_dark' => '745b27',
                            'c_bg_med_dark' => '9a7834',
                            'c_bg_med' => 'ccab68',
                            'c_bg_light' => 'e6d5b4',
                            'c_bg_very_light' => 'ffffff',
                            'c_cont_bg_dark' => '2d7685',
                            'c_cont_bg_med_dark' => 'b2a026',
                            'c_cont_bg_med' => '5485ab',
                            'c_cont_bg_light' => 'aabce6',
                            'c_cont_bg_very_light' => 'dedaf3',)
                            )
                    ),
                    'colors_gray' => $thesis->skin->color_scheme(array(// the Skin API contains a color_scheme() method for easy implementation
                        'id' => 'colors_gray',
                        'label' => __('Grey Color Range to Choose From or Alter - This color range is also used thoughout the site', 'byobptsd12'),
                        'colors' => array(
                            'cg_black' => __('Black', 'byobptsd12'),
                            'cg_darkest' => __('Darkest', 'byobptsd12'),
                            'cg_very_dark' => __('Very Dark', 'byobptsd12'),
                            'cg_dark' => __('Dark', 'byobptsd12'),
                            'cg_med_dark' => __('Medium Dark', 'byobptsd12'),
                            'cg_med' => __('Medium', 'byobptsd12'),
                            'cg_med_light' => __('Medium Light', 'byobptsd12'),
                            'cg_light' => __('Light', 'byobptsd12'),
                            'cg_very_light' => __('Very Light', 'byobptsd12'),
                            'cg_ligtest' => __('Lightest', 'byobptsd12'),
                            'cg_white' => __('White', 'byobptsd12')),
                        'default' => array(// use this section to set the default colors
                            'cg_black' => '000000',
                            'cg_darkest' => '171717',
                            'cg_very_dark' => '363636',
                            'cg_dark' => '555555',
                            'cg_med_dark' => '707070',
                            'cg_med' => '8A8A8A',
                            'cg_med_light' => 'A9A9A9',
                            'cg_light' => 'C0C0C0',
                            'cg_very_light' => 'D3D3D3',
                            'cg_ligtest' => 'FAFAFA',
                            'cg_white' => 'FFFFFF'))),
                );

                // Get the non color design elements
                $design_elements = new byobagn_design();

                // Setup the form parts
                $design_options_form_parts = array(
                    'color' => array(
                        'open' => '',
                        'fields' => $design_colors,
                        'heading' => __('BYOB Agility Nude Skin Design Color Options', 'byobagn'),
                        'save_label' => __('Save Color Options', 'byobagn'),
                        'close' => ''
                    ),
                    'fonts' => array(
                        'open' => '<div class="byobagn_canvas_left">',
                        'fields' => $design_elements->fonts_design($this->design),
                        'heading' => __('Font Style Options', 'byobagn'),
                        'save_label' => __('Save Font Options', 'byobagn'),
                        'close' => ''
                    ),
                    'backgrounds' => array(
                        'open' => '',
                        'fields' => $design_elements->background_design($this->design),
                        'heading' => __('Background Style Options', 'byobagn'),
                        'save_label' => __('Save Background Options', 'byobagn'),
                        'close' => ''
                    ),
                    'text_areas' => array(
                        'open' => '',
                        'fields' => $design_elements->text_area_design($this->design),
                        'heading' => __('Custom Text Area Options', 'byobagn'),
                        'save_label' => __('Save Custom Text Area Options', 'byobagn'),
                        'close' => ''
                    ),
                    'icons' => array(
                        'open' => '',
                        'fields' => $design_elements->icon_design($this->design),
                        'heading' => __('Icon Style Options', 'byobagn'),
                        'save_label' => __('Save Icon Style Options', 'byobagn')
                    ),
                    'config' => array(
                        'open' => '',
                        'fields' => $design_elements->configuration_design($this->design),
                        'heading' => __('Misc Skin Configuration Options', 'byobagn'),
                        'save_label' => __('Save Configuration Options', 'byobagn'),
                        'close' => '</div>'
                    ),
                    'menus' => array(
                        'open' => '<div class="byobagn_canvas_right">',
                        'fields' => $design_elements->menu_design($this->design),
                        'heading' => __('Menu Style Options', 'byobagn'),
                        'save_label' => __('Save Menu Options', 'byobagn'),
                        'close' => ''
                    ),
                    'widgets' => array(
                        'open' => '',
                        'fields' => $design_elements->widget_design($this->design),
                        'heading' => __('Widget Style Options', 'byobagn'),
                        'save_label' => __('Save Widget Style Options', 'byobagn'),
                        'close' => ''
                    ),
                    'cta' => array(
                        'fields' => $design_elements->cta_design($this->design),
                        'heading' => __('Call to Action Style Options', 'byobagn'),
                        'save_label' => __('Save Call to Action Styles', 'byobagn'),
                        'close' => ''
                    ),
                    'media_query' => array(
                        'open' => '',
                        'fields' => $design_elements->media_query_design($this->design),
                        'heading' => __('Media Query Options', 'byobagn'),
                        'save_label' => __('Save Media Query Options', 'byobagn'),
                        'close' => ''
                    ),
                    'dimensions' => array(
                        'open' => '',
                        'fields' => $design_elements->dimension_design($this->design),
                        'heading' => __('Skin Dimension Options', 'byobagn'),
                        'save_label' => __('Save Dimension Options', 'byobagn'),
                        'close' => '</div>'
                    )
                );


                // Produce the forms
                foreach ($design_options_form_parts as $part => $values) {

                        $options = $thesis->api->form->fields($values['fields'], $this->design, "{$this->_class}_", $this->_class, 3, 10);
                        $section_saved = !empty($_GET['part']) ? $_GET['part'] : '';
                        if (!empty($values['open'])) {
                                echo $values['open'];
                        }
                        echo "\t\t<div id=\"byobagn_$part\" class=\"t_skin_options $part\">\n";

                        echo (!empty($_GET['saved']) && $_GET['part'] === $part ? $thesis->api->alert(wptexturize($_GET['saved'] === 'yes' ?
                                                        sprintf(__('%s saved!', 'byobagn'), $values['heading']) :
                                                        sprintf(__('%s not saved. Please try again.', 'byobagn'), $this->_name)), 'options_saved', true, false, 2) : ''),
                        "\t\t<h3>", wptexturize($values['heading']), "</h3>\n",
                        "\t\t<form class=\"thesis_options_form\" method=\"post\" action=\"", admin_url("admin-post.php?action={$this->_class}__design"), "\" enctype=\"multipart/form-data\">\n",
                        "\t\t\t<div id=\"t_skin_options_$part\">\n",
                        $options['output'],
                        "\t\t\t</div>\n",
                        "\t\t\t<input type=\"submit\" data-style=\"button save\" class=\"t_save\" id=\"save_options\" value=\"", esc_attr(wptexturize($values['save_label'])), "\" />\n",
                        "\t\t\t", wp_nonce_field("{$this->_class}__design", "_wpnonce-{$this->_class}__design", true, false), "\n",
                        "\t\t</form>\n",
                        "<div style='clear:both;'></div></div><br><br>";
                        if (!empty($values['close'])) {
                                echo $values['close'];
                        }
                }
        }

        public function save_design() {
                global $thesis;
                $thesis->wp->check('edit_theme_options');
                $thesis->wp->nonce($_POST["_wpnonce-{$this->_class}__design"], "{$this->_class}__design");
                $saved = 'no';
                $pre_save_options = get_option("{$this->_class}__design");
                $convert_switch = get_option("byobagn_design_converted");
                $convert = empty($convert_switch) ? true : false;

                if (!empty($_POST[$this->_class])) {
                        // get the data from the post variable
                        $post_save = !empty($_POST[$this->_class]) ? $_POST[$this->_class] : array();

                        // get the part of design options being saved
                        if (array_key_exists('mode', $_POST[$this->_class])) {
                                $part = 'color';
                        } elseif (array_key_exists('main_menu', $_POST[$this->_class])) {
                                $part = 'menu';
                        } elseif (array_key_exists('primary_font_family', $_POST[$this->_class])) {
                                $part = 'fonts';
                        } elseif (array_key_exists('body_background', $_POST[$this->_class])) {
                                $part = 'backgrounds';
                        } elseif (array_key_exists('sidebar', $_POST[$this->_class])) {
                                $part = 'widgets';
                        } elseif (array_key_exists('cta_1_background', $_POST[$this->_class])) {
                                $part = 'cta';
                        } elseif (array_key_exists('custom_1_typical_text', $_POST[$this->_class])) {
                                $part = 'text_areas';
                        } elseif (array_key_exists('mq_desktop_1280', $_POST[$this->_class])) {
                                $part = 'media_query';
                        } elseif (array_key_exists('social_icon_style_1', $_POST[$this->_class])) {
                                $part = 'icons';
                        } elseif (array_key_exists('desktop_width', $_POST[$this->_class])) {
                                $part = 'dimensions';
                        } elseif (array_key_exists('skin_color_names', $_POST[$this->_class])) {
                                $part = 'config';
                        }

                        // replace the current design value with the new one
                        foreach ($post_save as $option => $value) {
                                $pre_save_options[$option] = $value;
                        }

                        // Go get all of the box options and save them here as well
                        if ($convert) {
                                $converted_options = new byob_convert_options();
                                $pre_save_converted_options = $converted_options->convert_old_design_mode_values($pre_save_options);
                        } else {
                                $pre_save_converted_options = $pre_save_options;
                        }


                        // clean out all of the empty values
                        $final_save = $this->array_filter_recursive($pre_save_converted_options);
//                        update_option('byob_post_test', $final_save);

                        if (empty($final_save))
                                delete_option("{$this->_class}__design");
                        else
                                update_option("{$this->_class}__design", $final_save);
                        $thesis->skin->_design_options();
                        if (is_array($map = $this->css_variables()) && is_array($vars = $thesis->skin->_css->update_vars($map)))
                                update_option("{$this->_class}_vars", $vars);
                        $thesis->skin->_write_css();
                        $saved = 'yes';
                }
                wp_redirect("admin.php?page=thesis&canvas={$this->_class}__design&saved=$saved&part=$part&#byobagn_$part");
                exit;
        }

        public function array_filter_recursive($array) {
                foreach ($array as $key => &$value) {
                        if (empty($value)) {
                                unset($array[$key]);
                        } else {
                                if (is_array($value)) {
                                        $value = $this->array_filter_recursive($value);
                                        if (empty($value)) {
                                                unset($array[$key]);
                                        }
                                }
                        }
                }

                return $array;
        }

        function init_skin_colors() {
                global $thesis;
                //initial setting of the $this->design property
                $this->design = get_option("{$this->_class}__design");

                $comp = 180;
                $split_2 = 210;
                $traid_2 = 240;
                $analog_2 = 330;
                if (!empty($this->design['flip']) && $this->design['flip']['flip'] == true) {
                        $comp = -180;
                        $split_2 = -150;
                        $traid_2 = -120;
                        $analog_2 = -30;
                }
                if (!empty($this->design['mode'])) {
                        $colors = new byob_color_scheme();
                        if (empty($this->design['c_base'])) {
                                $this->design['c_base'] = 'ccab68';
                        }
                        $this->design['c_bg_med'] = $primary = $this->design['c_base'];
                        $this->design['c_bg_dark'] = $colors->lightness($primary, 30, 'relative', true);
                        $this->design['c_bg_med_dark'] = $colors->lightness($primary, 20, 'relative', true);
                        $this->design['c_bg_light'] = $colors->lightness($primary, 20, 'relative');
                        $this->design['c_bg_very_light'] = $colors->lightness($primary, 40, 'relative');

                        if ($this->design['mode'] == 'default') {
                                $this->design['c_base'] = 'ccab68';

                                $this->design['c_bg_dark'] = '745b27';
                                $this->design['c_bg_med_dark'] = '9a7834';
                                $this->design['c_bg_med'] = 'ccab68';
                                $this->design['c_bg_light'] = 'e6d5b4';
                                $this->design['c_bg_very_light'] = 'ffffff';
                                $this->design['c_cont_bg_dark'] = '2d7685';
                                $this->design['c_cont_bg_med_dark'] = 'b2a026';
                                $this->design['c_cont_bg_med'] = '5485ab';
                                $this->design['c_cont_bg_light'] = 'aabce6';
                                $this->design['c_cont_bg_very_light'] = 'dedaf3';

                                $this->design['cg_black'] = '000000';
                                $this->design['cg_darkest'] = '171717';
                                $this->design['cg_very_dark'] = '363636';
                                $this->design['cg_dark'] = '555555';
                                $this->design['cg_med_dark'] = '707070';
                                $this->design['cg_med'] = '8A8A8A';
                                $this->design['cg_med_light'] = 'A9A9A9';
                                $this->design['cg_light'] = 'C0C0C0';
                                $this->design['cg_very_light'] = 'D3D3D3';
                                $this->design['cg_ligtest'] = 'FAFAFA';
                                $this->design['cg_white'] = 'FFFFFF';
                                return $this->design;
                        } elseif ($this->design['mode'] == 'complementary') {
                                $this->design['c_cont_bg_med'] = $complementary = $thesis->api->colors->hex($colors->hsl_to_rgb($colors->hsl_complement($colors->hsl($primary), $comp, 0, 0)));
                                $this->design['c_cont_bg_dark'] = $colors->lightness($complementary, 30, 'spread', true);
                                $this->design['c_cont_bg_med_dark'] = $colors->lightness($complementary, 20, 'spread', true);
                                $this->design['c_cont_bg_light'] = $colors->lightness($complementary, 20, 'relative');
                                $this->design['c_cont_bg_very_light'] = $colors->lightness($complementary, 30, 'relative');
                        } elseif ($this->design['mode'] == 'split') {
                                $this->design['c_cont_bg_med_dark'] = $split_comp_1 = $thesis->api->colors->hex($colors->hsl_to_rgb($colors->hsl_complement($colors->hsl($primary), 150, 0, 0)));
                                $this->design['c_cont_bg_med'] = $split_comp_2 = $thesis->api->colors->hex($colors->hsl_to_rgb($colors->hsl_complement($colors->hsl($primary), $split_2)));
                                $this->design['c_cont_bg_dark'] = $colors->lightness($split_comp_1, 20, 'relative', true);
                                $this->design['c_cont_bg_light'] = $colors->lightness($split_comp_2, 20, 'relative');
                                $this->design['c_cont_bg_very_light'] = $colors->lightness($split_comp_2, 30, 'relative');
                        } elseif ($this->design['mode'] == 'triadic') {
                                $this->design['c_cont_bg_med_dark'] = $split_comp_1 = $thesis->api->colors->hex($colors->hsl_to_rgb($colors->hsl_complement($colors->hsl($primary), 120, 0, 0)));
                                $this->design['c_cont_bg_med'] = $split_comp_2 = $thesis->api->colors->hex($colors->hsl_to_rgb($colors->hsl_complement($colors->hsl($primary), $traid_2, 0, 0)));
                                $this->design['c_cont_bg_dark'] = $colors->lightness($split_comp_1, 20, 'relative', true);
                                $this->design['c_cont_bg_light'] = $colors->lightness($split_comp_2, 20, 'relative');
                                $this->design['c_cont_bg_very_light'] = $colors->lightness($split_comp_2, 30, 'relative');
                        } elseif ($this->design['mode'] == 'analogous') {
                                $this->design['c_cont_bg_med_dark'] = $split_comp_1 = $thesis->api->colors->hex($colors->hsl_to_rgb($colors->hsl_complement($colors->hsl($primary), 30, 0, 0)));
                                $this->design['c_cont_bg_med'] = $split_comp_2 = $thesis->api->colors->hex($colors->hsl_to_rgb($colors->hsl_complement($colors->hsl($primary), $analog_2)));
                                $this->design['c_cont_bg_dark'] = $colors->lightness($split_comp_1, 20, 'relative', true);
                                $this->design['c_cont_bg_light'] = $colors->lightness($split_comp_2, 20, 'relative');
                                $this->design['c_cont_bg_very_light'] = $colors->lightness($split_comp_2, 30, 'relative');
                        } elseif ($this->design['mode'] == 'monochrome') {
                                $this->design['c_bg_very_light'] = $primary = $this->design['c_base'];
                                $this->design['c_bg_dark'] = $colors->lightness($primary, 40, 'relative', true);
                                $this->design['c_bg_med_dark'] = $colors->lightness($primary, 30, 'relative', true);
                                $this->design['c_bg_med'] = $colors->lightness($primary, 20, 'relative', true);
                                $this->design['c_bg_light'] = $colors->lightness($primary, 10, 'relative', true);
                                $this->design['c_cont_bg_dark'] = $colors->lightness($primary, 10, 'relative');
                                $this->design['c_cont_bg_med_dark'] = $colors->lightness($primary, 20, 'relative');
                                $this->design['c_cont_bg_med'] = $colors->lightness($primary, 25, 'relative');
                                $this->design['c_cont_bg_light'] = $colors->lightness($primary, 30, 'relative');
                                $this->design['c_cont_bg_very_light'] = $colors->lightness($primary, 40, 'relative');
                        }
                }
//                $vars = get_option('byob_agility_nude_vars');
//                var_dump($vars);
                return $this->design;
        }

        public function css_variables() {
                global $thesis;
                $this->design = get_option("{$this->_class}__design");

                $font_calc = new byob_font_style_vars($this->design);
                $space_calc = new byob_spacing_vars($this->design);
                $color_vars = new byob_color_values($this->design);
                $menus = new byob_menu_style_vars($this->design);
                $menu_vars = $menus->design();

                $colors = array(
                    'c_bg_dark',
                    'c_bg_med_dark',
                    'c_bg_med',
                    'c_bg_light',
                    'c_bg_very_light',
                    'c_cont_bg_dark',
                    'c_cont_bg_med_dark',
                    'c_cont_bg_med',
                    'c_cont_bg_light',
                    'c_cont_bg_very_light',
                    'cg_black',
                    'cg_darkest',
                    'cg_very_dark',
                    'cg_dark',
                    'cg_med_dark',
                    'cg_med',
                    'cg_med_light',
                    'cg_light',
                    'cg_very_light',
                    'cg_ligtest',
                    'cg_white'
                );
                foreach ($colors as $color) {
                        $vars[$color] = !empty($this->design[$color]) ? $thesis->api->colors->css($this->design[$color]) : false;
                }

                $vars['c_bg_input'] = $thesis->api->colors->css($this->design['cg_white']);
                $vars['c_bg_site'] = $color_vars->set_background_colors('body_background', 'skin_color', 'background-color', $this->design['cg_white']);

                // spacing vars
                $spacing_matrix = $space_calc->spacing_matrix();
                $full_spacing_matrix = $space_calc->full_spacing_matrix();

                $vars['page_width'] = $thesis->api->css->number($space_calc->page_width());
                $vars['x_padding_single'] = $vars['x_33_single'] = $vars['x_67_single'] = $thesis->api->css->number($spacing_matrix['x1']);
                $vars['x_padding_half'] = $vars['x_33_half'] = $vars['x_67_half'] = $thesis->api->css->number($spacing_matrix['x05']);
                $vars['x_padding_double'] = $vars['x_33_double'] = $vars['x_67_double'] = $thesis->api->css->number($spacing_matrix['x2']);
                $vars['x_padding_3over2'] = $vars['x_33_3over2'] = $vars['x_67_3over2'] = $thesis->api->css->number($spacing_matrix['x15']);
                $vars['x_100_single'] = $thesis->api->css->number($full_spacing_matrix['x1']);
                $vars['x_100_half'] = $thesis->api->css->number($full_spacing_matrix['x05']);
                $vars['x_100_double'] = $thesis->api->css->number($full_spacing_matrix['x2']);
                $vars['x_100_3over2'] = $thesis->api->css->number($full_spacing_matrix['x15']);

                $font_vars = $font_calc->generate_vars();

                $vars = array_merge($vars, $font_vars, $menu_vars);

                // Filter the array to remove any null elements
                array_filter($vars);
                $this->vars = $vars;
                return $vars;
        }

        public function filter_css($css) {
                global $thesis;
                $this->design = get_option("{$this->_class}__design");
                // create the admin CSS
//                $admin_css = new byob_generate_admin_css($this->design);
//                $admin_css->write_file();
                // create the editor CSS
                $editor_css = new byob_generate_editor_css($this->design, $this->vars);
                $editor_css->write_file();
                // Create the skin css
                $new_css = new byob_generate_css($this->design);
                // Add Font Awesome to the css
                $fonts = file_get_contents(BYOBAGN_PATH . '/css/font-awesome.min.css');
                $font_css = str_replace("url('../", "url('", $fonts);

                return $css . $new_css->css . $font_css;
        }

        public function generate_svg() {
                global $thesis;
                $str = '<?xml version="1.0" ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 1 1" preserveAspectRatio="none">
                      <linearGradient id="grad-ucgg-generated" gradientUnits="userSpaceOnUse" x1="0%" y1="0%" x2="0%" y2="100%">
                        <stop offset="0%" stop-color="' . $thesis->api->colors->css($this->design['c_bg_med']) . '" stop-opacity="1"/>
                        <stop offset="100%" stop-color="' . $thesis->api->colors->css($this->design['c_bg_dark']) . '" stop-opacity="1"/>
                      </linearGradient>
                      <rect x="0" y="0" width="1" height="1" fill="url(#grad-ucgg-generated)" />
                    </svg>';
                return base64_encode($str);
        }

        public function generate_ie_filter() {
                global $thesis;

                $filter = "progid:DXImageTransform.Microsoft.gradient( startColorstr='" . $thesis->api->colors->css($this->design['c_bg_med']) . "', endColorstr='" . $thesis->api->colors->css($this->design['c_bg_dark']) . "',GradientType=0 )";
                return $filter;
        }

        public function ie_filter_fix() {
                echo '<!--[if gte IE 9]>
                    <style type="text/css">
                      .gradient { filter: none; }
                    </style>
                  <![endif]-->';
        }

        public function body_class($classes) {

                $classes[] = 'agility';
                return $classes;
        }

        public function footer_scripts() {
                ?>
                <script>
                        jQuery( document ).ready( function ( $ ) {
                            var w = 0,
                                    x = 0,
                                    y = 0,
                                    z = 0;
                            var adjust_size = function () {
                                if ( $( ".page_wrapper" ).outerWidth() < 1024 && $( ".page_wrapper" ).outerWidth() > 800 ) {
                                    w = ( $( ".columns_312" ).outerWidth() - $( ".columns_312 .one-third" ).outerWidth() );
                                    $( ".columns_312 .two-thirds" ).css( "width", w );
                                    x = ( $( ".columns_321" ).outerWidth() - $( ".columns_321 .one-third" ).outerWidth() );
                                    $( ".columns_321 .two-thirds" ).css( "width", x );
                                    y = ( $( ".columns_431" ).outerWidth() - $( ".columns_431 .one-quarter" ).outerWidth() );
                                    $( ".columns_431 .three-quarters" ).css( "width", y );
                                    z = ( $( ".columns_413" ).outerWidth() - $( ".columns_413 .one-quarter" ).outerWidth() );
                                    $( ".columns_413 .three-quarters" ).css( "width", z );
                                } else {
                                    $( ".columns_312 .two-thirds" ).css( "width", "" );
                                    $( ".columns_321 .two-thirds" ).css( "width", "" );
                                    $( ".columns_431 .three-quarters" ).css( "width", "" );
                                    $( ".columns_413 .three-quarters" ).css( "width", "" );
                                }
                            }
                            adjust_size();
                            $( window ).resize( adjust_size );
                        } )
                </script>
                <?php
        }

        public function video_footer_scripts() {
                ?>
                <script>
                        jQuery( document ).ready( function ( $ ) {
                            $( "iframe[src*='oembed']" ).wrap( "<div class='video_player'></div>" );
                            $( "iframe[src*='player.vimeo']" ).wrap( "<div class='video_player'></div>" );
                            $( ".video_player" ).fitVids();
                        } )
                </script>
                <?php
        }

        public function responsive_menu_scripts() {
                ?>
                <script>
                        jQuery( document ).ready( function ( $ ) {
                            $( "span.menu_control" ).next().addClass( "responsive" );

                        } )
                </script>
                <?php
        }

        public function archive_page_scripts() {
                ?>
                <script>
                        jQuery( document ).ready( function ( $ ) {

                            function isEmpty( el ) {
                                return !$.trim( el.html() )
                            }

                            if ( isEmpty( $( '#post_nav .half' ) ) && isEmpty( $( '#post_nav .half.right' ) ) ) {
                                $( "#post_nav" ).css( "display", "none" );
                            }

                        } )
                </script>
                <?php
        }

        public function center_menu_scripts() {
                ?>
                <script>
                        jQuery( document ).ready( function ( $ ) {
                            if ( $( ".page_wrapper" ).outerWidth() > 800 ) {

                                var ulWidth = 0;
                                $( ".main.menu > li" ).each( function () {
                                    ulWidth = ulWidth + $( this ).width() + 2;
                                } );

                                $( ".main.menu" ).css( { "width": ulWidth, "margin": "0 auto" } );
                            }
                        } )
                </script>
                <?php
        }

}
