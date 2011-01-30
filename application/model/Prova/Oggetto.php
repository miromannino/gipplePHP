<?php
	class Prova_Oggetto {
		
		public function __construct(){
			$this->db1 = System_Load::Database('db1');
			echo "caricamento database effettuato<br/>";
		}
		
		public function insertOggetto($ogetto){
			echo 'inserimento ogetto<br>';
			print_r($this->db1->exec("create table osnoinomn ( id integer )"));
		}
		
	}
	
?>
