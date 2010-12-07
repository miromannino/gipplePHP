<?php

	class Home extends System_Controller {
		
		public function __construct(){
			$this->view = System::loadView();
		}
		
		public function hello(){
			$this->view->display('index');
		}
	}
?>
