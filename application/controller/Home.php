<?php

	class Controller_Home {
		
		public function __construct(){
			$this->view = System_Load::View();
		}
		
		public function hello(){
			$this->view->display('index');
		}
	}
?>
