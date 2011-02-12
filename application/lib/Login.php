<?php
	
	define('PasswdPath', RootPath . '/config/passwd.xml');
	
	class Login {
		
		private $passwdPath;
		
		public function __construct(){
			$config = System_Configuration::get('login');
			$this->passwdPath = $config['passwd_path'];
		}
		
		public function doLogin($usr, $psw, $captcha) {
			
			//controllo captcha
			$c = new Securimage_Captcha();
			if (!$c->check($captcha)) return -1;
			
			//controllo password
			$usr = htmlspecialchars(strtolower($usr), ENT_QUOTES);
			$psw = htmlspecialchars(strtolower($psw), ENT_QUOTES);
			$passwd = new DOMDocument();
			$passwd->load($this->passwdPath);
			$query = new DOMXPath($passwd);
			$ris = $query->query('//user[name =\'' . $usr . '\' and password =\'' . $psw . '\']');
			if ($ris->length == 1) {
				if(session_id() == '') session_start(); 
				$_SESSION['user'] = $ris->item(0)->getElementsByTagName('name')->item(0)->nodeValue;
				$_SESSION['realname'] = $ris->item(0)->getElementsByTagName('realname')->item(0)->nodeValue;
				return 0;
			}else{
				return -2;
			}
		}

		public function checkLogged() {
			if(session_id() == '') session_start(); 
			return isset($_SESSION['user']);
		}
		
		public function logOut() {
			if(session_id() == '') session_start(); 
			@session_destroy();
		}
		
	}
?>
