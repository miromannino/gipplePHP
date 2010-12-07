<?php
	
	/* General path configuration ------------------------------------*/
	define('RootPath', realpath('.'));
	define('AppPath', RootPath . '/application');
	define('SysPath', RootPath . '/system');
	define('WebRoot', ''); //Root as seen by the client. 
							//If the root is the same of
						  //the server root value is '' 
	/* ---------------------------------------------------------------*/
	
	define('_Error_Display', true);
	
	//Performance Test
	/*
	require_once(SysPath . '/lib/Benchmark.php');
	$b_time = new Benchmark();
	$b_time->start();
	*/
	
	require_once(SysPath . '/config/main.php');
	
	try{
		System_Router::execute();
	}catch(Exception $ex){
		System_Error::showSystemError($ex->getMessage(), $ex->getCode());
	}
	
	//Performance Test
	/*
	$b_time->end();
	echo '<br/>' . $b_time->getSecondTime() . '<br/>';
	echo $b_time->getMemoryUsage();
	*/
?>
