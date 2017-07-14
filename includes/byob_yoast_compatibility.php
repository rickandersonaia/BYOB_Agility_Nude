<?php

/**
 * Description of byob_yoast_compatibility
 *
 * @author Rick
 */
class byob_yoast_compatibility {
    //1.remove html boxes
    //2.switch to wp title tag
    //2.remove meta boxes
    //3.set yoast options
    public $post_types;
    
    public function __construct(){
            global $thesis;
            add_filter('thesis_boxes', array($this, 'remove_thesis_meta_boxes'));
            add_filter('thesis_title_tag', array($this, 'use_wp_title'));
		    $filtered_post_types = new byob_get_post_types();
		    $this->post_types = $filtered_post_types->post_types();
            add_action('admin_init', array($this, 'remove_thesis_seo_boxes'));
        
    }
    
    public function remove_thesis_meta_boxes($boxes){
            
            foreach ($boxes as $box => $value){
                    switch ($value){
                            
                            case 'thesis_meta_description';
                                unset($boxes[$box]);
                                break;
                            case 'thesis_meta_keywords';
                                unset($boxes[$box]);
                                break;
                            case 'thesis_meta_robots';
                                unset($boxes[$box]);
                                break;
                    }
            }
//            var_dump($boxes);
            return $boxes;
    }
    
    public function use_wp_title($title) {
            $title = apply_filters('wp_title', $title, '', '');
            return $title;
    }
    
    public function remove_thesis_seo_boxes() {
            $array = array(
                    'thesis_title_tag',
                    'thesis_canonical_link', 
                    'thesis_meta_keywords',
                    'thesis_meta_description', 
                    'thesis_meta_robots'
                    );

            foreach ($array as $box) {
                    foreach($this->post_types as $type){
                        remove_meta_box($box, $type,'normal');
                    }
            }
    }


}
