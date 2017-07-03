<?php

/**
 * Description of byobagn_system_status
 *
 * @author ander
 */
class byobagn_system_status {

        public function __construct() {
                add_filter('thesis_skin_menu', array($this, 'menu'), 5);
                if (!empty($_GET['canvas']) && $_GET['canvas'] == 'agility_system_status') {
                        add_action('thesis_admin_canvas', array($this, 'admin'));
                        add_action('admin_footer', array($this, 'js'));
                        add_action('admin_enqueue_scripts', array($this, 'add_scripts_and_styles'));
                }
        }

        public function menu($menu) {
                $menu['agility_system_status'] = array(
                    'text' => __('Agility System Status', 'byobagn'),
                    'url' => 'admin.php?page=thesis&canvas=agility_system_status',
                    'title' => __('Check your system for compatibility with Thesis.', 'byobagn'));
                return $menu;
        }

        public function add_scripts_and_styles() {
                wp_enqueue_style('thesis-options');
        }

        /*
          System Status admin page
         */

        public function admin() {
                global $thesis, $wp_version;
                $design_mode = get_option("byobagn_design_mode");
                $backgrounds = get_option("byobagn_background_design");
                $widgets = get_option("byobagn_widget_design");
                $text_areas = get_option("byobagn_text_area_design");
                $icons = get_option("byobagn_icon_design");
                $ctas = get_option("byobagn_cta_design");
                $mqs = get_option("byobagn_media_query_design");
                $converted = get_option('byobagn_design_converted');
                $scheme = new byob_determine_options_scheme();
                $options_scheme = $scheme->determine_current_options_scheme();

                echo
                "\t\t<h3>", __('Agility System Status', 'byobagn'), "</h3>\n",
                "\t\t<div class=\"option_item option_field\">\n",
                "\t\t\t<p>\n",
                "\t\t\t\t<textarea id=\"t_system_status\" rows=\"25\">\n",
                __('About Your Agility Installation', 'byobagn'), "\n",
                "===========================\n",
                sprintf(__('Thesis Version: %s', 'byobagn'), esc_attr($thesis->version)), "\n",
                sprintf(__('Current Skin Name: %s', 'byobagn'), esc_attr($thesis->skins->skin['name'])), "\n",
                sprintf(__('Current Skin Version: %s', 'byobagn'), esc_attr($thesis->skins->skin['version'])), "\n",
                (!empty($thesis->skins->skin['requires']) ? sprintf(__('Current Skin Requires: %s', 'byobagn'), esc_attr($thesis->skins->skin['requires'])) . "\n" : ""),
                sprintf(__('WordPress Version: %s', 'thesis'), esc_attr($wp_version)), "\n\n",
                __('Agility Design Options', 'byobagn'), "\n",
                "===========================\n";
                print_r(get_option("byob_agility_nude__design"));
                echo "\n", __('Old Agility Design Options', 'byobagn'), "\n",
                "===========================\n";
                if (!empty($design_mode)) {
                        echo __("Design Mode -", 'byobagn');
                        print_r($design_mode);
                }
                if (!empty($backgrounds)) {
                        echo __("Background Styles - ", 'byobagn');
                        print_r($backgrounds);
                }
                if (!empty($widgets)) {
                        echo __("Widget Styles - ", 'byobagn');
                        print_r($widgets);
                }
                if (!empty($text_areas)) {
                        echo __("Text Styles - ", 'byobagn');
                        print_r($text_areas);
                }
                if (!empty($icons)) {
                        echo __("Icon Styles - ", 'byobagn');
                        print_r($icons);
                }
                if (!empty($ctas)) {
                        echo __("Call to Action Styles - ", 'byobagn');
                        print_r($ctas);
                }
                if (!empty($mqs)) {
                        echo __("Custom Media Queries - ", 'byobagn');
                        print_r($mqs);
                }
                echo "\n", __('Misc Agility Options', 'byobagn'), "\n",
                "===========================\n";
                if (!empty($options_scheme)) {
                        echo __("Options Scheme - ", 'byobagn') . $options_scheme . "\n";
                }
                if (!empty($converted)) {
                        echo __('Have the old options been converted? - ', 'byobagn') . $converted . "\n";
                }
                echo "</textarea>\n",
                "\t\t\t</p>\n",
                "\t\t</div>\n";
        }

        /*
          Script to enable one-click highlighting for easy copy/paste of system status data
         */

        public function js() {
                echo
                "\t\t<script type=\"text/javascript\">\n",
                "\t\t\tjQuery(document).ready(function($){\n",
                "\t\t\t\tjQuery('#t_system_status').focus(function(){\n",
                "\t\t\t\t\tvar \$this = jQuery(this);\n",
                "\t\t\t\t\t\$this.select();\n",
                "\t\t\t\t\t\$this.mouseup(function() {\n",
                "\t\t\t\t\t\t\$this.unbind(\"mouseup\");\n",
                "\t\t\t\t\t\treturn false;\n",
                "\t\t\t\t\t});\n",
                "\t\t\t\t});\n",
                "\t\t\t});\n",
                "\t\t</script>\n";
        }

}
