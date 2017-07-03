<?php

/**
 * Description of byobagn_grid_content_patterns
 *
 * @author Rick
 */
class byobagn_grid_content_patterns {

        public $template_options = array(); // The current template's options
        public $template;  // the ID of the current template
        public $template_history = array(); // The byob_agility_nude_content_grid_template_settings options
        public $template_box_list = array();  // The full list of boxes inside the parent box - parent box id & column id & child boxes ids
        public $box_settings = array();  // The options for the parent box ($this->options)
        public $parent_class;  // The class name of the parent box
        public $parent_id;  // The ID of the parent box
        public $parent_name;  // The name of the parent box - set by the user ($this->name)
        public $cols; // Number of columns in the parent box
        public $unique_id; // The numeric part of the parent box ID
        public $box_options = array();  // The entire byob_agility_nude_boxes array
        public $box_list = array();  // The list of boxes inside the parent box - parent box id & child boxes ids
        public $boxes = array();  // The list of boxes in the current box - similar to $box_list
        public $box_history = array(); // The byob_agility_nude_content_grid_settings options
        public $delete_list = array(); // an array of box ids to be deleted

        public function __construct($box) {

                $this->template_options = get_option('byob_agility_nude_templates');
                $this->box_options = get_option('byob_agility_nude_boxes');
//                $this->box_history = get_option('byob_agility_nude_content_grid_settings');
//                $this->template_history = get_option('byob_agility_nude_content_grid_template_settings');

                foreach ($box as $box_class => $box_id) {
                        $this->parent_class = $box_class;
                        foreach ($box_id as $id => $options) {
                                $this->parent_id = $id;
                                $this->box_settings = $options;
                        }
                }

                // build a full version of the box that is being saved
                $this->dynamic_box[$this->parent_id] = $this->box_options[$this->parent_class][$this->parent_id];

                foreach ($this->box_settings as $option => $value) {
                        $this->dynamic_box[$this->parent_id][$option] = $value;
                }

                $this->unique_id = substr($this->parent_id, -10);
                $this->parent_name = !empty($this->box_options[$this->parent_class][$this->parent_id]['_name']) ? $this->box_options[$this->parent_class][$this->parent_id]['_name'] : 'not set';
        }

        public function build_column_content() {
                //step 1 - determine the numbet of columns in the parent box
                $this->cols = $this->set_number_of_columns();

                //step 2 - set up the template options
                $templates = array();
                foreach ($this->template_options as $template_name => $template_options) {
                        if (isset($template_options['boxes'][$this->parent_id])) {

                                // if the parent id exists in the template - rebuild the template
                                if (!empty($this->template_options[$template_name]['title'])) {
                                        $templates[$template_name]['title'] = $this->template_options[$template_name]['title'];
                                }
                                $templates[$template_name]['options'] = $this->template_options[$template_name]['options'];
                                $templates[$template_name]['boxes'] = $this->set_columns($template_name);
                        } else {
                                // if the parent id doesn't exist in the template copy the existing template
                                $templates[$template_name] = $this->template_options[$template_name];
                        }
                }

                //step 3- save the updated templates
                update_option('byob_agility_nude_templates', $templates);

                //step 4- setup the box options
                return $this->set_box_option_definitions();
        }

        public function set_number_of_columns() {
                if (empty($this->box_settings['layout'])) {
                        return 2;
                } else {
                        switch ($this->box_settings['layout']) {
                                case 'columns_1':
                                        return 1;
                                        break;
                                case 'columns_2':
                                case 'columns_321':
                                case 'columns_312':
                                case 'columns_413':
                                case 'columns_431':
                                        return 2;
                                        break;
                                case 'columns_3':
                                case 'columns_4121':
                                case 'columns_4211':
                                case 'columns_4112':
                                        return 3;
                                        break;
                                case 'columns_4':
                                        return 4;
                                        break;
                        }
                }
        }

        // The first part of the process - setting up the template options to include the new box configuration

