<?php
    // Se requiere la clase Productos para manejar las operaciones relacionadas con productos
    // Se requiere Lista_deseadosController para manejar la lista de productos deseados
    require_once "../../app/model/Productos.php";
    require_once "../../app/controller/Lista_deseadosController.php";

    /**
     * Clase controladora para gestionar las operaciones relacionadas con los productos.
     */
    class ProductoController {

        /**
         * Recupera todos los productos.
         *
         * @return array Lista de todos los productos.
         */
        public function getAllProductos() {
            return Productos::getAllProductos();
        }

        /**
         * Recupera productos filtrados según los parámetros especificados.
         *
         * @param string $expansion Expansión del producto.
         * @param string $tipos Tipos de productos.
         * @param string $categorias Categorías de productos.
         * @param string $idioma Idioma del producto.
         * @param float $min Precio mínimo.
         * @param float $max Precio máximo.
         * 
         * @return array Lista de productos filtrados.
         */
        public function getAllProductosFiltered($expansion, $tipos, $categorias, $idioma, $min, $max) {
            return Productos::getAllProductosFiltered($expansion, $tipos, $categorias, $idioma, $min, $max);
        }

        /**
         * Crea un nuevo producto.
         *
         * @param int $usuario_id ID del usuario creador.
         * @param int $idioma_id ID del idioma.
         * @param string $nombre Nombre del producto.
         * @param string $descripcion Descripción del producto.
         * @param float $precio Precio del producto.
         * @param int $stock Cantidad de stock disponible.
         * @param string $categoria Categoría del producto.
         * @param string $tipo Tipo del producto.
         * @param string $imagen_url URL de la imagen del producto.
         * 
         * @return bool Resultado de la operación de creación.
         */
        public function crearProducto($usuario_id, $idioma_id, $nombre, $descripcion, $precio, $stock, $categoria, $tipo, $imagen_url) {
            $nuevoProducto = new Productos();
            $nuevoProducto->setUsuario_id($usuario_id);
            $nuevoProducto->setIdioma_id($idioma_id);
            $nuevoProducto->setNombre($nombre);
            $nuevoProducto->setDescripcion($descripcion);
            $nuevoProducto->setPrecio($precio);
            $nuevoProducto->setStock($stock);
            $nuevoProducto->setCategoria($categoria);
            $nuevoProducto->setTipo($tipo);
            $nuevoProducto->setImagen_url($imagen_url);
            return $nuevoProducto->create();
        }

        /**
         * Recupera el número de 'me gusta' de un producto.
         *
         * @param int $id ID del producto.
         * 
         * @return int Número de 'me gusta'.
         */
        public function recuperarLikes($id) {
            return Productos::recuperarLikes($id);
        }

        /**
         * Recupera el número de unidades vendidas de un producto.
         *
         * @param int $id ID del producto.
         * 
         * @return int Cantidad de productos vendidos.
         */
        public function recuperarVendidos($id) {
            return Productos::recuperarVendidos($id);
        }

        /**
         * Recupera el número de unidades compradas de un producto.
         *
         * @param int $id ID del producto.
         * 
         * @return int Cantidad de productos comprados.
         */
        public function recuperarComprados($id) {
            return Productos::recuperarComprados($id);
        }

        /**
         * Carga los productos deseados de un usuario en la sesión.
         *
         * @param int $id ID del usuario.
         * 
         * @return void
         */
        public function cargarDeseadosSesion($id) {
            $_SESSION['deseadosDB'] = Productos::recuperarDeseados($id);
            $_SESSION['deseados'] = [];
        }

        /**
         * Guarda un producto deseado en la sesión o lo elimina si ya existe.
         *
         * @param int $id ID del producto.
         * @param string $nombre Nombre del producto.
         * @param float $precio Precio del producto.
         * @param string $imagen_url URL de la imagen del producto.
         * 
         * @return void
         */
        public function guardarDeseadosSesion($id, $nombre, $precio, $imagen_url) {
            if (array_filter($this->reuperarDseseadsoSesionConjunto(), function($producto) use ($id) { return ($producto['producto_id'] == $id); })) {
                $this->eliminarDeseados($id, $nombre, $precio, $imagen_url);
            } else {
                array_push($_SESSION['deseados'], ["producto_id" => $id, "nombre" => $nombre, "precio" => $precio, "imagen_url" => $imagen_url]);
            }
        }

        /**
         * Elimina un producto deseado de la sesión o de la base de datos.
         *
         * @param int $id ID del producto.
         * @param string $nombre Nombre del producto.
         * @param float $precio Precio del producto.
         * @param string $imagen_url URL de la imagen del producto.
         * 
         * @return void
         */
        public function eliminarDeseados($id, $nombre, $precio, $imagen_url) {
            if (array_filter($_SESSION['deseados'], function($producto) use ($id) { return ($producto['producto_id'] == $id); })) {
                $_SESSION['deseados'] = array_values(array_filter($_SESSION['deseados'], function($producto) use ($id) { return !($producto['producto_id'] == $id); }));
            } else {
                $listaDeseadosController = new ListaDeseadosController();
                $listaDeseadosController->eliminar($_SESSION['usuario'][0], $id);
                $_SESSION['deseadosDB'] = array_values(array_filter($_SESSION['deseadosDB'], function($producto) use ($id) { return !($producto['producto_id'] == $id); }));
            }
        }

        /**
         * Recupera los productos deseados en sesión.
         *
         * @return array|null Lista de productos deseados en sesión.
         */
        public function reuperarDseseadsoSesion() {
            if (isset($_SESSION['deseados'])) {
                return $_SESSION['deseados'];
            }
        }

        /**
         * Recupera todos los productos deseados, combinando los de la sesión y la base de datos.
         *
         * @return array|null Lista combinada de productos deseados.
         */
        public function reuperarDseseadsoSesionConjunto() {
            if (isset($_SESSION['deseados']) && isset($_SESSION['deseadosDB'])) {
                return $_SESSION['deseados'] + $_SESSION['deseadosDB'];
            }
        }

        /**
         * Recupera un producto por su ID.
         *
         * @param int $id ID del producto.
         * 
         * @return array Datos del producto.
         */
        public function recuperarPorId($id) {
            return Productos::recuperarPorId($id);
        }

        /**
         * Actualiza el stock de un producto.
         *
         * @param int $id ID del producto.
         * @param int $cantidad Nueva cantidad de stock.
         * 
         * @return void
         */
        public function cambiarStock($id, $cantidad) {
            Productos::cambiarStock($id, $cantidad);
        }

        /**
         * Recupera los productos más deseados.
         *
         * @return array Lista de productos más deseados.
         */
        public function masDeseados() {
            return Productos::masDeseados();
        }

        /**
         * Recupera los productos más recientes.
         *
         * @return array Lista de productos más recientes.
         */
        public function masRecientes() {
            return Productos::masRecientes();
        }

        /**
         * Alterna el estado de 'me gusta' de un producto.
         *
         * @param int $id ID del producto.
         * 
         * @return void
         */
        public function setmegusta($id) {
            Pedidos::updateMeGusta($id, $this->recuperarPorId($id)[0]['me_gusta'] == 0 ? 1 : 0);
        }
    }
?>
