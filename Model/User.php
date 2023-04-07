<?php
    class User{
        private $cin=null;
        private $nom=null;
        private $prenom=null;
        private $email=null;
        private $telephone=null;
        private $sexe=null;
        private $date_n=null;
        private $username=null;
        private $password=null;
        private $choix=null;
        private $ban=null;

        public function __construct($cin,$nom,$prenom,$email,$telephone,$sexe,$date_n,$username,$password,$choix,$ban)
        {
            $this->cin=$cin;
            $this->nom=$nom;
            $this->prenom=$prenom;
            $this->email=$email;
            $this->telephone=$telephone;
            $this->sexe=$sexe;
            $this->date_n=$date_n;
            $this->username=$username;
            $this->password=$password;
            $this->choix=$choix;
            $this->ban=$ban;
        }
        /////////////////////////////////////////////////////////
        public function get_cin()
        {
            return $this->cin;
        }
        public function get_ban()
        {
            return $this->ban;
        }

        public function get_nom()
        {
            return $this->nom;
        }

        public function get_prenom()
        {
            return $this->prenom;
        }

        public function get_email()
        {
            return $this->email;
        }

        public function get_telephone()
        {
            return $this->telephone;
        }

        public function get_sexe()
        {
            return $this->sexe;
        }

        public function get_date_n()
        {
            return $this->date_n;
        }
        
        public function get_username()
        {
            return $this->username;
        }

        public function get_password()
        {
            return $this->password;
        }
        public function get_choix()
        {
            return $this->choix;
        }
        ///////////////////////////////////////////////////////////

        public function set_cin($cin)
        {
            $this->cin=$cin;
        }
        public function set_ban($ban)
        {
            $this->ban=$ban;
        }
        
        public function set_nom($nom)
        {
            $this->nom=$nom;
        }

        public function set_prenom($prenom)
        {
            $this->prenom=$prenom;
        }
        
        public function set_email($email)
        {
            $this->email=$email;
        }

        public function set_telephone($telephone)
        {
            $this->telephone=$telephone;
        }

        public function set_sexe($sexe)
        {
            $this->sexe=$sexe;
        }

        public function set_username($username)
        {
            $this->username=$username;
        }
        
        public function set_password($password)
        {
            $this->password=$password;
        }

        public function set_choix($choix)
        {
            $this->choix=$choix;
        }
    } 
?>