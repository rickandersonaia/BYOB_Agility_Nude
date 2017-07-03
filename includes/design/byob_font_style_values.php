<?php

/**
 * This class returns either values or rules
 *
 * @author Rick
 */
class byob_font_style_values {

        public $design = array();

        public function __construct($design) {
                $this->design = $design;
        }

        // takes the design option id ($name) and potentially a default family
        // return a formatted font - either the design option, the default, or false
        public function font_family($name, $default = false) {
                global $thesis;
                // initialize the return value to false
                $font_family = false;
                if (!empty($this->design[$name]['font-family'])) {
                        // if there is a design option - use it
                        $font_family = $thesis->api->fonts->family($this->design[$name]['font-family']);
                } elseif ($default) {
                        // otherwise if there is a default supplied - use it.
                        $font_family = $thesis->api->fonts->family($default);
                }
                return $font_family;
        }

        // takes the design option id ($name) and a default size
        // returns a formatted font size - or false
        public function font_size($name, $default = false) {
                global $thesis;
                // initialize the return value to false
                $font_size = false;
                if (!empty($this->design[$name]['font-size'])) {
                        // if there is a design option - use it
                        $font_size = $thesis->api->css->number($this->design[$name]['font-size']);
                } elseif (!empty($default)) {
                        // otherwise if there is a default supplied - use it.
                        $font_size = $thesis->api->css->number($default);
                }
                return $font_size;
        }

        // takes the design option id ($name) the default line height, the default column configuration  ($width)
        // and the type of line height calculation to perform - (heading or primary)
        // return a formatted line height
        public function line_height($name, $default_line_height = false, $width = false, $type = 'primary', $default_font_size = false) {
                global $thesis;
                // initialize the return value to false
                $line_height = false;

                // get the font family set for this design option id
                $font_family = !empty($this->design[$name]['font-family']) ? $this->design[$name]['font-family'] : false;

                // if either font-family or font-size are specified then either use specified line height or calculate
                if (!empty($this->design[$name]['font-family']) || !empty($this->design[$name]['font-size'])) {
                        if (!empty($this->design[$name]['line-height'])) {
                                // if the user has specifed a line height - use it
                                $line_height = $thesis->api->css->number($this->design[$name]['line-height']);
                        } else {
                                // otherwise calculate the line height
                                // takes the design option id ($name), the font family - if any, the default line height - if any
                                // the column configuration ($width), and the type of line height calc to perform
                                // gets an unformatted number in return
                                $line_height = $thesis->api->css->number($this->calculate_line_height($name, $font_family, $default_line_height, $width, $type, $default_font_size));
                        }

                        // if neither font-family nor font-size are specified then either use specified line height or default line heighr
                } else {
                        if (!empty($this->design[$name]['line-height'])) {
                                // if the user has specifed a line height - use it
                                $line_height = $thesis->api->css->number($this->design[$name]['line-height']);
                        } else {
                                // otherwise if there is a default line height - use it
                                $line_height = $default_line_height ? $thesis->api->css->number($default_line_height) : false;
                        }
                }
                return $line_height;
        }

        // takes the design option id ($name), the font family,  the default line height($default_size), the column configuration  ($width)
        // and the type of line height calculation to perform - (heading or primary)
        // return an integer
        public function calculate_line_height($name, $font_family = false, $default_size = false, $width = 'two-thirds', $type = 'primary', $default_font_size = false) {
                global $thesis;
                $calc = new byob_text_dimensions_calculation();

                // calculate default font size
                // initialize the font size to false
                $font_size = false;
                if (!empty($this->design[$name]['font-size'])) {
                        // if the user has specified a font size - use it
                        $font_size = $this->design[$name]['font-size'];
                } elseif (!empty($default_font_size)) {
                        //otherwise use the default
                        $font_size = $default_font_size;
                }

                // initialize the return value to false
                $line_height = false;
                if (!empty($this->design[$name]['line-height'])) {
                        // if the user has specified a line height - use it
                        $line_height = $this->design[$name]['line-height'];
                } else {
                        if ($type == 'heading') {
                                // if it is a heading type use the heading type calc
                                // takes font size, column configuration and font family
                                // rounds it and returns an whole number - as a float
                                $line_height = round($calc->height_headings($font_size, $width, $font_family));
                        } else {
                                // otherwise use the primary type calc
                                // takes font size, column configuration and font family
                                // rounds it and returns an whole number - as a float
                                $line_height = round($calc->height_text($font_size, $width, $font_family));
                        }
                }


                if ($line_height) {
                        return $line_height;
                } else {
                        return false;
                }
        }

        // takes givens and returns a line height, givens = the font family,  the font_size($default_size), the column configuration  ($width)
        // and the type of line height calculation to perform - (heading or primary)
        // return an integer
        public function calculate_line_height_from_givens($font_family, $font_size, $width = 'two-thirds', $type = 'primary') {
                global $thesis;
                $calc = new byob_text_dimensions_calculation();

                // initialize the return value to false
                $line_height = false;

                if ($type == 'heading') {
                        // if it is a heading type use the heading type calc
                        // takes font size, column configuration and font family
                        // rounds it and returns an whole number - as a float
                        $line_height = round($calc->height_headings($font_size, $width, $font_family));
                } else {
                        // otherwise use the primary type calc
                        // takes font size, column configuration and font family
                        // rounds it and returns an whole number - as a float
                        $line_height = round($calc->height_text($font_size, $width, $font_family));
                }


                if ($line_height) {
                        return $line_height;
                } else {
                        return false;
                }
        }

