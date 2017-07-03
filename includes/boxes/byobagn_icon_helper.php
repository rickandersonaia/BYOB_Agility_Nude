<?php

/**
 * Description of byobagn_icon_helper
 *
 * @author Rick
 */
class byobagn_icon_helper {

        public function html_options() {
                global $thesis;
                $options = $thesis->api->html_options(array(
                        'span' => 'span',
                        'div' => 'div',
                        'p' => 'p',
                        'none' => 'none'
                        ), 'none');
                unset($options['id']);
                return $options;
        }

        public function options() {
                $options = array(
                        'icon' => array(
                                'type' => 'text',
                                'width' => 'medium',
                                'code' => true,
                                'label' => __('Icon Code - e.g. <code>fa-search</code>', 'byobagn'),
                                'tooltip' => __('Enter the code for the icon you want displayed.  You can find all of the icons at <a href="http://fortawesome.github.io/Font-Awesome/icons/">Font Awesome</a>', 'byobagn'),
                                'placeholder' => __('fa-question', 'byobagn')),
                        'icon_size' => array(
                                'type' => 'text',
                                'width' => 'short',
                                'code' => true,
                                'label' => __('Icon Size', 'byobagn'),
                                'tooltip' => __('Enter the size of the icon you wish to use.  You can use any CSS unit (px, em, % et)', 'byobagn'),
                                'placeholder' => '48px'),
                        'icon_style' => array(
                                'type' => 'select',
                                'lable' => __('Icon Style', 'byobagn'),
                                'options' => array(
                                        '' => __('Plain', 'byobagn'),
                                        'circle positive' => __('Circle - positive', 'byobagn'),
                                        'circle negative' => __('Circle - negative', 'byobagn'),
                                        'square positive' => __('Square - positive', 'byobagn'),
                                        'square negative' => __('Square - negative', 'byobagn'),
                                        'rounded_square positive' => __('Rounded Square - positive', 'byobagn'),
                                        'rounded_square negative' => __('Rounded Square - negative', 'byobagn'),
                                )
                        )
                );
                return $options;
        }

        public function html($args = false, $options = array()) {
                global $thesis;
                extract($args = is_array($args) ? $args : array());
                $tab = str_repeat("\t", $depth = !empty($depth) ? $depth : 0);
                $icon_element = !empty($options['icon']) ? esc_attr($options['icon']) : 'fa-question';
                $i_style = false;

                if (!empty($icon_style)) {
                        $i_style = esc_attr($icon_style);
                } elseif (!empty($options['icon_style'])) {
                        $i_style = esc_attr($options['icon_style']);
                }

                if ($i_style) {
                        $icon = $icon_element . ' fa-fw ' . $icon_style;
                } else {
                        $icon = $icon_element;
                }
                $html = !empty($options['html']) ? $options['html'] : 'none';
                $icon_font_size = false;

                if (!empty($options['icon_size'])) {
                        $icon_font_size = $thesis->api->css->number($this->options['icon_size']);
                } elseif (!empty($icon_size)) {
                        $icon_font_size = $thesis->api->css->number($icon_size);
                }

                $classout = new byobagn_config_classes($options, 'class');
                $class = $classout->simple();

                $style = '';
                if ($icon_font_size) {
                        $style = " style=\"font-size:$icon_font_size;\"";
                }
                if ($html !== 'none') {
                        echo "$tab<$html$class>\n";
                }
                echo "$tab\t<i class=\"fa $icon\"$style></i>\n";
                if ($html !== 'none') {
                        echo "$tab</$html>\n";
                }
        }

}
