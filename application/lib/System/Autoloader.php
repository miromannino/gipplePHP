<?php

	class System_Autoloader{
		
		static public function register(){
			ini_set('unserialize_callback_func', 'spl_autoload_call');
			spl_autoload_register(array(new self, 'autoload'));
		}

		static public function autoload($class){
			if (strpos($class, 'Controller_') === 0){
				$class_name = substr($class, 11);
				$file = AppPath . '/controller/' . str_replace('_', '/', $class_name) . _Ext;
            }else if (strpos($class, 'Model_') === 0){
				$class_name = substr($class, 6);
				$file = AppPath . '/model/' . str_replace('_', '/', $class_name) . _Ext;
			}else{
				$file = AppPath . '/lib/' . str_replace('_', '/', $class) . _Ext;
			}
			
			if(file_exists($file)) include_once($file);
		}
		
	}

?>