        public function additional_styles($name) {
                global $thesis;
                $result = '';
                if (!empty($this->design[$name]['font-weight'])) {
                        $result .= "\n\tfont-weight:" . $this->design[$name]['font-weight'] . ";";
                }
                if (!empty($this->design[$name]['font-style'])) {
                        $result .= "\n\tfont-style:" . $this->design[$name]['font-style'] . ";";
                }
                if (!empty($this->design[$name]['font-variant'])) {
                        $result .= "\n\tfont-variant:" . $this->design[$name]['font-variant'] . ";";
                }
                if (!empty($this->design[$name]['text-transform'])) {
                        $result .= "\n\ttext-transform:" . $this->design[$name]['text-transform'] . ";";
                }
                if (!empty($this->design[$name]['text-align'])) {
                        $result .= "\n\ttext-align:" . $this->design[$name]['text-align'] . ";";
                }
                if (!empty($this->design[$name]['letter-spacing'])) {
                        $result .= "\n\tletter-spacing:" . $thesis->api->css->number($this->design[$name]['letter-spacing']) . ";";
                }
                if (!empty($this->design[$name]['margin-top'])) {
                        $result .= "\n\tmargin-top:" . $thesis->api->css->number($this->design[$name]['margin-top']) . ";";
                }
                if (!empty($this->design[$name]['margin-right'])) {
                        $result .= "\n\tmargin-right:" . $thesis->api->css->number($this->design[$name]['margin-right']) . ";";
                }
                if (!empty($this->design[$name]['margin-bottom'])) {
                        $result .= "\n\tmargin-bottom:" . $thesis->api->css->number($this->design[$name]['margin-bottom']) . ";";
                }
                if (!empty($this->design[$name]['margin-left'])) {
                        $result .= "\n\tmargin-left:" . $thesis->api->css->number($this->design[$name]['margin-left']) . ";";
                }
                return $result;
        }

        public function link_styles($name, $state = 'link', $default_color = false) {
                $colors = new byob_color_values($this->design);
                $result = '';
                if (!empty($this->design[$name][$state . '_skin_color']) || !empty($this->design[$name][$state . '_color']) || $default_color) {

                        $color = $colors->set_link_colors($name, $state . '_skin_color', $state . '_color', $default_color);
                        $result .= "\n\tcolor: $color;";
                }
                if (!empty($this->design[$name][$state . '_decoration'])) {
                        $result .= "\n\ttext-decoration: " . $this->design[$name][$state . '_decoration'] . ";";
                }
                return $result;
        }

        public function list_styles($name) {
                global $thesis;
                $result = '';
                if (!empty($this->design[$name]['list-style-type'])) {
                        if ($this->design[$name]['list-style-type'] == 'icon') {
                                $result .= "\n\tlist-style-type:none;";
                        } else {
                                $result .= "\n\tlist-style-type:" . $this->design[$name]['list-style-type'] . ";";
                        }
                }
                if (!empty($this->design[$name]['list-style-position'])) {
                        $result .= "\n\tlist-style-position:" . $this->design[$name]['list-style-position'] . ";";
                }

                if (!empty($this->design[$name]['list-indent']['on'])) {
                        $margin = !empty($this->design[$name]['indent_size']) ? $thesis->api->css->number($this->design[$name]['indent_size']) : '24px';
                        $result .= "\n\tmargin-left:$margin;";
                }

                return $result;
        }

        public function list_item_styles($name) {
                $result = '';

                if (!empty($this->design[$name]['list-item-margin'])) {

                        $margin = $this->design[$name]['list-item-margin'] == 'half' ? '.5em' : '1em';
                        $result .= "\n\tmargin-bottom:$margin;";
                }
                if (!empty($this->design[$name]['list-style-type']) && $this->design[$name]['list-style-type'] == 'icon' && empty($this->design[$name]['list-style-position'])) {
                        $result .= "\n\tpadding-left:2em;";
                }

                return $result;
        }

        public function list_item_icon_styles($name) {
                $result = '';

                if (!empty($this->design[$name]['list-style-type']) && $this->design[$name]['list-style-type'] == 'icon') {
                        if (!empty($this->design[$name]['custom_icon'])) {
                                $icon = esc_html($this->design[$name]['custom_icon']);
                        } elseif (!empty($this->design[$name]['icon'])) {
                                $icon = $this->design[$name]['icon'];
                        } else {
                                $icon = 'f00c';
                        }
                        $result .= "\n\tcontent:'\\$icon';";
                        $result .= "\n\tfont-family: 'FontAwesome';";
                        $result .= "\n\tdisplay: inline-block;";
                        $result .= "\n\tmargin-right:1em;";
                }
                if (!empty($this->design[$name]['list-style-type']) && $this->design[$name]['list-style-type'] == 'icon' && empty($this->design[$name]['list-style-position'])) {
                        $result .= "\n\tmargin-left:-2em;";
                }
                return $result;
        }

        public function vertical_alignment_styles($name) {
                $result = '';

                if (!empty($this->design[$name]['vertical-align'])) {

                        $vert = $this->design[$name]['vertical-align'];
                        $result .= "\n\tvertical-align:$vert;";
                }

                return $result;
        }

}
