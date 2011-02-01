<?php

	require_once('application/config/system/main.php');

	//Performance Test
	/*
	require_once(AppPath . '/lib/Benchmark.php');
	$b_time = new Benchmark();
	$b_time->start();
	*/
	
	function ciccio($route){
		if ($route == 'ciaosonomiro') return 'my-class/textintemplate';
	}
	
	try{
		System_Router::setUsrRewriteFunction('ciccio');
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
