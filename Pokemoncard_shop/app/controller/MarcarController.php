<?php
    require_once "../../app/model/Marcar.php";
    class MarcarController{
        public function crear($filtro_id, $procuto_id){
            $marcar = new Marcar();
            $marcar->setFiltro_id($filtro_id);
            $marcar->setProducto_id($procuto_id);
            $marcar->crear();
        }

        public function recuperarPorId($id){
           return Marcar::recuperarPorId($id);
        }

        public function elimarPorId($id){
            return Marcar::elimarPorId($id);
        }
    }
?>