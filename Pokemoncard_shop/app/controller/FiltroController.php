<?php
    require_once "../../app/model/Filtro.php";
    class FiltroController{
        public function getAllFiltros(){
            return Filtro::getAllFiltros();
        }
    }
?>