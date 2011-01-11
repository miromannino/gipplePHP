<?php

	class Prova_MyClass extends System_Controller {
		
		private function privateFunction(){
			//this function can't be called
			echo "private";
		}
		
		function _index(){
			echo 'chiamata classe senza specificare una funzione, funzioni disponibili: <br>';
			echo '- funzione($p1,$p2,$p3) per provare a passare meno o più parametri<br>';
			echo '- oggetto() per provare il model<br>';
			echo '- tema($tema) per provare il tema<br>';
		}
		
		function parametri($p1='',$p2 = '',$p3=''){
			echo "ciao $p1 $p2 $p3 <br>";
		}
		
		function get(){
			echo 'prova get[ciccio] = ' . $_GET['ciccio'] . '<br/>';
		}
		
		function ancore(){
			echo '<a name="uno"></a>prova uno<br/><br/><br/><br/><br/><br/><br/><br/>';
			echo '<a name="due"></a>prova due<br/><br/><br/><br/><br/><br/><br/><br/>';
			echo '<a name="tre"></a>prova tre<br/><br/><br/><br/><br/><br/><br/><br/>';
			echo '<a name="quattro"></a>prova quattro<br/><br/><br/><br/><br/><br/><br/><br/>';
			echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
			echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
		}
		
		function fatalError(){
			$c->cia();
		}
		
		function oggetto(){
			$Ogetto = System_Load::Model('Prova/Oggetto');
			//$Ogetto->insertOggetto('dsicn');
		}
		
		function tema($tema = 'default'){
			$this->view->setTheme($tema);
			$this->view->display('home', array());
			
		}
		
		function text($c){
			$t = new Text();
			switch($c){
				case 1:
					echo $t->tranformText('doc/01-Introduction.markdown');
				break;
				case 2:
					echo $t->tranformText('doc/02-Twig-for-Template-Designers.markdown');
				break;
				case 3:
					echo $t->tranformText('doc/03-Twig-for-Developers.markdown');
				break;
				case 4:
					echo $t->tranformText('doc/04-Extending-Twig.markdown');
				break;
				case 5:
					echo $t->tranformText('doc/05-Hacking-Twig.markdown');
				break;
				case 5:
					echo $t->tranformText('doc/06-Recipes.markdown');
				break;
			}
			
		}
		
		/*function _filter($nomefunzione){
			echo 'si voleva chiamare la funzione: ' . $nomefunzione . 'ma è stata bloccata';
		}*/
	}
?>