        public function set_columns($template_name) {

                // rebuild the columns of the parent id
                // cycle through the potential columns and add $cols number of columns - after make sure the remain potential columns are unset
                // this happens for each template
                // this provides the data for the byob_agility_nude_templates options

                $count = 1;
                $template = $this->template_options[$template_name];
                $column_key_list = $box_key_list = array();

                while ($count < $this->cols + 1) {
                        // add a column until $cols is reached
                        // if the column doesn't exist - create it
                        if (!isset($this->template_options[$template_name]['boxes'][$this->parent_id][$this->parent_id . '_byobagn_column_' . $count])) {
                                $template['boxes'][$this->parent_id][] = $this->parent_id . '_byobagn_column_' . $count;
//                                $template['boxes'][] = $this->parent_id . '_byobagn_column_' . $count;
                        }
                        $count++;
                }
                $template['boxes'][$this->parent_id] = array_values(array_unique($template['boxes'][$this->parent_id]));

                // Make sure that any columns above $cols are unset
                // including their children
                while ($count < 5) {
                        $column_key_list[] = $this->parent_id . '_byobagn_column_' . $count;
                        $key = array_search($this->parent_id . '_byobagn_column_' . $count, $template['boxes'][$this->parent_id]);
                        if ($key !== false) {
                                unset($template['boxes'][$this->parent_id][$key]);
                        }
                        $count++;
                }
                // Now we should have $cols number of columns only in template options -  for each template

                $count = 1;
                // Cycle through the columns again and assign them their content
                while ($count < $this->cols + 1) {
                        $boxes = array();
                        $boxes = $this->set_column_content($count);
                        $column = $this->parent_id . '_byobagn_column_' . $count;

                        // the $box now has it's assignment

                        if (!empty($boxes)) {
                                foreach ($boxes as $box) {
                                        // if it is a rotator box
                                        if ($box['id'] === 'delete') {
                                                // see if it previously had a box that needs to be deleted
                                                // if the current assignment for the column isn't rotator
                                                // add the current box to the delete list
                                                if ($this->box_options[$this->parent_class][$this->parent_id]['column_content_' . $count] !== 'rotator') {
                                                        $box_key_list[] = $this->template_options[$template_name]['boxes'][$column][0];
                                                }
                                                // if it is a rotator box without content set it's contents to an empty array
                                                if (empty($this->template_options[$template_name]['boxes'][$column])) {
                                                        $template['boxes'][$column] = array();
                                                }
                                        } else {
                                                // setup the content of the column in the template
                                                // first - if the column is currently empty
                                                if (empty($this->template_options[$template_name]['boxes'][$column])) {
                                                        $template['boxes'][$column][0] = $box['id'];
                                                        // next - if the column has different box
                                                        // replace it with the new box and add it to the list to be deleted
                                                } elseif ($this->template_options[$template_name]['boxes'][$column][0] != $box['id']) {
                                                        $template['boxes'][$column][0] = $box['id'];
                                                        $box_key_list[] = $this->template_options[$template_name]['boxes'][$column][0];
                                                } else {
                                                        $template['boxes'][$column][0] = $this->template_options[$template_name]['boxes'][$column][0];
                                                }

                                                $box_content = $this->set_column_box_content($count, $box['id']);

                                                // get an array of boxes that should be children of the current column content box
                                                // if the new box id has children
                                                if ($box_content) {

                                                        if (empty($this->template_options[$template_name]['boxes'][$box['id']])) {
                                                                $template['boxes'][$box['id']] = $box_content;
                                                        } else {
                                                                $template['boxes'][$box['id']] = $this->template_options[$template_name]['boxes'][$box['id']];
                                                        }
                                                }


                                                // setup the box options
                                                // if the box doesn't exist in box options
                                                if (!isset($this->box_options[$box['class']][$box['id']])) {
                                                        // add it to the box list
                                                        $this->box_list[$this->parent_id][] = $box['id'];
                                                } else {
                                                        // if the box does exist in box options then add the current box options to the box list
                                                        $this->box_list[$this->parent_id][$box['id']] = $this->box_options[$box['class']][$box['id']];
                                                }

                                                // build an array of boxes that need to be added to the box options
                                                $this->boxes[$box['id']] = array(
                                                    'class' => $box['class'],
                                                    '_name' => $box['_name']
                                                );
                                        }
                                }
                        } else {
                                $template['boxes'][$this->parent_id . '_byobagn_column_' . $count] = array();
                        }
                        $count++;
                }

                // if there are boxes within columns to be unset - get a list of the children boxes and unset them all
                // first - get rid of the children boxes
                $this->delete_list = array_merge($column_key_list, $box_key_list);
                if (!empty($this->delete_list)) {
                        $delete = new byobagn_flatten_box_list();
                        $delete_list = $delete->flatten_list($this->delete_list, $this->template_options[$template_name]);
                        foreach ($delete_list as $box) {
                                unset($template['boxes'][$box]);
                        }
                        $this->delete_list = $delete_list;
                }

                // next - get rid of the columns
                if (!empty($column_key_list)) {
                        foreach ($column_key_list as $column_to_remove) {
                                unset($template['boxes'][$this->parent_id][$column_to_remove]);
                        }
                }

                return $template['boxes'];
        }

