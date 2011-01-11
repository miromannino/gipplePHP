<?php

	class System_View {
		
		public $twig;
		private $theme;
		private $webRoot;
		
		/*Public functions -----------------------------------------*/
		public function display($template, $variables = array()){
			$t = $this->twig->loadTemplate($template . _Template_Ext);
			$this->setVariables($variables);
			$t->display($variables);
		}
		
		public function render($template, $variables = array()){
			$t = $this->$twig->loadTemplate($template . _Template_Ext);
			$this->setVariables($variables);
			return $t->render($variables);
		}
		
		public function setTheme($name){
			$this->theme = $name;
		}
		
		public function getTheme(){
			return $this->theme;
		}
		/*------------------------------------------------------------*/
		
		public function __construct(){
			//loading configurations
			$app_config = System_Configuration::get('application');
			$twig_config = System_Configuration::get('twig');
			
			//set default theme
			if(isset($app_config['default_theme']))
				$this->theme = $app_config['default_theme'];
			else
				$this->theme = '';
				
			//web_root
			if(isset($app_config['web_root']))
				$this->webRoot = $app_config['web_root'];
			else
				$this->webRoot = '';
			
			//other configurations
			$config = array();
			if($twig_config['cache']){
				$config['cache'] = SysPath . '/cache/twig';
				$config['auto_reload'] = true;
				$config['strict_variables'] = true;
				if(!is_writable($config['cache'])){
					throw new Exception('path: ' . $config['cache'], System_Error::E_MAIN_FOLDERNOTWRITABLE);
				}
			}
			
			//creating twig object
			$loader = new Twig_Loader_Filesystem(_Path_View);
			$this->twig = new Twig_Environment($loader, $config);
			
			//loading extensions
			if($twig_config['i18n_extension'])
				$this->twig->addExtension(new Twig_Extension_I18n());
				
			if($twig_config['escaper_extension'])
				$this->twig->addExtension(new Twig_Extension_Escaper(true));
				
			//configuring syntax
			$lexer = new Twig_Lexer($this->twig, $twig_config['syntax']);
			$this->twig->setLexer($lexer);
		}
		
		private function setVariables(&$variables){
			$variables['ThemeName'] = $this->theme;
			$variables['WebRoot'] = $this->webRoot;
		}
		
	}
?>
