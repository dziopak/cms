<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\PageResource;
use App\Http\Utilities\AuthResponse;

use App\Page;
use App\User;
use JWTAuth;
use Hook;

class PagesController extends Controller
{
    
    public function index(Request $request)
    {
        return PageResource::collection(Page::with('author', 'thumbnail', 'category')->orderBy('id')->paginate(15));
    }


    public function store(Request $request)
    {
        $validationFields = [
            'name' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages',
            'content' => 'required|string'
        ];

        $validationFields = Hook::get('apiPagesStoreValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });
        $validator = Validator::make($request->all(), $validationFields);

        if($validator->fails()){
            return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
        } else {
            $access = AuthResponse::hasAccess('PAGE_CREATE');
            if ($access !== true) return $access;

            $user = User::jwtUser();
            $user = User::find($user->id);

            $data = $request->all();
            $data['user_id'] = $user->id;

            $page = Page::create($data);

            return response()->json(["status" => "201", "message" => "Successfully created new page.", "data" => compact('page')], 201);
        }
    }


    public function show($id)
    {
        if (is_numeric($id)) {
            $page = Page::with('author', 'category', 'thumbnail')->find($id);
        } else {
            $page = Page::with('author', 'category', 'thumbnail')->where(['slug' => $id])->orWhere(['slug_pl' => $id])->first();
        }

        if ($page) {
            return new PageResource($page);
        } else {
            return response()->json(["status" => "404", "message" => "Page doesn't exist."], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validationFields = [
            'name' => 'string|max:255',
            'excerpt' => 'string|max:255',
            'slug' => 'string|max:255|unique:pages',
            'content' => 'string'
        ];
        $validationFields = Hook::get('apiPostsUpdateValidation',[$validationFields],function($validationFields){
            return $validationFields;
        });

        $validator = Validator::make($request->all(), $validationFields);

        if($validator->fails()){
            return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
        } else {
            $access = AuthResponse::hasAccess('PAGE_UPDATE');
            if (!$access === true) return $access;
            
            $page = Page::find($id);
            if ($page) {
                $data = $request->all();
                $page->update($data);
    
                return response()->json(["status" => "201", "message" => "Successfully updated new page.", "data" => compact('page')], 201);
            } else {
                return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);    
            }
        }
    }


    public function destroy($id)
    {
        $access = AuthResponse::hasAccess('PAGE_UPDATE');
        if (!$access === true) return $access;

        $page = Page::find($id);
        if ($page) {
            $page->delete();
            return response()->json(["status" => "200", "message" => "Page has been successfully deleted.", "data" => compact('page')], 200);
        } else {
            return response()->json(["status" => "404", "message" => "Resource doesn't exist."], 404);
        }
    }
}
