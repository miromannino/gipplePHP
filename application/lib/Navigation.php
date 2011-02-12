<?php
	class Navigation {
		
		public function __construct(){
			$config = System_Configuration::get('navigation');
			$app_config = System_Configuration::get('application');
			$this->webroot = (isset($app_config['web_root'])?$app_config['web_root']:'');
			$this->navPath = $config['navigation-xml'];
			$this->navXSLPath = $config['navigation-xsl'];
		}
		
		public function get($id = ''){
			
			$c = System_Load::Cache();
			$c->setKey('xml-res/navigation-' . $id);
			$c->setDependance(array($this->navPath, $this->navXSLPath));
	
			if(!$c->get($ris)){
				$xml = new DOMDocument();
				$xml->load($this->navPath);
				
				$xpath = new DOMXPath($xml);
				$res = $xpath->query('//item[@id = \'' . $id . '\']');
				if($res->length == 0){
					$c->setKey('xml-res/navigation', false);
					if($c->get($ris)) return $ris;
				}
				
				$xsl = new DOMDocument();
				$xsl->load($this->navXSLPath);
		
				$proc = new XSLTProcessor();
				$proc->importStyleSheet($xsl);
				$proc->setParameter('', 'webroot', $this->webroot);
				$proc->setParameter('', 'selected', $id);
				
				$c->put($ris = $proc->transformToXml($xml));
			}
			
			return $ris;
		}
	}
?>
