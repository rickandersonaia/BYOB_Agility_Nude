<?php

/**
 * Description of byob_config_id
 *
 * @author Rick
 */
class byobagn_config_id {

        //put your code here
        protected $options = array();
        protected $simple_id = '';

        public function __construct($options, $option_name = 'id') {
                $this->options = $options;
                $this->simple_id = !empty($this->options[$option_name]) ? trim(esc_attr($this->options[$option_name])) : false;
        }

        public function simple() {

                $id = '';
                if ($this->simple_id) {
                        $id = $this->build_id($this->simple_id);
                }
                return $id;
        }

        public function given($default) {

                $id = '';
                $default_id = !empty($default) ? trim(esc_attr($default)) : false;

                if ($this->simple_id) {
                        $id = $this->build_id($this->simple_id);
                } elseif (!empty($default_id)) {
                        $id = $this->build_id($default_id);
                }
                return $id;
        }

        public function build_id($final_id) {

                $id = ' id="' . $final_id . '"';
                return $id;
        }

}
