<?php
/*
Based on phpColor, a class by Arlo Carreon
Copyright © 2012 Arlo Carreon, http://arlocarreon.com
*/

/**
 * A color utility that helps manipulate HEX colors
 */
class QPColor
{
    private $_hex;
    private $_hsl;

    /**
     * Auto darkens/lightens by 10% for sexily-subtle gradients.
     * Set this to FALSE to adjust automatic shade to be between given color
     * and black (for darken) or white (for lighten)
     */
    const DEFAULT_ADJUST = 10;

    /**
     * Instantiates the class with a HEX value
     * @param string $hex
     */
    public function __construct($hex = '')
    {
        if ('' != $hex) {
            $this->prepareColor($hex);
        }
    }

    // ====================
    // = Public Interface =
    // ====================

    /**
     * Prepares initial color
     * @param mixed $hex
     */
    public function prepareColor($hex)
    {
        // Strip # sign is present
        $color = str_replace('#', '', $hex);

        // Make sure it's 6 digits
        if (3 === mb_strlen($color)) {
            $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
        } elseif (6 != mb_strlen($color)) {
            throw new Exception('HEX color needs to be 6 or 3 digits long');
        }

        $this->_hsl = self::hexToHsl($color);
        $this->_hex = $color;
    }

    /**
     * Given a HEX string returns a HSL array equivalent.
     * @param  string $color
     * @return array  HSL associative array
     */
    public static function hexToHsl($color)
    {
        // Sanity check
        $color = self::_checkHex($color);

        // Convert HEX to DEC
        $R = hexdec($color[0] . $color[1]);
        $G = hexdec($color[2] . $color[3]);
        $B = hexdec($color[4] . $color[5]);

        $HSL = [];

        $var_R = ($R / 255);
        $var_G = ($G / 255);
        $var_B = ($B / 255);

        $var_Min = min($var_R, $var_G, $var_B);
        $var_Max = max($var_R, $var_G, $var_B);
        $del_Max = $var_Max - $var_Min;

        $L = ($var_Max + $var_Min) / 2;

        if (0 == $del_Max) {
            $H = 0;
            $S = 0;
        } else {
            if ($L < 0.5) {
                $S = $del_Max / ($var_Max + $var_Min);
            } else {
                $S = $del_Max / (2 - $var_Max - $var_Min);
            }

            $del_R = ((($var_Max - $var_R) / 6) + ($del_Max / 2)) / $del_Max;
            $del_G = ((($var_Max - $var_G) / 6) + ($del_Max / 2)) / $del_Max;
            $del_B = ((($var_Max - $var_B) / 6) + ($del_Max / 2)) / $del_Max;

            if ($var_R == $var_Max) {
                $H = $del_B - $del_G;
            } elseif ($var_G == $var_Max) {
                $H = (1 / 3) + $del_R - $del_B;
            } elseif ($var_B == $var_Max) {
                $H = (2 / 3) + $del_G - $del_R;
            }

            if ($H < 0) {
                $H++;
            }
            if ($H > 1) {
                $H--;
            }
        }

        $HSL['H'] = ($H * 360);
        $HSL['S'] = $S;
        $HSL['L'] = $L;

        return $HSL;
    }

    /**
     *  Given a HSL associative array returns the equivalent HEX string
     * @param  array     $hsl
     * @throws Exception "Bad HSL Array"
     * @return string    HEX string
     */
    public static function hslToHex($hsl = [])
    {
        // Make sure it's HSL
        if (empty($hsl) || !isset($hsl['H']) || !isset($hsl['S']) || !isset($hsl['L'])) {
            throw new Exception('Param was not an HSL array');
        }

        list($H, $S, $L) = [ $hsl['H'] / 360, $hsl['S'], $hsl['L'] ];

        if (0 == $S) {
            $r = $L * 255;
            $g = $L * 255;
            $b = $L * 255;
        } else {
            if ($L < 0.5) {
                $var_2 = $L * (1 + $S);
            } else {
                $var_2 = ($L + $S) - ($S * $L);
            }

            $var_1 = 2 * $L - $var_2;

            $r = round(255 * self::_huetorgb($var_1, $var_2, $H + (1 / 3)));
            $g = round(255 * self::_huetorgb($var_1, $var_2, $H));
            $b = round(255 * self::_huetorgb($var_1, $var_2, $H - (1 / 3)));
        }

        // Convert to hex
        $r = dechex($r);
        $g = dechex($g);
        $b = dechex($b);

        // Make sure we get 2 digits for decimals
        $r = (1 === mb_strlen('' . $r)) ? '0' . $r : $r;
        $g = (1 === mb_strlen('' . $g)) ? '0' . $g : $g;
        $b = (1 === mb_strlen('' . $b)) ? '0' . $b : $b;

        return $r . $g . $b;
    }

