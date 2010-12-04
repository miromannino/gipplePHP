<?php
	
	/* exception handler*/
	function _system_errorHandler($errno, $errstr, $errfile, $errline){
		System_Error::showPHPError($errno, $errstr, $errfile, $errline);
	}
	
	/* Fatal error handler, workaround for php5 that not call the error handler in fatal errors*/
	function _system_shutdownFunction(){
		$error = error_get_last(); 
		if ($error['type'] == 1)
			System_Error::showPHPError($error['type'], $error['message'], $error['file'], $error['line']);
	} 
	
	class System_Error {
		
		const E_ROUTER_INVALIDCONTROLLER = 1;
		const E_ROUTER_CONTROLLERNOTFOUND = 2;
		const E_ROUTER_MAXLOOPCOUNTEXCEED = 3;
		const E_ROUTER_INVALIDURL = 4;
		const E_ROUTER_CONTROLLERMETHODNOTFOUND = 5;
		const E_CONFIG_APPCONFIGNOTFOUND = 50;
		const E_CONFIG_SYSCONFIGNOTFOUND = 51;
		const E_MODEL_INVALIDNAME = 100;
		const E_MODEL_NOTFOUND = 101;
		const E_MODEL_INVALIDMODEL = 102;
		const E_DATABASE_NOTFOUND = 150;
		const E_DATABASE_WRONGCONFIG = 151;
		
		public static function showSystemError($message, $type){
			$errors = include(SysPath . '/config/errors' . _Ext);
			
			if($type > 0 && $type < 50){
				//is a router error
				header("HTTP/1.0 404 Not Found");
			}else{
				//other error
				header("HTTP/1.0 500 Internal Server Error");
			}
			
			$type = isset($errors[$type]) ? $errors[$type] : $type;
			echo '<div style="border: 1px solid #FF0000; padding-left: 20px; margin: 10px 2px 10px 2px;">';
			echo '<p style="font-weight:bold; font-size:18px;">System Exception</p>';
			if($type != 0) echo '<p style="font-weight:bold; font-size:16px;">' . $type . '</p>';
			if(strlen($message) > 0) echo '<p style="font-weight:normal; font-size:16px;">' . $message . '</p>';
			echo '</div>';
		}
		
		public static function showPHPError($errno, $errstr, $errfile, $errline){
			if($errno == E_ERROR) $errno = 'Fatal';
			else if($errno == E_WARNING) $errno = 'Warning';
			else if($errno == E_NOTICE) $errno = 'Notice';
			else $errno = 'Unknown';
			
			echo '<div style="border: 1px solid #FF0000; padding-left: 20px; margin: 10px 2px 10px 2px;">';
			echo '<p style="font-weight:bold; font-size:18px;">PHP Exception</p>';
			echo '<p style="font-weight:normal; font-size:16px;">Severity: ' . $errno . '</p>';
			echo '<p style="font-weight:normal; font-size:16px;">Message: ' . $errstr . '</p>';
			echo '<p style="font-weight:normal; font-size:16px;">From: ' . $errfile . ':' . $errline . '</p>';
			echo '</div>';
		}
	
		public static function set_handler(){
			error_reporting(E_ALL);
			ini_set('display_errors', 0);
			set_error_handler('_system_errorHandler', E_ALL);
			register_shutdown_function('_system_shutdownFunction');
		}
		
	}
?>
