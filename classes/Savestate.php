<?php

namespace app\classes;
					/********* Для статических методов. Здесь сохраняем/удаляем куки и сессии. *********/
					
class Savestate {
	
	static function savesession($name,$password){
		$_SESSION['username'] = base64_encode($name);
		$_SESSION['password'] = base64_encode($password);
		return true;
	}

	static function savecookie($name,$password){

		// ставим куки на 10 часов
		
		return  ( setcookie ("username", base64_encode($name), time()+36000) &&
		setcookie ("password", base64_encode($password), time()+36000) ) ? true : false;

	}

	static function savelanguage($lang){
		setcookie ("lang", base64_encode($lang), time()+36000);
	}

	static function deletestate(){

		// удаляем сессию и куки
		$_SESSION = array();
		return ( setcookie ("username", "false", time()-36000) &&
		setcookie ("password", "false", time()-36000) ) ? true : false;

	}
}