<?php

/**
 * Description of byob_color_vars
 *
 * @author Rick
 */
class byob_color_values {

        public $design = array();

        public function __construct($design) {
                $this->design = $design;
        }

        public function set_color($name, $color = false) {
                global $thesis;
                $final_color = false;
                if (!empty($this->design[$name]['skin_color'])) {
                        $color_name = $this->design[$name]['skin_color'];
                        $final_color = $thesis->api->colors->css($this->design[$color_name]);
                } elseif (!empty($this->design[$name]['color'])) {
                        $final_color = $thesis->api->colors->css($this->design[$name]['color']);
                } elseif (!empty($color)) {
                        $final_color = $thesis->api->colors->css($color);
                }
                return $final_color;
        }

        public function set_link_colors($name, $skin_color_option, $custom_color_option, $color = false) {
                global $thesis;
                $final_color = false;
                if (!empty($this->design[$name][$skin_color_option])) {
                        $color_name = $this->design[$name][$skin_color_option];
                        $final_color = $thesis->api->colors->css($this->design[$color_name]);
                } elseif (!empty($this->design[$name][$custom_color_option])) {
                        $final_color = $thesis->api->colors->css($this->design[$name][$custom_color_option]);
                } elseif (!empty($color)) {
                        $final_color = $thesis->api->colors->css($color);
                }
                return $final_color;
        }

        public function set_background_colors($name, $skin_color_option, $custom_color_option, $color = false) {
                global $thesis;
                $final_color = false;
                $opacity = new byob_color_scheme();
                if (!empty($this->design[$name][$skin_color_option])) {
                        $color_name = $this->design[$name][$skin_color_option];
                        $final_color = $thesis->api->colors->css($this->design[$color_name]);
                } elseif (!empty($this->design[$name][$custom_color_option])) {
                        $final_color = $thesis->api->colors->css($this->design[$name][$custom_color_option]);
                } elseif (!empty($color)) {
                        $final_color = $thesis->api->colors->css($color);
                }
                if ($final_color && !empty($this->design[$name]['opacity'])) {
                        $intermediate_color = $final_color;
                        $final_color = $opacity->hex2rgba($intermediate_color, $this->design[$name]['opacity']);
                }
                return $final_color;
        }

        public function set_border_shadow_colors($name, $skin_color_option, $custom_color_option, $color = false) {
                global $thesis;
                $final_color = false;
                $opacity = new byob_color_scheme();
                if (!empty($this->design[$name][$skin_color_option])) {
                        $color_name = $this->design[$name][$skin_color_option];
                        $final_color = $thesis->api->colors->css($this->design[$color_name]);
                } elseif (!empty($this->design[$name][$custom_color_option])) {
                        $final_color = $thesis->api->colors->css($this->design[$name][$custom_color_option]);
                } elseif (!empty($color)) {
                        $final_color = $thesis->api->colors->css($color);
                }
                if ($final_color && !empty($this->design[$name]['shadow_color_opacity'])) {
                        $intermediate_color = $final_color;
                        $final_color = $opacity->hex2rgba($intermediate_color, $this->design[$name]['shadow_color_opacity']);
                }
                return $final_color;
        }

}
