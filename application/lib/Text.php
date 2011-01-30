<?php
	class Text {
		
		public function __construct($base = ''){
			if (strlen($base) == 0){
				$this->base = RootPath . '/resource/text';
			}else{
				$this->base = $base;
			}
			if(!file_exists($this->base)) throw new Exception('Text: text folder not exists');
		}
		
		public function get($name, $type = 'markdown'){
			if($type === 'markdown'){
				$t = System_Load::Cache();
				$t->setKey('text/markdown/' . $name);
				$t->addDependance($this->base . '/' . $name);
				if(!$t->get($txt)){
					$mp = new Markdown_Parser();
					$txt = $mp->transform(file_get_contents($this->base . '/' . $name));
					$t->put($txt);
				}
				return $txt;
			}else if($type === 'markdown-extra'){
				$t = System_Load::Cache();
				$t->setKey('text/markdown-extra/' . $name);
				$t->addDependance($this->base . '/' . $name);
				if(!$t->get($txt)){
					$mp = new MarkdownExtra_Parser();
					$txt = $mp->transform(file_get_contents($this->base . '/' . $name));
					$t->put($txt);
				}
				return $txt;
			}else{
				throw new Exception('Text: unsupported text');
			}
		}
		
		public function show($name, $type = 'markdown'){
			echo $this->get($name, $type);
		}
	}
?>
