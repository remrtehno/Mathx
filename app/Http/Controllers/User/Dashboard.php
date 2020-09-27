<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use function foo\func;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



define("ONE_HOUR", 3600);
define("DELIMITER", "/:/");

class Dashboard extends Controller{
	
	protected $allow_tests = null;
	protected $continue_tests = null;
	protected $action = null;
	protected $time_left = null;
	protected $fiz = null;
	protected $math = true;
	protected $select = null;
	protected $results = null;
	protected $level_test = null;
	protected $timenow = null;
	protected $table = null;
	protected $user_tasks = null;
	
	function __construct() {
		//math set as default = false : isn't set default = true
		session(['select' => false, ]);
		$this->timenow = strtotime(date('Y-m-d H:i'));
		
		
		if(self::select_theme()) {
			$this->fiz = '_fiz';
		} else {
			$this->fiz = '';
		}
		
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
				$this->fiz = '_fiz';
			} else {
				$end_test = $users->first()->end_test;
				$start_test = $users->first()->start_test;
				$this->fiz = '';
			}
			
			
			// 0

				//1
				if ( empty( $end_test ) && empty( $start_test ) ) {
					
					$this->allow_tests = true;
					//2
				} elseif ( ! $end_test || ( $end_test < $start_test ) && ( ( $timenow - $start_test ) < 3600 ) ) {
					
					$this->continue_tests = true;
					
					//3
				} elseif ( ( ! $end_test || ( $end_test < $start_test ) ) && ( ( 3600 <= $timenow - $start_test ) && ( $timenow - $start_test < 10080 ) ) ) {
					
					$this->allow_tests    = null;
					$this->continue_tests = null;
					
					$end_test = $start_test + 3600;
					DB::table( 'users' )->where( 'id', $user_id )->update( [ 'end_test'.$this->fiz => $end_test, ] );
					$this->time_left = 7200 - $timenow + $end_test;
					session( [ 'alert' => 'Вы можете пройти тест через ' . date( 'H:i', $this->time_left ), ] );
					
					//4
				} elseif ( ( ! $end_test || ( $end_test < $start_test ) ) && ( ( $timenow - $start_test >= 10080 ) ) ) {
					
					$end_test = $start_test + 3600;
					DB::table( 'users' )->where( 'id', $user_id )->update( [ 'end_test'.$this->fiz => $end_test, ] );
					$this->allow_tests = true;
					
					//5
				} elseif ( ( $end_test >= $start_test ) && ( ( $timenow - $start_test ) < 10080 ) ) {
					
					$this->allow_tests    = null;
					$this->continue_tests = null;
					
					$this->time_left = 7200 - $timenow + $end_test;
					session( [ 'alert' => 'Вы можете пройти тест через ' . date( 'H:i', $this->time_left ), ] );
					
					//6
				} elseif ( ( $end_test > $start_test ) && ( $timenow - $start_test >= 10080 ) ) {
					
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
			
			if(self::select_theme()) {
				$end_test = $users->first()->end_test_fiz;
				$start_test = $users->first()->start_test_fiz;
				$this->fiz = '_fiz';
			} else {
				$end_test = $users->first()->end_test;
				$start_test = $users->first()->start_test;
				$this->fiz = '';
			}
			
			// 0

				
				//1
				if ( empty( $end_test ) && empty( $start_test ) ) {
					
					DB::table( 'users' )->where( 'id', $user_id )->update( [ 'start_test'.$this->fiz => $timenow, ] );
					$this->time_left = 3600;
					//2
				} elseif ( ! $end_test || ( $end_test < $start_test ) && ( ( $timenow - $start_test ) < 3600 ) ) {
					
					$this->time_left = ( $start_test - $timenow + 3600 );
					//3
				} elseif ( ( ! $end_test || ( $end_test < $start_test ) ) && ( ( 3600 <= $timenow - $start_test ) && ( $timenow - $start_test < 10080 ) ) ) {
					
					DB::table( 'users' )->where( 'id', $user_id )->update( [ 'start_test'.$this->fiz => $timenow, ] );
					$this->time_left = 3600;
					
					//4
				} elseif ( ( ! $end_test || ( $end_test < $start_test ) ) && ( ( $timenow - $start_test >= 10080 ) ) ) {
					
					//5
				} elseif ( ( $end_test > $start_test ) && ( ( $timenow - $start_test ) < 10080 ) ) {
					//6
				} elseif ( ( $end_test > $start_test ) && ( $timenow - $start_test >= 10080 ) ) {
					
					DB::table( 'users' )->where( 'id', $user_id )->update( [ 'start_test'.$this->fiz => $timenow, ] );
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
			
			
			
			if(self::select_theme()) {
				$this->fiz = '_fiz';
				$flights = new \App\Math;
			} else {
				$this->fiz = '';
				$flights = new \App\Math;
			}
			
			
			$flights->setTable($name_db);
			$get_test = $flights->get()->toArray();
			
			
			$timenow = strtotime(date('Y-m-d H:i'));
			
			$start_test = DB::table('users')->select('start_test'.$this->fiz)->where('id', '=', $user_id )->pluck('start_test'.$this->fiz)->toArray()[0];
			$end_test = DB::table('users')->select('end_test'.$this->fiz)->where('id', '=', $user_id )->pluck('end_test'.$this->fiz)->toArray()[0];

			if( (($timenow - $start_test) > ONE_HOUR) && ($start_test  > $end_test) ) {
				DB::table('users')->where('id', $user_id)->update(['end_test'.$this->fiz => $start_test+ONE_HOUR, ]);
				return redirect()->action('User\Dashboard@test');
			} elseif($start_test <= $end_test) {
				return redirect()->action('User\Dashboard@test');
			}
			
			$values_array = [];
			foreach ( $response as $item ) {
				$values_array[] = isset($item) ? $item : 'null';
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
					if (($val['kod_otvet'] === $values_array[$key+2])) {
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
				
				//picks one the key for a random entry
				//DB::table('users')->where('id', $user_id)->update(['end_test_fiz' => strtotime(date('Y-m-d H:i')), 'last_result_fiz' => [$invalid_test[array_rand($invalid_test)]],  ]);
				DB::table('users')->where('id', $user_id)->update(['end_test_fiz' => strtotime(date('Y-m-d H:i')), 'last_result_fiz' => $invalid_test,  ]);
				
				
			} else {
				foreach ($get_test as $key => $val) {
					$kod_otvet[] = $val['kod_otvet'];
					$get_variate_answers = array_map( 'trim', preg_split(DELIMITER, $val['kod_otvet'] ) ) ;
					
					//($val['kod_otvet'] === $values_array[$key+2])
					
					if ( in_array(trim($values_array[$key+2]), $get_variate_answers) ) {
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
					DB::table('users')->where('id', $user_id)->update(['end_test_fiz' => strtotime(date('Y-m-d H:i')), 'last_result_fiz' => $invalid_test,  ]);
					
				} else {
					DB::table('users')->where('id', $user_id)->update(['end_test' => strtotime(date('Y-m-d H:i')), 'last_result' => $invalid_test,  ]);
					
				}
				
			}
			
			session(['last_result' => true, ]);
			
			// 0.9 is percent of correct right answers
			if($count_corr_answ >= ceil(count($kod_otvet) * 0.9)) {
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
	
	public function get_start() {
		$user_id = session()->get('login');
		if($user_id) {
			
			$users = DB::table('users')->where('id', '=', $user_id )->first();
			
			
			
			if(self::select_theme()) {
				$sbornik = new \App\SbornikFiz;
				
				//get level and set bd
				if(isset($users->level_fiz)) {
					$this->table = $users->level_fiz;
				} else {
					$this->table = Config::get('constants.options.LEVEL_FIZ');
				}
				
			} else {
				$sbornik = new \App\SbornikMat;
				
				//get level and set bd
				if(isset($users->level)) {
					$this->table = $users->level;
				} else {
					$this->table = Config::get('constants.options.LEVEL');
				}
				
			}
			
			
			
			
			
			$sbornik->setTable('map');
			$get_test = $sbornik->where('level', '=', $this->table)->first();
			

			
			
			if(!isset($get_test->table_name)) {
				session( [ 'alert' => 'Задачи временно не доступны, пожалуйста выберите другой раздел или зайдите позже.', ] );
				return redirect()->route('dashboard');
			}
			
			$table_name = $get_test->table_name;
			

			
			$sbornik->setTable($table_name);
			$get_test = $sbornik->get()->toArray();
			$get_test_json = $sbornik->get()->toJson(JSON_PRETTY_PRINT);
			
			
			
			
			$this->user_tasks = [];
			$getArray = DB::table('user_meta')->where(['user_id' => $user_id, 'meta_key' => 'user_tasks' ])->get()->first();
			
			if(isset($getArray->meta_value)) {
				$this->user_tasks = unserialize($getArray->meta_value);
				if(isset($this->user_tasks[$table_name])) {
					$this->user_tasks = $this->user_tasks[$table_name]['id'];
				}
				$get_test = array_filter($get_test, function($var) {
					return !in_array($var['id'], (array)$this->user_tasks);
				});
			}
			
			//title
			$sbornik->setTable('info');
			$info = $sbornik->where('table_name', '=', $table_name)->get()->first();
			

			
			
			/*
			 *
			 *
			 *
			 *
			 *
			
			 
SELECT  (
        SELECT COUNT(*)
        FROM   blok_1_1a
        ) AS count1,
        (
        SELECT COUNT(*)
        FROM   blok_2_1a
        ) AS count2
FROM    dual
			
			
			
			SELECT SUM(TABLE_ROWS)

FROM  INFORMATION_SCHEMA.PARTITIONS
    WHERE TABLE_SCHEMA = 'mathexpe_sbornik_mat'
     AND table_name IN ('blok_1_1a', 'blok_2_1a', 'blok_2_1b')
			
			
			SELECT table_name FROM mathexpe_sbornik_mat.info WHERE info.glava = 2
			
			
			need to add where to prevent find whole tables

			SELECT *

FROM  INFORMATION_SCHEMA.TABLES
    WHERE INFORMATION_SCHEMA.TABLES.TABLE_SCHEMA = "mathexpe_sbornik_mat" AND CONVERT(TABLE_NAME  USING utf32) IN (SELECT  CONVERT(table_name USING utf32) FROM mathexpe_sbornik_mat.info WHERE info.glava = 1)

			//sum of all rows
			SELECT SUM(TABLE_ROWS) as rows FROM  INFORMATION_SCHEMA.TABLES
    WHERE INFORMATION_SCHEMA.TABLES.TABLE_SCHEMA = "mathexpe_sbornik_mat" AND CONVERT(TABLE_NAME  USING utf32) IN (SELECT  CONVERT(table_name USING utf32) FROM mathexpe_sbornik_mat.info WHERE info.glava = 2)
			 *
			 *
			 */
			
			$sql = DB::select("
SELECT SUM(TABLE_ROWS) as sumrows FROM  INFORMATION_SCHEMA.TABLES WHERE INFORMATION_SCHEMA.TABLES.TABLE_SCHEMA = '".env('DB_DATABASE_MAT', false)."' AND CONVERT(TABLE_NAME  USING utf32) IN (SELECT  CONVERT(table_name USING utf32) FROM ".env('DB_DATABASE_MAT', false).".info WHERE info.glava = ".$info->glava.")

");
			
			$total = 0;
			$resolved = 0;
			if(isset($getArray->meta_value)) {
				foreach (unserialize($getArray->meta_value) as $key => $val) {
					$resolved += count((array)$val['id']);
				}
				$total = round( ($resolved / $sql[0]->sumrows) * 100, 1);
			}
			$json = ['resolved' => $resolved, 'rows' => $sql[0]->sumrows];
			
			
			return view('user.dashboard.get-start', [
				'totalJson' => json_encode($json),
				'total' => $total,
				'fiz' => false,
				'title' => $info->name,
				'time_left' => 0,
				'id_test' => $table_name,
				'users' => $users,
				'data' => $get_test,
				'jsonData' => $get_test_json,
				'row' => [],
				]);
		}
		
		return view('signup');
	}
	
	
	//META SETTINGS
	public function save_meta(Request $post) {
		$user_id = session()->get('login');
		$meta = $post->input('value');
		$key = $post->input('key');
		
		
		if($user_id && $meta && $key) {
			$getArray = DB::table('user_meta')->where(['user_id' => $user_id, 'meta_key' => $key ])->get()->first();
			
			if(isset($getArray->meta_value)) {
				$meta_value_old = unserialize($getArray->meta_value);
				$result = array_merge_recursive($meta_value_old, $meta);
			} else {
				$result = $meta;
			}
			
			DB::table('user_meta')->updateOrInsert(
				['user_id' => $user_id, 'meta_key' => $key ],
				['meta_value' => serialize($result) ]
			);
		}
	}
	
	
	public function user_statistics() {
		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->first();
			
			$data = [];
			$statistics = DB::table('user_meta')->where(['user_id' => $user_id, 'meta_key' => 'user_statistics' ])->get()->first();
			if(isset($statistics->meta_value)) {
				$data = unserialize($statistics->meta_value);
			}
			
			return view('user.dashboard.user-statistics', [
				'users' => $users,
				'user_statistics' => (array)$data,
				]);
			
			
		}
	}
	
}