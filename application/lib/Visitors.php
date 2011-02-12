<?php
	
	class Visitors {
		
		private $pathCV;
		private $sessionName;
		
		public function __construct(){
			$config = System_Configuration::get('visitors');
			$this->pathCV = $config['source'];
			$this->sessionName = $config['session_name'];
		}
		
		public function inc(){
			@session_start();
			
			if (!isset($_SESSION[$this->sessionName])){
				$num = 1;
				
				if(!file_exists($this->pathCV)){
					file_put_contents($this->pathCV, '1', LOCK_EX);
					chmod($this->pathCV, 0666);
				}else{
					$num = (int)file_get_contents($this->pathCV);
					file_put_contents($this->pathCV, ++$num, LOCK_EX);
				}
				
				$_SESSION[$this->sessionName] = 1;
				
			}

		}
		
		public function getValue(){			
			if(!file_exists($this->pathCV)) return 1;
			return (int)file_get_contents($this->pathCV);
		}
	}

?>
