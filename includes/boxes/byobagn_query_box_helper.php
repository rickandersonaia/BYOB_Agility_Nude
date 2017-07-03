<?php

/**
 * Description of byobagn_query_box_helper
 *
 * @author Rick
 */
class byobagn_query_box_helper {

        //put your code here

        public function html_options() {
                global $thesis;
                $html = $thesis->api->html_options(array(
                        'div' => 'div',
                        'section' => 'section',
                        'article' => 'article'), 'div');

                $html['wp'] = array(
                        'type' => 'checkbox',
                        'label' => $thesis->api->strings['auto_wp_label'],
                        'tooltip' => $thesis->api->strings['auto_wp_tooltip'],
                        'options' => array(
                                'auto' => $thesis->api->strings['auto_wp_option'])
                );
                return $html;
        }

        public function expanded_html_options() {
                global $thesis;
                $html = $thesis->api->html_options(array(
                        'div' => 'div',
                        'section' => 'section',
                        'article' => 'article',
                        'ul' => 'ul',
                        'ol' => 'ol'), 'div');
                $html['html']['dependents'] = array('div', 'ul', 'ol', 'article', 'section');
                $html['id']['parent'] = array(
                        'html' => array('ul', 'ol'));
                $html['class']['parent'] = array(
                        'html' => array('div', 'section', 'article', 'ul', 'ol'));

                $html['wp'] = array(
                        'type' => 'checkbox',
                        'label' => $thesis->api->strings['auto_wp_label'],
                        'tooltip' => $thesis->api->strings['auto_wp_tooltip'],
                        'options' => array(
                                'auto' => $thesis->api->strings['auto_wp_option'])
                );
                return $html;
        }

        public function setup_schema($post_id = false) {

                $post_type = get_post_field('post_type', $post_id);
                $schema = '';
                $post_meta = get_post_meta($post_id, '_byobagn_schema_settings', true);

                if (!empty($post_meta['schema'])) {
                        $schema = $post_meta['schema'];
                } else {
                        // get the post type
                        $default = get_option('byobagn_schema_settings');
                        if (!empty($default[$post_type])) {
                                $schema = $default[$post_type];
                        }
                }
                return $schema;
        }

        public function title_html_options() {
                global $thesis;
                $html = $thesis->api->html_options(array(
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
                        'p' => 'p'), 'p');
                $options['title_html'] = $html['html'];
                $options['title_html']['label'] = __('Query Box Title - Select an html tag for the title', 'byobagn');
                $options['title_class'] = $html['class'];
                $options['title_class']['label'] = __('Add a class for the title', 'byobagn');
                $options['title_class']['placeholder'] = __('widget_title', 'byobagn');
                return $options;
        }

        public function title_options() {
                $options['use_title'] = array(
                        'type' => 'checkbox',
                        'label' => __('Add a title above the query box', 'byobagn'),
                        'tooltip' => __('check this in order to add a custom title above the query box output', 'byobagn'),
                        'options' => array(
                                'use_title' => __('Add a title ', 'byobagn')
                        ),
                        'dependents' => array('use_title')
                );

                $options['title_text'] = array(
                        'type' => 'text',
                        'width' => 'long',
                        'label' => __('Title text - html is ok', 'byobagn'),
                        'code' => 'true',
                        'tooltip' => __('Enter the text you want to use as the title - you can include html like <code>&lt;span&gt;</code> and <code>&lt;b&gt;</code>', 'byobagn'),
                        'parent' => array('use_title' => 'use_title')
                );

                return $options;
        }

}
