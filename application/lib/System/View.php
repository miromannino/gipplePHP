<?php

	class System_View {
		
		public $twig;
		private $theme;
		private $webRoot;
		
		/*Public functions -----------------------------------------*/
		public function display($template, $variables = array()){
			$t = $this->twig->loadTemplate($template . _Template_Ext);
			$t->display($variables);
		}
		
		public function render($template, $variables = array()){
			$t = $this->$twig->loadTemplate($template . _Template_Ext);
			return $t->render($variables);
		}
		
		public function setTheme($name){
			$this->theme = $name;
			$this->twig->addGlobal('ThemeName', $this->theme);
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
				$config['cache'] = AppPath . '/cache/twig';
				$config['auto_reload'] = true;
				
				if(!file_exists($config['cache'])){
					if(! @mkdir($config['cache'], 0777, true)) throw new Exception('path: ' . AppPath . '/cache', System_Error::E_MAIN_FOLDERNOTWRITABLE);
				}
				
				if(!is_writable($config['cache'])){
					throw new Exception('path: ' . $config['cache'], System_Error::E_MAIN_FOLDERNOTWRITABLE);
				}
			}
			
			$config['strict_variables'] = true;
			$config['autoescape'] = $twig_config['autoescape'];
			
			//creating twig object
			$loader = new Twig_Loader_Filesystem(_Path_View);
			$this->twig = new Twig_Environment($loader, $config);
			
			
			//cofiguring globals
			$this->twig->addGlobal('ThemeName', $this->theme);
			$this->twig->addGlobal('WebRoot', $this->webRoot);
						
			//configuring extensions
			if($twig_config['i18n_extension'])
				$this->twig->addExtension(new Twig_Extension_I18n());
				
			if($twig_config['escaper_extension'])
				$this->twig->addExtension(new Twig_Extension_Escaper(true));
				
			//configuring helpers
			if($twig_config['helpers']){
				$this->twig->addFunction('text', new Twig_Function_Function('System_TwigHelpers_Text::text', array('is_safe' => array('html'))));
			}
				
			//configuring syntax
			$lexer = new Twig_Lexer($this->twig, $twig_config['syntax']);
			$this->twig->setLexer($lexer);
			
		}
		
	}
?>
