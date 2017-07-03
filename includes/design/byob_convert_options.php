<?php

/**
 * Description of byob_convert_options
 *
 * @author ander
 */
class byob_convert_options {

        public $design = array();

        public function convert_old_design_mode_values($pre_save_options) {
                // this function only runs one time.  It converts the block class options created by the
                // design mode fix into skin design options
                // once done it deletes the old options and sets a new option noting that
                // the conversion is completed
                $this->design = $pre_save_options;
                $backgrounds = get_option("byobagn_background_design", array());
                $widgets = get_option("byobagn_widget_design", array());
                $text_areas = get_option("byobagn_text_area_design", array());
                $icons = get_option("byobagn_icon_design", array());
                $ctas = get_option("byobagn_cta_design", array());
                $mqs = get_option("byobagn_media_query_design", array());

                foreach (array($backgrounds, $widgets, $text_areas, $icons, $ctas, $mqs) as $area) {
                        if (!empty($area)) {
                                foreach ($area as $option => $value) {
                                        $this->design[$option] = $value;
                                }
                        }
                }

                // set the converted switch
                update_option('byobagn_design_converted', true);

                return $this->design;
        }

        public function delete_options() {
                delete_option("byobagn_background_design");
                delete_option("byobagn_widget_design");
                delete_option("byobagn_text_area_design");
                delete_option("byobagn_icon_design");
                delete_option("byobagn_cta_design");
                delete_option("byobagn_media_query_design");
                delete_option("byobagn_design_mode");
        }

}
