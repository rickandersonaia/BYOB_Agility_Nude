<?php

function byobagn_metaboxes(array $meta_boxes) {

        global $thesis;
        $s = new thesis_schema();
        $s->init();
        $schema_list = $s->select();

        $schema_list['options'][""] = __('Default schema', 'byobagn');

		$filtered_post_types = new byob_get_post_types();
		$post_types = $filtered_post_types->simple_post_type_list();

        $prefix = 'byob_';

        $meta_boxes['byobagn_post_page_meta_boxes'] = array(
                'id' => 'byobagn_post_page_meta_boxes',
                'title' => __('Agility Page Details', 'byobagn'),
                'pages' => $post_types, // Post type
                'context' => 'normal',
                'priority' => 'high',
                'show_names' => true, // Show field names on the left
                // 'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
                'fields' => array(
                        array(
                                'name' => __('Page Schema', 'byobagn'),
                                'desc' => __('Choose the schema from the list', 'byobagn'),
                                'id' => $prefix . 'post_schema',
                                'type' => 'select',
                                'options' => $schema_list['options']
                        ),
                        array(
                                'name' => __('Page Icon', 'byobagn'),
                                'desc' => __('<br>Enter the code for the desired icon - in this format "<code style="font-style:normal;font-weight:bold;">fa-flag</code>". <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">You can find the available codes here</a>', 'byobagn'),
                                'id' => $prefix . 'post_icon',
                                'type' => 'text_medium'
                        ),
                        array(
                                'name' => __('Responsive Video', 'byobagn'),
                                'desc' => __('Check this box if you want to add responsive video script to this page', 'byobagn'),
                                'id' => $prefix . 'fit_vids',
                                'type' => 'checkbox',
                                'options' => array(
                                        true => __('Add Responsive Video Script to this page', 'byobagn'),
                                )
                        ),
                        array(
                                'name' => __('Page Specific Widget Content', 'byobagn'),
                                'desc' => __('Enter any content that you wish displayed in the widget here.  This can include video & audio embeds, shortcodes, images and text.  Essentially anything that can be used in the post editor', 'byobagn'),
                                'id' => $prefix . 'widget_content',
                                'type' => 'wysiwyg',
                                'options' => array(
                                        'wpautop' => true,
                                        'textarea_rows' => 5
                                ),
                        ),
                )
        );



        return $meta_boxes;
}
