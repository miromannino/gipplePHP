<?php
	
	/*Application system configuration--------------------------------*/
	return array(
		/*Routing---------------------*/
		'route_index' => 'home/hello',
		'route_rewrite' => array(
			'/pruno/' => 'my-class/main',
			'/(.*)\/main/' => 'classe/pippo',
			'/classe\/pippo/' => 'my-class/rewrite-end',
			'/my-class\/rewrite-end/e' => 'strtoupper(\'pruno\')',
			
			'/^multi-rewrite-example$/' => 'rewrite-number-1',
			'/^rewrite-number-5$/' => 'my-class/rewrite-end',
			'/^rewrite-number-([0-9])$/e' => '\'rewrite-number-\' . (\\1 + 1)',
		),
		
		'web_root' => '', //Root as seen by the client. If the root is the same of the server root value is ''
		'display_errors' => true, 
		
		/*Themes---------------------*/
		'default_theme' => 'default'
	);
	
?>
