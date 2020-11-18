<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Helpers\ThemeHelpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class AssetController extends Controller
{
    public function __invoke($type, $filename)
    {
        $path = base_path() . '/resources/themes/' . ThemeHelpers::activeTheme() . '/assets/' . $type . "/" . $filename;
        $file = File::get($path);

        switch ($type) {
            case "css":
                $type = "text/css";
                break;

            default:
                $type = File::mimeType($path);
                break;
        }

        ob_end_clean();
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }
}
