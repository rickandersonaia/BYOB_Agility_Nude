<?php

/**
 * Description of byobagn_responsive_columns_helper
 *
 * @author Rick
 */
class byobagn_responsive_columns_helper {

        private $options = array();
        private $reverse = false;
        private $reverse_position = false;
        private $inner_reverse_position = false;
        private $column_width = false;
        private $column_configuration = 'columns_321';
        private $column_no = 0;

        public function __construct($options = array(), $column_no = 0) {
                $this->options = $options;
                $this->column_configuration = !empty($this->options['layout']) ? $this->options['layout'] : 'columns_321';
                $this->reverse = !empty($this->options['reverse']['use']) ? true : false;
                $this->column_no = $column_no;
        }

        public function layout_options() {
                return array(
                        'type' => 'select',
                        'label' => __('Select the column configuration for this header', 'byobagn'),
                        'options' => array(
                                'columns_1' => __('Single column', 'byobagn'),
                                'columns_2' => __('Two columns, equally sized', 'byobagn'),
                                'columns_321' => __('Two columns, two thirds - one third', 'byobagn'),
                                'columns_312' => __('Two columns, one third - two thirds', 'byobagn'),
                                'columns_431' => __('Two columns, three quarters - one quarter', 'byobagn'),
                                'columns_413' => __('Two columns, one quarter - three quarters', 'byobagn'),
                                'columns_3' => __('Three columns, equally sized', 'byobagn'),
                                'columns_4211' => __('Three columns, one half - one quarter - one quarter', 'byobagn'),
                                'columns_4121' => __('Three columns, one quarter - one half - one quarter', 'byobagn'),
                                'columns_4112' => __('Three columns, one quarter - one quarter - one half', 'byobagn'),
                                'columns_4' => __('Four columns, equally sized', 'byobagn')
                        ),
                        'dependents' => array(
                                'columns_1',
                                'columns_2',
                                'columns_321',
                                'columns_312',
                                'columns_431',
                                'columns_413',
                                'columns_3',
                                'columns_4211',
                                'columns_4121',
                                'columns_4112',
                                'columns_4')
                );
        }

        public function column_1() {
                switch ($this->column_configuration) {
                        case 'columns_1':
                                $this->column_width = 'full';
                                break;
                        case 'columns_2':
                        case 'sub_columns_2':
                                $this->column_width = 'half';
                                break;
                        case 'columns_321':
                                $this->column_width = 'two-thirds';
                                break;
                        case 'columns_312':
                                if ($this->reverse) {
                                        $this->column_width = 'two-thirds';
                                        $this->reverse_position = 'start';
                                } else {
                                        $this->column_width = 'one-third';
                                }
                                break;
                        case 'columns_431':
                                $this->column_width = 'three-quarters';
                                break;
                        case 'columns_413':
                                if ($this->reverse) {
                                        $this->column_width = 'three-quarters';
                                        $this->reverse_position = 'start';
                                } else {
                                        $this->column_width = 'one-quarter';
                                }
                                break;
                        case 'columns_3':
                        case 'sub_columns_3':
                                $this->column_width = 'one-third';
                                break;
                        case 'columns_4211':
                                $this->column_width = 'half';
                                break;
                        case 'columns_4121':
                                if ($this->reverse) {
                                        $this->column_width = 'half';
                                        $this->reverse_position = 'start';
                                } else {
                                        $this->column_width = 'one-quarter';
                                }
                                break;
                        case 'columns_4112':
                                if ($this->reverse) {
                                        $this->column_width = 'half';
                                        $this->reverse_position = 'start';
                                } else {
                                        $this->column_width = 'one-quarter';
                                }
                                break;
                        case 'columns_4':
                        case 'sub_columns_4':
                                $this->column_width = 'one-quarter';
                                break;
                }
        }

