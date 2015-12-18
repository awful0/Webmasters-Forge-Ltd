<?php

namespace app\classes;
		/********* Для статических методов. Здесь проверяем все переменные, которые были нам переданы  *********/
class Check {
	
	static function checkusername($name){
	
		return ((preg_match('/^[a-zA-Z0-9_-]{4,15}$/', $name)))? true : false;
		
	}

	static function checkemail($email){

		return ((preg_match('/^[a-z0-9_-]{2,20}@[a-z0-9_-]{2,30}\.[a-z]{2,8}$/i', $email)))? true : false;
	}


	
	/************* 
		В БД пароль попадет в md5 хэше, его с сайта не проверяем, но проверить хэш, который приходит с сессии или кук - необходимо.
	**************/

	static function checkhash($hash){

		return ((preg_match('/^[a-z0-9]{32}$/', $hash)))? true : false;
	}


	static function checkimage($data,$dir,$user){
	
		// Грузим не более 100Кб (1024 * 100)

		if ($data['size']>102400) 
			return false;

		// ДАЛЕЕ проверяем что вообще пытается грузить юзер

		$typefile=$data['type'];
		if (!preg_match('/^image\/(jpeg|gif|png)$/i', $typefile))
			return false;
		

		$namesIMG=basename($data['name']);
		if (!preg_match('/^[a-zа-яе0-9_-]{1,30}\.(jpg|jpeg|gif|png)$/iu', $namesIMG))
		 	return false;

		$massR=explode('/', $typefile);
		if (!preg_match('/^(jpeg|gif|png)$/i', $massR[1]))
			return false;
		

		if(!mkdir($dir, 0777))
			return false;
		
		$newNameFile=$user.date("dmYHis").".".$massR[1]; // новое имя картинки
		$newNameFileDir=$dir.$newNameFile; // полный путь к файлу
		
		
		return array(
			"newName"  => $newNameFile,
			"fullDir"  => $newNameFileDir,
		);
		
	}

}
