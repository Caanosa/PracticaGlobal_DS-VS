<?php
    class Pedidos{
        private $padido_id;
        private $usuairo_id;
        private $producto_id;
        private $cantidad;
        private $fecha_pedido;
        private $estado;

        public function crear(){
                try{
                    $conn = getDbConnection();
                    $sentencia = $conn->prepare("INSERT INTO `pedidos`(`usuario_id`, `producto_id`, `cantidad`, `estado`) VALUES (?,?,?,?)");
                    $sentencia->bindParam(1, $this->usuairo_id);
                    $sentencia->bindParam(2, $this->producto_id);
                    $sentencia->bindParam(3, $this->cantidad);
                    $sentencia->bindParam(4, $this->estado);
                    $sentencia->execute();
                    return $conn->lastInsertId();
                }catch(Exception $e){
                    echo "Error".$e->getMessage();
                }
        } 

        static function recuperarPorId($id){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT * FROM `pedidos` WHERE pedido_id = ?");
                        $sentencia->bindParam(1, $id);
                        $sentencia->execute();
                        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                }catch(Exception $e){
                        echo "Error".$e->getMessage();
                }
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

        public function getEstado()
        {
                return $this->estado;
        }

        public function setEstado($estado)
        {
                $this->estado = $estado;

                return $this;
        }
    }
?>