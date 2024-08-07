<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;

class CommentsController extends Controller
{

    public function getComments(Request $request, $id)
    {
        $comments = Comment::where('id', $id)->get();
        if(!empty($comments))
        {
            return response->json(['error' => false, 'message' => 'Getting Comments for the post', 'comments' => $comments]);
        }
        return response->json(['error' => true, 'message' => 'No Comments to Show']);
    }
    public function createComments(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'post_id' => 'required',
        ]);
        try
        {
            $comment = new Comment;
            $comment->content = $request->content;
            $comment->created_by = Auth::user()->email;
            if($comment->save())
            {
                return response->json(['error' => false, 'message' => 'Comment Created', 'posts' => $comment]);
            }
            return response->json(['error' => true, 'message' => 'Comented Not Created']);
        }
        catch(Exception $e)
        {
            return response->json(['error'=>true, 'message' => 'Something went wrong', 'error_data' => $e->errors()]);
        }
    }
    public function updateComments(Request $request, $id, $post_id)
    {
        $checkId = \Validator::make($request->all(), [
            'content' => 'required',
        ]);

        if ($checkId->fails())
        {
            $error['error'] = true; 
            $error['message'] = $login->errors();
    
            return response()->json($error);
        }
        try
        {
            $comment = Post::findOrFail($id);
            $comment->content = $request->title;
            $comment->post_id = $post_id;
            $comment->created_by = Auth::user()->email;
            if($comment->save())
            {
                return response->json(['error' => false, 'message' => 'Posts Updated', 'posts' => $comment]);
            }
            return response->json(['error' => true, 'message' => 'Posts Not Updated']);
        }
        catch(Exception $e)
        {
            return response->json(['error'=>true, 'message' => 'Something went wrong', 'error_data' => $e->errors()]);
        }
    }
    public function deleteComments(Request $request)
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
