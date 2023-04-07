<?php
	class reclamation{

		private $titre=null;
		private $contenue=null;
		private $nom_immuteur=null;
        private $nom_recepteur=null;
	
		
		function __construct($titre, $contenue, $nom_immuteur, $nom_recepteur){
			$this->titre=$titre;
			$this->contenue=$contenue;
            $this->nom_immuteur=$nom_immuteur;
            $this->nom_recepteur=$nom_recepteur;
            
		}
		
		function getTitre(){
			return $this->titre;
		}
		function getContenue(){
			return $this->contenue;
		}
        function getImmuteur(){
			return $this->nom_immuteur;
		}
        function getRecepteur(){
			return $this->nom_recepteur;
		}
       
        //////////


		function setTitre(string $titre){
			$this->titre=$titre;
		}
		function setContenue(string $contenue){
			$this->contenue=$contenue;
		}
        function setImmuteur(string $nom_immuteur){
			$this->nom_immuteur=$nom_immuteur;
		}
        function setRecepteur(string $nom_recepteur){
			$this->nom_recepteur=$nom_recepteur;
		}
    
	}


?>