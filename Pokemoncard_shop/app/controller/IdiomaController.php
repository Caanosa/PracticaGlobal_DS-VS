<?php
    require_once "../../app/model/Idioma.php";
    class IdiomaController{
        public function getAllIdiomas(){
            return Idioma::getAllIdiomas();
        }
    }
?>