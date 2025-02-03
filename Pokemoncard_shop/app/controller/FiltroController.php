<?php
    require_once "../../app/model/Filtro.php";

    /**
     * Clase FiltroController
     * 
     * Controlador que gestiona las operaciones relacionadas con la clase Filtro.
     * 
     * @package Controller
     */
    class FiltroController{
        /**
         * Recupera todos los filtros disponibles.
         *
         * Este método utiliza el modelo Filtro para obtener todos los registros
         * de la tabla "filtros" ordenados por el nombre del filtro.
         *
         * @return array|null Un array asociativo con los datos de los filtros o null si ocurre un error.
         */
        public function getAllFiltros(){
            return Filtro::getAllFiltros();
        }
    }
?>