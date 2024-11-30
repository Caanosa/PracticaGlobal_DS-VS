<?php
    require_once "../../app/model/Lista_deseados.php";
    require_once "../../app/controller/ProductoController.php";
    class ListaDeseadosController{
        function create($idU, $idP){
            $lista = new ListaDeseados();
            $lista->setUsuairo_id($idU);
            $lista->setProducto_id($idP);
            $lista->create();
        }

        function addAll($id){
            foreach ($_SESSION['deseados'] as $producto) {
                $lista = new ListaDeseados();
                $lista->setUsuairo_id($id);
                $lista->setProducto_id($producto['producto_id']);
                $lista->create();
            }
            $productoController = new ProductoController();
            $productoController->cargarDeseadosSesion($id);
        }
    }
?>