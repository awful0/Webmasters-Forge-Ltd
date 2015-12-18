<?php

namespace app\classes;

			/********** 
						ЗДЕСЬ вызываем наши VIEWS
			**********/
class View {

	public function display($langMass, $mass=[], $page='reg', $err='', $mess=''){
		
		( $_SESSION['token'] = ($token = md5(rand(2e6, 9e14)))? $token : false ) && (
			($page == 'reg') &&
			(include_once __DIR__ . '/../views/login.php') ||
			(include_once __DIR__ . '/../views/users.php') );
	}

	public function displayexit($path, $time){

		exit("<meta charset=utf-8><meta http-equiv='Refresh' content='".$time.", URL=".$path."'>");
	}

}