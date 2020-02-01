<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KnigaResheniy extends Controller{
	
	protected $allTablesContent = [];
	protected $nav_book = [];
	protected $output = [];
	
	public function index() {
		
		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			
			$flights = new \App\KnigaResheniy;
			$flights->setTable('kniga_mat_1');
			$content = $flights->get()->toArray();
			
			$mat_or_fiz = session('select') == true ? "fiz" : "mat";
			
			collect(DB::connection('mysql3')->select('SHOW TABLES WHERE Tables_in_' .env("DB_DATABASE_3", 'null'). ' LIKE "%'.$mat_or_fiz.'%"'))->map(function ($val) {
				$inc = [];
				foreach ($val as $key => $tbl) {
					$flights = new \App\KnigaResheniy;
					$flights->setTable('map');
					$content = $flights->where('name_db', $tbl)->select('title')->get('id')->toArray();
					
					$inc['name'] = $content[0]['title'];
					$inc['link'] = $tbl;
					$inc['id'] = null;

				}
				
				$this->nav_book[] = $inc;
			});
			
			
			return view('user.dashboard.kniga-resheniy', ['users' => $users->first(), 'nav_book' => $this->nav_book, 'content' => [], ]);
		}
		
		return view('signup');
	}
	
	
	public function getChapter(Request $request) {
		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			
			$content = [];
			$flights = new \App\KnigaResheniy;
			$flights->setTable('map');
			$titlePage = $flights->where('name_db', $request->input('name_db'))->get('title')->toArray()[0]['title'];
			
			
			$flights = new \App\KnigaResheniy;
			$flights->setTable($request->input('name_db'));
			if($request->input('id')) {
				$this->allTablesContent = $flights->where('id', '=', $request->input('id'))->get(['id', 'name', 'content'])->toArray();
			} else {
				$content = $flights->get( [ 'id', 'name' ] )->toArray();
			}
			
			
			foreach ($content as $key => $val) {
				$this->nav_book[$key] = $val;
				$this->nav_book[$key]['link'] = $request->input('name_db');
			}
			
			return view('user.dashboard.kniga-resheniy', ['users' => $users->first(), 'nav_book' => $this->nav_book, 'content' => $this->allTablesContent, 'title' => $titlePage, ]);
		}
		
		return view('signup');
	}
	
	
	
}