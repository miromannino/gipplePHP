<?php

	require_once('system/config/system/main.php');

	//Performance Test
	/*
	require_once(SysPath . '/lib/Benchmark.php');
	$b_time = new Benchmark();
	$b_time->start();
	*/
	
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
