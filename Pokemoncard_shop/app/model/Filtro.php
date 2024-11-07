<?php
    class Filtro{
        private $filtro_id;
        private $nombre_filtro;

        public function __construct($filtro_id, $nombre_filtro){
            $this->filtro_id = $filtro_id;
            $this->nombre_filtro = $nombre_filtro;
        }


        public function getFiltro_id()
        {
            return $this->filtro_id;
        }

        public function getNombre_filtro()
        {
            return $this->nombre_filtro;
        }

        public function setNombre_filtro($nombre_filtro)
        {
            $this->nombre_filtro = $nombre_filtro;
            return $this;
        }
    }
?>