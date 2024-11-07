<?php
    class Productos{
        private $producto_id;
        private $idioma_id;
        private $nombre;
        private $descripcion;
        private $precio;
        private $stock;
        private $categoria;
        private $tipo;
        private $imagen_url;
        private $fecha_agregado;

        public function __construct($producto_id, $idioma_id, $nombre, $descripcion, $precio, $stock, $categoria, $tipo, $imagen_url, $fecha_agregado){
            $this->producto_id = $producto_id;
            $this->idioma_id = $idioma_id;
            $this->nombre = $nombre;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->stock = $stock;
            $this->categoria = $categoria;
            $this->tipo = $tipo;
            $this->imagen_url = $imagen_url;
            $this->fecha_agregado = $fecha_agregado;
        }


        public function getProducto_id()
        {
                return $this->producto_id;
        }

        public function getIdioma_id()
        {
                return $this->idioma_id;
        }

        public function setIdioma_id($idioma_id)
        {
                $this->idioma_id = $idioma_id;

                return $this;
        }

        public function getNombre()
        {
                return $this->nombre;
        }

        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        public function getDescripcion()
        {
                return $this->descripcion;
        }
 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }
 
        public function getPrecio()
        {
                return $this->precio;
        }

        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }

        public function getStock()
        {
                return $this->stock;
        }

        public function setStock($stock)
        {
                $this->stock = $stock;

                return $this;
        }
 
        public function getCategoria()
        {
                return $this->categoria;
        }

        public function setCategoria($categoria)
        {
                $this->categoria = $categoria;

                return $this;
        }

        public function getTipo()
        {
                return $this->tipo;
        }
 
        public function setTipo($tipo)
        {
                $this->tipo = $tipo;

                return $this;
        }

        public function getImagen_url()
        {
                return $this->imagen_url;
        }

        public function setImagen_url($imagen_url)
        {
                $this->imagen_url = $imagen_url;

                return $this;
        }

        public function getFecha_agregado()
        {
                return $this->fecha_agregado;
        }

        public function setFecha_agregado($fecha_agregado)
        {
                $this->fecha_agregado = $fecha_agregado;

                return $this;
        }
    }
?>