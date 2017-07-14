<?php

/**
 * This box generates the query for custom query boxes
 *
 * @author Rick
 */
class byob_typical_query {

        public $options = array();

        //put your code here

        public function __construct($query_options) {
                $this->options = $query_options;
//                var_dump($this->options);
        }

        public function multiple_query() {
                global $thesis;

                if (!empty($this->options['post_by_id'])) {
                        $post_list = explode(',', $this->options['post_by_id']);
                        $query = array(
                            'post_type' => 'any',
                            'post__in' => $post_list,
                            'orderby' => 'post__in'
                        );
                } else {

                        $query = array(// start building the query
                            'post_type' => !empty($this->options['post_type']) ? $this->options['post_type'] : '',
                            'posts_per_page' => !empty($this->options['num']) ? (int) $this->options['num'] : 5,
                            'ignore_sticky_posts' => !empty($this->options['sticky']) ? 0 : 1,
                            'order' => !empty($this->options['order']) && $this->options['order'] == 'ASC' ? 'ASC' : 'DESC',
                            'orderby' => !empty($this->options['orderby']) && in_array($this->options['orderby'], array('ID', 'author', 'title', 'modified', 'rand', 'comment_count', 'menu_order')) ? (string) $this->options['orderby'] : 'date'
                        );

                        if (!empty($this->options['post_type']) && !empty($this->options[$this->options['post_type'] . '_tax']) && (!empty($this->options[$this->options['post_type'] . '_' . $this->options[$this->options['post_type'] . '_tax'] . '_term_text']) || !empty($this->options[$this->options['post_type'] . '_' . $this->options[$this->options['post_type'] . '_tax'] . '_term'])))
                                $query['tax_query'] = array(
                                    array(
                                        'taxonomy' => (string) $this->options[$this->options['post_type'] . '_tax'],
                                        'field' => 'id',
                                        'terms' => !empty($this->options[$this->options['post_type'] . '_' . $this->options[$this->options['post_type'] . '_tax'] . '_term_text']) ?
                                                (int) $this->options[$this->options['post_type'] . '_' . $this->options[$this->options['post_type'] . '_tax'] . '_term_text'] :
                                                (int) $this->options[$this->options['post_type'] . '_' . $this->options[$this->options['post_type'] . '_tax'] . '_term']));
                        if (!empty($this->options['author']))
                                $query['author'] = (string) $this->options['author'];
                        if (!empty($this->options['offset']))
                                $query['offset'] = (int) $this->options['offset'];
                        if (!empty($this->options['top_level_parents'])) {
                                $query['post_parent'] = 0;
                        }
                }

                return $query; // new or cached query object
        }

        public function single_query() {
                global $thesis;
//                var_dump($this->options);
                $post_type = !empty($this->options['post_type']) ? $this->options['post_type'] : 'post';
                $post_in = array();
                $post_in[] = !empty($this->options[$post_type . '_page']) ? $this->options[$post_type . '_page'] : '';

                $query = array(// start building the query
                    'post_type' => $post_type,
                    'post__in' => $post_in,
                    'posts_per_page' => 1,
                );


                return $query; // new or cached query object
        }

        public function related_query() {
                global $thesis, $post, $wp_query;
                $post_type = !empty($this->options['post_type']) ? $this->options['post_type'] : 'post';
                $tax = !empty($this->options[$post_type . '_tax']) ? $this->options[$post_type . '_tax'] : 'category';
                $termargs = array('fields' => 'ids');
                if ($wp_query->queried_object->is_archive) {
                        $terms = $wp_query->queried_object->queried_object_id;
                } else {
                        $terms = wp_get_object_terms($post->ID, $tax, $termargs);
                }
                $terms = !empty($terms) ? $terms : array(9999);  // a hack to avoid passing the query an empty array
                $exclude = array($post->ID);

                $query = array(// start building the query
                    'post_type' => $post_type,
                    'posts_per_page' => !empty($this->options['num']) ? (int) $this->options['num'] : 4,
                    'order' => !empty($this->options['order']) && $this->options['order'] == 'ASC' ? 'ASC' : 'DESC',
                    'orderby' => !empty($this->options['orderby']) && in_array($this->options['orderby'], array('ID', 'author', 'title', 'modified', 'rand', 'comment_count', 'menu_order')) ? (string) $this->options['orderby'] : 'date');
                $query['tax_query'] = array(
                    array(
                        'taxonomy' => $tax,
                        'field' => 'id',
                        'terms' => $terms));

                if (!empty($this->options['offset']))
                        $query['offset'] = (int) $this->options['offset'];
                $query['post__not_in'] = $exclude;
                return $query;
        }

}
