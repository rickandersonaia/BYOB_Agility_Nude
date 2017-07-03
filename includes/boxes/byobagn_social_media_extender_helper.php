<?php

/**
 * Description of byobagn_social_media_extender_helper
 *
 * @author Rick
 */
class byobagn_social_media_extender_helper {

        //put your code here

        public $dependents = array();
        public $children = array();
        public $options = array();
        private $tab = '';

        public function __construct($options) {
                $this->options = $options;
        }

        public function configure_dependents() {
                if (class_exists('thesis_facebook_like')) {
                        $this->dependents[] = 'thesis_facebook_like';
                };
                if (class_exists('thesis_google_plus_one')) {
                        $this->dependents[] = 'thesis_google_plus_one';
                };
                if (class_exists('thesis_tweet_button')) {
                        $this->dependents[] = 'thesis_tweet_button';
                };
                if (class_exists('thesis_linkedin_share')) {
                        $this->dependents[] = 'thesis_linkedin_share';
                };
                if (class_exists('thesis_pinterest_pin_it')) {
                        $this->dependents[] = 'thesis_pinterest_pin_it';
                };
                return $this->dependents;
        }

        public function configure_children() {
                if (class_exists('thesis_facebook_like')) {
                        $this->children[] = 'thesis_facebook_like';
                };
                if (class_exists('thesis_google_plus_one')) {
                        $this->children[] = 'thesis_google_plus_one';
                };
                if (class_exists('thesis_tweet_button')) {
                        $this->children[] = 'thesis_tweet_button';
                };
                return $this->children;
        }

        public function html_open($args = false) {
//                var_dump($this->options);
                global $thesis;
                extract($args = is_array($args) ? $args : array());
                $depth = isset($depth) ? $depth : 0;
                $this->tab = $tab = str_repeat("\t", $depth);

                $classout = new byobagn_config_classes($this->options, 'class');
                $class = $classout->given('social_wrapper', false);

                $this->hook = $hook = trim(esc_attr($this->options['_id']));
                if (!empty($this->options['hook'])) {
                        $hook = trim(esc_attr($this->options['hook']));
                }

                do_action("hook_before_$hook");

                echo "$tab<div$class>\n";

                do_action("hook_top_$hook");
        }

        public function html_close() {

                do_action("hook_bottom_$this->hook");

                echo "$this->tab</div>\n";
                do_action("hook_after_$this->hook");
        }

}