    /**
     * Given a HEX value, returns a darker color. If no desired amount provided, then the color halfway between
     * given HEX and black will be returned.
     * @param  int    $amount
     * @param mixed $hex
     * @return string Darker HEX value
     */
    public function darken($hex = '', $amount = self::DEFAULT_ADJUST)
    {
        if ('' != $hex) {
            $this->prepareColor($hex);
        }

        // Darken
        $darkerHSL = $this->_darken($this->_hsl, $amount);
        // Return as HEX
        return self::hslToHex($darkerHSL);
    }

    /**
     * Given a HEX value, returns a lighter color. If no desired amount provided, then the color halfway between
     * given HEX and white will be returned.
     * @param  int    $amount
     * @param mixed $hex
     * @return string Lighter HEX value
     */
    public function lighten($hex = '', $amount = self::DEFAULT_ADJUST)
    {
        if ('' != $hex) {
            $this->prepareColor($hex);
        }

        // Lighten
        $lighterHSL = $this->_lighten($this->_hsl, $amount);
        // Return as HEX
        return self::hslToHex($lighterHSL);
    }

    /**
     * Creates an array with two shades that can be used to make a gradient
     * @param  int   $amount Optional percentage amount you want your contrast color
     * @param mixed $hex
     * @return array An array with a 'light' and 'dark' index
     */
    public function makeGradient($hex, $amount = self::DEFAULT_ADJUST)
    {
        $this->prepareColor($hex);

        // Decide which color needs to be made
        if ($this->isLight()) {
            $lightColor = $this->_hex;
            $darkColor = $this->darken('', $amount);
        } else {
            $lightColor = $this->lighten('', $amount);
            $darkColor = $this->_hex;
        }

        // Return our gradient array
        return [ 'light' => $lightColor, 'dark' => $darkColor ];
    }

    /**
     * Returns whether or not given color is considered "light"
     * @param  string|bool $color
     * @return bool
     */
    public function isLight($color = false)
    {
        // Get our color
        $color = ($color) ? str_replace('#', '', $color) : $this->_hex;

        // Calculate straight from rbg
        $r = hexdec($color[0] . $color[1]);
        $g = hexdec($color[2] . $color[3]);
        $b = hexdec($color[4] . $color[5]);

        return (($r * 299 + $g * 587 + $b * 114) / 1000 > 130);
    }

    /**
     * Returns whether or not a given color is considered "dark"
     * @param  string|bool $color
     * @return bool
     */
    public function isDark($color = false)
    {
        // Get our color
        $color = ($color) ? $color : $this->_hex;

        // Calculate straight from rbg
        $r = hexdec($color[0] . $color[1]);
        $g = hexdec($color[2] . $color[3]);
        $b = hexdec($color[4] . $color[5]);

        return (($r * 299 + $g * 587 + $b * 114) / 1000 <= 130);
    }

    /**
     * Returns the complimentary color
     *
     * @param mixed $hex
     * @return string Complementary hex color
     */
    public function complementary($hex = '')
    {
        if ('' != $hex) {
            $this->prepareColor($hex);
        }

        // Get our HSL
        $hsl = $this->_hsl;

        // Adjust Hue 180 degrees
        $hsl['H'] += ($hsl['H'] > 180) ? -180 : 180;

        // Return the new value in HEX
        return self::hslToHex($hsl);
    }

    /**
     * Returns your colors HSL array
     * @param mixed $hex
     */
    public function getHsl($hex = '')
    {
        if ('' != $hex) {
            $this->prepareColor($hex);
        }

        return $this->_hsl;
    }

    /**
     * Returns your original color
     * @param mixed $hex
     */
    public function getHex($hex = '')
    {
        if ('' != $hex) {
            $this->prepareColor($hex);
        }

        return $this->_hex;
    }

