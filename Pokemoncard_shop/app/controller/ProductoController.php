<?php
    require "../../app/model/Productos.php";
    class ProductoController{
        public function getAllProductos(){
            return Productos::getAllProductos();
        }

        public function crearProducto($usuario_id, $idioma_id, $nombre, $descripcion, $precio,$stock, $categoria, $tipo, $imagen_url){
            $nuevoProducto = new Productos();
            $nuevoProducto->setUsuario_id($usuario_id);
            $nuevoProducto->setIdioma_id($idioma_id);
            $nuevoProducto->setNombre($nombre);
            $nuevoProducto->setDescripcion($descripcion);
            $nuevoProducto->setPrecio($precio);
            $nuevoProducto->setStock($stock);
            $nuevoProducto->setCategoria($categoria);
            $nuevoProducto->setTipo($tipo);
            $nuevoProducto->setImagen_url($imagen_url);
            $nuevoProducto->create();
        }
    }
?>