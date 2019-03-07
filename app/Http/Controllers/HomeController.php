<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->admin == true){

            return redirect()->route('admin.dashboard');

        }elseif (Auth::user()->author == true){

            return redirect()->route('author.dashboard');

        }else{

            return redirect()->route('user.dashboard');

        }
    }
}
