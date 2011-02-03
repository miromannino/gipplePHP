<?php
	
	class System_Load {
		
		public static function Database($db_name){
			$db_config = System_Configuration::get('database');
			
			//check if configuration exist
			if(!isset($db_config[$db_name])) throw new Exception('db name: ' . $db_name, System_Error::E_DATABASE_NOTFOUND);
			
			//configuration control
			if(!isset($db_config[$db_name]['dsn']) 
			|| !isset($db_config[$db_name]['usr']) 
			|| !isset($db_config[$db_name]['psw'])
			) throw new Exception('db name: ' . $db_name, System_Error::E_DATABASE_WRONGCONFIG);
			
			//create PDO Object
			if (isset($db_config[$db_name]['opt'])){
				return new PDO($db_config[$db_name]['dsn'], 
							   $db_config[$db_name]['usr'],
							   $db_config[$db_name]['psw'],
							   $db_config[$db_name]['opt']);
			}else{
				return new PDO($db_config[$db_name]['dsn'], 
							   $db_config[$db_name]['usr'],
							   $db_config[$db_name]['psw']);
			}
		}
		
		public static function Cache(){
			return new CachePHP_Cache(AppPath . '/cache');
		}
		
		public static function View(){
			return new System_View();
		}
		
	}
?>
