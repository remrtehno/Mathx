<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/10/19
 * Time: 11:40
 */

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Dashboard extends Controller{

	public function store() {

		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			return view('user.dashboard.home', ['users' => $users->first()]);
		}

		return view('signup');
	}
	
	public function test() {
		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			return view('user.dashboard.tests', ['users' => $users->first()]);
		}

	}
	
	
	public function start_test() {
		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			$end_test = $users->first()->end_test;

			if(empty($end_test)) {
				DB::table('users')->where('id', $user_id)->update(['start_test' => date('m/d/Y h:i:s a'), 'level_test' => 'A1.1', ]);
			};
			
			
			$conn = mysqli_connect('localhost', 'mathexpe_alex', '16851750g', 'mathexpe_tests');
			$result = mysqli_query($conn, "select * from mat_a1_1");
			
			$tests = (mysqli_fetch_array($result));
			
/*
			DB::connection('mysql2')->select(...);
			print_r( DB::table('mat_a1_1')->get() );
*/
			
			
			//return view('user.dashboard.tests', ['test' => $tests,]);
		}

	}

}