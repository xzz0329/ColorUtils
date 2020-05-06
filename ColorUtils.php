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

}