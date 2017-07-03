<?php

/**
 * Description of byob_menu_style_vars
 *
 * @author Rick
 */
class byob_menu_style_vars {

        //put your code here
        public $design = array();
        public $menu_elements = array();

        public function __construct($design) {
                global $thesis;
                $this->design = $design;
                $this->menu_elements = array(
                    'main_menu' => array(
                        'font-family' => false,
                        'font-size' => 16,
                        'font-weight' => false,
                        'font-style' => false,
                        'font-variant' => false,
                        'text-transform' => false,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'padding-top' => 10,
                        'padding-right' => 20,
                        'padding-bottom' => 10,
                        'padding-left' => 20,
                        'submenu_width' => 150,
                        'link_decoration' => false,
                        'hover_decoration' => false,
                        'link_text_color' => $this->design['cg_white'],
                        'link_background_color' => $this->design['c_bg_med'],
                        'hover_text_color' => $this->design['cg_white'],
                        'hover_background_color' => $this->design['c_cont_bg_med_dark'],
                        'current_text_color' => $this->design['cg_white'],
                        'current_background_color' => $this->design['c_bg_med_dark']),
                    'main_submenu' => array(
                        'font-family' => false,
                        'font-size' => 16,
                        'font-weight' => false,
                        'font-style' => false,
                        'font-variant' => false,
                        'text-transform' => false,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'padding-top' => false,
                        'padding-right' => false,
                        'padding-bottom' => false,
                        'padding-left' => false,
                        'link_text_color' => false,
                        'link_background_color' => $thesis->api->colors->css($this->design['c_bg_med']),
                        'link_decoration' => false,
                        'hover_decoration' => false,
                        'hover_text_color' => false,
                        'hover_background_color' => $thesis->api->colors->css($this->design['c_bg_dark']),
                        'current_text_color' => false,
                        'current_background_color' => false),
                    'header_menu' => array(
                        'font-family' => false,
                        'font-size' => 16,
                        'font-weight' => false,
                        'font-style' => false,
                        'font-variant' => false,
                        'text-transform' => false,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'padding-top' => 10,
                        'padding-right' => 20,
                        'padding-bottom' => 10,
                        'padding-left' => 20,
                        'submenu_width' => 150,
                        'link_text_color' => $thesis->api->colors->css($this->design['c_bg_dark']),
                        'link_background_color' => 'transparent',
                        'link_decoration' => false,
                        'hover_decoration' => false,
                        'hover_text_color' => $thesis->api->colors->css($this->design['c_cont_bg_med_dark']),
                        'hover_background_color' => 'transparent',
                        'current_text_color' => $thesis->api->colors->css($this->design['c_bg_med']),
                        'current_background_color' => 'transparent'),
                    'header_submenu' => array(
                        'font-family' => false,
                        'font-size' => 16,
                        'font-weight' => false,
                        'font-style' => false,
                        'font-variant' => false,
                        'text-transform' => false,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'padding-top' => false,
                        'padding-right' => false,
                        'padding-bottom' => false,
                        'padding-left' => false,
                        'link_text_color' => false,
                        'link_background_color' => false,
                        'link_decoration' => false,
                        'hover_decoration' => false,
                        'hover_text_color' => false,
                        'hover_background_color' => false,
                        'current_text_color' => false,
                        'current_background_color' => false),
                    'footer_menu' => array(
                        'font-family' => false,
                        'font-size' => 16,
                        'font-weight' => false,
                        'font-style' => false,
                        'font-variant' => false,
                        'text-transform' => false,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'padding-top' => 10,
                        'padding-right' => 20,
                        'padding-bottom' => 10,
                        'padding-left' => 20,
                        'submenu_width' => 150,
                        'link_text_color' => $thesis->api->colors->css($this->design['c_bg_light']),
                        'link_background_color' => 'transparent',
                        'link_decoration' => false,
                        'hover_decoration' => false,
                        'hover_text_color' => $thesis->api->colors->css($this->design['c_cont_bg_light']),
                        'hover_background_color' => 'transparent',
                        'current_text_color' => $thesis->api->colors->css($this->design['c_bg_light']),
                        'current_background_color' => 'transparent'),
                    'secondary_menu' => array(
                        'font-family' => false,
                        'font-size' => 16,
                        'font-weight' => false,
                        'font-style' => false,
                        'font-variant' => false,
                        'text-transform' => false,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'padding-top' => 10,
                        'padding-right' => 20,
                        'padding-bottom' => 10,
                        'padding-left' => 20,
                        'submenu_width' => 150,
                        'link_text_color' => $thesis->api->colors->css($this->design['c_bg_dark']),
                        'link_background_color' => 'transparent',
                        'link_decoration' => false,
                        'hover_decoration' => false,
                        'hover_text_color' => $thesis->api->colors->css($this->design['c_cont_bg_med_dark']),
                        'hover_background_color' => 'transparent',
                        'current_text_color' => $thesis->api->colors->css($this->design['c_bg_med']),
                        'current_background_color' => 'transparent'),
                    'secondary_submenu' => array(
                        'font-family' => false,
                        'font-size' => 16,
                        'font-weight' => false,
                        'font-style' => false,
                        'font-variant' => false,
                        'text-transform' => false,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'padding-top' => false,
                        'padding-right' => false,
                        'padding-bottom' => false,
                        'padding-left' => false,
                        'link_text_color' => false,
                        'link_background_color' => false,
                        'link_decoration' => false,
                        'hover_decoration' => false,
                        'hover_text_color' => false,
                        'hover_background_color' => false,
                        'current_text_color' => false,
                        'current_background_color' => false)
                );
        }

