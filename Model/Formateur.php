<?php 
    include_once 'C:\xampp\htdocs\mycruds\Model\User.php';

    class Formateur extends User
    {
        private $salaire=null;
        private $categorie=null;
        private $taux=null;
        private $id_formateur=null;

        public function __construct($id_formateur,$salaire,$categorie,$taux)
        {
            $this->id_formateur=$id_formateur;
            $this->salaire=$salaire;
            $this->categorie=$categorie;
            $this->taux=$taux;
            
        }

        //////////////////////////////////////////

        public function get_salaire()
        {
            return $this->salaire;
        }
        
        public function get_categorie()
        {
            return $this->categorie;
        }

        public function get_taux()
        {
            return $this->taux;
        }

        public function get_id_formateur()
        {
            return $this->id_formateur;
        }

        //////////////////////////////////////////////

        public function set_salaire($salaire)
        {
            $this->salaire=$salaire;
        }
        
        public function set_categorie($categorie)
        {
            $this->categorie=$categorie;
        }

        public function set_taux($taux)
        {
            $this->taux=$taux;
        }
        
        public function set_id_formateur($id_formateur)
        {
            $this->id_formateur=$id_formateur;
        }
    }
?>