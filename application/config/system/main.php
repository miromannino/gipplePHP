<?php
	
	/* Path -------------------------------------------*/
	define('RootPath', realpath('.'));
	define('AppPath', RootPath . '/application');
	
	/* Extra ------------------------------------------*/
	define('_Ext', '.php'); //php file extensions
	define('_Template_Ext', '.html'); //template file extensions

	/* Router ---------------------------------------- */
	define('_Router_LoopMax', 10);
	define('_Router_DefaultCaseSensitive', false);
	define('_Router_DefaultRouteIndex', 'home');
	
	/* Controller ------------------------------------ */
	define('_Controller_indexMethodName', '_index'); //function to call in case of a path that contains only class name
	define('_Controller_filterMethodName', '_filter'); //if defined this function is called instead normal function
	
	/* Model -------------------------------------------------------- */
	define('_Model_DB_Config_usr', 'user');
	define('_Model_DB_Config_psw', 'password');
	define('_Model_DB_Config_dsn', 'dsn');
	define('_Model_DB_Config_opt', 'pdo_option');
	
	/* MVC ------------------------------------------- */
	define('_Path_Controller', AppPath . '/controller');
	define('_Path_Model', AppPath . '/model');
	define('_Path_View', AppPath . '/view');
	
	/* Autoloader -------------------------------------*/
	require_once(AppPath . '/lib/System/Autoloader' . _Ext);
	System_Autoloader::register();
	
	/* Errors -----------------*/
	System_Error::set_handler();
	
	/* Cache folder -----------------------------------*/
	if(!is_writable(AppPath . '/cache')){
		System_Error::showSystemError('path: ' . AppPath . '/cache', System_Error::E_MAIN_FOLDERNOTWRITABLE);
		exit();
	}
?>
