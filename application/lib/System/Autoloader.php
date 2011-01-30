<?php

	class System_Autoloader{
		
		static public function register(){
			ini_set('unserialize_callback_func', 'spl_autoload_call');
			spl_autoload_register(array(new self, 'autoload'));
		}

		static public function autoload($class){
			$file = AppPath . '/lib/' . str_replace('_', '/', $class) . _Ext;
			if(file_exists($file)) include_once($file);
		}
		
	}

?>
