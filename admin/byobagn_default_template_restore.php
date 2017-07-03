<?php

/**
 * Description of byobagn_default_template_restore
 *
 * @author ander
 */
class byobagn_default_template_restore {

        public $current_boxes = array();
        public $current_templates = array();
        public $default_boxes = array();
        public $default_templates = array();
        public $default_header_layout = array();
        public $default_footer_layout = array();
        public $restore_templates = array(); // the options "saved" by the box - we don't actually save any options
        public $header_instances = array(); // for later use
        public $footer_instances = array(); // for later use
        public $_name = "Restore Options";

        public function __construct() {
                global $thesis;
                include_once(BYOBAGN_PATH . '/default.php');
                $defaults = byob_agility_nude_defaults(); // This is the array of default settings that comes from default.php
                $this->default_boxes = $defaults['boxes'];
                $this->default_templates = $defaults['templates'];
                $this->restore_templates = get_option('byob_agility_nude_restore_templates', array());
                $this->current_boxes = get_option('byob_agility_nude_boxes', array());
                $this->current_templates = get_option('byob_agility_nude_templates', array());
                $this->header_instances = $this->get_header_instances();
                $this->footer_instances = $this->get_footer_instances();


                add_filter('thesis_skin_menu', array($this, 'menu'), 4);
                if (!empty($_GET['canvas']) && $_GET['canvas'] == 'agility_restore_templates') {
                        add_action('thesis_admin_canvas', array($this, 'admin'));
                        add_action('admin_enqueue_scripts', array($this, 'admin_scripts_and_styles'));
                }

                if (is_admin()) {

                        if ($thesis->environment == 'admin') {
                                add_action('init', array($this, 'init_wp'));
                        }
                }
        }

        public function init_wp() {
                global $thesis;
                add_action("admin_post_agility_restore_templates", array($this, 'save_options'));
        }

        public function admin_scripts_and_styles() {
                wp_enqueue_style('byob-admin-style', BYOBAGN_URL . "/css/byobagn-admin-styles.css");
                wp_enqueue_style('thesis-options');
                wp_enqueue_script('thesis-options');
        }

        public function menu($menu) {
                $menu['agility_restore_templates'] = array(
                    'text' => __('Agility Restore Templates', 'byobagn'),
                    'url' => 'admin.php?page=thesis&canvas=agility_restore_templates',
                    'title' => __('Check your system for compatibility with Thesis.', 'byobagn'));
                return $menu;
        }

        /*
          Template Restore admin page
         */

        public function admin() {
                global $thesis, $wp_version;

                $form_parts = array(
                    'parts' => array(
                        'fields' => $this->template_part_options(),
                        'heading' => __('Default Template Parts', 'byobagn'),
                        'save_label' => __('Restore selected template parts', 'byobagn')
                    ),
                    'templates' => array(
                        'fields' => $this->template_options(),
                        'heading' => __('Default Templates', 'byobagn'),
                        'save_label' => __('Restore selected templates', 'byobagn')
                    )
                );


                // Produce the forms
                foreach ($form_parts as $part => $values) {

                        //fields($fields, $values = array(), $id_prefix = false, $name_prefix = false, $tabindex = 1, $depth = 0)
                        $options = $thesis->api->form->fields($values['fields'], $this->restore_templates, "agility_restore_templates_", "agility_restore_templates", 3, 10);

                        echo (!empty($_GET['saved']) ? $thesis->api->alert(wptexturize($_GET['saved'] === 'yes' ?
                                                        sprintf(__('%s saved!', 'byobagn'), $this->_name) :
                                                        sprintf(__('%s not saved. Please try again.', 'byobagn'), $this->_name)), 'options_saved', true, false, 2) : ''),
                        "\t\t<h3>", wptexturize($values['heading']), "</h3>\n",
                        "\t\t<p class='warning'>", __('<b>Warning</b> Make sure all other Thesis windows are closed prior to restoring these templates.  If either the Skin Editor'
                                . ' or the Skin Content pages are open, restoring will have undesirable results!', 'byobagn'), "</p>\n\n",
                        "\t\t<form class=\"thesis_options_form templates\" method=\"post\" action=\"", admin_url("admin-post.php?action=agility_restore_templates"), "\" enctype=\"multipart/form-data\">\n",
                        "\t\t\t<div id=\"t_skin_options\">\n",
                        $options['output'],
                        "\t\t\t</div>\n",
                        "\t\t\t<input type=\"submit\" data-style=\"button save\" class=\"t_save templates\" id=\"save_options\" value=\"", esc_attr(wptexturize($values['save_label'])), "\" />\n",
                        "\t\t\t", wp_nonce_field("agility_restore_templates", "_wpnonce-agility_restore_templates", true, false), "\n",
                        "\t\t</form>\n",
                        "<div style='clear:both;'></div><br><br>";
                }
        }

