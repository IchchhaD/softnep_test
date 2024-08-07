<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;

class PostsController extends Controller
{
   
/*
    public function __construct(Post $posts)
    {
        $this->posts = $posts;
    }
*/
    public function getPosts()
    {
        $posts = Post::get();
        if(!empty($posts))
        {
            return response->json(['error' => false, 'message' => 'Getting Posts', 'posts' => $posts]);
        }
        return response->json(['error' => true, 'message' => 'No Posts to Show']);
    }
    public function createPosts(Request $request)
    {
        $checkDetails = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($checkDetails->fails())
        {
            $error['error'] = true; 
            $error['message'] = $login->errors();
    
            return response()->json($error);
        }
        try
        {
            $post = new Post;
            $post->title = $request->title;
            $post->description = $request->description;
            $post->created_by = Auth::user()->email;
            if($post->save())
            {
                return response->json(['error' => false, 'message' => 'Posts Created', 'posts' => $posts]);
            }
            return response->json(['error' => true, 'message' => 'Posts Not Created']);
        }
        catch(Exception $e)
        {
            return response->json(['error'=>true, 'message' => 'Something went wrong', 'error_data' => $e->errors()]);
        }
    }
    public function updatePosts(Request $request, $id)
    {
        $checkDetails = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($checkDetails->fails())
        {
            $error['error'] = true; 
            $error['message'] = $login->errors();
    
            return response()->json($error);
        }
        try
        {
            $post = Post::findOrFail($id);
            $post->title = $request->title;
            $post->description = $request->description;
            $post->created_by = Auth::user()->email;
            if($post->save())
            {
                return response->json(['error' => false, 'message' => 'Posts Updated', 'posts' => $posts]);
            }
            return response->json(['error' => true, 'message' => 'Posts Not Updated']);
        }
        catch(Exception $e)
        {
            return response->json(['error'=>true, 'message' => 'Something went wrong', 'error_data' => $e->errors()]);
        }
    }
    public function deletePosts(Request $request)
    {
        $checkId = \Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($checkId->fails())
        {
            $error['error'] = true; 
            $error['message'] = $login->errors();
    
            return response()->json($error);
        }
        try
        {
            $post = Post::findOrFail($id);
            if($post->delete())
            {
                return response->json(['error' => false, 'message' => 'Posts Deleted', 'posts' => $posts]);
            }
            return response->json(['error' => true, 'message' => 'Posts Not Updated']);
        }
        catch(Exception $e)
        {
            return response->json(['error'=>true, 'message' => 'Something went wrong', 'error_data' => $e->errors()]);
        }
    }
}
