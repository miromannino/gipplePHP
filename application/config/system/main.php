<?php
	
	/*Application system configuration--------------------------------*/
	return array(
		/*Routing---------------------*/
		'route_index' => 'home/index',
		'route_rewrite' => array(
			'/pruno/' => 'my-class/main',
			'/(.*)\/main/' => 'classe/pippo',
			'/classe\/pippo/' => 'my-class/rewrite-end',
			'/my-class\/rewrite-end/e' => 'strtoupper(\'pruno\')',
			
			'/^multi-rewrite-example$/' => 'rewrite-number-1',
			'/^rewrite-number-5$/' => 'my-class/rewrite-end',
			'/^rewrite-number-([0-9])$/e' => '\'rewrite-number-\' . (\\1 + 1)',
		),
		
		/*Themes---------------------*/
		'default_theme' => 'default'
	);
	
?>
