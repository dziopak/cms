<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Events\Posts\PostCategoryCreateEvent;
use App\Events\Posts\PostCategoryUpdateEvent;
use App\Events\Posts\PostCategoryDestroyEvent;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\PostResource;

use App\Post;
use App\User;
use App\PostCategory;
use JWTAuth;

class PostCategoriesController extends Controller
{
    
    
    public function index(Request $request)
    {
        return CategoryCollection::collection(PostCategory::orderByDesc('created_at')->paginate(15));
    }

    public function posts($id) {
        $category = CategoryCollection::collection(PostCategory::findOrFail($id));
        return ['data' => $category, 'status' => '200'];
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'excerpt' => 'required|string|max:255',
    //         'slug' => 'required|string|max:255|unique:posts',
    //         'content' => 'required|string'
    //     ]);

    //     if($validator->fails()){
    //         return response()->json(["status" => "400", "message" => "There were errors during the validation.", "errors" => $validator->errors()], 400);
    //     } else {
    //         $user = User::jwtUser();
    //         $user = User::findOrFail($user->id);
    //         if ($user->hasAccess('POST_CREATE') === true) {
    //             $data = $request->all();
    //             $data['user_id'] = $user->id;
    //             $thumbnail = $request->file('thumbnail');

    //             $post = Post::create($data);
    //             event(new PostCreateEvent($post, $thumbnail));

    //             return response()->json(["status" => "201", "message" => "Successfully created new post.", "data" => compact('post')], 201);
    //         } else {
    //             return response()->json(["status" => "403", "message" => "You don't have permission to access this route."], 403);
    //         }
            
    //     }
    // }


    public function show($id)
    {
        $category = new CategoryResource(PostCategory::find($id));

        if ($category) {
            return $category;
        } else {
            return response()->json(["status" => "404", "message" => "Category doesn't exist."], 404);
        }
    }

    public function find(Request $request)
    {
        // TO DO //
        $category = PostCategory::where(['slug' => $request->get('slug')])->orWhere(['slug_pl' => $request->get('slug')])->first();
        // FINDING BY SLUG HOOK //

        if ($category) {
            return $category;
        } else {
            return response()->json(["status" => "404", "message" => "Category doesn't exist."], 404);
        }
    }


    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'string|max:255',
    //         'excerpt' => 'string|max:255',
    //         'slug' => 'string|max:255|unique:posts',
    //         'content' => 'string'
    //     ]);

    //     if($validator->fails()){
    //         return response()->json(["status" => "400", "message" => "There were errors during the validation", "errors" => $validator->errors()], 400);
    //     } else {
    //         $user = User::findOrFail(User::jwtUser()->id);
    //         return(User::jwtUser());
    //         if ($user->hasAccess('POST_UPDATE') === true) {
    //             $post = Post::find($id);
    //             if ($post) {
    //                 $data = $request->all();
    //                 $thumbnail = $request->file('thumbnail');
    //                 $post->update($data);
    //                 // TO DO //
    //                 // event(new PostUpdateEvent($post, $thumbnail));
    //                 return response()->json(["status" => "201", "message" => "Successfully updated new post.", "data" => compact('post')], 201);
    //             } else {
    //                 return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);    
    //             }
    //         } else {
    //             return response()->json(["status" => "403", "message" => "You don't have permission to access this route."], 403);
    //         }
            
    //     }
    // }


    // public function destroy($id)
    // {
    //     $user = User::find(User::jwtUser()->id);
    //     if ($user && $user->hasAccess('POST_DELETE') === true) {
    //         $post = Post::find($id);
    //         if ($post) {
    //             $post->delete();
    //             event(new PostDestroyEvent($post));
    //             return response()->json(["status" => "200", "message" => "Post has been successfully deleted.", "data" => compact('post')], 200);
    //         } else {
    //             return response()->json(["status" => "404", "message" => "Post doesn't exist."], 404);
    //         }
    //     } else {
    //         return response()->json(["status" => "403", "message" => "You don't have permission to access this route."], 403);
    //     }
    // }
}
