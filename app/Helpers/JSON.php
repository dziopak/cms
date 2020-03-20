<?php
    namespace App\Helpers;

    class JSON {
        public function jsonToArray($file) {
            $jsonString = file_get_contents(base_path('resources/data/'.$file.'.json'));
            return $data = json_decode($jsonString, true);
        }
    }