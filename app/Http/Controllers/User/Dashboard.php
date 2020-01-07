<?php


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
		return view('signup');

	}
	
	
	public function start_test() {


		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			$end_test = $users->first()->end_test;

			if(empty($end_test)) {
				DB::table('users')->where('id', $user_id)->update(['start_test' => date('m/d/Y h:i:s a'), 'level_test' => 'A1.1', ]);
			};
			
			
/*
			$conn = mysqli_connect('localhost', 'mathexpe_alex', '16851750g', 'mathexpe_tests');
			$result = mysqli_query($conn, "select * from mat_a1_1");
			
			$tests = (mysqli_fetch_array($result));

			
			//DB::connection('mysql2')->select(...);
			//print_r( 'qwe' );
			//return (1);
			//return view('user.dashboard.tests');
			
			
			*/
			$timenow = strtotime(date('Y-m-d H:i'));
			$end_test = $users->first()->end_test;
			$start_test = $users->first()->start_test;
			
			$more_5h = ($timenow - $end_test) >= 18000;
			$more_6h = ($timenow - $end_test) >= 21640;
			
		
			$allow_tests = false;
			if(empty($end_test)) {
				DB::table('users')->where('id', $user_id)->update(['end_test' => $timenow, 'level_test' => 'A1.1', 'start_test' => $timenow, ]);
				$allow_tests = true;
				// ### START TEST WHICH SPECIFIED IN LEVEL TEST
			} elseif($more_5h && (($timenow - $start_test) < 3641)) {
				//print_r('end_test = not NULL) and (now_date-end_test >= 5h) and (now_date-start_test < 1h');
				
				//### START TEST WHICH SPECIFIED IN LEVEL TEST
				// timeout =  start_test-now_date+1h
				
			} elseif( 
			$more_5h && ( (3641 <= $timenow - $start_test) && ($timenow - $start_test < 21640) ) 
			)  {
				print_r('else if (end_test = not NULL) and (now_date-end_test >= 5h) and (1h <= now_date-start_test < 6h
');
				DB::table('users')->where('id', $user_id)->update(['end_test' => $start_test + 3641, ]);
				$time_left = (21640 - $timenow) + $end_test;
				session(['alert' => 'Вы можете пройти тест через ' . $time_left ,]);
			} elseif($more_5h && $more_6h) {
				print_r('(end_test = not NULL) and (now_date-end_test >= 5h) and (now_date-start_test >= 6h)
');
				$allow_tests = true;
			

			} else {
				session(['error' => "No one condition works." ,]);
			}




			//print_r($users->first()->end_test);
			//print_r( (strtotime(date('Y-m-d H:i') - $users->first()->end_test) >= 18000) );
			
/*
			elseif (($users->first()->end_test - strtotime(date('Y-m-d H:i')) ) {
			
				$timenow = strtotime(date('Y-m-d H:i'));
					
	
				echo strtotime( date("Y-m-d H:i", strtotime('+5 hours')) );
				
				print_r(($timenow - $users->first()->end_test) >= strtotime(date("Y-m-d H:i", strtotime('+5 hours'))));
				
				echo 'time : ' . $timenow . '<br />';
				echo 'MY test : ' . $timestamp;
			}
*/


			return view('user.dashboard.start-tests', ['users' => $users->first(), 'allow_tests' => $allow_tests, ]);
			
		}
		
		return view('signup');
	}
	
	
	public function go_on() {
		

		$flights = new \App\Math;
		$flights->setTable('blok_2_1a');


		//print_r($flights->find(62));

        
        
		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			return view('user.dashboard.go-on', ['users' => $users->first()]);
		}
		return view('signup');
	}

}