<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PluginDownloadController extends Controller
{
    public function download(Request $request)
    {
        $url = "https://dziopak.com/dcms/modules/test.zip";
        $zip_file = base_path() . "/resources/downloads/test.zip";

        $zip_resource = fopen($zip_file, "w");

        $ch_start = curl_init();
        curl_setopt($ch_start, CURLOPT_URL, $url);
        curl_setopt($ch_start, CURLOPT_FAILONERROR, true);
        curl_setopt($ch_start, CURLOPT_HEADER, 0);
        curl_setopt($ch_start, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch_start, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch_start, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch_start, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch_start, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch_start, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch_start, CURLOPT_FILE, $zip_resource);
        $page = curl_exec($ch_start);
        if (!$page) {
            echo "Error :- " . curl_error($ch_start);
        }
        curl_close($ch_start);

        $zip = new \ZipArchive;
        $extractPath = base_path() . '/Modules';
        if ($zip->open($zip_file) != "true") {
            echo "Error :- Unable to open the Zip File";
        }

        $zip->extractTo($extractPath);
        $zip->close();
    }
}
