<?php
/**
 * Created by PhpStorm.
 * User: hanqinghai
 * Date: 2020/5/6
 * Time: 4:28 PM
 */

class ColorUtils {
    /**
     * 校验16进制颜色是否合法
     *
     * @param $color
     * @param bool $isForce
     * @return bool
     */
    public static function validateHexColor($color, $isForce = false) {
        $pattern = '/^#([a-fA-F0-9]{6}';

        if (!$isForce) {
            $pattern .= '|[a-fA-F0-9]{3}';
        }

        $pattern .= ')$/';

        return (bool) preg_match($pattern, $color);
    }

    /**
     * 16进制转rgba，rgb格式
     *
     * @param $color
     * @param bool $opacity
     * @param bool $raw
     * @return array|string
     */
    public static function hex2rgba($color, $opacity = false, $raw = false) {
        $default = 'rgb(0,0,0)';
        //Return default if no color provided
        if (empty($color)) {
            return $default;
        }
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

        if ($raw) {
            if ($opacity) {
                if (abs($opacity) > 1) {
                    $opacity = 1.0;
                }
                array_push($rgb, $opacity);
            }
            $output = $rgb;
        } else {
            //Check if opacity is set(rgba or rgb)
            if ($opacity) {
                if (abs($opacity) > 1) {
                    $opacity = 1.0;
                }
                $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
            } else {
                $output = 'rgb(' . implode(",", $rgb) . ')';
            }
        }

        //Return rgb(a) color string
        return $output;
    }

}