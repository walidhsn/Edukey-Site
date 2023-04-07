<?php
    class Admin{
        private username=null;
        private password=null;

        public function __construct($username,$password)
        {
            $this->username=$username;
            $this->password=$password;
        }
        /////////////////////////////////
        public function get_username()
        {
            return $this->username;
        }

        public function get_password()
        {
            return $this->password;
        }
        ////////////////////////////////
        public function set_username($username)
        {
            $this->username=$username;
        }
        public function set_password($password)
        {
            $this->pasword=$password;
        }
    }
?>