<?php
	class evaluation{

		private $cate=null;
		private $nb_qs=null;
        private $base_qs=null;
		
	
		
		function __construct($cate, $nb_qs, $base_qs){
			$this->cate=$cate;
			$this->nb_qs=$nb_qs;
            $this->base_qs=$base_qs;
		}
		
		function getCate(){
			return $this->cate;
		}
		function getNbq(){
			return $this->nb_qs;
        }
        function getBaseQ(){
			return $this->base_qs;
        }
       
        //////////


		function setCate(string $cate){
			$this->cate=$cate;
		}
		function setNbq(string $nb_qs){
			$this->nb_qs=$nb_qs;
		}
        function setBaseQ(string $base_qs){
			$this->base_qs=$base_qs;
		}
    
	}


?>