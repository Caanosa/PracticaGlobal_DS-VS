<?php

    class MeGusta{
        private $me_gusta_id;
        private $usuairo_id;
        private $producto_id;
        private $fecha_me_gusta;

        public function __construct($me_gusta_id, $usuairo_id, $producto_id, $fecha_agregado){
            $this->me_gusta_id = $me_gusta_id;
            $this->usuairo_id = $usuairo_id;
            $this->producto_id = $producto_id;
            $this->fecha_me_gusta = $fecha_agregado;
        }

        
        public function getMe_gusta_id()
        {
                return $this->me_gusta_id;
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

        public function getFecha_me_gusta()
        {
                return $this->fecha_me_gusta;
        }

        public function setFecha_me_gusta($fecha_me_gusta)
        {
                $this->fecha_me_gusta = $fecha_me_gusta;

                return $this;
        }
    }

?>