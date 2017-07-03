<?php

/**
 * Description of byob_read_more_link
 *
 * @author Rick
 */
class byob_read_more_link {

        public function html_options() {
                global $thesis;
                $options = $thesis->api->html_options(array(
                        'span' => 'span',
                        'div' => 'div',
                        'p' => 'p',
                        'none' => 'none'
                        ), 'none');
                $options['link_class'] = array(
                        'type' => 'text',
                        'width' => 'medium',
                        'code' => true,
                        'label' => __('Class Name for the link', 'byobagn'),
                        'tooltip' => __('Enter the class name for the Read More link - it will also include "read-more', 'byobagn'));

                unset($options['id']);
                return $options;
        }

        public function options() {
                $options = array(
                        'message' => array(
                                'type' => 'text',
                                'width' => 'medium',
                                'code' => true,
                                'label' => __('Text for the Read More Link', 'byobagn'),
                                'tooltip' => __('Enter the text you want displayed in the Read More link', 'byobagn'),
                                'placeholder' => __('Read More', 'byobagn')),
                        'title' => array(
                                'type' => 'text',
                                'width' => 'medium',
                                'code' => true,
                                'label' => __('Read More link title - shows on hover', 'byobagn'),
                                'tooltip' => __('Enter the text you want displayed as the link title.  This shows up when the user hovers over the link - to include the name of the page enter "%s" where you want it displayed', 'byobagn'),
                                'placeholder' => 'Visit our %s page'),
                );
                return $options;
        }

        public function html($args = false, $options = array()) {

                global $thesis, $post;
                extract($args = is_array($args) ? $args : array());
                $tab = str_repeat("\t", $depth = !empty($depth) ? $depth : 0);
                $html = !empty($options['html']) ? $options['html'] : 'none';
                $message = !empty($options['message']) ? wp_kses_post($options['message']) : 'Read More';
                $title = !empty($options['title']) ? $thesis->api->esc($options['title']) : 'Visit our %s page';
                $simple_class = !empty($options['class']) ? trim($thesis->api->esc($options['class'])) : false;
                $link_class = !empty($options['link_class']) ? ' ' . trim($thesis->api->esc($options['link_class'])) : '';
                $permalink = get_permalink($post->ID);
                $post_title = strip_tags(get_the_title($post->ID));

                $link_title = sprintf("title=\"$title\"", $post_title);

                if ($simple_class) {
                        $class = ' class="' . $simple_class . '"';
                } else {
                        $class = '';
                }

                if ($html !== 'none') {
                        echo "$tab<$html$class>\n";
                }
                echo "$tab\t<a href=\"$permalink\" $link_title class=\"read-more$link_class\">$message</a>\n";
                if ($html !== 'none') {
                        echo "$tab</$html>\n";
                }
        }

}
