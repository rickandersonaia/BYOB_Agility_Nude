<?php

/**
 * Description of byobagn_featured_image
 *
 * @author Rick
 */
class byobagn_featured_image {

        //put your code here
        private $prefix = '';
        private $options = array();

        public function __construct($prefix = '') {
                $this->prefix = $prefix;
        }

        public function html_options() {
                global $thesis;
                $options = $thesis->api->html_options();
                unset($options['id']);

                $image_sizes = get_intermediate_image_sizes();
                foreach ($image_sizes as $size) {
                        $select_images[$size] = $size;
                }

                $select_images['full'] = 'full';

                return array_merge($options, array(
                        'size' => array(
                                'type' => 'select',
                                'label' => __('Select Image Size', $this->prefix),
                                'tooltip' => __('Select the desired image size.', $this->prefix),
                                'options' => $select_images
                        ),
                        'alignment' => array(
                                'type' => 'select',
                                'label' => __('Select Image Alignment', $this->prefix),
                                'tooltip' => __('Select the desired image alignment.', $this->prefix),
                                'options' => array(
                                        'none' => 'none',
                                        'left' => 'left',
                                        'center' => 'center',
                                        'right' => 'right'
                                )
                        ),
                        'link' => array(
                                'type' => 'select',
                                'label' => __('Link Image to Post', $this->prefix),
                                'tooltip' => __('Select whether or not to link the image to the post.', $this->prefix),
                                'options' => array(
                                        'yes' => 'yes',
                                        'no' => 'no'
                                )
                        ),
                        'link_title' => array(
                                'type' => 'text',
                                'width' => 'medium',
                                'label' => __('Specify the link title', $this->prefix),
                                'tooltip' => __('Enter a title for the link.  If the image is linked to the post then this text will display when a user hovers over the image', $this->prefix),
                                'placeholder' => __('View the post', $this->prefix)
                        )
                ));
        }

        public function html($args = false, $options = array()) {
                global $post;
                extract($args = is_array($args) ? $args : array());
                $this->options = $options;
                $tab = str_repeat("\t", $depth = !empty($depth) ? $depth : 0);
                $size = !empty($this->options['size']) ? $this->options['size'] : 'thumbnail';
                $alignment = !empty($this->options['alignment']) ? $this->options['alignment'] : 'none';
                $class = !empty($this->options['class']) ? ' ' . $this->options['class'] : '';

                $link = !empty($this->options['link']) ? $this->options['link'] : 'no';
                $link_title = !empty($this->options['link_title']) ? $this->options['link_title'] : 'View the post';

                $image = get_the_post_thumbnail($post->ID);
                $title = !empty(get_post(get_post_thumbnail_id())->post_title) ? get_post(get_post_thumbnail_id())->post_title : '';
                $attachment_id = get_post_thumbnail_id($post->ID);
                $attr = array(
                        'class' => "attachment-$size align$alignment$class",
                        'title' => $title,
                        'alt' => trim(strip_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true))));

//		var_dump($title);
                if ($image) {
                        echo $tab . ($link == 'yes' ? '<a href="' . get_permalink($post->ID) . '" title="' . $link_title . '" >' : '') . get_the_post_thumbnail($post->ID, $size, $attr) . ($link == 'yes' ? '</a>' : '');
                }
        }

}
