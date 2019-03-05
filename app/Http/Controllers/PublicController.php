<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index ()
    {
        $posts = Post::with('user')->paginate(5);
        return view('index', compact('posts'));
    }

    public function singlePost ($id)
    {
        $post = Post::findOrFail($id);

        return view('singlePost', compact('post'));
    }

    public function about ()
    {
        return view('about');
    }

    public function contact ()
    {
        return view('contact');
    }
}
