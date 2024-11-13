<?php
    require "../../app/model/Filtro.php";
    class FiltroController{
        public function getAllFiltros(){
            return Filtro::getAllFiltros();
        }
    }
?>