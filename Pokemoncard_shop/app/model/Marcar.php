<?php
    class Marcar{
        private $marcar_id;
        private $filtro_id;
        private $producto_id;

        public function __construct($marcar_id, $filtro_id, $producto_id){
            $this->marcar_id = $marcar_id;
            $this->filtro_id = $filtro_id;
            $this->producto_id = $producto_id;
        }

        
        public function getMarcar_id()
        {
                return $this->marcar_id;
        }
 
        public function getFiltro_id()
        {
                return $this->filtro_id;
        }

        public function setFiltro_id($filtro_id)
        {
                $this->filtro_id = $filtro_id;

                return $this;
        }

        public function getProducto_id()
        {
                return $this->producto_id;
        }

        public function setProducto_id($producto_id)
        {
                $this->producto_id = $producto_id;

                return $this;
        }
    }
?>