        public function save_options() {
                global $thesis;
                $thesis->wp->check('edit_theme_options');
                $thesis->wp->nonce($_POST["_wpnonce-agility_restore_templates"], "agility_restore_templates");
                $saved = 'no';
                $pre_save_options = $this->restore_templates;

                if (!empty($_POST['agility_restore_templates'])) {
                        // get the data from the post variable
                        $post_save = !empty($_POST['agility_restore_templates']) ? $_POST['agility_restore_templates'] : array();

                        // replace the current design value with the new one
                        foreach ($post_save as $option => $value) {
                                $pre_save_options[$option] = $value;
                        }
                        // clean out all of the empty values
                        $final_save = $this->array_filter_recursive($pre_save_options);
                        $this->restore($final_save);

                        $saved = 'yes';
                        update_option("byob_agility_nude_restore_templates", $post_save);
                }
                wp_redirect("admin.php?page=thesis&canvas=agility_restore_templates&saved=$saved");
                exit;
        }

        public function template_part_options() {
                return array(
                    'default_header' => array(
                        'type' => 'checkbox',
                        'label' => __('Reset the the typical header to its defaults', 'byobagn'),
                        'tooltip' => __('Check this box if you want to restore the header to its original state.  This applies to all templates using the default header', 'byobagn'),
                        'options' => array(
                            'header_reset' => __('Reset the header to defaults', 'byobagn')
                        )
                    ),
                    'default_footer' => array(
                        'type' => 'checkbox',
                        'label' => __('Reset the the typical footer to its defaults', 'byobagn'),
                        'tooltip' => __('Check this box if you want to restore the footer to its original state.  This applies to all templates using the default footer', 'byobagn'),
                        'options' => array(
                            'footer_reset' => __('Reset the footer to defaults', 'byobagn')
                        )
                    )
                );
        }

        public function template_options() {
                $options = array();
                foreach ($this->default_templates as $name => $values) {
                        $label = !empty($values['title']) ? ucfirst($values['title']) : ucfirst($name);
                        $options[$name] = array(
                            'type' => 'checkbox',
                            'label' => sprintf(__('Reset the the %s template to its defaults', 'byobagn'), $label),
                            'tooltip' => sprintf(__('Check this box if you want to restore the  %s template to its original state.', 'byobagn'), $label),
                            'options' => array(
                                "{$name}_reset" => sprintf(__('Reset the %s template to defaults', 'byobagn'), $label)
                            )
                        );
                }

                if (!empty($options)) {
                        return $options;
                }
        }

        public function array_filter_recursive($array) {
                foreach ($array as $key => &$value) {
                        if (empty($value)) {
                                unset($array[$key]);
                        } else {
                                if (is_array($value)) {
                                        $value = $this->array_filter_recursive($value);
                                        if (empty($value)) {
                                                unset($array[$key]);
                                        }
                                }
                        }
                }

                return $array;
        }

        public function restore($final_save) {

                if (!empty($final_save['default_header'])) {
                        unset($final_save['default_header']);
                        $this->restore_header();
                }
                if (!empty($final_save['default_footer'])) {
                        unset($final_save['default_footer']);
                        $this->restore_footer();
                }
                if (!empty($final_save)) {
                        $this->restore_templates($final_save);
                }
        }

