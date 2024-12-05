<?php
    require_once "../../app/model/Productos.php";
    require_once "../../app/controller/Lista_deseadosController.php";
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
            return $nuevoProducto->create();
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

        public function guardarDeseadosSesion($id,$nombre,$precio,$imagen_url){
            if(array_filter($this->reuperarDseseadsoSesionConjunto(), function($producto) use ($id) { return ($producto['producto_id'] == $id);})){
                $this->eliminarDeseados($id,$nombre,$precio,$imagen_url);
            }else{
                array_push($_SESSION['deseados'], ["producto_id" =>$id, "nombre" =>$nombre, "precio" =>$precio, "imagen_url"=> $imagen_url]);
            }
            
        }

        public function eliminarDeseados($id, $nombre, $precio, $imagen_url){
            if(array_filter($_SESSION['deseados'], function($producto) use ($id) { return ($producto['producto_id'] == $id);})){
                $_SESSION['deseados'] = array_values(array_filter($_SESSION['deseados'], function($producto) use ($id) { return !($producto['producto_id'] == $id);}));
            }else{
                $listaDeseadosController = new ListaDeseadosController ();
                $listaDeseadosController->eliminar($_SESSION['usuario'][0],$id);
                $_SESSION['deseadosDB'] = array_values(array_filter($_SESSION['deseadosDB'], function($producto) use ($id) { return !($producto['producto_id'] == $id);}));
            }
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

        public function recuperarPorId($id){
            return Productos::recuperarPorId($id);
        }
        
        public function cambiarStock($id, $cantidad){
            Productos::cambiarStock($id, $cantidad);
        }

        public function masDeseados(){
            return Productos::masDeseados();
        }

        public function masRecientes(){
            return Productos::masRecientes();
        }

        public function setmegusta($id){
            Pedidos::updateMeGusta($id, $this->recuperarPorId($id)[0]['me_gusta']==0?1:0);
        }
    }
?>