        // The second part of the process - making sure that the byob_agility_nude_boxes list
        // accurately reflects the boxes in the content grid box

        public function set_box_option_definitions() {

                $final_box_list = $this->box_options;

                // setup the parent box
                // remove the original parent box
                unset($final_box_list[$this->parent_class][$this->parent_id]);
                // add the new parent box to the final list
                $final_box_list[$this->parent_class] = array_merge($final_box_list[$this->parent_class], $this->dynamic_box);

                // check the list of boxes added to the template to make sure they are added to the box list as well
                foreach ($this->boxes as $box_id => $settings) {
                        $box_class = $settings['class'];

                        // if the class hasn't been set then set it and its children boxes
                        if (!isset($this->box_options[$box_class])) {
                                $final_box_list[$box_class][$box_id] = array(
                                    '_name' => $settings['_name']
                                );

                                // if the class has been set then check to see if the child box
                                // is set.  If it isn't set the child box
                        } elseif (!isset($this->box_options[$box_class][$box_id])) {
                                $final_box_list[$box_class][$box_id] = array(
                                    '_name' => $settings['_name']
                                );
                                //if the child box has been set - make sure the name is right
                        } elseif (isset($this->box_options[$box_class][$box_id])) {
                                $final_box_list[$box_class][$box_id]['_name'] = $settings['_name'];
                        }
                }

                // finally delete all of the boxes that should be deleted from the final list

                if (!empty($this->delete_list)) {
                        foreach ($this->delete_list as $box) {
                                foreach ($this->box_options as $class => $boxex) {
                                        unset($final_box_list[$class][$box]);
                                }
                        }
                }
                return $final_box_list;
        }

        public function set_column_content($count) {
                $box = array();
                // create a unique id for each box by adding $count to the parent id
                $id = (int) $this->unique_id + (int) $count;

                // the options for the grid box for which content should be in which column
                if (!empty($this->box_settings['column_content_' . $count])) {
                        $box[] = $this->column_content_options($this->box_settings['column_content_' . $count], $id, $count);
                }
                //return the results of the column assignment
                return $box;
        }

