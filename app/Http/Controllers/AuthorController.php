<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\createPost;
use App\Http\Requests\deleteRequest;
use App\Post;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthorController extends Controller
{

    public function __construct()
    {
        $this->middleware(['CheckRole:author','auth']);
    }

    public function dashboard ()
    {

        $allPosts = Post::all();
        $postsToday = Post::find(Auth::user()->id)->whereDate('created_at',Carbon::today())->get();
        $allComments = Comment::all();
        $commentsToday = Comment::find(Auth::user()->id)->whereDate('created_at',Carbon::today())->get();

        // start Chart
        $chart = new DashboardChart;

        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());
        $postsChart = [];

        foreach ($days as $day){
            $postsChart [] = Post::whereDate('created_at', $day)->where('user_id', Auth::user()->id)->count();
        }


        $chart->labels($days);
        $chart->dataset('posts', 'line', $postsChart);
        // end Chart
        return view('author.dashboard', compact('allPosts', 'postsToday' ,'allComments', 'commentsToday', 'chart'));
    }


    private function generateDateRange (Carbon $startDate, Carbon $endDate)
    {
        $dates = [];
        for ($date = $startDate; $date->lte($endDate); $date->addDay()){
            $dates [] = $date->format('Y-m-d');
//            $dates[] = Post::whereDate('created_at', $date)->where('user_id', Auth::user()->id)->count();
        }
        return $dates ;
    }


    public function posts ()
    {

        $posts = Post::where('user_id', Auth::user()->id)->orderBy('id','desc')->paginate(5);

        return view('author.posts', compact('posts'));
    }

    public function createPost()
    {
        return view('author.createPost');
    }

    public function addPost (createPost $request)
    {

        $post = new Post ;
        $post->title = $request->title;
        $post->content = $request->postContent;
        $post->user_id = Auth::id();
        $post->save();
        return back()->with('success', 'Post Created Successfully.');
    }

    public function editPost ($id)
    {
        $post = Post::findOrFail($id);
        return view('author.editPost', compact('post'));
    }

    public function updatePost (createPost $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->postContent;
        $post->save();
        return redirect()->route('author.posts')->with('success', 'Post Update Successfully');
    }

    public function deletePost (deleteRequest $request)
    {
        if ($request->has('delete')){

            Post::destroy($request->id);
            return back()->with('delete', 'Post /s Deleted Successfully');

        }elseif ($request->has('restore')){

            Post::whereIn('id', $request->id)->restore();
            return back()->with('restore', 'Post /s Restored Successfully');

        }elseif($request->has('finalDelete')){

            Post::whereIn('id', $request->id)->forceDelete();
            return back()->with('delete', 'Post /s Deleted Successfully');

        }

    }

    public function comments ()
    {
        $postsIds = Post::where(['user_id' => Auth::user()->id, 'deleted_at' => NULL])->pluck('id')->toArray();
        $comments = Comment::whereIn('post_id', $postsIds)->orderBy('id','desc')->paginate(5);
        $trashedComments = Comment::onlyTrashed()->get();
        return view('author.comments', compact('comments', 'trashedComments'));
    }

    public function deleteComment (deleteRequest $request)
    {
        if ($request->has('delete')){

            Comment::destroy($request->id);
            return back()->with('delete', 'Comment /s Deleted Successfully');

        }elseif ($request->has('restore')){

            Comment::whereIn('id', $request->id)->restore();
            return back()->with('restore', 'Comment /s Restored Successfully');

        }elseif($request->has('finalDelete')){

            Comment::whereIn('id', $request->id)->forceDelete();
            return back()->with('delete', 'Comment /s Deleted Successfully');

        }

    }
}
