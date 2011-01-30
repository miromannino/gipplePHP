<?php
	
	/* Twig configuration ----------------------------*/
	return array(
		'cache' => true,
		'i18n_extension' => false,
		'escaper_extension' => false,
		
		'syntax' => array(
			'tag_comment' => array('<%#', '%>'),
			'tag_block' => array('<%', '%>'),
			'tag_variable' => array('<%=', '%>')
		),
		
		'text_helper' => true
		
	);
	
?>
