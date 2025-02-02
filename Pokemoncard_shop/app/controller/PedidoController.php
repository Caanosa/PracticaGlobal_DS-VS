<?php    
    require_once "../../app/model/Pedidos.php";
    require_once "../../app/controller/ProductoController.php";

    /**
     * Clase controladora que gestiona las operaciones relacionadas con los pedidos.
     */
    class PedidoController{
        
        /**
         * Crea un nuevo pedido, actualiza el stock del producto y establece su estado a 'pendiente'.
         *
         * @param int $usuario_id El ID del usuario que realiza el pedido.
         * @param int $producto_id El ID del producto que se está pidiendo.
         * @param int $cantidad La cantidad del producto que se está pidiendo.
         * 
         * @return int Retorna el id del pedido resultado de la creación del mismo.
         */
        function crear($usuario_id, $producto_id, $cantidad){
            $productoController = new ProductoController();
            $productoController->cambiarStock($producto_id, $cantidad);
            
            $pedido = new Pedidos();
            $pedido->setUsuairo_id($usuario_id);
            $pedido->setProducto_id($producto_id);
            $pedido->setCantidad($cantidad);
            $pedido->setEstado("pendiente");

            return $pedido->crear();
        }

        /**
         * Recupera un pedido por su ID.
         *
         * @param int $id El ID del pedido a recuperar.
         * 
         * @return array Un array con los datos del pedido recuperado.
         */
        function recuperarPorId($id){
            return Pedidos::recuperarPorId($id);
        }

        /**
         * Actualiza la preferencia 'me gusta' de un pedido, alternando su estado entre 0 y 1.
         *
         * @param int $id El ID del pedido que se actualizará.
         */
        function updateMeGusta($id){
            return Pedidos::updateMeGusta($id, $this->recuperarPorId($id)[0]['me_gusta'] == 1 ? 0 : 1);
        }
    }
?>
