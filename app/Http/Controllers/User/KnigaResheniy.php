<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class KnigaResheniy extends Controller{
	
	protected $allTablesContent = [];
	
	public function index() {
		
		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			
			$flights = new \App\KnigaResheniy;
			$flights->setTable('kniga_mat_1');
			$content = $flights->get()->toArray();
			
			$mat_or_fiz = session('select') == true ? "fiz" : "mat";
			
			collect(DB::connection('mysql3')->select('SHOW TABLES WHERE Tables_in_' .env("DB_DATABASE_3", 'null'). ' LIKE "%'.$mat_or_fiz.'%"'))->map(function ($val) {
				foreach ($val as $key => $tbl) {
					$flights = new \App\KnigaResheniy;
					$flights->setTable($tbl);
					$this->allTablesContent = array_merge($this->allTablesContent, $flights->get()->toArray());
				}
			});
			
			
			
			return view('user.dashboard.kniga-resheniy', ['users' => $users->first(), 'content' => $this->allTablesContent, ]);
		}
		
		return view('signup');
	}
	
	
}