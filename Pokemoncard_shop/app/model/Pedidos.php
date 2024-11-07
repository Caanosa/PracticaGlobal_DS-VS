<?php
    class Pedidos{
        private $padido_id;
        private $usuairo_id;
        private $producto_id;
        private $cantidad;
        private $fecha_pedido;

        public function __construct($padido_id, $usuairo_id, $producto_id, $cantidad, $fecha_pedido){
            $this->padido_id = $padido_id;
            $this->usuairo_id = $usuairo_id;
            $this->producto_id = $producto_id;
            $this->cantidad = $cantidad;
            $this->fecha_pedido = $fecha_pedido;
        }

        public function getPadido_id()
        {
                return $this->padido_id;
        }

        public function getUsuairo_id()
        {
                return $this->usuairo_id;
        }

        public function setUsuairo_id($usuairo_id)
        {
                $this->usuairo_id = $usuairo_id;

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

        public function getCantidad()
        {
                return $this->cantidad;
        }
 
        public function setCantidad($cantidad)
        {
                $this->cantidad = $cantidad;

                return $this;
        }

        public function getFecha_pedido()
        {
                return $this->fecha_pedido;
        }

        public function setFecha_pedido($fecha_pedido)
        {
                $this->fecha_pedido = $fecha_pedido;

                return $this;
        }
    }
?>