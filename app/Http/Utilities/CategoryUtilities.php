<?php

    namespace App\Http\Utilities;

    use Illuminate\Support\Facades\Validator;
    use App\Http\Utilities\AuthResponse;
    use App\PostCategory;
    use App\PageCategory;

    use Hook;

    class CategoryUtilities {
        static function find($id, $type) {
            switch($type) {
                case 'post':
                    if (is_numeric($id)) {
                        $category = PostCategory::find($id);
                    } else {
                        $category = PostCategory::where(['slug' => $id]);
                        $category = Hook::get('apiPostCategoriesFindSelector',[$category, $id],function($category, $id) {
                            return $category;
                        });
                    }
                break;

                case 'page':
                    if (is_numeric($id)) {
                        $category = PageCategory::find($id);
                    } else {
                        $category = PageCategory::where(['slug' => $id]);
                        $category = Hook::get('apiPageCategoriesFindSelector',[$category, $id],function($category, $id){
                            return $category;
                        });
                    }
                break;
            }
            
            return $category->first();
        }

        static function storeValidation($request, $type) {
            $access = AuthResponse::hasAccess('CATEGORY_CREATE');
            if ($access !== true) return $access;

            $validationFields = [
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:'.$type.'_categories'
            ];
            
            if ($type === 'post') {
                $validationFields = Hook::get('apiPostCategoriesStoreValidation',[$validationFields],function($validationFields){
                    return $validationFields;
                });
            } else if ($type === 'page') {
                $validationFields = Hook::get('apiPageCategoriesStoreValidation',[$validationFields],function($validationFields){
                    return $validationFields;
                });
            }

            $validator = Validator::make($request->all(), $validationFields);
            if($validator->fails()) return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
            
            return true;
        }


        static function updateValidation($request, $type) {
            $access = AuthResponse::hasAccess('CATEGORY_EDIT');
            if ($access !== true) return $access;

            $validationFields = [
                'name' => 'string|max:255',
                'slug' => 'string|max:255|unique:'.$type.'_categories',
                'description' => 'string|max:255',
            ];

            if ($type === 'post') {
                $validationFields = Hook::get('apiPostCategoriesUpdateValidation',[$validationFields],function($validationFields){
                    return $validationFields;
                });
            } else if ($type === 'page') {
                $validationFields = Hook::get('apiPageCategoriesUpdateValidation',[$validationFields],function($validationFields){
                    return $validationFields;
                });
            }
    
            $validator = Validator::make($request->all(), $validationFields);
            if($validator->fails()) return ["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()];
        
            return true;
        }
    }



