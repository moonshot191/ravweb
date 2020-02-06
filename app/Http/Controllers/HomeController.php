<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Apollo;
use App\Seshat;
use App\Zalmo;
use App\Gaia;
use App\Africa;
use App\User;
use App\Invite;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;


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

    public function mail(Request $request)
    {
        $this->validate($request, [
            'teacher_name' => 'required',
            'email_address' => 'required|email',
        ]);
       $name = $request->input('teacher_name');
       $email_address = $request->input('email_address');
       Mail::to($email_address)->send(new SendMailable($name, $email_address));
       
       return view('emails.email_sent_successfully', ['name'=>$name, 'email_address'=>$email_address]);
    }

    public function register()
    {
       
       return view('emails.register');
    }
}
