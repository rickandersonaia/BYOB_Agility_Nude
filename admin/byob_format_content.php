<?php

/**
 * Description of byob_format_content
 *
 * @author ander
 */
class byob_format_content {

        public $instances = array(); // $this->_instances passed
        public $sections = array(); // new sections array with formatting data
        public $built_in_sections = 8; // number of content sections programmed into the skin

        public function __construct($instances = array()) {
                $this->instances = $instances;
//                var_dump($this->instances);
                $this->sections = array(
                    'header' => array(
                        'label' => __('Typical Header Settings', 'byobagn'),
                        'description' => __('The typical Agility 3 header consists of 3 main sections: the Top Header Bar, the Main Header and the Top Menu Area', 'byobagn'),
                        'section' => 1
                    ),
                    'footer' => array(
                        'label' => __('Typical Footer Settings', 'byobagn'),
                        'description' => __('The typical Agility 3 footer consists of 2 main sections: the Footer and the Bottom Footer', 'byobagn'),
                        'section' => 2
                    ),
                    'front' => array(
                        'label' => __('Front Page Settings', 'byobagn'),
                        'description' => __('The Agility 3 front page consists of 5 main sections plus the Header and Footer: the Feature Box, Main Content, Attention Box Area, Featured Content Area and the Notice Bar', 'byobagn'),
                        'section' => 3
                    ),
                    'notice' => array(
                        'label' => __('Notice Bar Settings', 'byobagn'),
                        'description' => __('The Agility Notice Bar shows up on a number of pages, including the Front Page', 'byobagn'),
                        'section' => 4
                    ),
                    'single' => array(
                        'label' => __('Single Post Settings', 'byobagn'),
                        'description' => __('Settings for the Single Post pages', 'byobagn'),
                        'section' => 5
                    ),
                    'home' => array(
                        'label' => __('Blog Page Settings', 'byobagn'),
                        'description' => __('Settings for the Blog Posts page', 'byobagn'),
                        'section' => 6
                    ),
                    'archive' => array(
                        'label' => __('Archive Page Settings', 'byobagn'),
                        'description' => __('Settings for the various types of archive pages (category & tag pages)', 'byobagn'),
                        'section' => 7
                    ),
                    'site_wide' => array(
                        'label' => __('Site Wide Settings', 'byobagn'),
                        'description' => __('Settings for boxes that exist site wide', 'byobagn'),
                        'section' => 8
                    ),
                    'custom' => array(
                        'label' => __('User Added Boxes', 'byobagn'),
                        'description' => __('Settings for boxes that you have added to templates in the Skin Editor', 'byobagn'),
                        'section' => 0
                    )
                );
        }

        public function format_instance_array() {

                // setup an array of box instances with additional elements
                foreach ($this->instances as $name => $text) {
                        $instance[$name]['text'] = $text;
                        // section is the first number of the name
                        $instance[$name]['section'] = substr($text, 0, 1);
                        // group is extracted from number in the id of the box
                        $instance[$name]['group'] = substr($name, -6, 4);
                        $instance[$name]['parent'] = false;
                        $instance[$name]['child'] = false;
                }

                // setup the box groupings & add box instances to their sections
                foreach ($this->sections as $section) {
                        foreach ($instance as $id => $box) {
                                // set the section and group for elements outside of the Agility Skin range
                                if (!is_numeric($box['section']) || $box['section'] < 1 || $box['section'] > $this->built_in_sections) {
                                        $box['section'] = 0;
                                        $box['group'] = false;
                                }
                                // add the box to the appropriate section of the array
                                if ($section['section'] == $box['section']) {
                                        $section['instances'][$id] = $box;
                                }
                        }
                        $section_list[] = $section;
                }
//                var_dump($section_list);

                foreach ($section_list as $section) {
                        // get the ids of the groups and the number of instances in each group
                        // group id is extracted from number in the id of the box
                        $groups = array();
                        if (!empty($section['instances'])) {
                                foreach ($section['instances'] as $value) {
                                        if (!empty($value['group']) && !array_key_exists($value['group'], $groups)) {
                                                $groups[$value['group']] = 1;
                                        } elseif (!empty($value['group'])) {
                                                $groups[$value['group']] ++;
                                        }
                                }

//                        var_dump($groups);
                                $current_group = '';
                                foreach ($groups as $id => $number) {
                                        $cnt = 1;
                                        foreach ($section['instances'] as $key => $instance) {
                                                if ($instance['group'] == $id) {
                                                        if ($id !== $current_group) {
                                                                $cnt = 1;
                                                                $current_group = $id;
                                                        }
//                                                var_dump($id, $cnt, $number);
                                                        if ($cnt == 1 && $number == 1) {
                                                                $instance['parent'] = false;
                                                                $instance['child'] = false;
                                                        }

                                                        if ($cnt == 1 && $number > 1) {
                                                                $instance['parent'] = true;
                                                                $instance['child'] = false;
                                                        }

                                                        if ($cnt == 2 && $number == 2) {
                                                                $instance['parent'] = false;
                                                                $instance['child'] = 'both';
                                                        }

                                                        if ($cnt == 2 && $number > 2) {
                                                                $instance['parent'] = false;
                                                                $instance['child'] = 'first';
                                                        }

                                                        if ($cnt > 2 && $number > $cnt) {
                                                                $instance['parent'] = false;
                                                                $instance['child'] = true;
                                                        }

                                                        if ($cnt > 2 && $number == $cnt) {
                                                                $instance['parent'] = false;
                                                                $instance['child'] = 'last';
                                                        }
                                                }
                                                $section['instances'][$key] = $instance;
                                                $cnt++;
                                        }
                                }
                        }
                        $matrix[] = $section;
                }
                return $matrix;
        }

        public function open($instance = array()) {
                if ($instance['parent']) {
                        return '';
                }
                if (!empty($instance['child']) && $instance['child'] == 'both') {
                        return "\t\t";
                }
                if (!empty($instance['child'])) {
                        return "\t\t";
                }
                return '';
        }

        public function close($instance = array()) {
                if ($instance['parent']) {
                        return "\n\t\t\t\t\t<ul>\n";
                }
                if ($instance['child'] === 'last' || $instance['child'] === 'both') {
                        return "\n\t\t\t\t\t</ul>\n";
                }
                if ($instance['child'] === true) {
                        return "\n";
                }
                return "\n";
        }

}
