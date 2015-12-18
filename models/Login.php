<?php

namespace app\models;
use app\classes\Db;

class Login {

	protected $db = '';

	public function __construct(){
		$this->db = new Db();
	}

	/******** Авторизуеся *********/

	public function trytologin($name, $pass){

		$sql = 'SELECT name, email, avatar, date FROM users WHERE (name=:name AND passwd=:pass) OR (email=:name AND passwd=:pass)';
			return $this->db->execute($sql, [':name' => $name, ':pass' => $pass]);
	}

	/******** Проверяем наличие пользователя в БД *********/

	public function selectuser($name) {

		$sql = 'SELECT name FROM users WHERE name=:name';
		return $this->db->execute($sql, [':name' => $name]);
	}

	/******** Регистрируемся *********/

	public function reguser($name, $email, $pass, $avatar) {

		$date = date('Y-m-d');
		$sql = 'INSERT INTO users VALUES ("",:name,:email,:pass,:avatar,"'.$date.'")';

		return $this->db->execute($sql, [':name' => $name, ':email' => $email, ':pass' => $pass, ':avatar' => $avatar],1);
	}


	
}