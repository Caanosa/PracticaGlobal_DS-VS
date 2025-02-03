<?php
    require_once "../../app/model/Lista_deseados.php";
    require_once "../../app/controller/ProductoController.php";

    /**
     * Clase ListaDeseadosController
     * 
     * Controlador que gestiona las operaciones relacionadas con la clase ListaDeseados.
     * 
     * @package Controller
     */
    class ListaDeseadosController{
        /**
         * Crea una nueva entrada en la lista de deseados.
         *
         * Este método crea un nuevo registro en la tabla "lista_deseados"
         * utilizando los IDs del usuario y producto proporcionados.
         *
         * @param int $idU ID del usuario.
         * @param int $idP ID del producto.
         */
        function create($idU, $idP){
            $lista = new ListaDeseados();
            $lista->setUsuairo_id($idU);
            $lista->setProducto_id($idP);
            $lista->create();
        }

        /**
         * Agrega todos los productos de la sesión actual a la lista de deseados de un usuario.
         *
         * Este método recorre los productos almacenados en la sesión y los añade
         * a la lista de deseados del usuario especificado por su ID.
         *
         * @param int $id ID del usuario.
         */
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

        /**
         * Elimina un producto de la lista de deseados de un usuario.
         *
         * Este método elimina un registro de la tabla "lista_deseados"
         * según los IDs del usuario y producto proporcionados.
         *
         * @param int $usuario_id ID del usuario.
         * @param int $producto_id ID del producto.
         */
        function eliminar($usuario_id, $producto_id){
            ListaDeseados::eliminar($usuario_id, $producto_id);
        }
    }
?>
