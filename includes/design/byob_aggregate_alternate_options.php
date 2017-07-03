<?php

/**
 * Description of byob_aggregate_alternate_options
 *
 * @author Rick
 */
class byob_aggregate_alternate_options {

        public $alt_background = array();
        public $alt_widget = array();
        public $alt_text = array();
        public $alt_icon = array();
        public $alt_cta = array();
        public $alt_mq = array();

        public function __construct() {
                $this->alt_background = get_option('byobagn_background_design');
                $this->alt_widget = get_option('byobagn_widget_design');
                $this->alt_text = get_option('byobagn_text_area_design');
                $this->alt_icon = get_option('byobagn_icon_design');
                $this->alt_cta = get_option('byobagn_cta_design');
                $this->alt_mq = get_option('byobagn_media_query_design');
        }

        public function all_options() {

                $background_options = (!empty($this->alt_background)) ? $this->alt_background : array();
                $widget_options = (!empty($this->alt_widget)) ? $this->alt_widget : array();
                $text_options = (!empty($this->alt_text)) ? $this->alt_text : array();
                $icon_options = (!empty($this->alt_icon)) ? $this->alt_icon : array();
                $cta_options = (!empty($this->alt_cta)) ? $this->alt_cta : array();
                $mq_options = (!empty($this->alt_mq)) ? $this->alt_mq : array();

                return array_filter(array_merge($background_options, $widget_options, $text_options, $icon_options, $cta_options, $mq_options));
        }

}
