<?php
    class Formation{
        private $nom=null;
        private $prix=null;
        private $nb_cour=null;
        private $categorie=null;
        private $taux=null;
        private $temp=null;
        private $date_creation=null;
        private $description=null;
        private $editor=null;
        public function __construct($nom,$categorie,$nb_cour,$temp,$prix,$taux,$date_creation,$description,$editor)
        {
            $this->nom=$nom;
            $this->categorie=$categorie;
            $this->nb_cour=$nb_cour;
            $this->temp=$temp;
            $this->prix=$prix;
            $this->taux=$taux;
            $this->date_creation=$date_creation;
            $this->description=$description;
            $this->editor=$editor;
        }
        /////////////////////////////////////////////////////////
    
        public function get_nom()
        {
            return $this->nom;
        }
        public function get_editor()
        {
            return $this->editor;
        }
        public function get_date_creation()
        {
            return $this->date_creation;
        }

        public function get_categorie()
        {
            return $this->categorie;
        }

        public function get_nb_cour()
        {
            return $this->nb_cour;
        }

        public function get_temp()
        {
            return $this->temp;
        }

        public function get_prix()
        {
            return $this->prix;
        }

        public function get_taux()
        {
            return $this->taux;
        }
        
        public function get_description()
        {
            return $this->description;
        }
        ///////////////////////////////////////////////////////////
        
        public function set_nom($nom)
        {
            $this->nom=$nom;
        }
        public function set_editor($editor)
        {
            $this->editor=$editor;
        }
        public function set_date_creation($date_creation)
        {
            $this->date_creation=$date_creation;
        }

        public function set_categorie($categorie)
        {
            $this->categorie=$categorie;
        }
        
        public function set_nb_cour($nb_cour)
        {
            $this->nb_cour=$nb_cour;
        }

        public function set_temp($temp)
        {
            $this->temp=$temp;
        }

        public function set_prix($prix)
        {
            $this->prix=$prix;
        }

        public function set_taux($taux)
        {
            $this->taux=$taux;
        }
        public function set_description($description)
        {
            $this->description=$description;
        }
    } 
?>