    /**
     * Returns the cross browser CSS3 gradient
     * @param int Optional: percentage amount to light/darken the gradient
     * @param  string $prefix Optional: prefix for every lines
     * @param  string $suffix Optional: suffix for every lines
     * @param mixed $hex
     * @param mixed $amount
     * @return string CSS3 gradient for chrome, safari, firefox, opera and IE10
     */
    public function getCssGradient($hex, $amount = self::DEFAULT_ADJUST, $suffix = '', $prefix = '')
    {
        // Get the recommended gradient
        $g = $this->makeGradient($hex, $amount);

        $css = '';
        /* fallback/image non-cover color */
        $css .= "{$prefix}background-color: #" . $this->_hex . ";{$suffix}";

        /* IE Browsers */
        $css .= "{$prefix}filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#" . $g['light'] . "', endColorstr='#" . $g['dark'] . "');{$suffix}";

        /* Safari 4+, Chrome 1-9 */
        $css .= "{$prefix}background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#" . $g['light'] . '), to(#' . $g['dark'] . "));{$suffix}";

        /* Safari 5.1+, Mobile Safari, Chrome 10+ */
        $css .= "{$prefix}background-image: -webkit-linear-gradient(top, #" . $g['light'] . ', #' . $g['dark'] . ");{$suffix}";

        /* Firefox 3.6+ */
        $css .= "{$prefix}background-image: -moz-linear-gradient(top, #" . $g['light'] . ', #' . $g['dark'] . ");{$suffix}";

        /* IE 10+ */
        $css .= "{$prefix}background-image: -ms-linear-gradient(top, #" . $g['light'] . ', #' . $g['dark'] . ");{$suffix}";

        /* Opera 11.10+ */
        $css .= "{$prefix}background-image: -o-linear-gradient(top, #" . $g['light'] . ', #' . $g['dark'] . ");{$suffix}";

        // Return our CSS
        return $css;
    }

    // ===========================
    // = Private Functions Below =
    // ===========================

    /**
     * Darkens a given HSL array
     * @param  array $hsl
     * @param  int   $amount
     * @return array $hsl
     */
    private function _darken($hsl, $amount = self::DEFAULT_ADJUST)
    {
        // Check if we were provided a number
        if ($amount) {
            $hsl['L'] = ($hsl['L'] * 100) - $amount;
            $hsl['L'] = ($hsl['L'] < 0) ? 0 : $hsl['L'] / 100;
        } else {
            // We need to find out how much to darken
            $hsl['L'] = $hsl['L'] / 2;
        }

        return $hsl;
    }

    /**
     * Lightens a given HSL array
     * @param  array $hsl
     * @param  int   $amount
     * @return array $hsl
     */
    private function _lighten($hsl, $amount = self::DEFAULT_ADJUST)
    {
        // Check if we were provided a number
        if ($amount) {
            $hsl['L'] = ($hsl['L'] * 100) + $amount;
            $hsl['L'] = ($hsl['L'] > 100) ? 1 : $hsl['L'] / 100;
        } else {
            // We need to find out how much to lighten
            $hsl['L'] += (1 - $hsl['L']) / 2;
        }

        return $hsl;
    }

    /**
     * Given a Hue, returns corresponding RGB value
     * @param  type $v1
     * @param  type $v2
     * @param  type $vH
     * @return int
     */
    private static function _huetorgb($v1, $v2, $vH)
    {
        if ($vH < 0) {
            $vH += 1;
        }

        if ($vH > 1) {
            $vH -= 1;
        }

        if ((6 * $vH) < 1) {
            return ($v1 + ($v2 - $v1) * 6 * $vH);
        }

        if ((2 * $vH) < 1) {
            return $v2;
        }

        if ((3 * $vH) < 2) {
            return ($v1 + ($v2 - $v1) * ((2 / 3) - $vH) * 6);
        }

        return $v1;
    }

    /**
     * You need to check if you were given a good hex string
     * @param  string    $hex
     * @throws Exception "Bad color format"
     * @return string    Color
     */
    private static function _checkHex($hex)
    {
        // Strip # sign is present
        $color = str_replace('#', '', $hex);

        // Make sure it's 6 digits
        if (3 == mb_strlen($color)) {
            $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
        } elseif (6 != mb_strlen($color)) {
            throw new Exception('HEX color needs to be 6 or 3 digits long');
        }

        return $color;
    }

    public function hexToRGB($hex)
    {
        $hex = str_replace('#', '', $hex);
        $color = [];

        if (3 == mb_strlen($hex)) {
            $color['r'] = hexdec(mb_substr($hex, 0, 1) . $r);
            $color['g'] = hexdec(mb_substr($hex, 1, 1) . $g);
            $color['b'] = hexdec(mb_substr($hex, 2, 1) . $b);
        } elseif (6 == mb_strlen($hex)) {
            $color['r'] = hexdec(mb_substr($hex, 0, 2));
            $color['g'] = hexdec(mb_substr($hex, 2, 2));
            $color['b'] = hexdec(mb_substr($hex, 4, 2));
        }

        return implode(',', $color);
    }
}
