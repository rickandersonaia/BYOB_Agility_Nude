<?php

/**
 * This takes an array of parent box ids and a template and gets all of the boxes
 * That are children in a flatened array of box ids
 *
 * @author ander
 */
class byobagn_flatten_box_list {

        public function flatten_list($key_list, $template) {
                // get a flattened list of default header boxes
                $box_list = array();
                foreach ($key_list as $box_name) {
                        $box_list[] = $box_name;
                        foreach ($template['boxes'][$box_name] as $columns) {
                                // $box_list will be a flattened array of dboxes
                                $box_list[] = $columns;
                                foreach ($template['boxes'][$columns] as $content) {
                                        $box_list[] = $content;
                                        if (is_array($template['boxes'][$content])) {
                                                foreach ($template['boxes'][$content] as $box1) {
                                                        $box_list[] = $box1;
                                                        if (is_array($template['boxes'][$box1])) {
                                                                foreach ($template['boxes'][$box1] as $box2) {
                                                                        $box_list[] = $box2;
                                                                        if (is_array($template['boxes'][$box2])) {
                                                                                foreach ($template['boxes'][$box2] as $box3) {
                                                                                        $box_list[] = $box3;
                                                                                        if (is_array($template['boxes'][$box3])) {
                                                                                                foreach ($template['boxes'][$box3] as $box4) {
                                                                                                        $box_list[] = $box4;
                                                                                                        if (is_array($template['boxes'][$box4])) {
                                                                                                                foreach ($template['boxes'][$box4] as $box5) {
                                                                                                                        $box_list[] = $box5;
                                                                                                                        if (is_array($template['boxes'][$box5])) {
                                                                                                                                foreach ($template['boxes'][$box5] as $box6) {
                                                                                                                                        $box_list[] = $box6;
                                                                                                                                        if (is_array($template['boxes'][$box6])) {
                                                                                                                                                foreach ($template['boxes'][$box6] as $box7) {
                                                                                                                                                        $box_list[] = $box7;
                                                                                                                                                }
                                                                                                                                        }
                                                                                                                                }
                                                                                                                        }
                                                                                                                }
                                                                                                        }
                                                                                                }
                                                                                        }
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                }
                                        }
                                }
                        }
                }
                return $box_list;
        }

}
