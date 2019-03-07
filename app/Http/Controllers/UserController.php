<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\editProfile;
use App\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function dashboard ()

    {
        return view('user.dashboard');
    }

    public function comments ()

    {
        return view('user.comments');
    }

    public function commentDelete ($id)

    {
        $comment = Comment::where(['id' => $id, 'user_id' => Auth::user()->id])->first();
        $comment->delete();
        return back();
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
        return redirect()->back();
    }
}
