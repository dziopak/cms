<?php

use WebPConvert\WebPConvert;

require '../vendor/autoload.php';        // Make sure to point this correctly


$docRoot = rtrim($_SERVER["DOCUMENT_ROOT"], '/');
$requestUriNoQS = explode('?', $_SERVER['REQUEST_URI'])[0];
$source = $docRoot . urldecode($requestUriNoQS);
$destination = $source . '.webp';     // Store the converted images besides the original images (other options are available!)

$options = [

    // UNCOMMENT NEXT LINE, WHEN YOU ARE UP AND RUNNING!
    // 'show-report' => true             // Show a conversion report instead of serving the converted image.

    // More options available!
];
WebPConvert::serveConverted($source, $destination, $options);
