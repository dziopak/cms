<?php

    namespace App\Http\Utilities;

    use Illuminate\Support\Facades\Validator;
    use App\Http\Utilities\AuthResponse;

    class MenuUtilities {
        static function storeValidation($request) {
            $access = AuthResponse::hasAccess('MENU_CREATE');
            if ($access !== true) return $access;
            
            $data = $request->all();

            $validationFields = [
                'name' => 'required|string|max:255',
                'items' => 'array',
            ];
            $validator = Validator::make($data, $validationFields);
            
            if($validator->fails()){
                $errors = $validator->errors();
                return ["status" => "400", "message" => "There were errors during the validation.", "errors" => $errors];
            }
            
            if (!empty($data['items'])) {
                if (!is_array($data['items'])) {
                    $errors = ["items" => ["The items field should be an array of objects"]];
                    return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $errors], 400);
                }
    
                foreach($data['items'] as $key => $item) {
                    $validationFields = [
                        'label' => 'required|string|max:255',
                        'link' => 'required|string|max:255',
                        'parent' => 'numeric',
                        'sort' => 'numeric',
                        'class' => 'string',
                        'depth' => 'numeric',
                    ];
                    $validator = Validator::make($item, $validationFields);
    
                    if($validator->fails()) {
                        !empty($item['label']) ? $label = $item['label'] : $label = $key;
                        $errors['items'][$label] = $validator->errors();
                    }
    
                }
            }

            if (!empty($errors)) return response()->json(['message' => 'There were errors during the validation.', 'errors' => $errors, 'status' => '400'], 400);
            return true;
        }
        
        static function updateValidation($request) {
            $access = AuthResponse::hasAccess('MENU_EDIT');
            if ($access !== true) return $access;
            
            $validationFields = [
                'name' => 'required|string|max:255',
                'items' => 'array',
            ];
            $validator = Validator::make($request->all(), $validationFields);
            
            if($validator->fails()){
                $errors = $validator->errors();
                return ["status" => "400", "message" => "There were errors during the validation.", "errors" => $errors];
            }

            return true;
        }

    }