<?php
    class categorie{
        private $nom=null;
        private $icon_html=null;
        public function __construct($nom,$icon_html)
        {
            $this->nom=$nom;
            $this->icon_html=$icon_html;
        }
        /////////////////////////////////
        public function get_nom()
        {
            return $this->nom;
        }
        ////////////////////////////////
        public function set_nom($nom)
        {
            $this->nom=$nom;
        }
         public function get_icon_html()
        {
            return $this->icon_html;
        }
        ////////////////////////////////
        public function set_icon_html($icon_html)
        {
            $this->icon_html=$icon_html;
        }
    }
?>