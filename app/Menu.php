<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use DB;
class Menu extends Model
{
	public static function menu(){
		$menus = new Menu();
		$subopciones = array();

		if(Auth::user()){
			if(Auth::user()->profile == 4){
				$subopciones = ['100','200','300','400','500'];
			}else{
				$subopciones = ['100','200'];
			}
			$menupadres = DB::table('menu')
			                ->where('id_menu', 'like', '02.%.00')
			                ->where('obs_menu', '<>', 'principal')
			                ->whereIn('icono_menu', $subopciones)
			                ->get();
			$opciones[] = $menupadres;
			foreach ($menupadres as $menupadre){
				$menuhijos[] = DB::table('menu')
				                 ->where(DB::raw('left(id_menu,5)'),'=',DB::raw('left("'.$menupadre->id_menu.'",5)'))
				                 ->where(DB::raw('right(id_menu,6)'),'<>',DB::raw('right("'.$menupadre->id_menu.'",6)'))
				                 ->where('obs_menu', '<>', 'principal')
				                 ->get();
			}
			$opciones[] = $menuhijos;
			return $menus->opciones=$opciones;
		}else {
			return $menus = [];

		}

	}

}
