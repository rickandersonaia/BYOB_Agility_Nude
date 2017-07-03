<?php

/**
 * Description of byobagn_social_profile_helper
 *
 * @author Rick
 */
class byobagn_social_profile_helper {

        //put your code here
        public function options() {

        }

        public function html($args = false, $options = array(), $labels = array()) {
                global $thesis;
                extract($args = is_array($args) ? $args : array());
                $tab = str_repeat("\t", $depth = !empty($depth) ? $depth : 0);


                if (isset($options['social_profiles']['use_' . $labels['suffix']])) {

                        $link = !empty($options[$labels['suffix'] . '_url']) ? esc_url($options[$labels['suffix'] . '_url']) : "#"; // found in the $args array

                        if (!empty($options[$labels['suffix'] . '_url'])) {
                                $title = !empty($options[$labels['suffix'] . '_link_title']) ? esc_attr($options[$labels['suffix'] . '_link_title']) : '';
                        } else {
                                $title = __('You need to enter the URL of your ' . $labels['label'] . ' Profile');
                        }
                        if (isset($options['use_images']['use_images'])) {
                                $img_url = !empty($options[$labels['suffix'] . '_image_url']) ? esc_url($options[$labels['suffix'] . '_image_url']) : '';
                                $output = "<img src=\"$img_url\">";
                        } else {
                                $output = "<i class=\"fa fa-fw " . $labels['icon'] . "\"></i>";
                        }

                        echo "$tab<a href=\"$link\" title=\"$title\" target=\"_blank\">$output</a>\n";
                }
        }

}
