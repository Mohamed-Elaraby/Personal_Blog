<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\createPost;
use App\Http\Requests\deleteRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckRole:admin');
    }

    public function dashboard ()
    {
        $posts = Post::all();
        $comments = Comment::all();
        $users = User::all();
        return view('admin.dashboard', compact('posts', 'comments', 'users'));
    }

    public function posts ()
    {
        $posts = Post::paginate(5);
        return view('admin.posts', compact('posts'));
    }

    public function editPost ($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.editPost', compact('post'));
    }

    public function updatePost (createPost $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->postContent;
        $post->save();
        return redirect()->route('admin.posts')->with('success', 'Post Update Successfully');
    }

    public function deletePost (deleteRequest $request)
    {
        if ($request->has('delete')){

            Post::destroy($request->id);
            return back()->with('delete', 'Post Deleted Successfully');

        }elseif ($request->has('restore')){

            Post::whereIn('id', $request->id)->restore();
            return back()->with('delete', 'Post Deleted Successfully');

        }elseif($request->has('finalDelete')){

            Post::whereIn('id', $request->id)->forceDelete();
            return back()->with('delete', 'Post Deleted Successfully');

        }

    }

    public function comments ()
    {
        $comments = Comment::with('post')->paginate(5);
        return view('admin.comments', compact('comments'));
    }

    public function users ()
    {
        $users = User::paginate(5);
        return view('admin.users');
    }
}
