<?php

/**
 * Description of byob_column_width_calculations
 *
 * @author Rick
 */
class byob_column_width_calculations {

        public $design = array();
        public $column_width_defaults = array(
                'full' => array(
                        'default' => 960,
                        'factor' => 1),
                'three-quarters' => array(
                        'default' => 725,
                        'factor' => .75),
                'two-thirds' => array(
                        'default' => 640,
                        'factor' => .666),
                'half' => array(
                        'default' => 485,
                        'factor' => .5),
                'one-third' => array(
                        'default' => 320,
                        'factor' => .333),
                'one-quarter' => array(
                        'default' => 232,
                        'factor' => .25),
        );
        public $desktop_width = 1032;
        public $content_width = 'two-thirds';
        public $spacing_constant_width = 26;
        public $spacing_constant_guess = 27;

        public function __construct($design) {
                $this->design = $design;
                $this->calculate_column_widths();
        }

        public function column_width_guess() {

        }

        public function calculate_column_widths() {
                if (!empty($this->design['dimensions'])) {
                        switch ($this->design['dimensions']) {

                        }
                }
        }

        public function calculate_spacing() {

        }

}
