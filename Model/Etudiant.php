<?php
    include_once 'C:\xampp\htdocs\mycruds\Model\User.php';

    class Etudiant extends User{
        private $montant = null;
        private $nb_formation = null;
        private $id_etudiant = null;
        
        public function __construct($id_etudiant,$montant,$nb_formation)
        {
            $this->id_etudiant=$id_etudiant;
            $this->montant=$montant;
            $this->nb_formation=$nb_formation;
        }

        //////////////////////////////////////////////////

        public function get_montant()
        {
            return $this->montant;
        }

        public function get_nb_formation()
        {
            return $this->nb_formation;
        }

        public function get_id_etudiant()
        {
            return $this->id_etudiant;
        }

        ////////////////////////////////////////////////

        public function set_montant($montant)
        {
            $this->montant=$montant;
        }

        public function set_nb_formation($nb_formation)
        {
            $this->nb_formation=$nb_formation;
        }

        public function set_id_etudiant($id_etudiant)
        {
            $this->id_etudiant=$id_etudiant;
        }
    }
?>