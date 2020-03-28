<?php

/**
 * Returns position of a certain key within an array
 *
 * @param string $key
 * Key for which position you're looking for
 *
 * @param array $array
 * Searched array
 *
 * @return integer position of key in array
 *
**/
if (!function_exists('array_key_position')) {
    function array_key_position($key, $array) {
        return $i = array_search($key, array_keys($array));
    }
}


/**
 * Push array elements after certain key
 *
 * @param string $key
 * Key after which you want to push your data
 *
 * @param array $data
 * Data to push
 *
 * @param array $array
 * Target array
 *
 * @return array complete array
 *
**/
if (!function_exists('array_push_after')) {
    function array_push_after($key, $data, $array) {
        $position = array_key_position($key, $array) + 1;
        $res = array_slice($array, 0, $position, true) + $data + array_slice($array, $position, count($array), true);

        return $res;
    }
}