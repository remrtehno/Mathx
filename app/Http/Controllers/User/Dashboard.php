<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Dashboard extends Controller{
	
	protected $allow_tests = null;
	protected $continue_tests = null;
	protected $action = null;
	protected $time_left = null;

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
			
			$timenow = strtotime(date('Y-m-d H:i'));
			$end_test = $users->first()->end_test;
			$start_test = $users->first()->start_test;
			
			if(!empty($end_test)) {
				$more_5h = ($timenow - $end_test) >= 18000;
			}
			if(!empty($end_test)) {
				$more_6h = ($timenow - $start_test) >= 21640;
			}
			
			if(empty($end_test) && empty($start_test)) {
				$this->allow_tests = true;
			} elseif((!$end_test || $more_5h) && (($timenow - $start_test) < 3641)) {
				
				$this->continue_tests = true;
				
				
			} elseif((!$end_test || $more_5h) && ( (3641 <= $timenow - $start_test) && ($timenow - $start_test < 21640) ) )  {
				
				
				$this->allow_tests = null;
				$this->continue_tests = null;
				
				$end_test = $start_test + 3641;
				DB::table('users')->where('id', $user_id)->update(['end_test' => $end_test, ]);
				$this->time_left = 18000 - $timenow + $end_test;
				
				session(['alert' => 'Вы можете пройти тест через ' . date('H:i',$this->time_left),]);
				

			} elseif( ($end_test - $start_test <= 3641) &&  ( (3641 <= $timenow-$start_test) && ($timenow - $start_test) < 21640 ) ) {
				
				$this->allow_tests = null;
				$this->continue_tests = null;
				
				$end_test = $start_test + 3641;
				DB::table('users')->where('id', $user_id)->update(['end_test' => $end_test, ]);
				$this->time_left = 18000 - $timenow + $end_test;
				
				session(['alert' => 'Вы можете пройти тест через ' . date('H:i',$this->time_left),]);
				
			} elseif($more_5h && $more_6h) {
				
				$this->allow_tests = true;
				$start_test = $timenow;
				DB::table('users')->where('id', $user_id)->update(['start_test' => $start_test, ]);
				
			} else {
				session(['alert' => 'No works condition.']);
			}
			
			
			
			return view('user.dashboard.tests', ['users' => $users->first(), 'allow_tests' => $this->allow_tests, 'continue_tests' => $this->continue_tests, 'level_test' => $users->first()->level_test,]);
		}
		return view('signup');
	}
	
	public function load_tests($level_test = null) {
		print_r($level_test);
		$user_id = session()->get('login');
		if($user_id) {
			
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			
			
			$timenow = strtotime(date('Y-m-d H:i'));
			$end_test = $users->first()->end_test;
			$start_test = $users->first()->start_test;
			
			if(!empty($end_test)) {
				$more_5h = ($timenow - $end_test) >= 18000;
				$more_6h = ($timenow - $start_test) >= 21640;
			}
			
			
			if(empty($end_test) && empty($start_test)) {
				
				DB::table('users')->where('id', $user_id)->update(['start_test' => $timenow, 'level_test' => 'A1.1',  ]);
				$this->time_left = 3641;
				
			} elseif(!$end_test || $more_5h && (($timenow - $start_test) < 3641)) {
				
				$this->time_left = ($start_test - $timenow + 3641);
				
			} elseif( (!$end_test || $more_5h) && ( (3641 <= $timenow - $start_test) && ($timenow - $start_test < 21640) ) )  {
			
			
			} elseif(($end_test - $start_test <= 3641) &&  ( (3641 <= $timenow-$start_test) && ($timenow - $start_test) < 21640 )) {
			
			} elseif($more_5h && $more_6h) {
				$this->time_left = 3641;
			}
			
			$this->allow_tests = null;
			$this->continue_tests = null;
			
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			$name_lvl_table = DB::table('levels_tests')->where('level', '=', $users->first()->level_test )->get();
			
			$get_test = [];
			$get_test_json = [];
			if(!empty( $name_lvl_table->first()->name_db)) {
				$flights = new \App\Math;
				$flights->setTable($name_lvl_table->first()->name_db);
				$get_test_json = $flights->get()->toJson(JSON_PRETTY_PRINT);
				$get_test = $flights->get()->toArray();
			}
			
			return view('user.dashboard.test-container', ['users' => $users->first(), 'data' => $get_test, 'jsonData' => $get_test_json, 'time_left' => $this->time_left, 'id_test' => $name_lvl_table->first()->name_db,]);
		}
		
		return view('signup');
	}

}