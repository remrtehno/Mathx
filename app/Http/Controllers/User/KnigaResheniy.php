<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class KnigaResheniy extends Controller{
	
	public function index() {
		
		$user_id = session()->get('login');
		if($user_id) {
			$users = DB::table('users')->where('id', '=', $user_id )->get();
			
			$flights = new \App\KnigaResheniy;
			$flights->setTable('kniga_mat_1');
			$content = $flights->get()->toArray();
			
			return view('user.dashboard.kniga-resheniy', ['users' => $users->first(), 'content' => $content, ]);
		}
		
		return view('signup');
	}
	
	
}