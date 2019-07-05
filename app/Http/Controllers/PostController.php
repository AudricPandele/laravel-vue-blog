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

    public function delete(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
        }
        return response()->json(
            [
                'status' => 'success'
            ],
            200
        );
    }

    public function add(Request $request)
    {
        $post = new Post;
        $post->name = $request->name;
        $post->text = $request->text;
        $post->save();

        return response()->json(
            [
                'status' => 'success',
                'post' => $post->toArray()
            ],
            200
        );
    }
}
