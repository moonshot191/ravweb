<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;

class InviteController extends Controller{
	public function index(User $model) {
		return view('invite.index', ['users' => $model->paginate(15)]);
	}

	public function invite(){
		return view('invite.invite');
	}
}