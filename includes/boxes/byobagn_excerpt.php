<?php

/**
 * Description of byobagn_excerpt
 *
 * @author Rick
 */
class byobagn_excerpt {

        private $options = array();

        public function __construct($options) {
                $this->options = $options;
        }

        public function html_options() {
                global $thesis;
                $html = $thesis->api->html_options();
                $html['length'] = array(
                        'type' => 'text',
                        'width' => 'tiny',
                        'label' => __('Excerpt Length - in words', 'byobagn'),
                        'placeholder' => '55'
                );
                $html['style'] = array(
                        'type' => 'radio',
                        'label' => __('Excerpt Type', 'thesis'),
                        'tooltip' => __('The Thesis enhanced excerpt strips <code>h1</code>-<code>h4</code> tags and images, in addition to the typical items removed by WordPress.', 'thesis'),
                        'options' => array(
                                'thesis' => __('Thesis enhanced (recommended)', 'thesis'),
                                'wp' => __('WordPress default', 'thesis')),
                        'default' => 'thesis',
                        'dependents' => array(
                                'thesis', 'wp'));
                $html['ellipsis'] = array(
                        'type' => 'radio',
                        'label' => __('Excerpt Ellipsis', 'thesis'),
                        'options' => array(
                                'bracket' => __('Show ellipsis with a bracket at the end of the excerpt.', 'thesis'),
                                'no_bracket' => __('Show ellipsis without a bracket at the end of the excerpt.', 'thesis'),
                                'none' => __('Do not show an ellipsis.', 'thesis')),
                        'default' => 'none',
                        'parent' => array('style' => array('thesis', 'wp')));

                unset($html['id']);
                return $html;
        }

        public function html($args = array()) {
                global $thesis, $post;
                extract($args = is_array($args) ? $args : array());
                $tab = str_repeat("\t", !empty($depth) ? $depth : 0);
                $class = !empty($this->options['class']) ? ' ' . trim($thesis->api->esc($this->options['class'])) : '';
//                $schema = $this->setup_schema();
                add_filter('excerpt_length', array($this, 'length'), 999);
                add_filter('excerpt_more', array($this, 'more'), 1);

                $content = empty($this->options['style']) ? (!empty($post->post_excerpt) ? $post->post_excerpt : $thesis->api->trim_excerpt($post->post_content)) : get_the_excerpt();
                echo "$tab<div class=\"post_content post_excerpt$class\"" . (!empty($schema) ? ' itemprop="description"' : '') . ">\n";
                echo "$tab\t<p>" . $content . "</p>\n";
                echo "$tab</div>\n";
        }

        public function more($more) {
                $out = '';
                if (isset($this->options['ellipsis'])) {
                        if (($this->options['ellipsis'] === 'bracket')) {
                                $more = ' [...]';
                        } else {
                                $more = ' ...';
                        }
                } else {
                        $more = '';
                }

                return $more;
        }

        public function length($excerpt_length) {
                $length = !empty($this->options['length']) ? (int) $this->options['length'] : false;
                if ($length) {
                        $excerpt_length = $length;
                }
                return $excerpt_length;
        }

}
