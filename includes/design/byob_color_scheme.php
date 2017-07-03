<?php

/**
 * Description of byob_color_scheme
 *
 * @author Chris Pearson (DIY Themes)/Rick Anderson
 * Version 1.1 - 6/16/2015
 */
class byob_color_scheme {

        public function lightness($color, $percentage, $mode = 'absolute', $darker = false) {
                // $color can be hex or RGB input
                // potential modes: absolute, relative, spread; relative and spread use the darker parameter
                global $thesis;
                if (empty($color) || (!is_numeric($percentage) || abs($percentage) > 100))
                        return;
                $hsl = $this->hsl($color);
                if ($mode == 'absolute')
                        $l = $percentage;
                elseif ($mode == 'relative') {
                        $l = $darker ? $hsl['l'] - $percentage : $hsl['l'] + $percentage;
                        $l = $l > 100 ? 100 : ($l < 0 ? 0 : $l);
                } elseif ($mode == 'spread') {
                        $pct = abs($percentage) > 1 ? (abs($percentage) / 100) : abs($percentage);
                        $spread = $darker ? $hsl['l'] : 100 - $hsl['l'];
                        $l = $darker ? $hsl['l'] - $spread * $pct : $hsl['l'] + $spread * $pct;
                }
                return $thesis->api->colors->hex($this->hsl_to_rgb(array('h' => $hsl['h'], 's' => $hsl['s'], 'l' => $l)));
        }

        public function wheel($color, $h = 180, $s = 0, $l = 0, $smax = 100, $smin = 0, $lmax = 100, $lmin = 0) {
                global $thesis;
                if ($color) {
                        $hsl = $this->hsl($color);
                        $adjusted_color = $this->hsl_complement($hsl, $h, $s, $l, $smax, $smin, $lmax, $lmin);
                        $rgb = $this->hsl_to_rgb($adjusted_color);
                        $hex = $thesis->api->colors->hex($rgb);
                        return $hex;
                }
        }

        public function hsl($color) { // hex or RGB input
                global $thesis;
                if (empty($color))
                        return false;
                if (!is_array($color) && (strlen($color) == 6 || strlen($color) == 3)) {
                        $color = $thesis->api->colors->rgb($color);
                } elseif (!is_array($color)) {
                        // this fixes the error thrown by values that are outside of the range
                        $color = array();
                        $color['r'] = 00;
                        $color['g'] = 00;
                        $color['b'] = 00;
                }

                $rgb = array(
                        'r' => $color['r'] / 255,
                        'g' => $color['g'] / 255,
                        'b' => $color['b'] / 255);
                $l = (($max = max($rgb['r'], $rgb['g'], $rgb['b'])) + ($min = min($rgb['r'], $rgb['g'], $rgb['b']))) / 2;
                $chroma = $max - $min;
                if ($chroma == 0)
                        return array('h' => 0, 's' => 0, 'l' => 100 * $l);
                $s = $chroma / (1 - abs(2 * $l - 1));
                $h = 60 * ($min == $rgb['r'] ?
                                3 - (($rgb['g'] - $rgb['b']) / $chroma) : ($min == $rgb['g'] ?
                                        5 - (($rgb['b'] - $rgb['r']) / $chroma) :
                                        1 - (($rgb['r'] - $rgb['g']) / $chroma)));
                return array('h' => round($h, 2), 's' => round(100 * $s, 2), 'l' => round(100 * $l, 2));
        }

        public function hsl_to_rgb($hsl) {
                if (empty($hsl) || !is_array($hsl))
                        return;
                $h = $hsl['h'];
                $s = $hsl['s'] / 100;
                $l = $hsl['l'] / 100;
                $chroma = $s * (1 - abs(2 * $l - 1));
                $x = $chroma * (1 - abs(fmod($h / 60, 2) - 1));
                $rgb = $h < 60 ?
                        array('r' => $chroma, 'g' => $x, 'b' => 0) : ($h < 120 ?
                                array('r' => $x, 'g' => $chroma, 'b' => 0) : ($h < 180 ?
                                        array('r' => 0, 'g' => $chroma, 'b' => $x) : ($h < 240 ?
                                                array('r' => 0, 'g' => $x, 'b' => $chroma) : ($h < 300 ?
                                                        array('r' => $x, 'g' => 0, 'b' => $chroma) :
                                                        array('r' => $chroma, 'g' => 0, 'b' => $x)))));
                $m = $l - ($chroma / 2);
                return array(
                        'r' => round(255 * ($rgb['r'] + $m)),
                        'g' => round(255 * ($rgb['g'] + $m)),
                        'b' => round(255 * ($rgb['b'] + $m)));
        }

        public function hsl_complement($hsl, $h = 180, $s = 0, $l = 0, $smax = 100, $smin = 0, $lmax = 100, $lmin = 0) {
                if (!is_array($hsl))
                        return false;
                $smax = $smax > 100 ? 100 : ($smax < 0 ? 0 : $smax);
                $smin = $smin < 0 ? 0 : ($smin > 100 ? 100 : $smin);
                $lmax = $lmax > 100 ? 100 : ($lmax < 0 ? 0 : $lmax);
                $lmin = $lmin < 0 ? 0 : ($lmin > 100 ? 100 : $lmin);
                return array(
                        'h' => ($hx = $hsl['h'] + $h) > 360 || $hx < 0 ? $hsl['h'] - $h : $hx,
                        's' => ($sx = $hsl['s'] + $s) > $smax ? $smax : ($sx < $smin ? $smin : $sx),
                        'l' => ($lx = $hsl['l'] + $l) > $lmax ? $lmax : ($lx < $lmin ? $lmin : $lx));
        }

        public function hex2rgba($color, $opacity = false) {

                $default = 'rgb(0,0,0)';

                //Return default if no color provided
                if (empty($color))
                        return $default;

                //Sanitize $color if "#" is provided
                if ($color[0] == '#') {
                        $color = substr($color, 1);
                }

                //Check if color has 6 or 3 characters and get values
                if (strlen($color) == 6) {
                        $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
                } elseif (strlen($color) == 3) {
                        $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
                } else {
                        return $default;
                }

                //Convert hexadec to rgb
                $rgb = array_map('hexdec', $hex);

                //Check if opacity is set(rgba or rgb)
                if ($opacity) {
                        if (abs($opacity) > 1)
                                $opacity = 1.0;
                        $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
                } else {
                        $output = 'rgb(' . implode(",", $rgb) . ')';
                }

                //Return rgb(a) color string
                return $output;
        }

}