        public function restore_header() {
                $box_list = array();

                // how many header styles?  If there are only 3 boxes then 1 style -
                // otherwise couple header boxes with templates
                $styles = $this->determine_number_of_header_styles();

                // get header layout of default page template - we'll use this as the default template layout
                $this->default_header_layout = $this->default_header_layout();

                // get a flattened list of default & current header boxes
                $default_box_list = $this->flatten_list($this->default_header_layout, $this->default_templates['page']);
                $current_box_list = $this->flatten_list($this->default_header_layout, $this->current_templates['page']);
                $box_list = array_values(array_unique(array_merge($default_box_list, $current_box_list)));

                // next delete the box list from the current boxes -
                // this way current settings for default boxes without settings
                // will be deleted
                $culled_list = $this->current_boxes;
                foreach ($culled_list as $box_type => $instances) {
                        foreach ($instances as $box_id => $values) {
                                if (in_array($box_id, $box_list)) {
                                        unset($culled_list[$box_type][$box_id]);
                                }
                        }
                }

                // add the box list from the default to the current
                foreach ($this->default_boxes as $box_type => $instances) {
                        foreach ($instances as $box_id => $settings) {
                                foreach ($box_list as $box) {
                                        if ($box_id == $box) {
                                                $culled_list[$box_type][$box_id] = $settings;
                                        }
                                }
                        }
                }

                update_option('byob_agility_nude_boxes', $culled_list);
                // we don't have to worry about settings in templates so now we can replace or restore the
                // template layout
                $final_build_list = $this->current_templates;
                // get a flattened list of header boxes
                $default_template_box_list = $this->flatten_list($this->default_header_layout, $this->default_templates['page']);
                foreach ($this->default_templates as $template_name => $boxes) {
                        // setup the new array with the default & current boxes - $delete_list
                        // start with a flattened list of default & current header boxes
                        $current_template_box_list = $this->flatten_list($this->default_header_layout, $this->current_templates[$template_name]);
                        $delete_list = array_values(array_unique(array_merge($default_box_list, $current_template_box_list)));

                        foreach ($delete_list as $box) {
                                unset($final_build_list[$template_name]['boxes'][$box]);
                        }

                        // cycle through the flattened list of boxes to find
                        foreach ($box_list as $box) {
                                // check to see if the box in the list is also in the default template
                                // if it is then add the default template values to final build
                                if (array_key_exists($box, $this->default_templates[$template_name]['boxes'])) {
                                        $final_build_list[$template_name]['boxes'][$box] = $this->default_templates[$template_name]['boxes'][$box];
                                }
                        }
                        // need to add the default header boxes to the thesis_html_body
                        // add them to the list
                        // then delete duplicates
                        // then modify the final build list
                        $pre_header_layout = $boxes['boxes']['thesis_html_body'];
                        $interim_header_layout = array_merge($this->default_header_layout, $pre_header_layout);
                        $final_layout = array_values(array_unique($interim_header_layout));
                        $final_build_list[$template_name]['boxes']['thesis_html_body'] = $final_layout;
                }
                update_option('byob_test', $delete_list);
                update_option('byob_agility_nude_templates', $final_build_list);
        }

