<?php
	
	class Benchmark {
		
		private $start;
		private $end;
		
		public function __construct(){
			$this->start = 0;
			$this->end = 0;
		}
		
		public function start(){
			$this->start = microtime();
		}
		
		public function end(){
			$this->end = microtime();
		}
		
		public function getTime($decimals = 4){
			if($this->start == 0 || $this->end == 0) throw new Exception('BENCHMARK_ERROR');
			$start = explode(' ', $this->start);
			$end = explode(' ', $this->end);
			return number_format(($end[0] + $end[1]) - ($start[0] + $start[1]), $decimals);
		}
		
		public function getTime_Second(){
			return $this->getTime(4) . ' s';
		}
		
		public function getMemoryUsage(){
			return number_format(memory_get_usage() / 1048576, 6) . ' MB';
		}
		
		
	}
?>
