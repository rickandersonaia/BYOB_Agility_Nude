<?php

/**
 * Description of byob_font_style_vars
 *
 * @author Rick
 */
class byob_font_style_vars {

        public $design = array();
        public $font_elements = array();
        public $fm = array(); // stands for "font matrix"
        public $primary_font_size;
        public $primary_font_family;
        public $heading_font_family;

        public function __construct($design) {
                $this->design = $design;

                $this->primary_font_size = !empty($this->design['typ_p']['font-size']) ? $this->design['typ_p']['font-size'] : 16;
                $this->primary_font_family = !empty($this->design['primary_font_family']['font_family']) ? $this->design['primary_font_family']['font_family'] : 'arial';
                $this->heading_font_family = !empty($this->design['heading_font_family']['font_family']) ? $this->design['heading_font_family']['font_family'] : $this->primary_font_family;
                $this->content_width = !empty($this->design['content_width']['width']) ? $this->design['content_width']['width'] : 'two-thirds';

                //setup an array of default font sizes by desktop width and column configuration
                $calc = new byob_text_dimensions_calculation($this->design);
                $this->fm = $calc->setup();



                $this->font_elements = array(
                    'title' => array(
                        'font-family' => $this->heading_font_family,
                        'font-size' => $this->fm['heading'][$this->content_width]['f1']['font_size'],
                        'line-height' => $this->fm['heading'][$this->content_width]['f1']['line_height'],
                        'color' => false,
                        'default_width' => 'two-thirds'),
                    'tagline' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary'][$this->content_width]['f6']['font_size'],
                        'line-height' => $this->fm['primary'][$this->content_width]['f6']['line_height'],
                        'color' => $this->design['c_bg_med_dark'],
                        'default_width' => 'two-thirds'),
                    'headline_100' => array(
                        'font-family' => $this->heading_font_family,
                        'font-size' => $this->fm['heading']['full']['f2']['font_size'],
                        'line-height' => $this->fm['heading']['full']['f2']['line_height'],
                        'default_width' => 'full'),
                    'headline' => array(
                        'font-family' => $this->heading_font_family,
                        'font-size' => $this->fm['heading'][$this->content_width]['f2']['font_size'],
                        'line-height' => $this->fm['heading'][$this->content_width]['f2']['line_height'],
                        'color' => $this->design['cg_darkest'],
                        'default_width' => 'two-thirds'),
                    'subhead_100' => array(
                        'font-family' => $this->heading_font_family,
                        'font-size' => $this->fm['heading']['full']['f3']['font_size'],
                        'line-height' => $this->fm['heading']['full']['f3']['line_height'],
                        'default_width' => 'full'),
                    'subhead' => array(
                        'font-family' => $this->heading_font_family,
                        'font-size' => $this->fm['heading'][$this->content_width]['f3']['font_size'],
                        'line-height' => $this->fm['heading'][$this->content_width]['f3']['line_height'],
                        'color' => $this->design['cg_very_dark'],
                        'default_width' => 'two-thirds'),
                    'subsubhead_100' => array(
                        'font-family' => $this->heading_font_family,
                        'font-size' => $this->fm['heading']['full']['f4']['font_size'],
                        'line-height' => $this->fm['heading']['full']['f4']['line_height'],
                        'default_width' => 'full'),
                    'subsubhead' => array(
                        'font-family' => $this->heading_font_family,
                        'font-size' => $this->fm['heading'][$this->content_width]['f4']['font_size'],
                        'line-height' => $this->fm['heading'][$this->content_width]['f4']['line_height'],
                        'color' => $this->design['cg_very_dark'],
                        'default_width' => 'two-thirds'),
                    'blockquote' => array(
                        'font-family' => false,
                        'font-size' => false,
                        'color' => $this->design['cg_med_light']),
                    'code' => array(
                        'font-family' => 'consolas',
                        'font-size' => false,
                        'color' => false),
                    'pre' => array(
                        'font-family' => 'consolas',
                        'font-size' => false,
                        'color' => false),
                    'secondary_font_100' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary']['full']['f8']['font_size'],
                        'line-height' => $this->fm['primary']['full']['f8']['line_height'],
                        'default_width' => 'full'),
                    'secondary_font' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary'][$this->content_width]['f8']['font_size'],
                        'line-height' => $this->fm['primary'][$this->content_width]['f8']['line_height'],
                        'color' => $this->design['cg_med_light'],
                        'default_width' => 'two-thirds'),
                    'sidebar' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary']['one-third']['f7']['font_size'],
                        'line-height' => $this->fm['primary']['one-third']['f7']['line_height'],
                        'color' => $this->design['cg_dark'],
                        'default_width' => 'one-third'),
                    'sidebar_heading' => array(
                        'font-family' => $this->heading_font_family,
                        'font-size' => $this->fm['heading']['one-third']['f4']['font_size'],
                        'line-height' => $this->fm['heading']['one-third']['f4']['line_height'],
                        'color' => $this->design['cg_very_dark'],
                        'default_width' => 'one-third'),
                    'f_default_100' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary']['three-quarters']['f7']['font_size'],
                        'line-height' => $this->fm['primary']['three-quarters']['f7']['line_height'],
                        'color' => false,
                        'default_width' => 'full'),
                    'f_default_75' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary']['full']['f7']['font_size'],
                        'line-height' => $this->fm['primary']['full']['f7']['line_height'],
                        'color' => false,
                        'default_width' => 'three-quarters'),
                    'f_default_67' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary']['two-thirds']['f7']['font_size'],
                        'line-height' => $this->fm['primary']['two-thirds']['f7']['line_height'],
                        'color' => false,
                        'default_width' => 'two-thirds'),
                    'f_default_50' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary']['half']['f7']['font_size'],
                        'line-height' => $this->fm['primary']['half']['f7']['line_height'],
                        'color' => false,
                        'default_width' => 'half'),
                    'f_default_33' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary']['one-third']['f7']['font_size'],
                        'line-height' => $this->fm['primary']['one-third']['f7']['line_height'],
                        'color' => false,
                        'default_width' => 'one-third'),
                    'f_default_25' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['primary']['one-quarter']['f7']['font_size'],
                        'line-height' => $this->fm['primary']['one-quarter']['f7']['line_height'],
                        'color' => false,
                        'default_width' => 'one-quarter'),
                    'h_default_100' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['heading']['full']['f2']['font_size'],
                        'line-height' => $this->fm['heading']['full']['f2']['line_height'],
                        'color' => false,
                        'default_width' => 'full'),
                    'h_default_75' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['heading']['three-quarters']['f2']['font_size'],
                        'line-height' => $this->fm['heading']['three-quarters']['f2']['line_height'],
                        'color' => false,
                        'default_width' => 'three-quarters'),
                    'h_default_67' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['heading']['two-thirds']['f2']['font_size'],
                        'line-height' => $this->fm['heading']['two-thirds']['f2']['line_height'],
                        'color' => false,
                        'default_width' => 'two-thirds'),
                    'h_default_50' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['heading']['half']['f2']['font_size'],
                        'line-height' => $this->fm['heading']['half']['f2']['line_height'],
                        'color' => false,
                        'default_width' => 'half'),
                    'h_default_33' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['heading']['one-third']['f4']['font_size'],
                        'line-height' => $this->fm['heading']['one-third']['f4']['line_height'],
                        'color' => false,
                        'default_width' => 'one-third'),
                    'h_default_25' => array(
                        'font-family' => false,
                        'font-size' => $this->fm['heading']['one-quarter']['f4']['font_size'],
                        'line-height' => $this->fm['heading']['one-quarter']['f4']['line_height'],
                        'color' => false,
                        'default_width' => 'one-quarter')
                );
        }

        public function generate_vars() {
                global $thesis;
                $colors = new byob_color_values($this->design);
                $font_values = new byob_font_style_values($this->design);
                $heading_list = array('title', 'headline_100', 'headline', 'subhead_100', 'subhead', 'subsubhead', 'subsubhead_100', 'sidebar_heading');

                // first set up the values and use defaults when applicable
                foreach ($this->font_elements as $name => $elements) {

                        // font family
                        $default_font_family = !empty($elements['font-family']) ? $elements['font-family'] : false;
                        // send the design option id and the default value and get the appropriately modified results
                        $font_family = $font_values->font_family($name, $default_font_family);
                        if ($font_family) {
                                $e[$name]['font-family'] = "font-family: $font_family;";
                        }

                        //font size
                        $default_font_size = !empty($elements['font-size']) ? $elements['font-size'] : false;
                        // send a design option id and a default font size and get a formatted number
                        $font_size = $font_values->font_size($name, $default_font_size);
                        if ($font_size) {
                                $e[$name]['font-size'] = "font-size: $font_size;";
                        }

                        //line height
                        // setup defaults - if they exist
                        $default_line_height = !empty($elements['line-height']) ? $elements['line-height'] : false;
                        // default width is the default main content column configuration
                        $default_width = !empty($elements['default_width']) ? $elements['default_width'] : false;

                        // set the type of line height calculation to be used - heading or primary
                        if (in_array($name, $heading_list)) {
                                $type = 'heading';
                        } else {
                                $type = 'primary';
                        }

                        // send the design option id, the default line height, the default content column configuration
                        // and the type of line hright calculation to use
                        // get a calculated, formatted line height in return
                        $line_height = $font_values->line_height($name, $default_line_height, $default_width, $type, $default_font_size);

                        if ($line_height) {
                                $e[$name]['line-height'] = "line-height: $line_height;";
                        }

                        // color
                        $color = false;
                        $default_color = !empty($elements['color']) ? $elements['color'] : false;
                        $color = $colors->set_color($name, $default_color);
                        if ($color) {
                                $e[$name]['color'] = "color: $color;";
                        }

                        // clean out the array before moving on
                        $e[$name] = array_filter($e[$name]);
                }

                // second - take the values and turn them into single string variables for each element
                foreach ($e as $name => $element) {
                        if (is_array($element)) {// since array_filter() didn't work here - get rid of all the false elements before setting up the vars
                                foreach ($element as $property => $value) {
                                        if ($value == false) {
                                                unset($element);
                                        }
                                }
                        }
                        if (is_array($element)) {  // turn each array element into a property value pair on a new line
                                $vars[$name] = implode("\n\t", $element);
                        } else {
                                if ($element) { // otherwise turn the element into a single property value pair.
                                        $vars[$name] = $element;
                                } else {
                                        $vars[$name] = '';
                                }
                        }
                }

                // $vars array is now setup
                // third - add additional string data to each variable
                foreach ($this->font_elements as $name => $content) {
                        $vars[$name] .= $font_values->additional_styles($name);
                }

                //setup primitive vars
                $vars['font'] = $thesis->api->fonts->family($this->primary_font_family);
                $vars['heading_font'] = $thesis->api->fonts->family($this->heading_font_family);

                $vars['c_primary'] = $colors->set_color('typ_p', $this->design['cg_dark']);
                $vars['c_secondary'] = $colors->set_color('secondary_font', $this->design['cg_med']);
                $vars['c_links'] = $colors->set_link_colors('typ_links', 'link_skin_color', 'link-color', $this->design['c_cont_bg_med']);
                $vars['c_link_hover'] = $colors->set_link_colors('typ_links', 'hover_skin_color', 'hover-color', $this->design['c_cont_bg_med_dark']);

                $vars['f_primary_100'] = $thesis->api->css->number($this->fm['primary']['full']['f7']['font_size']);
                $vars['h_primary_100'] = $thesis->api->css->number($this->fm['primary']['full']['f7']['line_height']);
                $vars['f_primary_67'] = $thesis->api->css->number($this->fm['primary'][$this->content_width]['f7']['font_size']);
                $vars['h_primary_67'] = $thesis->api->css->number($this->fm['primary'][$this->content_width]['f7']['line_height']);
                $vars['f_primary_75'] = $thesis->api->css->number($this->fm['primary']['three-quarters']['f7']['font_size']);

                $vars['title_link'] = $font_values->link_styles('title', 'link');
                $vars['title_hover'] = $font_values->link_styles('title', 'hover');

                $vars['sidebar_widget_link'] = $font_values->link_styles('sidebar_widget_links', 'link', $this->design['c_cont_bg_med_dark']);
                $vars['sidebar_widget_hover'] = $font_values->link_styles('sidebar_widget_links', 'hover', $this->design['cg_dark']);

                return $vars;
        }

}