        public function restore_footer() {
                $box_list = array();

                // how many footer styles?  If there are only s boxes then 1 style -
                // otherwise couple footer boxes with templates
                // for later use
                $styles = $this->determine_number_of_footer_styles();

                // get header layout of default page template - we'll use this as the default template layout
                $this->default_footer_layout = $this->default_footer_layout();

                // get a flattened list of default & current footer boxes
                $default_box_list = $this->flatten_list($this->default_footer_layout, $this->default_templates['page']);
                $current_box_list = $this->flatten_list($this->default_footer_layout, $this->current_templates['page']);
                $box_list = array_values(array_unique(array_merge($default_box_list, $current_box_list)));

                // next delete the box list from the current boxes -
                // this way current settings for default boxes without settings
                // will be deleted
                $culled_list = $this->current_boxes;
                foreach ($culled_list as $box_type => $instances) {
                        foreach ($instances as $box_id => $values) {
                                if (in_array($box_id, $box_list)) {
                                        unset($culled_list[$box_type][$box_id]);
                                }
                        }
                }

                // add the box list from the default to the current
                foreach ($this->default_boxes as $box_type => $instances) {
                        foreach ($instances as $box_id => $settings) {
                                foreach ($box_list as $box) {
                                        if ($box_id == $box) {
                                                $culled_list[$box_type][$box_id] = $settings;
                                        }
                                }
                        }
                }

                update_option('byob_agility_nude_boxes', $culled_list);

                // we don't have to worry about settings in templates so now we can replace or restore the
                // template layout
                $check = array();
                $final_build_list = $this->current_templates;
                foreach ($this->default_templates as $template_name => $boxes) {
                        // setup the new array with the current boxes
                        // get a flattened list of current footer boxes & delete them from
                        // the template - this protects from zombie boxes

                        $current_template_box_list = $this->flatten_list($this->default_footer_layout, $this->current_templates[$template_name]);
                        $delete_list = array_values(array_unique(array_merge($default_box_list, $current_template_box_list)));

                        foreach ($delete_list as $box) {
                                unset($final_build_list[$template_name]['boxes'][$box]);
                        }

                        // cycle through the flattened list of boxes to find
                        foreach ($box_list as $box) {
                                // check to see if the box in the list is also in the default template
                                // if it is then add the default template values to final build
                                if (array_key_exists($box, $this->default_templates[$template_name]['boxes'])) {
                                        $final_build_list[$template_name]['boxes'][$box] = $this->default_templates[$template_name]['boxes'][$box];
                                }
                        }
                        // need to add the default footer boxes to the thesis_html_body
                        // get the list
                        // then delete defaults from the list
                        // merge the list with defaults
                        $pre_footer_layout = array_flip($boxes['boxes']['thesis_html_body']);

                        foreach ($this->default_footer_layout as $key => $box) {
                                unset($pre_footer_layout[$box]);
                        }

                        $final_layout = array_merge(array_flip($pre_footer_layout), $this->default_footer_layout);

                        $final_build_list[$template_name]['boxes']['thesis_html_body'] = $final_layout;
                }

                update_option('byob_agility_nude_templates', $final_build_list);
        }

