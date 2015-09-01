<?php
/**
 * Created by PhpStorm.
 * User: pauk
 * Date: 31.08.15
 * Time: 19:47
 */

namespace helpers;


class Url {

    public static function to($url)
    {
        if (is_array($url)) {
            return static::toRoute($url);
        } else {
            return $url;
        }
    }

    public static function toRoute($url)
    {

        $route = $url[0];
        unset($url[0]);
        $url['r'] = $route;


        return '?' . http_build_query($url);
    }
}