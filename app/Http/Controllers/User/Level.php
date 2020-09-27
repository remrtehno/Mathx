<?php


namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class Level extends Controller {
	protected $table = null;
	protected $level = null;
	protected $level_fiz = null;
	protected $fiz = null;
	protected $math = true;
	
	public function select_theme() {
		if ( session( 'select' ) ) {
			return true;
		}
		$this->fiz  = null;
		$this->math = true;
		
		return false;
	}
	
	public function up() {
		$user_id = session()->get( 'login' );
		if ( $user_id ) {
			
			$users = DB::table( 'users' )->where( 'id', '=', $user_id )->first();
			
			
			if ( self::select_theme() ) {
				//get level and set bd
				if ( isset( $users->level_fiz ) ) {
					$this->table = $users->level_fiz;
				} else {
					$this->table = Config::get( 'constants.options.LEVEL_FIZ' );
				}
				
				$this->fiz = '_fiz';
				$sbornik   = new \App\SbornikFiz;
			} else {
				
				//get level and set bd
				if ( isset( $users->level ) ) {
					$this->table = $users->level;
				} else {
					$this->table = Config::get( 'constants.options.LEVEL' );
				}
				$this->fiz = '';
				$sbornik   = new \App\SbornikMat;
			}
			
			
			$sbornik->setTable( 'map' );
			if ( self::select_theme() ) {
				$get_test    = $sbornik->where( 'level', '>', $this->table )->first();
				$this->level = isset( $get_test->level ) ? $get_test->level : null;
				 DB::table( 'users' )->where( 'id', '=', $user_id )->update( [ 'level_fiz' => $this->level ] );
				
			} else {
				$get_test    = $sbornik->where( 'level', '>', $this->table )->first();
				$this->level = isset( $get_test->level ) ? $get_test->level : null;
				return DB::table( 'users' )->where( 'id', '=', $user_id )->update( [ 'level' => $this->level ] );
				
			}
			
			
			
		}
	}
}
