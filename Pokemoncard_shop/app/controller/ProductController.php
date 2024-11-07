<?php
    require "../../app/model/Producto.php";
    class ProductController{
        public function getAllProducts(){
            return Producto::getAllProducts();
        }

        public function getProductbyName($nombre){
            return Producto::getProductByName($nombre);
        }

        public function crearProducto($nombre,$precio){
            $nuevoProducto = new Producto();
            $nuevoProducto->setNombre($nombre);
            $nuevoProducto->setPrecio($precio);

            $nuevoProducto->create();
        }
    }
    

    
?>