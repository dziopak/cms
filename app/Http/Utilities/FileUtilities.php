<?php

namespace App\Http\Utilities;

use App\File;

class FileUtilities
{
    public static function upload($request)
    {
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

                return response()->json($file->id, 200);
            } else {
                return response()->json("Incorrect format", 500);
            }
        }
    }
}
