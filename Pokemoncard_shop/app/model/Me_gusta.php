<?php

    class MeGusta{
        private $me_gusta_id;
        private $usuairo_id;
        private $producto_id;
        private $fecha_me_gusta;

        public function crear(){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("INSERT INTO `me_gusta`(`usuario_id`, `producto_id`) VALUES (?,?)");
                        $sentencia->bindParam(1, $this->usuairo_id);
                        $sentencia->bindParam(2, $this->producto_id);
                        $sentencia->execute();
                }catch(Exception $e){
                        echo "Error".$e->getMessage();
                }
        }

        static function recuperarPorId($usuairo_id, $producto_id){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT * FROM `me_gusta` WHERE usuario_id = ? AND producto_id = ?");
                        $sentencia->bindParam(1, $usuairo_id);
                        $sentencia->bindParam(2, $producto_id);
                        $sentencia->execute();
                        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                    }catch(Exception $e){
                        echo "Error".$e->getMessage();
                    }
        }

        static function eliminar($usuairo_id, $producto_id){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("DELETE FROM `me_gusta` WHERE usuario_id = ? AND producto_id = ?");
                        $sentencia->bindParam(1, $usuairo_id);
                        $sentencia->bindParam(2, $producto_id);
                        $sentencia->execute();
                }catch(Exception $e){
                        echo "Error".$e->getMessage();
                }
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