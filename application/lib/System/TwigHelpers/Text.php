<?php

	class System_TwigHelpers_Text{
		
		private $t;
		
		static public function text($f, $parser = ''){
			if(!isset($t)) $t = new Text();
			if(strlen($parser) == 0) return $t->get($f);
			else return $t->get($f, $parser);
		}
		
	}

?>
