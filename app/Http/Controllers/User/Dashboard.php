<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use function foo\func;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class Dashboard extends Controller{
	
	protected $allow_tests = null;
	protected $continue_tests = null;
	protected $action = null;
	protected $time_left = null;
	
	protected $fiz = null;
	protected $math = true;
	protected $select = null;
	
	protected $results = null;
	
	function __construct() {
		//math set as default = false : isn't set default = true
		session(['select' => false, ]);
	}
	
	
	// if return false is math
	public function select_theme() {
		if(session('select')) {
			 return true;
		}
		$this->fiz = null;
		$this->math = true;
		return false;
	}
	
	
	

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
			
			
			if(self::select_theme()) {
				$end_test = $users->first()->end_test_fiz;
				$start_test = $users->first()->start_test_fiz;
			} else {
				$end_test = $users->first()->end_test;
				$start_test = $users->first()->start_test;
			}

			
			
			//1
			if(empty($end_test) && empty($start_test)) {
				
				$this->allow_tests = true;
			//2
			} elseif( !$end_test || ($end_test < $start_test) && (($timenow - $start_test) < 3600) ) {
				
				$this->continue_tests = true;
				
			//3
			} elseif( (!$end_test || ($end_test < $start_test)) && ( (3600 <= $timenow - $start_test) && ($timenow - $start_test < 10080) ) ) {
				
				$this->allow_tests = null;
				$this->continue_tests = null;
				
				$end_test = $start_test + 3600;
				DB::table('users')->where('id', $user_id)->update(['end_test' => $end_test, ]);
				$this->time_left = 7200 - $timenow + $end_test;
				session(['alert' => 'Вы можете пройти тест через ' . date('H:i',$this->time_left),]);
				
			//4
			} elseif( (!$end_test || ($end_test < $start_test) ) && ( ($timenow - $start_test >= 10080) ) )  {
				
				$end_test = $start_test + 3600;
				DB::table('users')->where('id', $user_id)->update(['end_test' => $end_test, ]);
				$this->allow_tests = true;
				
			//5
			} elseif( ($end_test >= $start_test) &&  (($timenow - $start_test) < 10080)  ) {
				
				$this->allow_tests = null;
				$this->continue_tests = null;
				
				$this->time_left = 7200 - $timenow + $end_test;
				session(['alert' => 'Вы можете пройти тест через ' . date('H:i',$this->time_left), ]);
				
			//6
			} elseif( ($end_test > $start_test) && ($timenow - $start_test >= 10080) ) {
				
				$this->allow_tests = true;
			
			//7
			}
			

			
			if(self::select_theme()) {
				if(session()->has('last_result')) {
					$this->results = $users->first()->last_result_fiz;
				}
				return view('user.dashboard.tests', ['users' => $users->first(), 'allow_tests' => $this->allow_tests, 'continue_tests' => $this->continue_tests, 'level_test' => $users->first()->level_test_fiz, 'results' =>  $this->results, ]);
			} else {
				if(session()->has('last_result')) {
					$this->results = $users->first()->last_result;
				}
				return view('user.dashboard.tests', ['users' => $users->first(), 'allow_tests' => $this->allow_tests, 'continue_tests' => $this->continue_tests, 'level_test' => $users->first()->level_test, 'results' => $this->results, ]);
				
			}
		}
		return view('signup');
	}
	
	public function load_tests($level_test = null) {
		
		$user_id = session()->get('login');
		if($user_id) {
			
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			
			
			$timenow = strtotime(date('Y-m-d H:i'));
			$end_test = $users->first()->end_test;
			$start_test = $users->first()->start_test;
			
			//1
			if(empty($end_test) && empty($start_test)) {
				
				DB::table('users')->where('id', $user_id)->update(['start_test' => $timenow,  ]);
				$this->time_left = 3600;
				//2
			} elseif(!$end_test || ($end_test < $start_test) && (($timenow - $start_test) < 3600)) {
				
				$this->time_left = ($start_test - $timenow + 3600);
				//3
			} elseif( (!$end_test || ($end_test < $start_test)) && ( (3600 <= $timenow - $start_test) && ($timenow - $start_test < 10080) ) ) {
				
				DB::table('users')->where('id', $user_id)->update(['start_test' => $timenow,  ]);
				$this->time_left = 3600;
				
				//4
			} elseif( (!$end_test || ($end_test < $start_test) ) && ( ($timenow - $start_test >= 10080) ) )  {
			
				//5
			} elseif( ($end_test > $start_test) &&  (($timenow - $start_test) < 10080) ) {
				//6
			} elseif( ($end_test > $start_test) && ($timenow - $start_test >= 10080) ) {
				
				DB::table('users')->where('id', $user_id)->update(['start_test' => $timenow,  ]);
				$this->time_left = 3600;
			}
			
			
			
			$users = DB::table('users')->where('id', '=', $user_id )->get()->first();
			if(self::select_theme()) {
				$name_lvl_table = DB::table('levels_tests_fiz')->where('level', '=', $users->level_test_fiz )->get()->first();
				$this->fiz = true;
				$this->math = null;
			} else {
				$this->fiz = null;
				$this->math = true;
				$name_lvl_table = DB::table('levels_tests')->where('level', '=', $users->level_test )->get()->first();
			}
			
			
			$get_test = [];
			$get_test_json = [];
			if(!empty( $name_lvl_table->name_db)) {
				$flights = new \App\Math;
				$flights->setTable($name_lvl_table->name_db);
				$get_test_json = $flights->get()->toJson(JSON_PRETTY_PRINT);
				$get_test = $flights->get()->toArray();
			}
			
			return view('user.dashboard.test-container', ['users' => $users, 'data' => $get_test, 'jsonData' => $get_test_json, 'time_left' => $this->time_left, 'id_test' => $name_lvl_table->name_db, 'fiz' => $this->fiz, ]);
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
			
			
			$values_array = [];
			foreach ( $response as $item ) {
				$values_array[] = $item ? : 'null';
			}
			
			//check answers
			$kod_otvet = [];
			//count correct answers
			$count_corr_answ = 0;
			//invalid test
			$invalid_test = [];
			
			if(self::select_theme()) {
				foreach ($get_test as $key => $val) {
					$kod_otvet[] = $val['kod_otvet'];
					if (($val['kod_otvet'] === array_values($response)[$key+2])) {
						$count_corr_answ++;
						//echo $val['kod_otvet'];
						//NEED REFACTOR//HACK #############
					} else {                                  // 1 token // 2 namedb
						if($values_array[$key+2]) {
							$invalid_test[$key+1] = array('id' => $val['id'], 'uslovie' => htmlentities($val['uslovie']), 'kod_otvet' => array_values($response)[$key+2 ], );
						}
					}
					//!!!! NEED REFACTOR
				}
				
				DB::table('users')->where('id', $user_id)->update(['end_test' => strtotime(date('Y-m-d H:i')), 'last_result_fiz' => $invalid_test,  ]);
			} else {
				foreach ($get_test as $key => $val) {
					$kod_otvet[] = $val['kod_otvet'];
					if (in_array($val['kod_otvet'], $response)) {
						$count_corr_answ++;
						//echo $val['kod_otvet'];
						
						//NEED REFACTOR//HACK #############
					} else {                                  // 1 token // 2 namedb
						
						if($values_array[$key+2]) {
							$invalid_test[$key+1] = array('id' => $val['id'], 'uslovie' => htmlentities($val['uslovie']), 'kod_otvet' => array_values($response)[$key+2 ], );
						}
					}
					//!!!! NEED REFACTOR
				}
				if(self::select_theme()) {
					DB::table('users')->where('id', $user_id)->update(['end_test' => strtotime(date('Y-m-d H:i')), 'last_result_fiz' => $invalid_test,  ]);
					
				} else {
					DB::table('users')->where('id', $user_id)->update(['end_test' => strtotime(date('Y-m-d H:i')), 'last_result' => $invalid_test,  ]);
					
				}
				
			}
			
			

			session(['last_result' => true, ]);

			
			
			// 0.8 is percent of correct right answers
			if($count_corr_answ >= ceil(count($kod_otvet) * 0.8)) {
				if(self::select_theme()) {
					$name_lvl_table = DB::table( 'levels_tests_fiz' )->where( 'name_db', '=', $name_db )->get()->first();
				} else {
					$name_lvl_table = DB::table( 'levels_tests' )->where( 'name_db', '=', $name_db )->get()->first();
				}
				
				if(!empty($name_lvl_table)) {
					$id = $name_lvl_table->id;
					if(self::select_theme()) {
						$next_lvl = DB::table( 'levels_tests_fiz' )->where( 'id', '=', $id + 1 )->get()->first();
					} else {
						$next_lvl = DB::table( 'levels_tests' )->where( 'id', '=', $id + 1 )->get()->first();
					}
					if(self::select_theme()){
						DB::table('users')->where('id', $user_id)->update(['level_test_fiz' => $next_lvl->level,  ]);
					} else {
						DB::table('users')->where('id', $user_id)->update(['level_test' => $next_lvl->level,  ]);
					}
				}
				
				session(['success' => 'Поздравляем, Вы успешно сдали тест ответив правильно на '. $count_corr_answ .' из ' .  count($kod_otvet), 'last_result' => true, ]);
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
	
	
	
	public function switcher_theme(Request $request) {
		
		$user_id = session()->get('login');
		if($user_id) {
			
			$select = $request->all();
			if($select['select']) {
				$this->math = true;
				$this->fiz = false;
				session(['select' => false, ]);
			} else {
				$this->math = false;
				$this->fiz = true;
				session(['select' => true, ]);
			}
			
			return redirect()->action('User\Dashboard@store');
		}
		return view('signup');
	}
	
	
	//META SETTINGS
	public function save_meta() {
		$user_id = session()->get('login');
		if($user_id) {
			if ( $_POST['json'] ) {
				$directions = $_POST['json'];
				//mysql_real_escape_string($directions);
			}
		}
	}
	
}