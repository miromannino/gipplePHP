<?php
	
	class System_Load {
		
		public static function Model($model){
			$app_config = System_Configuration::get('application');
			
			//path control
			$model = preg_replace(array('@^/+@','@/+$@','@/{2,}@'), array('','','/'), $model);
			if(!preg_match('/^([a-zA-Z0-9]+)(\/[a-zA-Z0-9]+)*$/', $model)) throw new Exception('' , System_Error::E_MODEL_INVALIDNAME);
			
			//path and class compose
			$path = _Path_Model . '/' . $model . _Ext;
			$class_name = str_replace('/', '_', $model);

			//existance control and inclusion
			if(file_exists($path)) include_once($path);
			else throw new Exception('model path: ' . $path, System_Error::E_MODEL_NOTFOUND);
			if(!class_exists($class_name)) throw new Exception('model class name: ' . $class_name, System_Error::E_MODEL_INVALIDMODEL);

			return new $class_name();
		}
		
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
			return new CachePHP_Cache(SysPath . '/cache');
		}
		
		public static function View(){
			return new System_View();
		}
		
	}
?>
