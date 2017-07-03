<?php

/**
 * Description of byobagn_original_font_spacing_calculation
 *
 * @author Rick
 */
class byobagn_original_font_spacing_calculation {

        public $deign = array();

        public function __construct($design) {
                $this->design = $design;
        }

        public function generate_vars() {
                global $thesis;
                $px['c_full'] = 980;
                $px['c_half'] = 486;
                $px['c_two_thirds'] = 640;
                $px['c_one_third'] = 320;
                $px['c_three_quarters'] = 748;
                $px['c_one_quarter'] = 232;

                $vars['font'] = $thesis->api->fonts->family($font = !empty($this->design['font']['family']) ? $this->design['font']['family'] : 'georgia');


                // Font Size for Content area columns
                $s['full'] = !empty($this->design['font']['size']) ? $this->design['font']['size'] + 1 : 17;
                $s['half'] = $s['two_thirds'] = $s['three_quarters'] = !empty($this->design['font']['size']) ? $this->design['font']['size'] : 16;
                // Determine typographical scale based on primary font size
                $f['full'] = $thesis->api->typography->scale($s['full']);
                $f['half'] = $f['two_thirds'] = $f['three_quarters'] = $thesis->api->typography->scale($s['half']);

                // Line Height
                $h['full'] = $thesis->api->typography->height($s['full'], $px['c_full'], $font, 112);
                $h['half'] = $thesis->api->typography->height($s['half'], $px['c_half'], $font, 56);
                $h['two_thirds'] = $thesis->api->typography->height($s['two_thirds'], $px['c_two_thirds'], $font);
                $h['three_quarters'] = $thesis->api->typography->height($s['three_quarters'], $px['c_three_quarters'], $font, 84);
                //Spacing
                $x['full'] = $thesis->api->typography->space($h['full']);
                $x['half'] = $thesis->api->typography->space($h['half']);
                $x['two_thirds'] = $thesis->api->typography->space($h['two_thirds']);
                $x['three_quarters'] = $thesis->api->typography->space($h['three_quarters']);
                $x['fixed'] = $thesis->api->typography->space(!empty($this->design['typical_padding']['typical_padding']) ? $this->design['typical_padding']['typical_padding'] : 26 );

                // Determine sidebar font, size, typographical scale, and spacing
                $sidebar_font = !empty($this->design['sidebar']['font']) ? $this->design['sidebar']['font'] : $font;
                $s['third'] = $s['quarter'] = !empty($this->design['sidebar']['font-size']) && is_numeric($this->design['sidebar']['font-size']) ?
                        $this->design['sidebar']['font-size'] : $s['half'];
                $f['third'] = $f['quarter'] = $thesis->api->typography->scale($s['third']);
                // Line Height
                $h['third'] = $thesis->api->typography->height($s['third'], $px['c_one_third'], $sidebar_font, 38);
                $h['quarter'] = $thesis->api->typography->height($s['quarter'], $px['c_one_quarter'], $sidebar_font, 30);
                //Spacing
                $x['third'] = $thesis->api->typography->space($h['third']);
                $x['quarter'] = $thesis->api->typography->space($h['quarter']);

                // Set up an array containing numerical values that require a unit for CSS output
                $px['f_primary_100'] = $f['full']['text'];
                $px['f_primary_67'] = $f['two_thirds']['text'];
                $px['f_primary_33'] = $f['third']['text'];

                $px['f_secondary_100'] = $f['full']['aux'];
                $px['f_secondary_67'] = $f['two_thirds']['aux'];

                $px['f_headline_100'] = $f['two_thirds']['headline'] + 2;
                $px['f_headline_67'] = $f['two_thirds']['headline'];

                $px['f_subhead_100'] = $f['full']['subhead'];
                $px['f_subhead_67'] = $f['two_thirds']['subhead'];

                $px['f_subsubhead_100'] = $f['full']['subhead'] - 2;
                $px['f_subsubhead_67'] = $f['two_thirds']['subhead'] - 2;

                $px['h_primary_100'] = round($h['full'], 0);
                $px['h_primary_50'] = round($h['half'], 0);
                $px['h_primary_67'] = round($h['two_thirds'], 0);
                $px['h_primary_75'] = round($h['three_quarters'], 0);
                $px['h_primary_33'] = round($h['third'], 0);
                $px['h_primary_25'] = round($h['quarter'], 0);

                $px['h_secondary_100'] = round($thesis->api->typography->height($f['full']['aux'], $px['c_full'], $font), 0);
                $px['h_secondary_50'] = round($thesis->api->typography->height($f['half']['aux'], $px['c_half'], $font), 0);
                $px['h_secondary_67'] = round($thesis->api->typography->height($f['two_thirds']['aux'], $px['c_two_thirds'], $font), 0);
                $px['h_secondary_75'] = round($thesis->api->typography->height($f['three_quarters']['aux'], $px['c_three_quarters'], $font), 0);
                $px['page_width'] = 980 + ((!empty($this->design['typical_padding']['typical_padding']) ? $this->design['typical_padding']['typical_padding'] : 26) * 2 );

                foreach ($x['full'] as $dim => $value)
                        $px["x_100_$dim"] = $value;

                foreach ($x['half'] as $dim => $value)
                        $px["x_50_$dim"] = $value;

                foreach ($x['two_thirds'] as $dim => $value)
                        $px["x_67_$dim"] = $value;

                foreach ($x['three_quarters'] as $dim => $value)
                        $px["x_75_$dim"] = $value;

                foreach ($x['third'] as $dim => $value)
                        $px["x_33_$dim"] = $value;

                foreach ($x['quarter'] as $dim => $value)
                        $px["x_25_$dim"] = $value;

                foreach ($x['fixed'] as $dim => $value)
                        $px["x_padding_$dim"] = $value;

                // Add the 'px' unit to the $px array constructed above
                $vars = is_array($px) ? array_merge($vars, $thesis->api->css->unit($px)) : $vars;
                // Use the Colors API to set up proper CSS color references
                foreach (array('c_primary', 'c_secondary', 'c_links', 'c_link_hover', 'c_bg_dark', 'c_bg_med', 'c_bg_light', 'c_bg_input', 'c_bg_site') as $color) {
                        $vars[$color] = !empty($this->design[$color]) ? $thesis->api->colors->css($this->design[$color]) : false;
                }

                // Set up a modification array for individual typograhical overrides
                $elements = array(
                        'title' => array(
                                'font-family' => false,
                                'font-size' => $f['full']['title'],
                                'color' => !empty($vars['c_links']) ? $vars['c_links'] : false),
                        'tagline' => array(
                                'font-family' => false,
                                'font-size' => $f['full']['text'],
                                'color' => !empty($vars['c_secondary']) ? $vars['c_secondary'] : false),
                        'headline_100' => array(
                                'font-size' => !empty($this->design['headline']['font-size']) ? $this->design['headline']['font-size'] + 2 : $f['full']['headline']),
                        'headline' => array(
                                'font-family' => false,
                                'font-size' => $f['two_thirds']['headline'],
                                'color' => !empty($vars['c_primary']) ? $vars['c_primary'] : false),
                        'subhead_100' => array(
                                'font-size' => !empty($this->design['subhead']['font-size']) ? $this->design['subhead']['font-size'] + 2 : $f['full']['subhead']),
                        'subhead' => array(
                                'font-family' => false,
                                'font-size' => $f['two_thirds']['subhead'],
                                'color' => !empty($vars['c_primary']) ? $vars['c_primary'] : false),
                        'subsubhead_100' => array(
                                'font-size' => !empty($this->design['subsubhead']['font-size']) ? $this->design['subsubhead']['font-size'] + 2 : $f['full']['subhead']),
                        'subsubhead' => array(
                                'font-family' => false,
                                'font-size' => $f['two_thirds']['subhead'] - 2,
                                'color' => false),
                        'blockquote' => array(
                                'font-family' => false,
                                'font-size' => false,
                                'color' => !empty($vars['c_secondary']) ? $vars['c_secondary'] : false),
                        'code' => array(
                                'font-family' => 'consolas',
                                'font-size' => false,
                                'color' => false),
                        'pre' => array(
                                'font-family' => 'consolas',
                                'font-size' => false,
                                'color' => false),
                        'secondary_font_100' => array(
                                'font-size' => !empty($this->design['secondary_font']['font-size']) ? $this->design['secondary_font']['font-size'] + 2 : $f['full']['aux']),
                        'secondary_font' => array(
                                'font-family' => false,
                                'font-size' => $f['two_thirds']['aux'],
                                'color' => false),
                        'sidebar' => array(
                                'font-family' => false,
                                'font-size' => $f['third']['text'],
                                'color' => false,
                                'line-height' => false),
                        'sidebar_heading' => array(
                                'font-family' => false,
                                'font-size' => $f['third']['headline'],
                                'color' => false,
                                'line-height' => false));


                // Loop through the modification array to see if any fonts, sizes, or colors need to be overridden

                foreach ($elements as $name => $element) {
                        foreach ($element as $p => $def) {
                                switch ($p) {
                                        case 'font-family':
                                                $e[$name][$p] = !empty($this->design[$name][$p]) ?
                                                        "$p: " . $thesis->api->fonts->family($family[$name] = $this->design[$name][$p]) . ';' : (!empty($def) ?
                                                                "$p: " . $thesis->api->fonts->family($family[$name] = $def) . ';' : false);
                                                break;
                                        case 'font-size':
                                                $e[$name][$p] = !empty($this->design[$name][$p]) && is_numeric($this->design[$name][$p]) ?
                                                        "$p: " . ($size[$name] = $this->design[$name][$p]) . "px;" : (!empty($def) ?
                                                                "$p: " . ($size[$name] = $def) . "px;" : false);
                                                break;
                                        case 'color':
                                                $e[$name][$p] = !empty($this->design[$name][$p]) ?
                                                        "$p: " . $thesis->api->colors->css($this->design[$name][$p]) . ';' : (!empty($def) ?
                                                                "$p: $def;" : false);
                                                break;
                                        default:
                                                $e[$name][$p] = false;
                                }
                        }
//                        print_r($e);
                        $e[$name] = array_filter($e[$name]);
                }

                foreach (array_filter($e) as $name => $element) {
                        $vars[$name] = implode("\n\t", $element);
                }

                // Override content elements
                foreach (array('headline', 'subhead', 'subsubhead', 'secondary_font', 'blockquote', 'pre') as $name) {
                        if (!empty($size[$name])) {
                                $vars[$name] .= "\n\tline-height: " . ($line[$name] = round($thesis->api->typography->height($size[$name], 640, !empty($family[$name]) ? $family[$name] : $font), 0)) . "px;";
                        }
                }

                foreach (array('headline_100', 'subhead_100', 'subsubhead_100', 'secondary_font_100', 'title', 'tagline') as $name) {
                        if (!empty($size[$name])) {
                                $vars[$name] .= "\n\tline-height: " . ($line[$name] = round($thesis->api->typography->height($size[$name], 980, !empty($family[$name]) ? $family[$name] : $font, 112), 0)) . "px;";
                        }
                }

                // Override sidebar elements
                foreach (array('sidebar', 'sidebar_heading') as $name) {
                        $line_height = false;
                        if (!empty($size[$name]) && empty($this->design[$name]['line-height'])) { // if a font size is set but the line height isn't -> then calculate line height
                                $line_height = "\n\tline-height: " . round($thesis->api->typography->height($size[$name], 320, !empty($family[$name]) ? $family[$name] : $sidebar_font), 0) . "px;";
                        } elseif (!empty($this->design[$name]['line-height'])) { // if the the line height is set then use that setting
                                $line_height = "\n\tline-height: " . $this->design[$name]['line-height'] . "px;";
                        }

                        if ($line_height) {
                                $vars[$name] .= $line_height;
                        }
                }

                // Override font style elements
                foreach (array('secondary_font') as $name) {
                        if (!empty($this->design[$name]['font-style']))
                                $vars[$name] .= "\n\tfont-style: " . $this->design[$name]['font-style'] . ";";
                }

                // Add media queries
                foreach (array('mq_tablet_lanscape', 'mq_tablet_portrait', 'mq_phone_lanscape', 'mq_phone_portrait') as $name) {
                        if (!empty($this->design[$name]['code'])) {
                                $vars[$name] = $this->design[$name]['code'];
                        } else {
                                $vars[$name] = '';
                        }
                }
                return $vars;
        }

}
