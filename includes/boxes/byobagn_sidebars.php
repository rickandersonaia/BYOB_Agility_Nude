<?php

/**
 * Description of byobagn_sidebars
 *
 * @author Rick
 */
class byobagn_sidebars {

        //put your code here
        public function standard($args = array()) {
                extract($args); // $widget_name, $id, $widget_description
                $sidebars = $GLOBALS['wp_registered_sidebars'];
                if (!in_array($widget_name, $sidebars)) {
                        register_sidebar(array(
                                'name' => $widget_name,
                                'id' => $id,
                                'description' => $widget_description,
                                'before_widget' => '<div class="widget %2$s" id="%1$s">',
                                'after_widget' => '</div>',
                                'before_title' => '<h4 class="widget_title">',
                                'after_title' => '</h4>'));
                }
        }

}
