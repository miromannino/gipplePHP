<?php

	class System_Configuration {
		
		private static $cache;
		
		public static function get($conf){
			if(isset(self::$cache[$conf])) return self::$cache[$conf];
			if(!file_exists(SysPath . '/config/' . $conf . _Ext)) 
				throw new Exception('configuration name: ' . $conf, System_Error::E_CONFIG_SYSCONFIGNOTFOUND);
			$config = include_once(SysPath . '/config/' . $conf . _Ext);
			self::$cache[$conf] = $config;
			return $config;
		}
		
	}
?>
