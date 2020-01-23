<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class CodeExamples extends Controller{
	
	public function index() {

		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			return view('user.dashboard.code-examples', ['users' => $users->first(), 'content' => '', ]);
		}

		return view('signup');
	}

	
}