        public function design() {
                $primary = $this->primary_styles();
                $menu_supp = $this->menu_supplemental_styles();
                $submenu_supp = $this->submenu_supplemental_styles();
                $final_merged = array_merge_recursive($primary, $menu_supp, $submenu_supp);

                // setup the menu vars
                foreach ($final_merged as $name => $element) {
                        if (is_array($element)) {// since array_filter() didn't work here - get rid of all the false elements before setting up the vars
                                foreach ($element as $property => $value) {
                                        if ($value == false) {
                                                unset($element);
                                        }
                                }
                        }
                        if (!empty($element) && is_array($element)) {  // turn each array element into a property value pair on a new line
                                $vars[$name] = implode("\n\t", $element);
                        } else {
                                if (!empty($element)) { // otherwise turn the element into a single property value pair.
                                        $vars[$name] = $element;
                                } else {
                                        $vars[$name] = '';
                                }
                        }
                }
//                update_option('byob_agility', $vars);
                return $vars;
        }

        public function primary_styles() {
                global $thesis;
                $m = array(); // menu variable array
                foreach ($this->menu_elements as $name => $menu_element) {
                        foreach ($menu_element as $p => $def) {
                                switch ($p) {
                                        case 'font-family':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ?
                                                        "$p: " . $thesis->api->fonts->family($family[$name] = $this->design[$name][$p]) . ';' : (!empty($def) ?
                                                                "$p: " . $thesis->api->fonts->family($family[$name] = $def) . ';' : false);
                                                break;
                                        case 'font-size':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ?
                                                        "$p: " . ($size[$name] = $thesis->api->css->number($this->design[$name][$p])) . ";" : (!empty($def) ?
                                                                "$p: " . ($size[$name] = $thesis->api->css->number($def)) . ";" : false);
                                                break;
                                        case 'font-weight':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ? "$p: " . $this->design[$name][$p] . ';' : false;
                                                break;
                                        case 'font-style':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ? "$p: " . $this->design[$name][$p] . ';' : false;
                                                break;
                                        case 'font-variant':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ? "$p: " . $this->design[$name][$p] . ';' : false;
                                                break;
                                        case 'text-transform':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ? "$p: " . $this->design[$name][$p] . ';' : false;
                                                break;
                                        case 'text-align':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ? "$p: " . $this->design[$name][$p] . ';' : false;
                                                break;
                                        case 'letter-spacing':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ?
                                                        "$p: " . ($size[$name] = $thesis->api->css->number($this->design[$name][$p])) . ";" : (!empty($def) ?
                                                                "$p: " . ($size[$name] = $thesis->api->css->number($def)) . ";" : false);
                                                break;
                                        case 'padding-top':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ?
                                                        "$p: " . ($size[$name] = $thesis->api->css->number($this->design[$name][$p])) . ";" : (!empty($def) ?
                                                                "$p: " . ($size[$name] = $thesis->api->css->number($def)) . ";" : false);
                                                break;
                                        case 'padding-right':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ?
                                                        "$p: " . ($size[$name] = $thesis->api->css->number($this->design[$name][$p])) . ";" : (!empty($def) ?
                                                                "$p: " . ($size[$name] = $thesis->api->css->number($def)) . ";" : false);
                                                break;
                                        case 'padding-left':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ?
                                                        "$p: " . ($size[$name] = $thesis->api->css->number($this->design[$name][$p])) . ";" : (!empty($def) ?
                                                                "$p: " . ($size[$name] = $thesis->api->css->number($def)) . ";" : false);
                                                break;
                                        case 'padding-bottom':
                                                $m[$name][$p] = !empty($this->design[$name][$p]) ?
                                                        "$p: " . ($size[$name] = $thesis->api->css->number($this->design[$name][$p])) . ";" : (!empty($def) ?
                                                                "$p: " . ($size[$name] = $thesis->api->css->number($def)) . ";" : false);
                                                break;
                                        case 'link_text_color':
                                                if (!empty($this->design[$name][$p]) || !empty($this->design[$name]['link_text_skin_color'])) {
                                                        $value = !empty($this->design[$name]['link_text_skin_color']) ? $this->design[$name]['link_text_skin_color'] : false;
                                                        $color = !empty($value) ? $this->design[$value] : $this->design[$name][$p];
                                                        $m["{$name}_link"][$p] = "color: " . $thesis->api->colors->css($color) . ';';
                                                } else {
                                                        $m["{$name}_link"][$p] = !empty($def) ? "color: " . $thesis->api->colors->css($def) . ';' : false;
                                                }
                                                break;
                                        case 'link_background_color':
                                                if (!empty($this->design[$name][$p]) || !empty($this->design[$name]['link_background_skin_color'])) {
                                                        $value = !empty($this->design[$name]['link_background_skin_color']) ? $this->design[$name]['link_background_skin_color'] : false;
                                                        $color = !empty($value) ? $this->design[$value] : $this->design[$name][$p];

                                                        $final_color = $this->opacity_color($name, 'link_background_opacity', $color);

                                                        $m["{$name}_link"][$p] = "background-color: " . $thesis->api->colors->css($final_color) . ';';
                                                } else {
                                                        $m["{$name}_link"][$p] = !empty($def) ? "background-color: " . $thesis->api->colors->css($def) . ';' : false;
                                                }
                                                break;
                                        case 'link_decoration':
                                                if (!empty($this->design[$name][$p])) {
                                                        $m["{$name}_link"][$p] = "text-decoration: " . esc_attr($this->design[$name][$p]) . ';';
                                                }
                                                break;
                                        case 'hover_text_color':
                                                if (!empty($this->design[$name][$p]) || !empty($this->design[$name]['hover_text_skin_color'])) {
                                                        $value = !empty($this->design[$name]['hover_text_skin_color']) ? $this->design[$name]['hover_text_skin_color'] : false;
                                                        $color = !empty($value) ? $this->design[$value] : $this->design[$name][$p];
                                                        $m["{$name}_hover"][$p] = "color: " . $thesis->api->colors->css($color) . ';';
                                                } else {
                                                        $m["{$name}_hover"][$p] = !empty($def) ? "color: " . $thesis->api->colors->css($def) . ';' : false;
                                                }
                                                break;
                                        case 'hover_background_color':
                                                if (!empty($this->design[$name][$p]) || !empty($this->design[$name]['hover_background_skin_color'])) {
                                                        $value = !empty($this->design[$name]['hover_background_skin_color']) ? $this->design[$name]['hover_background_skin_color'] : false;
                                                        $color = !empty($value) ? $this->design[$value] : $this->design[$name][$p];
                                                        $final_color = $this->opacity_color($name, 'hover_background_opacity', $color);

                                                        $m["{$name}_hover"][$p] = "background-color: " . $thesis->api->colors->css($final_color) . ';';
                                                } else {
                                                        $m["{$name}_hover"][$p] = !empty($def) ? "background-color: " . $thesis->api->colors->css($def) . ';' : false;
                                                }
                                                break;
                                        case 'hover_decoration':
                                                if (!empty($this->design[$name][$p])) {
                                                        $m["{$name}_hover"][$p] = "text-decoration: " . esc_attr($this->design[$name][$p]) . ';';
                                                }
                                                break;
                                        case 'current_text_color':
                                                if (!empty($this->design[$name][$p]) || !empty($this->design[$name]['current_text_skin_color'])) {
                                                        $value = !empty($this->design[$name]['current_text_skin_color']) ? $this->design[$name]['current_text_skin_color'] : false;
                                                        $color = !empty($value) ? $this->design[$value] : $this->design[$name][$p];
                                                        $m["{$name}_current"][$p] = "color: " . $thesis->api->colors->css($color) . ';';
                                                } else {
                                                        $m["{$name}_current"][$p] = !empty($def) ? "color: " . $thesis->api->colors->css($def) . ';' : false;
                                                }
                                                break;
                                        case 'current_background_color':
                                                if (!empty($this->design[$name][$p]) || !empty($this->design[$name]['current_background_skin_color'])) {
                                                        $value = !empty($this->design[$name]['current_background_skin_color']) ? $this->design[$name]['current_background_skin_color'] : false;
                                                        $color = !empty($value) ? $this->design[$value] : $this->design[$name][$p];
                                                        $final_color = $this->opacity_color($name, 'current_background_opacity', $color);

                                                        $m["{$name}_current"][$p] = "background-color: " . $thesis->api->colors->css($final_color) . ';';
                                                } else {
                                                        $m["{$name}_current"][$p] = !empty($def) ? "background-color: " . $thesis->api->colors->css($def) . ';' : false;
                                                }
                                                break;
                                }
                        }

                        // clean out the menu array
                        $m[$name] = array_filter($m[$name]);
                }
                $m['main_submenu_width'] = !empty($this->design['main_menu']['submenu_width']) ? $thesis->api->css->number($this->design['main_menu']['submenu_width']) . ";" : "150px;";
                $m['footer_submenu_width'] = !empty($this->design['footer_menu']['submenu_width']) ? $thesis->api->css->number($this->design['footer_menu']['submenu_width']) . ";" : "150px;";
                $m['header_submenu_width'] = !empty($this->design['header_menu']['submenu_width']) ? $thesis->api->css->number($this->design['header_menu']['submenu_width']) . ';' : "150px;";
                $m['secondary_submenu_width'] = !empty($this->design['secondary_menu']['submenu_width']) ? $thesis->api->css->number($this->design['secondary_menu']['submenu_width']) . ";" : "150px;";
//                var_dump($final);
                return $m;
        }

