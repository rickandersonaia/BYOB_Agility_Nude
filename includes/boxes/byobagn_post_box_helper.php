<?php

/**
 * Description of byobagn_post_box_helper
 *
 * @author Rick
 */
class byobagn_post_box_helper {

        private $options = array();
        private $hook = '';
        private $post_count = 0;
        private $html = 'article';

        public function __construct($options = array()) {
                $this->options = $options;
        }

        public function html_options() {
                global $thesis;
                $html = $thesis->api->html_options(array(
                        'div' => 'div',
                        'section' => 'section',
                        'article' => 'article'), 'article');
                unset($html['id']);
                $html['class']['tooltip'] = sprintf(__('This box already contains a %1$s, <code>post_box</code>. If you wish to add an additional %1$s, you can do that here. Separate multiple %1$ses with spaces.%2$s', 'thesis'), $thesis->api->base['class'], $thesis->api->strings['class_note']);

                return array_merge($html, array(
                        'wp' => array(
                                'type' => 'checkbox',
                                'label' => $thesis->api->strings['auto_wp_label'],
                                'tooltip' => $thesis->api->strings['auto_wp_tooltip'],
                                'options' => array(
                                        'auto' => $thesis->api->strings['auto_wp_option']))));
        }

        public function open_html($args = array(), $box_id, $type_class = false) {
                global $thesis, $wp_query, $post; #wp
                extract($args = is_array($args) ? $args : array());
                $secondary = array();
                $tab = str_repeat("\t", $depth = !empty($depth) ? $depth : 0);
                $this->post_count = !empty($post_count) ? $post_count : false;
                $this->html = !empty($this->options['html']) ? $this->options['html'] : 'article';

                if ($type_class) {
                        $secondary[] = trim(esc_attr($type_class));
                }
                $classout = new byobagn_config_classes($this->options, 'class');
                if (!empty($this->options['wp']['auto'])) {
                        $secondary = get_post_class();
                }
                if (empty($post_count) || $post_count == 1) {
                        $secondary[] = 'top';
                }

                $class = $classout->secondary('post_box', false, $secondary);
                $id = $wp_query->is_404 ? '' : " id=\"post-$post->ID\"";

                $schema_att = '';
                if (!empty($schema)) {
                        $schema_att = $schema ? ' itemscope itemtype="' . esc_url($thesis->api->schema->types[$schema]) . '"' : '';
                }

                $this->hook = trim($thesis->api->esc(!empty($this->options['_id']) ?
                                        $this->options['_id'] : (!empty($this->options['hook']) ?
                                                $this->options['hook'] : $box_id)));

                do_action("thesis_hook_before_post_box_$this->hook", $this->post_count);
                do_action("hook_before_$this->hook", $this->post_count);

                echo "$tab<$this->html$id$class$schema_att>\n"; #wp

                do_action("thesis_hook_post_box_{$this->hook}_top", $this->post_count);
                do_action("hook_top_$this->hook", $this->post_count);
        }

        public function close_html($args = array()) {
                extract($args = is_array($args) ? $args : array());
                $tab = str_repeat("\t", $depth = !empty($depth) ? $depth : 0);

                do_action("thesis_hook_post_box_{$this->hook}_bottom", $this->post_count);
                do_action("hook_bottom_$this->hook", $this->post_count);

                echo "$tab</$this->html>\n";

                do_action("thesis_hook_after_post_box_$this->hook", $this->post_count);
                do_action("hook_after_$this->hook", $this->post_count);
        }

        public function setup_schema($post_id = false) {

                $post_type = get_post_field('post_type', $post_id);
                $schema = '';
                $post_meta = get_post_meta($post_id, 'byob_post_schema', true);

                if (!empty($post_meta)) {
                        $schema = $post_meta;
                } else {
                        // get the post type
                        $default = get_option('byobagn_schema_settings');
                        if (!empty($default[$post_type])) {
                                $schema = $default[$post_type];
                        }
                }
                return $schema;
        }

}
