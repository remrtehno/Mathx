<?php


namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class Level extends Controller {
	protected $table = null;
	protected $level = null;
	
	
	public function up() {
		$user_id = session()->get('login');
		if($user_id) {
			
			$users = DB::table( 'users' )->where( 'id', '=', $user_id )->first();
			
			//get level and set bd
			if ( isset( $users->level ) ) {
				$this->table = $users->level;
			} else {
				$this->table = Config::get( 'constants.options.LEVEL' );
			}
			
			$sbornik = new \App\SbornikMat;
			$sbornik->setTable( 'map' );
			$get_test   = $sbornik->where( 'level', '>', $this->table )->first();
			$this->level = isset($get_test->level) ? $get_test->level : null;
			
			return DB::table( 'users' )->where( 'id', '=', $user_id )->update(['level' => $this->level]);
		}
	}
}
