<?php
    class Idioma{
        private $idioma;
        private $nomnbre_idioma;

        public function __construct($idioma, $nomnbre_idioma){
            $this->idioma = $idioma;
            $this->nomnbre_idioma = $nomnbre_idioma;
        }


        public function getIdioma()
        {
            return $this->idioma;
        }

        public function getNomnbre_idioma()
        {
            return $this->nomnbre_idioma;
        }

        public function setNomnbre_idioma($nomnbre_idioma)
        {
            $this->nomnbre_idioma = $nomnbre_idioma;
            return $this;
        }
    }
?>