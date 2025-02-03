<?php
    require_once "../../app/model/Idioma.php";

    /**
     * Clase IdiomaController
     * 
     * Controlador que gestiona las operaciones relacionadas con la clase Idioma.
     * 
     * @package Controller
     */
    class IdiomaController{
        /**
         * Recupera todos los idiomas disponibles.
         *
         * Este método utiliza el modelo Idioma para obtener todos los registros
         * de la tabla "idioma".
         *
         * @return array|null Un array asociativo con los datos de los idiomas o null si ocurre un error.
         */
        public function getAllIdiomas(){
            return Idioma::getAllIdiomas();
        }
    }
?>