        public function column_2() {
                switch ($this->column_configuration) {

                        case 'columns_2':
                        case 'sub_columns_2':
                                $this->column_width = 'half';
                                break;
                        case 'columns_321':
                                $this->column_width = 'one-third';
                                break;
                        case 'columns_312':
                                if ($this->reverse) {
                                        $this->column_width = 'one-third';
                                        $this->reverse_position = 'end';
                                } else {
                                        $this->column_width = 'two-thirds';
                                }
                                break;
                        case 'columns_431':
                                $this->column_width = 'one-quarter';
                                break;
                        case 'columns_413':
                                if ($this->reverse) {
                                        $this->column_width = 'one-quarter';
                                        $this->reverse_position = 'end';
                                } else {
                                        $this->column_width = 'three-quarters';
                                }
                                break;
                        case 'columns_3':
                        case 'sub_columns_3':
                                $this->column_width = 'one-third';
                                break;
                        case 'columns_4211':
                                $this->column_width = 'one-quarter';
                                break;
                        case 'columns_4121':
                                if ($this->reverse) {
                                        $this->column_width = 'one-quarter';
                                        $this->reverse_position = 'end';
                                } else {
                                        $this->column_width = 'half';
                                }
                                break;
                        case 'columns_4112':
                                if ($this->reverse) {
                                        $this->column_width = 'one-quarter';
                                        $this->inner_reverse_position = 'start';
                                } else {
                                        $this->column_width = 'one-quarter';
                                }
                                break;
                        case 'columns_4':
                        case 'sub_columns_4':
                                $this->column_width = 'one-quarter';
                                break;
                }
        }

        public function column_3() {

                switch ($this->column_configuration) {
                        case 'columns_3':
                        case 'sub_columns_3':
                                $this->column_width = 'one-third';
                                break;
                        case 'columns_4211':
                                $this->column_width = 'one-quarter';
                                break;
                        case 'columns_4121':
                                $this->column_width = 'one-quarter';
                                break;
                        case 'columns_4112':

                                if ($this->reverse) {
                                        $this->column_width = 'one-quarter';
                                        $this->reverse_position = 'end';
                                        $this->inner_reverse_position = 'end';
                                } else {
                                        $this->column_width = 'half';
                                }
                                break;
                        case 'columns_4':
                                $this->column_width = 'one-quarter';
                                break;
                }
        }

        public function column_4() {
                $this->column_width = 'one-quarter';
        }

        public function open_html($args = array()) {
                global $thesis;
                extract($args = is_array($args) ? $args : array());
                $tab = str_repeat("\t", $depth = !empty($depth) ? $depth : 0);

                $output = '';

                if (!empty($this->column_width)) {
                        $classout = new byobagn_config_classes($this->options, 'class');
                        $class = $classout->given($this->column_width, false);
                        if ($this->reverse_position == 'start') {
                                $output = "$tab<div class=\"reverse_wrapper\">\n";
                        }

                        if ($this->inner_reverse_position == 'start') {
                                $output .= "$tab<div class=\"inner_reverse\">\n";
                        }
                        $output .= "$tab<div$class>\n";
                }
                return $output;
        }

        public function close_html($args = array()) {
                global $thesis;
                extract($args = is_array($args) ? $args : array());
                $tab = str_repeat("\t", $depth = !empty($depth) ? $depth : 0);
                $output = '';

                if (!empty($this->column_width)) {
                        if ($this->reverse_position == 'end') {
                                if ($this->inner_reverse_position == 'end') {
                                        $output .= "$tab</div>\n";
                                }
                                $output = "$tab</div>\n";
                        }
                        $output .= "$tab</div>\n";
                }

                return $output;
        }

        public function header_options() {
                return array(
                        'title' => __('The site title and tagline', 'byobagn'),
                        'header_image' => __('Thesis header image', 'byobagn'),
                        'images' => __('A set of responsive header images', 'byobagn'),
                        'widget_area' => __('A widget area', 'byobagn'),
                        'title_only' => __('Just the site title', 'byobagn'),
                        'tagline_only' => __('Just the tagline', 'byobagn'),
                        'nav_menu' => __('A WordPress menu', 'byobagn'),
                        'phone_number' => __('Your Phone Number', 'byobagn'),
                        'text_box' => __('Thesis Text Box', 'byobagn'),
                        'social_icons' => __('Social Media Icons', 'byobagn'),
//                        'multiple' => __('Two elements', 'byobagn'),
                        'rotator' => __('Let me drag whatever I want there in the Skin Editor ', 'byobagn')
                );
        }

        public function header_section_options() {
                return array(
                        '' => __('Choose One', 'byobagn'),
                        'title' => __('The site title and tagline', 'byobagn'),
                        'header_image' => __('Thesis header image', 'byobagn'),
                        'images' => __('A set of responsive header images', 'byobagn'),
                        'widget_area' => __('A widget area', 'byobagn'),
                        'title_only' => __('Just the site title', 'byobagn'),
                        'tagline_only' => __('Just the tagline', 'byobagn'),
                        'nav_menu' => __('A WordPress menu', 'byobagn'),
                        'phone_number' => __('Your Phone Number', 'byobagn'),
                        'social_icons' => __('Social Media Icons', 'byobagn'),
                        'rotator' => __('Let me drag whatever I want there in the Skin Editor ', 'byobagn')
                );
        }

}
