<?php
    /**
     * Clase ListaDeseados
     * Representa el modelo de datos para la tabla "lista_deseados" en la base de datos.
     */
    class ListaDeseados{
        /**
         * @var int $lista_deseados_id ID de la lista de deseados (atributo privado).
         */
        private $lista_deseados_id;

        /**
         * @var int $usuairo_id ID del usuario asociado a la lista de deseados (atributo privado).
         */
        private $usuairo_id;

        /**
         * @var int $producto_id ID del producto asociado a la lista de deseados (atributo privado).
         */
        private $producto_id;

        /**
         * @var string $fecha_agregado Fecha en la que el producto fue agregado a la lista de deseados (atributo privado).
         */
        private $fecha_agregado;

        /**
         * Crea un nuevo registro en la tabla "lista_deseados" en la base de datos.
         * 
         * @return void
         * @throws Exception Si ocurre un error durante la ejecución de la consulta.
         */
        public function create(){
            try{
                $conn = getDbConnection();
                $sentencia = $conn->prepare("INSERT INTO `lista_deseados`(`usuario_id`, `producto_id`) VALUES (?,?)");
                $sentencia->bindParam(1, $this->usuairo_id);
                $sentencia->bindParam(2, $this->producto_id);
                $sentencia->execute();
            }catch(Exception $e){
                echo "Error" . $e->getMessage();
            }
        }

        /**
         * Elimina un registro de la tabla "lista_deseados" basado en el usuario y producto especificados.
         * 
         * @param int $usuairo_id ID del usuario asociado.
         * @param int $producto_id ID del producto asociado.
         * @return void
         * @throws Exception Si ocurre un error durante la ejecución de la consulta.
         */
        static function eliminar($usuairo_id, $producto_id){
            try{
                $conn = getDbConnection();
                $sentencia = $conn->prepare("DELETE FROM `lista_deseados` WHERE usuario_id = ? AND producto_id = ?;");
                $sentencia->bindParam(1, $usuairo_id);
                $sentencia->bindParam(2, $producto_id);
                $sentencia->execute();
            }catch(Exception $e){
                echo "Error" . $e->getMessage();
            }
        }

        /**
         * Obtiene el ID de la lista de deseados.
         * 
         * @return int El ID de la lista de deseados.
         */
        public function getLista_deseados_id()
        {
            return $this->lista_deseados_id;
        }

        /**
         * Obtiene el ID del usuario asociado a la lista de deseados.
         * 
         * @return int El ID del usuario.
         */
        public function getUsuairo_id()
        {
            return $this->usuairo_id;
        }

        /**
         * Establece el ID del usuario asociado a la lista de deseados.
         * 
         * @param int $usuairo_id El ID del usuario a establecer.
         * @return $this La instancia actual.
         */
        public function setUsuairo_id($usuairo_id)
        {
            $this->usuairo_id = $usuairo_id;
            return $this;
        }

        /**
         * Obtiene el ID del producto asociado a la lista de deseados.
         * 
         * @return int El ID del producto.
         */
        public function getProducto_id()
        {
            return $this->producto_id;
        }

        /**
         * Establece el ID del producto asociado a la lista de deseados.
         * 
         * @param int $producto_id El ID del producto a establecer.
         * @return $this La instancia actual de la clase para permitir encadenamiento.
         */
        public function setProducto_id($producto_id)
        {
            $this->producto_id = $producto_id;
            return $this;
        }

        /**
         * Obtiene la fecha en la que el producto fue agregado a la lista de deseados.
         * 
         * @return string La fecha de agregado.
         */
        public function getFecha_agregado()
        {
            return $this->fecha_agregado;
        }

        /**
         * Establece la fecha en la que el producto fue agregado a la lista de deseados.
         * 
         * @param string $fecha_agregado La fecha de agregado a establecer.
         * @return $this La instancia actual.
         */
        public function setFecha_agregado($fecha_agregado)
        {
            $this->fecha_agregado = $fecha_agregado;
            return $this;
        }
    }
?>
