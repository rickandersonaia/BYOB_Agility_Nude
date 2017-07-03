<?php

/**
 * Description of byob_config_classes
 *
 * @author Rick
 */
class byobagn_config_classes {

        protected $options = array();
        protected $simple_class = '';

        public function __construct($options, $option_name = 'class') {
                $this->options = $options;
                $this->simple_class = !empty($options[$option_name]) ? trim(esc_attr($options[$option_name])) : false;
        }

        public function simple() {

                $output = '';
                if ($this->simple_class) {
                        $output = $this->build_output($this->simple_class);
                }
                return $output;
        }

        public function given($default, $replace = false) {

                $output = '';
                $default_class = !empty($default) ? trim(esc_attr($default)) : false;
                $temp_class = array();

                if ($replace) {
                        if ($this->simple_class) {
                                $temp_class[] = $this->simple_class;
                        } elseif (!empty($default_class)) {
                                $temp_class[] = $default_class;
                        }
                } else {
                        if ($this->simple_class) {
                                $temp_class[] = $this->simple_class;
                        }
                        if ($default_class) {
                                $temp_class[] = $default_class;
                        }
                }

                if (!empty($temp_class)) {
                        $final_class = implode(' ', $temp_class);
                        $output = $this->build_output($final_class);
                }

                return $output;
        }

        public function secondary($default, $replace = false, $secondary_class) {
                $output = '';
                $default_class = !empty($default) ? trim(esc_attr($default)) : false;
                $temp_class = array();

                if ($replace) {
                        if ($this->simple_class) {
                                $temp_class[] = $this->simple_class;
                        } elseif (!empty($default_class)) {
                                $temp_class[] = $default_class;
                        }
                } else {
                        if ($this->simple_class) {
                                $temp_class[] = $this->simple_class;
                        }
                        if ($default_class) {
                                $temp_class[] = $default_class;
                        }
                }

                if (!empty($secondary_class)) {

                        if (is_array($secondary_class)) {
                                foreach ($secondary_class as $class) {
                                        if (!empty($class)) {
                                                $temp_class[] = trim(esc_attr($class));
                                        }
                                }
                        } else {
                                $temp_class[] = $secondary_class;
                        }
                }

                if (!empty($temp_class)) {
                        $final_class = implode(' ', $temp_class);
                        $output = $this->build_output($final_class);
                }

                return $output;
        }

        public function build_output($final_class) {

                $class = ' class="' . $final_class . '"';
                return $class;
        }

}
