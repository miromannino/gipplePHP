<?php

	class System_Configuration {
		
		private static $sys_conf;
		private static $app_conf;
		
		public static function getSysConfig($conf){
			if(isset(self::$sys_conf[$conf])) return self::$sys_conf[$conf];
			if(!file_exists(SysPath . '/config/' . $conf . _Ext)) 
				throw new Exception('configuration name: ' . $conf, System_Error::E_CONFIG_SYSCONFIGNOTFOUND);
			$config = include_once(SysPath . '/config/' . $conf . _Ext);
			self::$sys_conf[$conf] = $config;
			return $config;
		}
		
		public static function getAppConfig($conf){
			if(isset(self::$sys_conf[$conf])) return self::$sys_conf[$conf];
			if(!file_exists(AppPath . '/config/system/' . $conf . _Ext)) 
				throw new Exception('configuration name: ' . $conf, System_Error::E_CONFIG_APPCONFIGNOTFOUND);
			$config = include_once(AppPath . '/config/system/' . $conf . _Ext);
			self::$sys_conf[$conf] = $config;
			return $config;
		}

	}
?>
