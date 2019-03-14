<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\createPost;
use App\Http\Requests\deleteRequest;
use App\Post;
use App\User;
use App\Http\Requests\UpdateUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['CheckRole:admin','auth']);
    }

    public function dashboard ()
    {
        $posts = Post::all();
        $comments = Comment::all();
        $users = User::all();
        // start Chart
        $chart = new DashboardChart ;
        $days = $this->generateDateRang(Carbon::now()->subDays(30), Carbon::now());

        $postsChart = [];

        foreach ($days as $day){
            $postsChart [] = Post::whereDate('created_at', $day)->count();
        }

        $chart->labels($days);
        $chart->dataset('Posts', 'line', $postsChart);
        // end Chart
        return view('admin.dashboard', compact('posts', 'comments', 'users', 'chart'));
    }

    private function generateDateRang (Carbon $start_date, Carbon $end_date)
    {
        $dates = [];
        for ($date = $start_date; $date->lte($end_date); $date->addDay()){
            $dates [] = $date->format('Y-m-d');
        }
        return $dates ;
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
            return back()->with('delete', 'Post /s Deleted Successfully');

        }elseif ($request->has('restore')){

            Post::whereIn('id', $request->id)->restore();
            return back()->with('delete', 'Post /s Deleted Successfully');

        }elseif($request->has('finalDelete')){

            Post::whereIn('id', $request->id)->forceDelete();
            return back()->with('delete', 'Post /s Deleted Successfully');

        }

    }

    public function comments ()
    {
        $comments = Comment::with('post')->paginate(5);
        return view('admin.comments', compact('comments'));
    }

    public function deleteComment (deleteRequest $request)
    {
        if ($request->has('delete')){

            Comment::destroy($request->id);
            return back()->with('delete', 'Comment /s Deleted Successfully');

        }elseif ($request->has('restore')){

            Comment::whereIn('id', $request->id)->restore();
            return back()->with('delete', 'Comment /s Restored Successfully');

        }elseif($request->has('finalDelete')){

            Comment::whereIn('id', $request->id)->forceDelete();
            return back()->with('delete', 'Comment /s Deleted Successfully');

        }

    }

    public function users ()
    {
        $users = User::orderBy('id', 'desc')->paginate(5);
        return view('admin.users', compact('users'));
    }

    public function editUser ($id)
    {
        $user = User::findOrFail($id);
        return view('admin.editUser', compact('user'));
    }

    public function updateUser (UpdateUser $request, $id)
    {
//        dd($request->all());
        $user = User::findOrFail($id);
//        $user->name = $request->name;
//        $user->email = $request->email;

        if ($request->author == 1){
            $user->author = true;

        }else{
            $user->author = false;
        }

        if ($request->admin == 1) {
            $user->admin = true;
        }else{
            $user->admin = false;

        }
        $user->save();
        return redirect()->route('admin.users')->with('success', 'User Update Successfully');
    }

    public function deleteUser (deleteRequest $request)
    {
        if ($request->has('delete')){

            User::destroy($request->id);
            return back()->with('delete', 'User /s Deleted Successfully');

        }elseif ($request->has('restore')){

            User::whereIn('id', $request->id)->restore();
            return back()->with('delete', 'User /s Restored Successfully');

        }elseif($request->has('finalDelete')){

            User::whereIn('id', $request->id)->forceDelete();
            return back()->with('delete', 'User /s Deleted Successfully');

        }

    }
}
