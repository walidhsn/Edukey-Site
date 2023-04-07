<?php
	class offer{
	
		private $id_formation;
		private $pourcentage;
		private $price_before;
		private $price_after;
        
		public function __construct($id_formation,$pourcentage,$price_before,$price_after)
        {
			$this->id_formation=$id_formation;
			$this->pourcentage=$pourcentage;
			$this->price_before=$price_before;
			$this->price_after=$price_after;
		}
        //********************************************************* 
		public function get_id_formation(){
			return $this->id_formation;
		}
		public function get_pourcentage(){
			return $this->pourcentage;
		}
		public function get_price_before(){
			return $this->price_before;
		}
		public function get_price_after(){
			return $this->price_after;
		}
        //********************************************************** 
		function set_id_formation($id_formation){
			$this->id_formation=$id_formation;
		}
		function set_pourcentage($pourcentage){
			$this->pourcentage=$pourcentage;
		}
		function set_price_before( $price_before){
			$this->price_before=$price_before;
		}
		function set_price_after($price_after){
			$this->price_after=$price_after;
		}
	}
?>