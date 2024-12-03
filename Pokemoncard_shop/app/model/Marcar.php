<?php
    class Marcar{
        private $marcar_id;
        private $filtro_id;
        private $producto_id;

        public function crear(){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("INSERT INTO `marcar`(`filtro_id`, `producto_id`) VALUES (?,?)");
                        $sentencia->bindParam(1, $this->filtro_id);
                        $sentencia->bindParam(2, $this->producto_id);
                        $sentencia->execute();
                }catch(Exception $e){
                        echo "Error".$e->getMessage();
                }
        }

        static function recuperarPorId($id){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT * FROM `marcar` NATURAL JOIN filtros WHERE producto_id = ?");
                        $sentencia->bindParam(1, $id);
                        $sentencia->execute();
                        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                    }catch(Exception $e){
                        echo "Error".$e->getMessage();
                    }
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