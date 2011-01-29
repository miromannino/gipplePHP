<?php

	class System_TwigHelpers_Text{
		
		static public function text($f){
			$t = new Text();
			return $t->get($f);
		}
		
	}

?>