        public function opacity_color($name, $option, $color) {
                $final_color = $color;
                $opacity = new byob_color_scheme();

                if ($color && !empty($this->design[$name][$option])) {
                        $final_color = $opacity->hex2rgba($final_color, $this->design[$name][$option]);
                }
                return $final_color;
        }

        public function menu_supplemental_styles() {
                global $thesis;
                $m = array();
                if (!empty($this->design['link_supplement']['applies_to'])) {
                        $menu = $this->design['link_supplement']['applies_to'];
                } else {
                        $menu = 'main_menu';
                }
                foreach (array('link_supplement', 'hover_supplement', 'current_supplement') as $name) {
                        if (!empty($this->design[$name])) {
                                if ($name == 'hover_supplement') {
                                        $element = $menu . "_hover";
                                } elseif ($name == 'current_supplement') {
                                        $element = $menu . "_current";
                                } else {
                                        $element = $menu;
                                }


                                $m[$element] = $this->shared_styles($element, $name);
//                                var_dump($m[$element]);
                        }
                        $m[$menu . '_item_width'] = !empty($this->design['link_supplement']['width']) ? "\n\twidth:" . $thesis->api->css->number($this->design['link_supplement']['width']) . ';' : "";
                }

                return $m;
        }

        public function submenu_supplemental_styles() {
                $m = array();
                if (!empty($this->design['submenu_link_supplement']['applies_to'])) {
                        $menu = $this->design['submenu_link_supplement']['applies_to'];
                } else {
                        $menu = 'main_submenu';
                }

                foreach (array('submenu_link_supplement', 'submenu_hover_supplement', 'submenu_current_supplement') as $name) {

                        if (!empty($this->design[$name])) {
                                if ($name == 'submenu_link_supplement')
                                        $element = $menu;
                                elseif ($name == 'submenu_hover_supplement')
                                        $element = $menu . "_hover";
                                elseif ($name == 'submenu_current_supplement')
                                        $element = $menu . "_current";

                                $m[$element] = $this->shared_styles($element, $name);
                        }
                }

                return $m;
        }

