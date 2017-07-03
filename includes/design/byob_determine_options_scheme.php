<?php

/**
 * Determines which of 3 schemes to use
 * new - There are no old design options - this condition exists if it is a new install
 * or if the conversion process has taken place and the old design options have been deleted
 * old - This condition exists if there are old design options and the converted switch
 * hasn't been set
 * converted - This condition exists if there are old design options that have been already converted
 *
 * @author ander
 */
class byob_determine_options_scheme {

        public $scheme = '';

        public function determine_current_options_scheme() {
                $this->scheme = 'new';
                $convert_switch = get_option('byobagn_design_converted');
                $backgrounds = get_option("byobagn_background_design", array());
                $widgets = get_option("byobagn_widget_design", array());
                $text_areas = get_option("byobagn_text_area_design", array());
                $icons = get_option("byobagn_icon_design", array());
                $ctas = get_option("byobagn_cta_design", array());
                $mqs = get_option("byobagn_media_query_design", array());

                if (!empty($backgrounds) || !empty($widgets) || !empty($widgets) || !empty($widgets) || !empty($widgets) || !empty($widgets)) {
                        if (empty($convert_switch)) {
                                $this->scheme = 'old';
                        } else {
                                $this->scheme = 'converted';
                        }
                }
                return $this->scheme;
        }

}
