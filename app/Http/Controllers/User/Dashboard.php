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
			
			
			//1
			if(empty($end_test) && empty($start_test)) {
				
				$this->allow_tests = true;
			//2
			} elseif( (!$end_test || ($end_test < $start_test)) && ( (3641 <= $timenow - $start_test) && ($timenow - $start_test < 21640) ) ) {
				
				$this->continue_tests = true;
				
			//3
			} elseif( (!$end_test || ($end_test < $start_test)) && ( (3641 <= $timenow - $start_test) && ($timenow - $start_test < 21640) ) ) {
				
				$this->allow_tests = null;
				$this->continue_tests = null;
				
				$end_test = $start_test + 3641;
				DB::table('users')->where('id', $user_id)->update(['end_test' => $end_test, ]);
				$this->time_left = 18000 - $timenow + $end_test;
				session(['alert' => 'Вы можете пройти тест через ' . date('H:i',$this->time_left),]);
				
			//4
			} elseif( (!$end_test || ($end_test < $start_test) ) && ( ($timenow - $start_test >= 21640) ) )  {
				
				$end_test = $start_test + 3641;
				DB::table('users')->where('id', $user_id)->update(['end_test' => $end_test, ]);
				$this->allow_tests = true;
				
			//5
			} elseif( ($end_test > $start_test) &&  (($timenow - $start_test) < 21640)  ) {
				
				$this->allow_tests = null;
				$this->continue_tests = null;
				
				$this->time_left = 18000 - $timenow + $end_test;
				session(['alert' => 'Вы можете пройти тест через ' . date('H:i',$this->time_left), ]);
				
			//6
			} elseif( ($end_test > $start_test) && ($timenow - $start_test >= 21640) ) {
				
				$this->allow_tests = true;
			
			//7
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
			
			//1
			if(empty($end_test) && empty($start_test)) {
				
				DB::table('users')->where('id', $user_id)->update(['start_test' => $timenow,  ]);
				$this->time_left = 3641;
				//2
			} elseif(!$end_test || ($end_test < $start_test) && (($timenow - $start_test) < 3641)) {
				
				$this->time_left = ($start_test - $timenow + 3641);
				//3
			} elseif( (!$end_test || ($end_test < $start_test)) && ( (3641 <= $timenow - $start_test) && ($timenow - $start_test < 21640) ) ) {
				
				DB::table('users')->where('id', $user_id)->update(['start_test' => $timenow,  ]);
				$this->time_left = 3641;
				
				//4
			} elseif( (!$end_test || ($end_test < $start_test) ) && ( ($timenow - $start_test >= 21640) ) )  {
			
				//5
			} elseif( ($end_test > $start_test) &&  (($timenow - $start_test) < 21640) ) {
				//6
			} elseif( ($end_test > $start_test) && ($timenow - $start_test >= 21640) ) {
				
				DB::table('users')->where('id', $user_id)->update(['start_test' => $timenow,  ]);
				$this->time_left = 3641;
			}
			
			
			
			$users = DB::table('users')->where('id', '=', $user_id )->get()->first();
			$name_lvl_table = DB::table('levels_tests')->where('level', '=', $users->level_test )->get()->first();
			
			
			$get_test = [];
			$get_test_json = [];
			if(!empty( $name_lvl_table->name_db)) {
				$flights = new \App\Math;
				$flights->setTable($name_lvl_table->name_db);
				$get_test_json = $flights->get()->toJson(JSON_PRETTY_PRINT);
				$get_test = $flights->get()->toArray();
			}
			
			return view('user.dashboard.test-container', ['users' => $users, 'data' => $get_test, 'jsonData' => $get_test_json, 'time_left' => $this->time_left, 'id_test' => $name_lvl_table->name_db ,]);
		}
		
		return view('signup');
	}
	
	public function end_test(Request $request) {
		$user_id = session()->get('login');
		if($user_id) {
			$response = $request->all();
			$name_db =$response['name_db'];
			$flights = new \App\Math;
			$flights->setTable($name_db);
			$get_test = $flights->get()->toArray();
			

			//check answers
			$kod_otvet = [];
			//count correct answers
			$count_corr_answ = 0;
			foreach ($get_test as $val) {
				$kod_otvet[] = $val['kod_otvet'];
				if (in_array($val['kod_otvet'], $response)) {
					$count_corr_answ++;
					//echo $val['kod_otvet'];
				}
			}
			
			DB::table('users')->where('id', $user_id)->update(['end_test' => strtotime(date('Y-m-d H:i')), ]);
			// 0.8 is percent of correct right answers
			if($count_corr_answ > ceil(count($kod_otvet) * 0.8)) {
				
				$name_lvl_table = DB::table('levels_tests')->where('name_db', '=', $name_db )->get()->first();
				if(!empty($name_lvl_table)) {
					$id = $name_lvl_table->id;
					$next_lvl = DB::table('levels_tests')->where('id', '=', $id+1 )->get()->first();
					DB::table('users')->where('id', $user_id)->update(['level_test' => $next_lvl->level,  ]);
				}
				
				session(['success' => 'Поздравляем, Вы успешно сдали тест ответив правильно на '. $count_corr_answ .' из ' .  count($kod_otvet), ]);
				return redirect()->action('User\Dashboard@test');
			} else {
				
				$output_danger = $count_corr_answ > 5 ? 'ов!' : 'а!';
				session(['danger' => 'Вы не прошли тест, ответив правильно только на '. $count_corr_answ . " вопрос" . $output_danger, ]);
				return redirect()->action('User\Dashboard@test');
			}
			
			
		} else {
			abort( 403, 'Unauthorized action.' );
		}
	}

}