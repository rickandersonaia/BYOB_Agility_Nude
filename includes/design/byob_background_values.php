<?php

/**
 * Description of byoib_background_values
 *
 * @author Rick
 */
class byob_background_values {

        public $design = array();

        public function __construct($design) {
                $this->design = $design;
        }

        public function background_image($name) {
                $design = $this->design;
                $output = '';
                if (!empty($design[$name]['background-image']) || !empty($design[$name]['skin_image'])) {
                        if (!empty($design[$name]['background-image'])) {
                                $output .= 'background-image: url(' . esc_url($design[$name]['background-image']) . ');';
                        } else {
                                $output .= 'background-image: url(' . esc_url($design[$name]['skin_image']) . ');';
                        }
                        if (!empty($design[$name]['background-position']) || !empty($design[$name]['background-position-custom'])) {
                                $position = !empty($design[$name]['background-position-custom']) ? $design[$name]['background-position-custom'] : $design[$name]['background-position'];
                                $output .= 'background-position:' . esc_attr($position) . ';';
                        }
                        if (!empty($design[$name]['background-attachment'])) {
                                $output .= 'background-attachment:' . $design[$name]['background-attachment'] . ';';
                        }
                        if (!empty($design[$name]['background-repeat'])) {
                                $output .= 'background-repeat:' . $design[$name]['background-repeat'] . ';';
                        }
                }
                return $output;
        }

        public function background_padding($name) {
                global $thesis;
                $design = $this->design;
                $output = '';

                if (!empty($design[$name]['top-padding']) || !empty($design[$name]['padding-top'])) {
                        $value = !empty($design[$name]['top-padding']) ? $design[$name]['top-padding'] : $design[$name]['padding-top'];
                        $output .= 'padding-top:' . $thesis->api->css->number($value) . ';';
                }
                if (!empty($design[$name]['right-padding']) || !empty($design[$name]['padding-right'])) {
                        $value = !empty($design[$name]['right-padding']) ? $design[$name]['right-padding'] : $design[$name]['padding-right'];
                        $output .= 'padding-right:' . $thesis->api->css->number($value) . ';';
                }
                if (!empty($design[$name]['bottom-padding']) || !empty($design[$name]['padding-bottom'])) {
                        $value = !empty($design[$name]['top-padding']) ? $design[$name]['bottom-padding'] : $design[$name]['padding-bottom'];
                        $output .= 'padding-bottom:' . $thesis->api->css->number($value) . ';';
                }
                if (!empty($design[$name]['left-padding']) || !empty($design[$name]['padding-left'])) {
                        $value = !empty($design[$name]['left-padding']) ? $design[$name]['left-padding'] : $design[$name]['padding-left'];
                        $output .= 'padding-left:' . $thesis->api->css->number($value) . ';';
                }


                return $output;
        }

        public function background_margin($name) {
                global $thesis;
                $design = $this->design;
                $output = '';

                if (!empty($design[$name]['margin-top'])) {
                        $output .= 'margin-top:' . $thesis->api->css->number($design[$name]['margin-top']) . ';';
                }
                if (!empty($design[$name]['margin-right'])) {
                        $output .= 'margin-right:' . $thesis->api->css->number($design[$name]['margin-right']) . ';';
                }
                if (!empty($design[$name]['margin-bottom'])) {
                        $output .= 'margin-bottom:' . $thesis->api->css->number($design[$name]['margin-bottom']) . ';';
                }
                if (!empty($design[$name]['margin-left'])) {
                        $output .= 'margin-left:' . $thesis->api->css->number($design[$name]['margin-left']) . ';';
                }
                return $output;
        }

        public function background_borders($name) {
                global $thesis;
                $colors = new byob_color_values($this->design);
                $design = $this->design;
                $output = '';

                if (!empty($design[$name]['border-style'])) {
                        $output .= 'border-style:' . $design[$name]['border-style'] . ';';
                }
                if (!empty($design[$name]['border-width'])) {
                        $output .= 'border-width:' . $thesis->api->css->number($design[$name]['border-width']) . ';';
                }
                if (!empty($design[$name]['skin_border_color']) || !empty($design[$name]['border-color'])) {
                        $color = $colors->set_background_colors($name, 'skin_border_color', 'border-color');
                        $output .= 'border-color:' . $color . ';';
                }
                if (!empty($design[$name]['border-radius'])) {
                        $output .= 'border-radius:' . $thesis->api->css->number($design[$name]['border-radius']) . ';';
                }
                if (!empty($design[$name]['skin_shadow_color']) || !empty($design[$name]['shadow-color']) || !empty($design[$name]['shadow-offsets'])) {
                        $output .= 'box-shadow:';
                        if (!empty($design[$name]['shadow-offsets'])) {
                                $output .= $thesis->api->css->number($design[$name]['shadow-offsets']);
                        } else {
                                $output .= '3px 3px 3px';
                        }

                        $shadow_color = $colors->set_border_shadow_colors($name, 'skin_shadow_color', 'shadow-color', '888888');
                        $output .= ' ' . $shadow_color;

                        $output .= ';';
                }
                return $output;
        }

}