        public function restore_templates($final_save) {
                // get header layout of default page template - we'll use this as the default template layout
                $this->default_header_layout = $this->default_header_layout();
                // get header layout of default page template - we'll use this as the default template layout
                $this->default_footer_layout = $this->default_footer_layout();

                $restored_templates = $this->current_templates;

                // cycle through the templates to be saved
                foreach ($final_save as $template => $reset) {
                        // get all of the current boxes in the template layout
                        $boxes = $this->current_templates[$template]['boxes'];
                        $default_boxes = $this->default_templates[$template]['boxes'];
                        $current_layout = $this->current_templates[$template]['boxes']['thesis_html_body'];

                        // extract the current header from the template boxes
                        $parent_header_boxes = $this->get_current_header_instances($this->current_templates[$template]);
                        $flatened_header_boxes = $this->flatten_list($parent_header_boxes, $this->current_templates[$template]);
                        $current_header = array();
                        foreach ($flatened_header_boxes as $box) {
                                if (isset($boxes[$box])) {
                                        $current_header[$box] = $this->current_templates[$template]['boxes'][$box];
                                }
                        }

                        // delete the default header from the template boxes
                        $flatened_default_header_boxes = $this->flatten_list($this->default_header_layout, $this->default_templates[$template]);
                        $default_header = array();
                        foreach ($flatened_default_header_boxes as $box) {
                                unset($default_boxes[$box]);
                        }

                        // extract the current footer from the template boxes
                        $parent_footer_boxes = $this->get_current_footer_instances($this->current_templates[$template]);
                        $flatened_footer_boxes = $this->flatten_list($parent_footer_boxes, $this->current_templates[$template]);
                        foreach ($flatened_footer_boxes as $box) {
                                if (isset($boxes[$box])) {
                                        $current_footer[$box] = $this->current_templates[$template]['boxes'][$box];
                                }
                        }

                        // delete the default footer from the template boxes
                        $flatened_default_footer_boxes = $this->flatten_list($this->default_footer_layout, $this->default_templates[$template]);
                        foreach ($flatened_default_footer_boxes as $box) {
                                unset($default_boxes[$box]);
                        }

                        // delete the thesis_html_body from the template boxes
                        unset($default_boxes['thesis_html_body']);


                        // get the default template layout from thesis_html_body
                        $default_layout = array_flip($this->default_templates[$template]['boxes']['thesis_html_body']);

                        // delete the default header & footee from the default layout
                        foreach ($this->default_header_layout as $box) {
                                unset($default_layout[$box]);
                        }
                        foreach ($this->default_footer_layout as $box) {
                                unset($default_layout[$box]);
                        }

                        // get the current template layout from thesis_html_body
                        $current_layout = array_flip($this->current_templates[$template]['boxes']['thesis_html_body']);

                        // delete the default header & footee from the default layout
                        foreach ($parent_header_boxes as $box) {
                                unset($current_layout[$box]);
                        }
                        foreach ($parent_footer_boxes as $box) {
                                unset($current_layout[$box]);
                        }

                        $resultant_template = array();

                        // reset the current template options
                        if (!empty($this->default_templates[$template]['title'])) {
                                $resultant_template['title'] = $this->default_templates[$template]['title'];
                        }
                        $resultant_template['options'] = $this->default_templates[$template]['options'];

                        // reset the layout to be the current header, the default layout and the current footer
                        $resultant_layout['thesis_html_body'] = array_merge($parent_header_boxes, array_flip($default_layout), $parent_footer_boxes);

                        // reset the current template boxes
                        $resultant_template['boxes'] = array_merge($resultant_layout, $current_header, $default_boxes, $current_footer);


                        $restored_templates[$template] = $resultant_template;
                }

                // Part 2 - delete the current & boxes from the box options array
                // then insert the default options in the box options array
                // This gets rid of unused boxes and restores default settings to restored boxes
                // get a flattened list of current boxes
                $current_box_list = $this->flatten_list(array_flip($current_layout), $this->current_templates[$template]);

                // get a flattened list of default boxes
                $default_box_list = $this->flatten_list(array_flip($default_layout), $this->default_templates[$template]);

                $box_list = array_merge($current_box_list, $default_box_list);
                // next delete the combined current & default box list from the current boxes -
                // this way current settings for default boxes without settings
                // will be deleted
                $culled_list = $this->current_boxes;
                foreach ($culled_list as $box_type => $instances) {
                        foreach ($instances as $box_id => $values) {
                                if (in_array($box_id, $box_list)) {
                                        unset($culled_list[$box_type][$box_id]);
                                }
                        }
                }

                // add the box list from the default to the current
                foreach ($this->default_boxes as $box_type => $instances) {
                        foreach ($instances as $box_id => $settings) {
                                foreach ($box_list as $box) {
                                        if ($box_id == $box) {
                                                $culled_list[$box_type][$box_id] = $settings;
                                        }
                                }
                        }
                }
//                update_option('byob_test', array_filter($culled_list));
                update_option('byob_agility_nude_boxes', array_filter($culled_list));
                update_option('byob_agility_nude_templates', $restored_templates);
        }

