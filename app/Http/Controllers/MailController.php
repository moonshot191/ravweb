<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
    public function invitation_mail(Request $request){
        $this->validate($request, [
            'teacher_name' => 'required',
            'email_address' => 'required|email',
        ]);
        $name = $request->input('teacher_name');
        $email = $request->input('email_address');
        Mail::to($email)->send(new SendMailable($name, $email));

        return view('emails.email_sent_successfully', ['name'=>$name, 'email_address'=>$email]);
    }
}