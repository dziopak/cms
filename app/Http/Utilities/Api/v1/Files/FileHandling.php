<?php

namespace App\Http\Utilities\Api\Files;

use App\Entities\File;

class FileHandling
{

    static function fromBlob($blob)
    {
        $imagesPath = 'images/';
        $destinationPath = 'uploads/';
        $path = $imagesPath . $destinationPath;

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $fileName = time() . '_' . randomString() . '.png';

        $image = file_get_contents($blob);
        file_put_contents($path . $fileName, $image);

        $file = File::create(['path' => $destinationPath . $fileName, 'type' => 1]);
        return $file->id ?? false;
    }


    static function uploadBlob($request)
    {
        $image = $request->file('data');

        $imagesPath = 'images/';
        $destinationPath = 'uploads/';

        $path = $imagesPath . $destinationPath;

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $fileName = $request->get('fname') ?? time() . '_' . randomString() . '.png';


        $image = file_get_contents($image);
        file_put_contents($path . $fileName, $image);

        if (empty($request->get('fname'))) {
            $file = File::create(['path' => $destinationPath . $fileName, 'type' => 1]);
            return response()->json(['message' => 'Successfully uploaded the file.', 'id' => $file->id]);
        }

        return response()->json(['message' => 'Override successfull.']);
    }


    static function upload($request, $web = false)
    {

        if (!empty($request->get('type')) && $request->get('type')) {
            return self::uploadBlob($request);
        }


        if ($request->hasFile('file')) {
            $imagesPath = 'images/';
            $destinationPath = 'uploads/';

            $path = $imagesPath . $destinationPath;

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $extension = $request->file('file')->getClientOriginalExtension();
            $validextensions = array("jpeg", "jpg", "png", "pdf");

            if (in_array(strtolower($extension), $validextensions)) {
                $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
                $request->file('file')->move($path, $fileName);
                $file = File::create(['path' => $destinationPath . $fileName, 'type' => 1]);

                if ($web === true) {
                    return $file->id;
                }

                return response()->json($file->id, 200);
            } else {
                return response()->json("Incorrect format", 500);
            }
        }

        File::flushQueryCache();
    }
}
