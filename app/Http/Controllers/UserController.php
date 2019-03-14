<?php

namespace App\Http\Controllers;

use App\Charts\DashboardChart;
use App\Comment;
use App\Http\Requests\editProfile;
use App\User;
use Auth;
use App\Http\Requests\deleteRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard ()

    {

        $comments = Comment::where('user_id', Auth::user()->id)->get();

        // start Chart
        $chart = new DashboardChart ;
        $days = $this->genarateDataRange(Carbon::now()->subDays(30), Carbon::now());

        $chartComments = [];


        foreach ($days as $day){
            $chartComments [] = Comment::whereDate('created_at', $day)->where('user_id', Auth::user()->id)->count();
        }

        $chart->labels($days);
        $chart->dataset('comments', 'line', $chartComments);
        // end Chart
        return view('user.dashboard', compact('comments', 'chart'));

    }

    
    private function genarateDataRange (Carbon $start_date, Carbon $end_date)
    {
        $dates = [];

        for ($date = $start_date; $date->lte($end_date); $date->addDay()){
            $dates[] = $date->format('Y-m-d');
        }

        return $dates;

    }
    
    public function comments ()

    {


        $comments = Comment::where('user_id', Auth::user()->id)->with('post')->paginate(5);
        $trashedComments = Comment::onlyTrashed()->get();
        return view('user.comments', compact('comments', 'trashedComments'));
    }

    public function newComment (Request $request)
    {

        $request->validate(['comment' => 'required|string']);
        $comment = new Comment ;
        $comment->content = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->save();

        return back();
    }

    public function commentDelete (deleteRequest $request)

    {
        if ($request->has('delete')){
            Comment::destroy($request->id);
            return back();
        }elseif ($request->has('restore')){
            Comment::whereIn('id',$request->id)->restore();
            return back();
        }elseif ($request->has('finalDelete')){
            Comment::whereIn('id',$request->id)->forceDelete();
            return back();
        }
    }

    public function profile ()
    {
        return view('user.profile');
    }

    public function editProfile (editProfile $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();


        if (!empty($request->password)) {

            if (!Hash::check($request->password, Auth::user()->password)) {

                return back()->with('error',"You'r current password dose not match with the password you provided .");

            }

            if (strcmp($request->password, $request->new_password) == 0){

                return back()->with('error',"New password cannot be same as you'r current password .");

            }

            $request->validate([
                'password' => 'required',
                'new_password' => 'required | string | min:6 | confirmed',
            ]);


            $user->password = bcrypt($request->new_password);
            $user->save();
            return back()->with('success',"Password changed successfully");
        }

        return redirect()->back();

    }
}
