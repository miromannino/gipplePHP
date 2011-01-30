<?php
	
	class System_Router {
		
		//The name of the get variable
		private static $route_rewrite;
		private static $route_index;
		
		public static function execute(){
			self::init();
			$route = self::getRoute();
			$needRep = true;
			$loopCount = _Router_LoopMax;
			
			while($loopCount > 0 && $needRep == true){
				$needRep = false;
				$route = trim($route, '/');
				//echo 'route: ' . $route . '<br>';
				
				if (strlen($route) == 0){
					//Index url in case of empty url
					$route = self::$route_index;
					$needRep = true;
				}else if(self::$route_rewrite != null){
					//Url rewrite
					foreach(self::$route_rewrite as $key => $value){
						if(preg_match($key, $route)){
							$route = preg_replace($key, $value, $route);
							$needRep = true;
							break;
						}
					}
				}
				
				$loopCount--;
			}
			
			if($loopCount <= 0) throw new Exception('' , System_Error::E_ROUTER_MAXLOOPCOUNTEXCEED);
			if(!preg_match('/^([a-zA-Z0-9_-]+)(\/[a-zA-Z0-9_-]+)*$/', $route)) throw new Exception('' , System_Error::E_ROUTER_INVALIDURL);
			$exp_route = explode('/', $route);
			
			$class_name = ucfirst($exp_route[0]);
			$class_name = preg_replace(array('/-([a-z]?)/e', '/_([a-z]?)/e'), array('strtoupper(\'\\1\')', 'strtoupper(\'_\\1\')'), $class_name);
			$class_path = _Path_Controller . '/' . str_replace('_', '/', $class_name) . _Ext;
			
			if(!file_exists($class_path)) throw new Exception('path: ' . $class_path, System_Error::E_ROUTER_CONTROLLERNOTFOUND);
			include_once($class_path);
			if(!class_exists($class_name)) throw new Exception('class name: ' . $class_name, System_Error::E_ROUTER_INVALIDCONTROLLER);
			$c = new $class_name();
			
			if(sizeof($exp_route) == 1){
				//in case exp_route==1 the url only specify the class and the router try to call _index

				//check if index exists
				if(!is_callable(array($c, _Controller_indexMethodName))) 
					throw new Exception('method name: ' . _Controller_indexMethodName, System_Error::E_ROUTER_CONTROLLERMETHODNOTFOUND);
					
				call_user_func_array(array($c, _Controller_indexMethodName), array());
			}else{
				//in case exp_route>1 the url specify the method name too
				$method_name = $exp_route[1] = preg_replace('/-([a-z]?)/e', 'strtoupper(\'\\1\')', $exp_route[1]);
				
				//check if method exists
				if(!is_callable(array($c, $method_name)))
					throw new Exception('method name: ' . $method_name, System_Error::E_ROUTER_CONTROLLERMETHODNOTFOUND);
					
				//if filter method exists then if it return true the method is called
				if(is_callable(array($c, _Controller_filterMethodName))){
					$argv = array_slice($exp_route, 2);
					if(call_user_func_array(array($c, _Controller_filterMethodName), array($method_name, &$argv))){
						call_user_func_array(array($c, $method_name), $argv);
					}
				}else{
					call_user_func_array(array($c, $method_name), array_slice($exp_route, 2));
				}
			}
		}
		
		private static function init(){
			$app_config = System_Configuration::get('application');
			
			if(isset($app_config['route_rewrite'])) 
				self::$route_rewrite = $app_config['route_rewrite'];
			else 
				self::$route_rewrite = null;
				
			if(isset($app_config['route_index'])) 
				self::$route_index = $app_config['route_index'];
			else
				self::$route_index = _Router_DefaultRouteIndex;
		}
		
		private static function getRoute(){
			if(isset($_SERVER['PATH_INFO'])) return $_SERVER['PATH_INFO']; else return '';
		}

	}
?>
