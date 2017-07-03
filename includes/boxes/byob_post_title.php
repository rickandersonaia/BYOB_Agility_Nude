<?php

/**
 * Description of byob_post_title
 *
 * @author Rick
 */
class byob_post_title {

        public function html_options() {
                global $thesis;
                $html = $thesis->api->html_options(array(
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'p' => 'p',
                        'span' => 'span'), 'h2');
                $html['class']['tooltip'] = sprintf(__('This box already contains a %1$s, <code>headline</code>. If you wish to add an additional %1$s, you can do that here. Separate multiple %1$ses with spaces.%2$s', 'thesis'), $thesis->api->base['class'], $thesis->api->strings['class_note']);
                unset($html['id']);
                return array_merge($html, array(
                        'link' => array(
                                'type' => 'radio',
                                'options' => array(
                                        'on' => __('Link headline to article page', 'thesis'),
                                        'off' => __('Don&apos;t link headline to article page', 'thesis')))));
        }

        public function html($args = array(), $options) {
                global $thesis;
                extract($args = is_array($args) ? $args : array());
                $html = !empty($options['html']) ? $options['html'] : 'h2';
                $class = !empty($options['class']) ? " {$thesis->api->esc($options['class'])}" : '';
                echo
                str_repeat("\t", !empty($depth) ? $depth : 0),
                "<$html class=\"headline$class\"", (!empty($schema) ? ' itemprop="name"' : ''), '>',
                (isset($options['link']) ?
                        '<a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a>' :
                        get_the_title()),
                "</$html>\n";
        }

        public function small_headline_html($args = array(), $options) {
                global $thesis;
                extract($args = is_array($args) ? $args : array());
                $html = !empty($options['html']) ? $options['html'] : 'h2';
                $class = !empty($options['class']) ? " {$thesis->api->esc($options['class'])}" : '';
                echo
                str_repeat("\t", !empty($depth) ? $depth : 0),
                "<$html class=\"small_headline$class\"", (!empty($schema) ? ' itemprop="name"' : ''), '>',
                (isset($options['link']) ?
                        '<a href="' . get_permalink() . '" rel="bookmark">' . get_the_title() . '</a>' :
                        get_the_title()),
                "</$html>\n";
        }

}
