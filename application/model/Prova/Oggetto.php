<?php
	class Prova_Oggetto {
		
		public function __construct(){
			$this->db1 = System::loadDatabase('db5');
			echo "caricamento database effettuato<br/>";
		}
		
		public function insertOggetto($ogetto){
			echo 'inserimento ogetto<br>';
			//ciccio();
			print_r($this->db1->exec("create table osnoinomn ( id integer )"));
		}
		
	}
	
?>
