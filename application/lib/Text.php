<?php
	class Text {
		
		private $base;
		private $cache;
		
		public function __construct($base = ''){
			if (strlen($base) == 0){
				$this->base = RootPath . '/resource/text';
			}else{
				$this->base = $base;
			}
			
			$this->cache = System_Load::Cache();
			
			if(!file_exists($this->base)) throw new Exception('Text: text folder not exists');
		}
		
		public function get($name, $type = 'markdown'){
			$filepath = $this->base . '/' . $name;
			if(!file_exists($filepath)) throw new Exception('Text: file not found');
			$cont = file_get_contents($filepath);
			if($cont === FALSE) throw new Exception('Text: file not found');
						
			if($type === 'markdown'){
				$this->cache->setKey('text/markdown/' . $name);
				$this->cache->setDependance($this->base . '/' . $name);
				if(!$this->cache->get($txt)){
					$mp = new Markdown_Parser();
					$txt = $mp->transform($cont);
					$this->cache->put($txt);
				}
				return $txt;
			}else if($type === 'markdown-extra'){
				$this->cache->setKey('text/markdown-extra/' . $name);
				$this->cache->setDependance($this->base . '/' . $name);
				if(!$this->cache->get($txt)){
					$mp = new MarkdownExtra_Parser();
					$txt = $mp->transform($cont);
					$this->cache->put($txt);
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

