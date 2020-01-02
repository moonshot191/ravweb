<?php

namespace App\Http\Controllers;
use App\Apollo;
use App\Seshat;
use App\Zalmo;
use App\Gaia;
use App\Africa;
use App\User;
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $apollo = Apollo::all()->count();
        $africa = Africa::all()->count();
        $gaia = Gaia::all()->count();
        $kadlu = \App\Kadlu::all()->count();
        $kadluq = \App\Kadluq::all()->count();
        $leizi = \App\Leizi::all()->count();
        $odin = \App\Odin::all()->count();
        $seshat = Seshat::all()->count();
        $tyche = \App\Tyche::all()->count();
        $wala = \App\Wala::all()->count();
        $walaq = \App\Walaq::all()->count();
        $zalmo = Zalmo::all()->count();


        $users = User::all();
        return view('dashboard',compact('apollo','seshat','zalmo','gaia','africa','users','wala','walaq','tyche','odin','leizi','kadlu','kadluq'));
    }
}
