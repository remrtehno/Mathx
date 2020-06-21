<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

use Illuminate\Http\Request;

class SignUp extends Controller
{

	public function signin(Request $request) {

		$user_new = $request->all();

		if ($request->isMethod('post') && !empty($user_new['phone_number']) && !empty($user_new['password']) ) {

			$users = new users;
			$users->phone_number = $user_new['phone_number'];
			$users->password = $user_new['password'];
			$users->last_name = $user_new['last_name'];
			$users->first_name = $user_new['first_name'];
			$users->level_test = Config::get('constants.options.LEVEL_TEST');
			$users->level_test_fiz = Config::get('constants.options.LEVEL_FIZ');
			$users->level = Config::get('constants.options.LEVEL');



			$users->save();


			$users = DB::table( 'users' )->where( [
				[ 'phone_number', '=', $user_new['phone_number'] ],
				[ 'password', '=', $user_new['password'] ],
			] )->get()->first();

			session(['login' => $users->id]);

			return redirect()->route('dashboard');
		}


		$users = DB::table('users')->get();

		return view('signin', ['users' => $users]);
	}



	public function signup(Request $request) {


		$signup = $request->only(['phone_number', 'password']);


		session()->forget('error');

		if(!empty($signup['phone_number']) && !empty($signup['password'])) {
			$users = DB::table( 'users' )->where( [
				[ 'phone_number', '=', $signup['phone_number'] ],
				[ 'password', '=', $signup['password'] ],
			] )->get()->toArray();

			if(empty($users)) {
				if(!session()->get('login')) {
					session(['error' => 'Введены не верные данные или пользователь не существует.']);
				}
			} else {
				session(['login' => $users[0]->id]);
				return redirect()->route('dashboard');
			}

		}

		return view('signup');
	}



	public function logout(Request $request) {
		$request->session()->flush();
		return view('welcome');
	}
}