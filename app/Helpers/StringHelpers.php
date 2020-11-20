<?php

function randomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function camelCase($string)
{
    $string = str_replace('-', ' ', $string);
    $string = str_replace('_', ' ', $string);
    return str_replace(' ', '', ucwords($string));
}

function stringContains($a, $b)
{
    if (strpos($a, $b) !== false) {
        return true;
    }

    return false;
}
