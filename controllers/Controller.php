<?php

namespace app\controllers;
use app\models\Login;
use app\classes\Funct;
use app\classes\Savestate;
use app\classes\Check;
use app\classes\View;

class Controller {
	
	protected $langMass = [];
	protected $username = '';
	protected $password = '';

	public function __construct(){
		
		/********** 
					Проверяем наличие кук с переменной lang, 
					в которой содержится шифрованное название языка
		**********/
		$lang = (!empty($_COOKIE['lang'])) ? base64_decode($_COOKIE['lang']) : 'ru';
		
		/********** 
					А здесь достаем все в массив
		**********/
		$this->langMass = parse_ini_file(__DIR__."/../config/".$lang.".ini");

		/********** 
					Ставим переменные 
		**********/

		$this->username = (!empty($_SESSION['username'])) ? $_SESSION['username'] : ((!empty($_COOKIE['username'])) ? $_COOKIE['username'] : 'guest');

		$this->password = (!empty($_SESSION['password'])) ? $_SESSION['password'] : ((!empty($_COOKIE['password'])) ? $_COOKIE['password'] : 'guest');
	}

	public function run(){

		$objUser = new Login;
		$view = new View;

		/********** 
					Авторизация пользователя по логину или email, с паролем
		**********/

		if (!empty($_POST['login'])){

			(!empty($_POST['token'])) ? 
				($_POST['token']!=$_SESSION['token'] && $view->displayexit('/', 0)) : exit();
				
			$name = (!empty($_POST['name'])) ? $_POST['name'] : false;
			$password = (!empty($_POST['password'])) ? md5($_POST['password']) : false;
			
		/********** 
					Проверяем пользователя с таким именем/email и паролем
					в переменной name содержится или имя или email
		**********/

			if( Check::checkusername($name) || Check::checkemail($name) ){
				if ($objUser->trytologin($name,$password)){

		/********** 
					При успешной проверке сохраняем имя и пароль в сессии или куках
		**********/

					(!empty($_POST['scookies'])) ? 
							(($_POST['scookies']=='yes')? Savestate::savecookie($name,$password): exit()) : Savestate::savesession($name,$password);

					$view->displayexit('/', 0);

				} else {
					$view->display($this->langMass, [], 'reg', $this->langMass['ERRINFO1']);
					$view->displayexit('/', 3);
				}
				
			}else{
				
				$view->display($this->langMass, [], 'reg', $this->langMass['ERRINFO2']);
				$view->displayexit('/', 3);
			}
		}


		/**********
					регистрируем пользователя
		**********/

		if (!empty($_POST['registration'])){

			$regYes = true;
			(!empty($_POST['token'])) ? 
				($_POST['token']!=$_SESSION['token'] && exit()) : exit();
			$name = (!empty($_POST['name'])) ? $_POST['name'] : $regYes = false;
			$email = (!empty($_POST['email'])) ? $_POST['email'] : $regYes = false;
			$password = (!empty($_POST['password'])) ? $_POST['password'] : false;
			$imageTempName = (!empty($_FILES['image']["tmp_name"])) ? $_FILES['image']["tmp_name"] : $regYes = false;


			if($regYes && Check::checkusername($name) && Check::checkemail($email)){
				
		/**********
					перед тем как вставить в БД, создать дирректорию и загрузить файл, проверим существование этого юзера в БД
		**********/

				if($objUser->selectuser($name)){
					$view->display($this->langMass, [], 'reg', $this->langMass['ERRINFO5']);
					$view->displayexit('/', 3);
				}

				/********** 
							Проверка файла и его загрузка 
				**********/

				$avatar = $_FILES['image'];
				if(is_uploaded_file($imageTempName)){
						
					$dir = dirname(__file__).'/../images/users/'.$name.'/';

					$returnMass=Check::checkimage($avatar, $dir, $name);

					if (!$returnMass){
						$view->display($this->langMass, [], 'reg', $this->langMass['ERRINFO4']);
							$view->displayexit('/', 3);
					}else{
						
						$newName=$returnMass['newName'];
						$fullDir=$returnMass['fullDir'];
						$newWidth = 280;
						
						if (Funct::imgresize($imageTempName, $newWidth, $fullDir)){

							chmod($fullDir, 444);
					
					/********** 
								Хешируем  пароль и заносим в в БД 
					**********/

							$password = md5($password);

							if ($objUser->reguser($name, $email, $password, $newName)){

								$view->display($this->langMass, [], 'reg', '', $this->langMass['REGINFO']);
								$view->displayexit('/', 3);

							}else {
								$view->display($this->langMass, [], 'reg', $this->langMass['ERRINFO7']);
								$view->displayexit('/', 3);
							}
						}
					}
				}
			}
			else {
				
				$view->display($this->langMass, [], 'reg', $this->langMass['ERRINFO6']);
				$view->displayexit('/', 3);
			}
		}	

		/************ 
						Если пользователь авторизован то грузим его страницу, иначе страницу авторизации 
		**********/

		if ($this->username!='guest'){
			
			/***** 

			Здесь можно развить далее тему если есть GET параметр например user то ходим по ссылкам название сайта/имя пользователя
			в .htaccess пишем
			RewriteRule ^user/(\w|[0-9_-]){4,15}/?$ index.php?user=$1
			и здесь пишем уловие if(!empty($_GET['user'])) и так далее, тем много, заданий много и это уже не по условию задачи.

			*****/

			$this->username=base64_decode($this->username);
			$this->password=base64_decode($this->password);

			if( ( Check::checkusername($this->username) || Check::checkemail($this->username) ) && Check::checkhash($this->password) ){
				if ($resultMassUser = $objUser->trytologin($this->username, $this->password)){
					
					$view->display($this->langMass, $resultMassUser, 'users');
				}
			}else 
				exit($this->langMass['ERRINFO3']);
		} else {
			$view->display($this->langMass);
		}
		
		/************ 
						Разлогиниваем пользователя 
		************/

		if(!empty($_GET['reg']) && $_GET['reg']=='false') {
			Savestate::deletestate();
			$view->displayexit('/', 0);
		}

		/************ 
						Смена языка и заносим переменную в куки 
		************/

		if(!empty($_GET['lang'])) {
			Savestate::savelanguage($_GET['lang']);
			$view->displayexit('/', 0);
		}

	}

}
