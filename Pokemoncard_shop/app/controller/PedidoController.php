<?php
    require_once "../../app/model/Pedidos.php";
    require_once "../../app/controller/ProductoController.php";
    class PedidoController{
        function crear($usuario_id, $producto_id, $cantidad){
            $productoController = new ProductoController();
            $productoController->cambiarStock($producto_id,$cantidad);
            $pedido = new Pedidos();
            $pedido->setUsuairo_id($usuario_id);
            $pedido->setProducto_id($producto_id);
            $pedido->setCantidad($cantidad);
            $pedido->setEstado("pendiente");

            return $pedido->crear();
        }

        function recuperarPorId($id){
            return Pedidos::recuperarPorId($id);
        }

        function updateMeGusta($id){
            return Pedidos::updateMeGusta($id, $this->recuperarPorId($id)[0]['me_gusta']==1?0:1);
        }
    }