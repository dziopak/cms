<?php

function lang($array, $key)
{
    if (empty($array[$key]) || !isLang()) return $array[$key];
    return $array[$key . '_' . getLang()] ?? $array[$key];
}
