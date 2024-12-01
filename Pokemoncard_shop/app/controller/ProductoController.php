<?php
    require_once "../../app/model/Productos.php";
    class ProductoController{
        public function getAllProductos(){
            return Productos::getAllProductos();
        }

        public function getAllProductosFiltered($expansion, $tipos, $categorias, $idioma, $min, $max){
            
            return Productos::getAllProductosFiltered($expansion, $tipos, $categorias, $idioma, $min, $max);
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

        public function recuperarLikes($id){
            return Productos::recuperarLikes($id);
        }

        public function recuperarVendidos($id){
            return Productos::recuperarVendidos($id);
        }

        public function recuperarComprados($id){
            return Productos::recuperarComprados($id);
        }

        public function cargarDeseadosSesion($id){
            $_SESSION['deseadosDB'] = Productos::recuperarDeseados($id);
            $_SESSION['deseados'] = [];
        }

        public function reuperarDseseadsoSesion(){
            if(isset($_SESSION['deseados'])){
                return $_SESSION['deseados'];
            }
        }

        public function reuperarDseseadsoSesionConjunto(){
            if(isset($_SESSION['deseados'])&&isset($_SESSION['deseadosDB'])){
                return  $_SESSION['deseados'] + $_SESSION['deseadosDB'];
            }
        }

        
    }
?>