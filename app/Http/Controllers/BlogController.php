<?php

namespace selftotten\Http\Controllers;

use Illuminate\Http\Request;
use selftotten\Http\Requests;
use selftotten\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('comments')->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $post = new Post;
        return view('posts.create', compact('post'));
    }

    /**
     * @param Request $request
     */
    public function save(Request $request)
    {
        $post = new Post;

        $post->save($request->all());

        return back();
    }
}
