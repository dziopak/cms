<?php

function jsonToArray($file)
{
    $jsonString = file_get_contents($file);
    return $data = json_decode($jsonString, true);
}
