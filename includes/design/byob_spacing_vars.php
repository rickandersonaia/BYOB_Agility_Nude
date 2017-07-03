<?php

/**
 * Description of byob_spacing_vars
 *
 * @author Rick
 */
class byob_spacing_vars {

        public $design = array();
        public $spacing_constant = 26;
        public $full_spacing_constant = 31;
        public $desktop_matrix = array();
        public $desktop_width = 1032;
        public $content_width = 640;
        public $full_content_width = 980;
        public $content_column_config = 'two-thirds';

        public function __construct($design) {
                $this->design = $design;

                // setup an array of defalut font sizes and column widths for each desktop width and column configuration
                $sizes = new byob_text_dimensions_calculation($this->design);
                $this->desktop_matrix = $sizes->column_fonts;

                // setup desktop width
                $this->desktop_width = !empty($this->design['desktop_width']['width']) ? $this->design['desktop_width']['width'] : 1032;
                // setup column configuration
                $this->content_column_config = !empty($this->design['content_width']['width']) ? $this->design['content_width']['width'] : 'two-thirds';

                // get the width of the full content column based on the matrix above - as an integer
                $this->full_content_width = !empty($this->desktop_matrix[$this->desktop_width]['full']['column_width']) ? $this->desktop_matrix[$this->desktop_width]['full']['column_width'] : 980;

                // get the width of the content column based on the matrix above - as an integer
                $this->content_width = !empty($this->desktop_matrix[$this->desktop_width][$this->content_column_config]['column_width']) ? $this->desktop_matrix[$this->desktop_width][$this->content_column_config]['column_width'] : 640;

                $this->set_spacing_constant();
                $this->set_full_spacing_constant();
        }

        public function set_spacing_constant() {

                if (!empty($this->design['spacing_constant_width']['width']) && is_numeric($this->design['spacing_constant_width']['width'])) {
                        $this->spacing_constant = $this->design['spacing_constant_width']['width'];
                } else {
                        if (!empty($this->design['typ_p']['font-size']) && is_numeric($this->design['typ_p']['font-size'])) {

                                $this->spacing_constant = round($this->design['typ_p']['font-size'] * 1.616);
                        } else {
                                $this->spacing_constant = round($this->desktop_matrix[$this->desktop_width][$this->content_column_config]['font_size'] * 1.616);
                        }
                }
        }

        public function set_full_spacing_constant() {
                $spacing = new byob_text_dimensions_calculation($this->design);
                $fm = $spacing->setup();
                $font_size = $fm['primary']['full']['f7']['font_size'];
                $this->full_spacing_constant = round($font_size * 1.616);
        }

        public function page_width() {
                $page_width = $this->desktop_matrix[$this->desktop_width]['full']['column_width'] + ( $this->spacing_constant * 2 );
                return $page_width;
        }

        public function spacing_matrix() {
                $spacing = new byob_text_dimensions_calculation($this->design);
                $matirx = $spacing->space($this->spacing_constant);
                return $matirx;
        }

        public function full_spacing_matrix() {
                $spacing = new byob_text_dimensions_calculation($this->design);
                $full_matirx = $spacing->space($this->full_spacing_constant);
                return $full_matirx;
        }

}
