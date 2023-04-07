<?php
	class Cours{
	
		private $nomCours;
		private $idformation;
		private $nbrPage;
		private $dateCreation;
		private $dateModification;
        

		public function __construct($nomCours,$idformation,$nbrPage, $dateCreation, $dateModification){
			
			$this->nomCours=$nomCours;
			$this->idformation=$idformation;
			$this->nbrPage=$nbrPage;
			$this->dateCreation=$dateCreation;
			$this->dateModification=$dateModification;
		}
		public function getIdCours(){
			return $this->idCours;
		}
		
		public function get_idformation(){
			return $this->idformation;
		}

		public function getNomCours(){
			return $this->nomCours;
		}
		 public function getNbrPage(){
			return $this->nbrPage;
		}
		public function getDateCreation(){
			return $this->dateCreation;
		}
		public function getDateModification(){
			return $this->dateModification;
		}
		function setIdCours($idCours){
			$this->idCours=$idCours;
		}
		function setNomCours($nomCours){
			$this->nomCours=$nomCours;
		}

		function set_idformation($idformation){
			$this->idformation=$idformation;
		}

		function setNbrPage($nbrPage){
			$this->nbrPage=$nbrPage;
		}
		function setDateCreation( $dateCreation){
			$this->dateCreation=$dateCreation;
		}
		function setDateModification($DateModification){
			$this->dateModification=$DateModification;
		}
		
	}


?>