        public function column_content_options($content, $id, $count) {
                $box = array();

                switch ($content) {
                        case 'featured_content':
                                $box['id'] = 'byobagn_featured_content_query_box_' . $id;
                                $box['class'] = 'byobagn_featured_content_query_box';
                                $box['type'] = 'featured_content';
                                $box['label'] = 'Featured Content';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Featured Content';
                                break;
                        case 'icon_content':
                                $box['id'] = 'byobagn_icon_query_box_' . $id;
                                $box['class'] = 'byobagn_icon_query_box';
                                $box['type'] = 'icon_content';
                                $box['label'] = 'Icon Content Box';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Icon Content';
                                break;
                        case 'widget_area':
                                $box['id'] = 'thesis_wp_widgets_' . $id;
                                $box['class'] = 'thesis_wp_widgets';
                                $box['type'] = 'widget_area';
                                $box['label'] = 'Widget Area';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Widget Area';
                                break;
                        case 'text_box':
                                $box['id'] = 'thesis_text_box_' . $id;
                                $box['class'] = 'thesis_text_box';
                                $box['type'] = 'text_box';
                                $box['label'] = 'Text Box';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Text Box';
                                break;
                        case 'call_to_action':
                                $box['id'] = 'byobagn_call_to_action_' . $id;
                                $box['class'] = 'byobagn_call_to_action';
                                $box['type'] = 'call_to_action';
                                $box['label'] = 'Call to Action';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Call to Action';
                                break;
                        case 'title':
                                $box['id'] = 'byobagn_title_and_tagline_' . $id;
                                $box['class'] = 'byobagn_title_and_tagline';
                                $box['type'] = 'title_and_tagline';
                                $box['label'] = 'Site Title & Tagline';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Site Title & Tagline';
                                break;
                        case 'title_only':
                                $box['id'] = 'thesis_site_title_' . $id;
                                $box['class'] = 'thesis_site_title';
                                $box['type'] = 'thesis_site_title';
                                $box['label'] = 'Site Title';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Site Title';
                                break;
                        case 'tagline_only':
                                $box['id'] = 'thesis_site_tagline_' . $id;
                                $box['class'] = 'thesis_site_tagline';
                                $box['type'] = 'thesis_site_tagline';
                                $box['label'] = 'Site Tagline';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Site Tagline';
                                break;
                        case 'header_image':
                                $box['id'] = 'byobagn_header_image_' . $id;
                                $box['class'] = 'byobagn_header_image';
                                $box['type'] = 'header_image';
                                $box['label'] = 'Thesis Header Image';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Thesis Header Image';
                                break;
                        case 'images':
                                $box['id'] = 'byobagn_responsive_images_' . $id;
                                $box['class'] = 'byobagn_responsive_images';
                                $box['type'] = 'responsive_images';
                                $box['label'] = 'Responsive Header Images';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Responsive Header Images';
                                break;
                        case 'nav_menu':
                                $box['id'] = 'thesis_wp_nav_menu_' . $id;
                                $box['class'] = 'thesis_wp_nav_menu';
                                $box['type'] = 'thesis_wp_nav_menu';
                                $box['label'] = 'WP Nav Menu';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - WP Nav Menu';
                                break;
                        case 'phone_number':
                                $box['id'] = 'byobagn_phone_number_' . $id;
                                $box['class'] = 'byobagn_phone_number';
                                $box['type'] = 'phone_number';
                                $box['label'] = 'Phone Number';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Phone Number';
                                break;
                        case 'social_icons':
                                $box['id'] = 'byobagn_social_profile_links_' . $id;
                                $box['class'] = 'byobagn_social_profile_links';
                                $box['type'] = 'social_icons';
                                $box['label'] = 'Social Profile Links';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Social Profile Links';
                                break;
                        case 'copyright':
                                $box['id'] = 'byobagn_copyright_date_' . $id;
                                $box['class'] = 'byobagn_copyright_date';
                                $box['type'] = 'copyright';
                                $box['label'] = 'Copyright';
                                $box['_name'] = $this->parent_name . ' - Column ' . $count . ' - Copyright';
                                break;
                        case 'rotator':
                                $box['id'] = 'delete';
                                break;
                }
                return $box;
        }

        public function set_column_box_content($count, $box_id) {
                $box_content = false;
                switch ($this->box_settings['column_content_' . $count]) {
                        case 'featured_content':
                                $box_content = $this->featured_content($box_id);
                                break;
                        case 'icon_content':
                                $box_content = $this->icon_box($box_id);
                                break;
                        case 'title':
                                $box_content = $this->title_tagline($box_id);
                                break;
                        case 'social_icons':
                                $box_content = $this->social_icons($box_id);
                                break;
                }

                return $box_content;
        }

        public function featured_content($box_id) {
                return array(
                    $box_id . '_byobagn_featured_content_featured_image',
                    $box_id . '_byobagn_featured_content_post_title',
                    $box_id . '_byobagn_typical_excerpt',
                    $box_id . '_byobagn_featured_content_read_more'
                );
        }

        public function icon_box($box_id) {
                return array(
                    $box_id . '_byobagn_dependent_icon_box',
                    $box_id . '_byobagn_featured_content_post_title',
                    $box_id . '_byobagn_typical_short_excerpt',
                    $box_id . '_byobagn_featured_content_read_more'
                );
        }

        public function title_tagline($box_id) {
                return array(
                    $box_id . '_thesis_site_title',
                    $box_id . '_thesis_site_tagline'
                );
        }

        public function social_icons($box_id) {
                return array(
                    $box_id . '_byobagn_twitter_link',
                    $box_id . '_byobagn_linkedin_link',
                    $box_id . '_byobagn_facebook_link',
                    $box_id . '_byobagn_stumbleupon_link',
                    $box_id . '_byobagn_googleplus_link',
                    $box_id . '_byobagn_pinterest_link',
                    $box_id . '_byobagn_instagram_link',
                    $box_id . '_byobagn_vimeo_link',
                    $box_id . '_byobagn_vine_link',
                    $box_id . '_byobagn_youtube_link',
                    $box_id . '_byobagn_flickr_link',
                    $box_id . '_byobagn_reddit_link',
                    $box_id . '_byobagn_tumblr_link',
                    $box_id . '_byobagn_slideshare_link',
                    $box_id . '_byobagn_custom1_link',
                    $box_id . '_byobagn_custom2_link'
                );
        }

}
