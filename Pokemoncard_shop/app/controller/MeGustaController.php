<?php
    require_once "../../app/model/Me_gusta.php";
    class MeGustaController{
        public  function recuperarPorId($usuario_id, $producto_id){
            return MeGusta::recuperarPorId($usuario_id, $producto_id);
        }

        public  function setmegusta($usuario_id, $producto_id){
            if($this->recuperarPorId($usuario_id, $producto_id)){
                echo"eliminar";
                MeGusta::eliminar($usuario_id, $producto_id);
            }else{
                echo"añadir";
                $meGusta = new MeGusta();
                $meGusta->setUsuairo_id($usuario_id);
                $meGusta->setProducto_id($producto_id);
                $meGusta->crear();
            }
        }
    }
?>