        public function shared_styles($element, $name) {
                global $thesis;
                $m = array();
                $m[$element]['left-margin'] = !empty($this->design[$name]['margin-left']) && is_numeric($this->design[$name]['margin-left']) ?
                        "\n\tmargin-left:" . $thesis->api->css->number($this->design[$name]['margin-left']) . ';' : false;

                $m[$element]['right-margin'] = !empty($this->design[$name]['margin-right']) && is_numeric($this->design[$name]['margin-right']) ?
                        "\n\tmargin-right:" . $thesis->api->css->number($this->design[$name]['margin-right']) . ';' : false;

                if (!empty($this->design[$name]['background-image']) || !empty($this->design[$name]['skin_image'])) {
                        if (!empty($this->design[$name]['background-image'])) {
                                $m[$element]['background-image'] = "\n\tbackground-image: url(" . $thesis->api->esc($this->design[$name]['background-image']) . ");";
                        } else {
                                $m[$element]['background-image'] = "\n\tbackground-image: url(" . $thesis->api->esc($this->design[$name]['skin_image']) . ");";
                        }
                }

                $m[$element]['background-position'] = !empty($this->design[$name]['background-position']) ?
                        "\n\tbackground-position:" . $this->design[$name]['background-position'] . ';' : false;

                $m[$element]['background-attachment'] = !empty($this->design[$name]['background-attachment']) ?
                        "\n\tbackground-attachment:" . $this->design[$name]['background-attachment'] . ';' : false;

                $m[$element]['background-repeat'] = !empty($this->design[$name]['background-repeat']) ?
                        "\n\tbackground-repeat:" . $this->design[$name]['background-repeat'] . ';' : false;

                $m[$element]['border-width'] = !empty($this->design[$name]['border-width']) ?
                        "\n\tborder-width:" . $thesis->api->css->number($this->design[$name]['border-width']) . ';' : false;

                $m[$element]['border-style'] = !empty($this->design[$name]['border-style']) ?
                        "\n\tborder-style:" . $this->design[$name]['border-style'] . ';' : false;

                if (!empty($this->design[$name]['border-color']) || !empty($this->design[$name]['skin_border-color'])) {
                        if (!empty($this->design[$name]['border-color'])) {
                                $m[$element]['border-color'] = "\n\tborder-color:" . $thesis->api->colors->css($this->design[$name]['border-color']) . ';';
                        } else {
                                $color_name = $this->design[$name]['skin_border-color'];
                                $m[$element]['border-color'] = "\n\tborder-color:" . $thesis->api->colors->css($this->design[$color_name]) . ';';
                        }
                }

                $m[$element]['border-radius'] = !empty($this->design[$name]['border-radius']) ?
                        "\n\tborder-radius:" . $thesis->api->css->number($this->design[$name]['border-radius']) . ';' : false;

                if (!empty($this->design[$name]['skin_shadow_color']) || !empty($this->design[$name]['shadow-color']) || !empty($this->design[$name]['shadow-offsets'])) {
                        $m[$element]['box-shadow'] = "\n\tbox-shadow:";
                        $m[$element]['box-shadow'] .=!empty($this->design[$name]['shadow-offsets']) ?
                                $thesis->api->css->number($this->design[$name]['shadow-offsets']) : '3px 3px 3px';

                        if (!empty($this->design[$name]['shadow-color'])) {
                                $color = $thesis->api->colors->css($this->design[$name]['shadow-color']);
                        } elseif (!empty($this->design[$name]['skin_shadow_color'])) {
                                $color_name = $this->design[$name]['skin_shadow_color'];
                                $color = $thesis->api->colors->css($this->design[$color_name]);
                        } else {
                                $color = 888888;
                        }
                        $final_color = $this->opacity_color($name, 'shadow_color_opacity', $color);
                        $m[$element]['box-shadow'] .= ' ' . $thesis->api->colors->css($final_color);

                        $m[$element]['box-shadow'] .= ';';
                }
                return array_filter($m[$element]);
        }

}