        public function flatten_list($key_list, $template) {
                // get a flattened list of default header boxes
                $box_list = array();
                foreach ($key_list as $box_name) {
                        $box_list[] = $box_name;
                        foreach ($template['boxes'][$box_name] as $columns) {
                                // $box_list will be a flattened array of dboxes
                                $box_list[] = $columns;
                                foreach ($template['boxes'][$columns] as $content) {
                                        $box_list[] = $content;
                                        if (is_array($template['boxes'][$content])) {
                                                foreach ($template['boxes'][$content] as $box1) {
                                                        $box_list[] = $box1;
                                                        if (is_array($template['boxes'][$box1])) {
                                                                foreach ($template['boxes'][$box1] as $box2) {
                                                                        $box_list[] = $box2;
                                                                        if (is_array($template['boxes'][$box2])) {
                                                                                foreach ($template['boxes'][$box2] as $box3) {
                                                                                        $box_list[] = $box3;
                                                                                        if (is_array($template['boxes'][$box3])) {
                                                                                                foreach ($template['boxes'][$box3] as $box4) {
                                                                                                        $box_list[] = $box4;
                                                                                                        if (is_array($template['boxes'][$box4])) {
                                                                                                                foreach ($template['boxes'][$box4] as $box5) {
                                                                                                                        $box_list[] = $box5;
                                                                                                                        if (is_array($template['boxes'][$box5])) {
                                                                                                                                foreach ($template['boxes'][$box5] as $box6) {
                                                                                                                                        $box_list[] = $box6;
                                                                                                                                        if (is_array($template['boxes'][$box6])) {
                                                                                                                                                foreach ($template['boxes'][$box6] as $box7) {
                                                                                                                                                        $box_list[] = $box7;
                                                                                                                                                }
                                                                                                                                        }
                                                                                                                                }
                                                                                                                        }
                                                                                                                }
                                                                                                        }
                                                                                                }
                                                                                        }
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                }
                                        }
                                }
                        }
                }
                return $box_list;
        }

        public function default_header_layout() {
                // this uses the page template for the default header layout
                $header_boxes = array();
                foreach ($this->default_templates['page']['boxes']['thesis_html_body'] as $layout) {
                        $pos = strpos($layout, 'byobagn_easy_header');

                        if ($pos === 0) {
                                $header_boxes[] = $layout;
                        }
                }
                return $header_boxes;
        }

        public function determine_number_of_header_styles() {
                if (count($this->header_instances) === 3) {
                        return 1;
                } else {
                        // create an array of templates with layouts
                }
        }

        public function get_header_instances() {
                $final_instances = array();
                foreach ($this->default_templates as $template_name => $values) {
                        foreach ($values['boxes'] as $name => $config) {

                                $pos = strpos($name, 'byobagn_easy_header');
                                $delete = strpos($name, 'column');

                                if ($pos === 0 && !$delete > 0) {
                                        $instances[] = $name;
                                }
                        }
                }
                if (!empty($instances)) {
                        $final_instances = array_values(array_unique($instances));
                }
                return $final_instances;
        }

        public function get_current_header_instances($template) {
                $final_instances = array();

                foreach ($template['boxes'] as $name => $config) {

                        $pos = strpos($name, 'byobagn_easy_header');
                        $delete = strpos($name, 'column');

                        if ($pos === 0 && !$delete > 0) {
                                $instances[] = $name;
                        }
                }

                if (!empty($instances)) {
                        $final_instances = array_values(array_unique($instances));
                }
                return $final_instances;
        }

        public function default_footer_layout() {
                // this uses the page template as the default for the footer layout
                $footer_boxes = array();
                foreach ($this->default_templates['page']['boxes']['thesis_html_body'] as $layout) {
                        if (!empty($this->default_boxes['byobagn_content_grid'][$layout])) {
                                $pos = strpos($this->default_boxes['byobagn_content_grid'][$layout]['_name'], 'ooter');
                                if ($pos) {
                                        $footer_boxes[] = $layout;
                                }
                        }
                }

                return $footer_boxes;
        }

        public function determine_number_of_footer_styles() {
                if (count($this->footer_instances) === 2) {
                        return 1;
                } else {
                        // create an array of templates with layouts
                }
        }

        public function get_footer_instances() {
                $final_instances = array();
                foreach ($this->default_boxes['byobagn_content_grid'] as $box_name => $values) {
                        if (!empty($values['_name'])) {
                                $pos = strpos($values['_name'], 'ooter');
                                if ($pos) {
                                        $instances[] = $box_name;
                                }
                        }
                }

                if (!empty($instances)) {
                        $final_instances = array_values(array_unique($instances));
                }
                return $final_instances;
        }

        public function get_current_footer_instances($template) {
                $final_instances = array();

                foreach ($this->current_boxes['byobagn_content_grid'] as $box_name => $values) {
                        if (!empty($values['_name'])) {
                                $pos = strpos($values['_name'], 'ooter');
                                if ($pos) {
                                        $instances[] = $box_name;
                                }
                        }
                }

                if (!empty($instances)) {
                        $all_instances = array_values(array_unique($instances));
                }

                foreach ($template['boxes']['thesis_html_body'] as $box) {
                        if (in_array($box, $all_instances)) {
                                $current_instances[] = $box;
                        }
                }

                if (!empty($current_instances)) {
                        $final_instances = array_values(array_unique($current_instances));
                }
                return $final_instances;
        }

}
