<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json(
            [
                'status' => 'success',
                'posts' => $posts->toArray()
            ],
            200
        );
    }
    public function show(Request $request, $id)
    {
        $post = Post::find($id);
        return response()->json(
            [
                'status' => 'success',
                'post' => $post->toArray()
            ],
            200
        );
    }
}
