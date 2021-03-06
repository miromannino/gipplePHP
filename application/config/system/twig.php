<?php
	
	/* Twig configuration ----------------------------*/
	return array(
	
		'autoescape' => false,
		
		'cache' => true,
		'i18n_extension' => false,
		'escaper_extension' => false,
		
		'syntax' => array(
			'tag_comment' => array('<%#', '%>'),
			'tag_block' => array('<%', '%>'),
			'tag_variable' => array('<%=', '%>')
		),
		
		'helpers' => true
		
	);
	
?>
