<?php
    /**
     * Clase Pedidos
     * Representa el modelo de datos para la tabla "pedidos" en la base de datos.
     */
    class Pedidos{
        /**
         * @var int $padido_id ID del pedido (atributo privado).
         */
        private $padido_id;

        /**
         * @var int $usuairo_id ID del usuario (atributo privado).
         */
        private $usuairo_id;

        /**
         * @var int $producto_id ID del producto (atributo privado).
         */
        private $producto_id;

        /**
         * @var int $cantidad Cantidad del producto (atributo privado).
         */
        private $cantidad;

        /**
         * @var string $fecha_pedido Fecha en la que se realizó el pedido (atributo privado).
         */
        private $fecha_pedido;

        /**
         * @var string $estado Indica el estado del pedido: pendiente, procesado, enviado, entregado o cancelado (atributo privado).
         */
        private $estado;

        /**
         * @var int $meGusta Número de "me gusta" asociado al pedido (atributo privado).
         */
        private $meGusta;

        /**
         * Crea un nuevo pedido en la tabla "pedidos" en la base de datos.
         * 
         * @return int El ID del pedido insertado.
         * @throws Exception Si ocurre un error durante la ejecución de la consulta.
         */
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
                echo "Error" . $e->getMessage();
            }
        } 

        /**
         * Recupera un pedido por su ID desde la base de datos.
         * 
         * @param int $id El ID del pedido a recuperar.
         * @return array Información del pedido recuperado.
         * @throws Exception Si ocurre un error durante la ejecución de la consulta.
         */
        static function recuperarPorId($id){
            try{
                $conn = getDbConnection();
                $sentencia = $conn->prepare("SELECT * FROM `pedidos` WHERE pedido_id = ?");
                $sentencia->bindParam(1, $id);
                $sentencia->execute();
                return $sentencia->fetchAll(PDO::FETCH_ASSOC);
            }catch(Exception $e){
                echo "Error" . $e->getMessage();
            }
        }

        /**
         * Actualiza el campo "me gusta" de un pedido específico.
         * 
         * @param int $id El ID del pedido a actualizar.
         * @param int $meGusta El valor de "me gusta" a establecer.
         * @return void
         * @throws Exception Si ocurre un error durante la ejecución de la consulta.
         */
        static function updateMeGusta($id, $meGusta){
            try{
                $conn = getDbConnection();
                $sentencia = $conn->prepare("UPDATE `pedidos` SET `me_gusta`=? WHERE pedido_id = ?");
                $sentencia->bindParam(1, $meGusta);
                $sentencia->bindParam(2, $id);
                $sentencia->execute();
            }catch(Exception $e){
                echo "Error" . $e->getMessage();
            }
        }

        /**
         * Obtiene el ID del pedido.
         * 
         * @return int El ID del pedido.
         */
        public function getPadido_id(){
            return $this->padido_id;
        }

        /**
         * Obtiene el ID del usuario asociado al pedido.
         * 
         * @return int El ID del usuario.
         */
        public function getUsuairo_id(){
            return $this->usuairo_id;
        }

        /**
         * Establece el ID del usuario asociado al pedido.
         * 
         * @param int $usuairo_id El ID del usuario a establecer.
         * @return $this La instancia actual.
         */
        public function setUsuairo_id($usuairo_id){
            $this->usuairo_id = $usuairo_id;
            return $this;
        }

        /**
         * Obtiene el ID del producto asociado al pedido.
         * 
         * @return int El ID del producto.
         */
        public function getProducto_id(){
            return $this->producto_id;
        }

        /**
         * Establece el ID del producto asociado al pedido.
         * 
         * @param int $producto_id El ID del producto a establecer.
         * @return $this La instancia actual.
         */
        public function setProducto_id($producto_id){
            $this->producto_id = $producto_id;
            return $this;
        }

        /**
         * Obtiene la cantidad del producto en el pedido.
         * 
         * @return int La cantidad del producto.
         */
        public function getCantidad(){
            return $this->cantidad;
        }

        /**
         * Establece la cantidad del producto en el pedido.
         * 
         * @param int $cantidad La cantidad a establecer.
         * @return $this La instancia actual.
         */
        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
            return $this;
        }

        /**
         * Obtiene la fecha en la que se realizó el pedido.
         * 
         * @return string La fecha del pedido.
         */
        public function getFecha_pedido(){
            return $this->fecha_pedido;
        }

        /**
         * Establece la fecha en la que se realizó el pedido.
         * 
         * @param string $fecha_pedido La fecha a establecer.
         * @return $this La instancia actual.
         */
        public function setFecha_pedido($fecha_pedido){
            $this->fecha_pedido = $fecha_pedido;
            return $this;
        }

        /**
         * Obtiene el estado actual del pedido.
         * 
         * @return string El estado del pedido.
         */
        public function getEstado(){
            return $this->estado;
        }

        /**
         * Establece el estado actual del pedido.
         * 
         * @param string $estado El estado a establecer.
         * @return $this La instancia actual.
         */
        public function setEstado($estado){
            $this->estado = $estado;
            return $this;
        }

        /**
         * Obtiene el valor de "me gusta" del pedido.
         * 
         * @return int El valor de "me gusta".
         */
        public function getMeGusta(){
            return $this->meGusta;
        }

        /**
         * Establece el valor de "me gusta" del pedido.
         * 
         * @param int $meGusta El valor de "me gusta" a establecer.
         * @return $this La instancia actual.
         */
        public function setMeGusta($meGusta){
            $this->meGusta = $meGusta;
            return $this;
        }
    }
?>
