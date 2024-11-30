<?php
    class ListaDeseados{
        private $lista_deseados_id;
        private $usuairo_id;
        private $producto_id;
        private $fecha_agregado;

        public function create(){
            try{
                $conn = getDbConnection();
                $sentencia = $conn->prepare("INSERT INTO `lista_deseados`(`usuario_id`, `producto_id`) VALUES (?,?)");
                $sentencia->bindParam(1, $this->usuairo_id);
                $sentencia->bindParam(2, $this->producto_id);
                $sentencia->execute();
            }catch(Exception $e){
                echo "Error".$e->getMessage();
            }
    }

        
        public function getLista_deseados_id()
        {
            return $this->lista_deseados_id;
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