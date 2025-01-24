<?php
    // Se requiere la clase Productos para gestionar los productos y Lista_deseadosController para manejar la lista de deseados
    require_once "../../app/model/Productos.php";
    require_once "../../app/controller/Lista_deseadosController.php";

    /**
     * Clase controladora para manejar las operaciones relacionadas con los productos.
     */
    class ProductoController {

        /**
         * Obtiene todos los productos.
         *
         * @return array Lista de productos.
         */
        public function getAllProductos() {
            return Productos::getAllProductos();
        }

        /**
         * Obtiene productos filtrados según los criterios especificados.
         *
         * @param string $expansion El criterio de expansión.
         * @param array $tipos Los tipos de productos.
         * @param array $categorias Las categorías de productos.
         * @param string $idioma El idioma del producto.
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
         * @param int $usuario_id ID del usuario.
         * @param int $idioma_id ID del idioma.
         * @param string $nombre Nombre del producto.
         * @param string $descripcion Descripción del producto.
         * @param float $precio Precio del producto.
         * @param int $stock Cantidad disponible.
         * @param string $categoria Categoría del producto.
         * @param string $tipo Tipo del producto.
         * @param string $imagen_url URL de la imagen del producto.
         * 
         * @return bool Resultado de la creación del producto.
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
         * Recupera la cantidad de "me gusta" de un producto.
         *
         * @param int $id ID del producto.
         * 
         * @return int Cantidad de "me gusta".
         */
        public function recuperarLikes($id) {
            return Productos::recuperarLikes($id);
        }

        /**
         * Recupera la cantidad de productos vendidos.
         *
         * @param int $id ID del producto.
         * 
         * @return int Cantidad de productos vendidos.
         */
        public function recuperarVendidos($id) {
            return Productos::recuperarVendidos($id);
        }

        /**
         * Recupera la cantidad de productos comprados.
         *
         * @param int $id ID del producto.
         * 
         * @return int Cantidad de productos comprados.
         */
        public function recuperarComprados($id) {
            return Productos::recuperarComprados($id);
        }

        /**
         * Carga la lista de productos deseados en la sesión.
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
         * Guarda un producto en la lista de deseados de la sesión.
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
         * Elimina un producto de la lista de deseados.
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
         * Recupera la lista de deseados de la sesión.
         * 
         * @return array|null Lista de deseados o null si no está definida.
         */
        public function reuperarDseseadsoSesion() {
            if (isset($_SESSION['deseados'])) {
                return $_SESSION['deseados'];
            }
        }

        /**
         * Recupera la lista de deseados combinada entre la sesión y la base de datos.
         * 
         * @return array|null Lista combinada de deseados o null si no está definida.
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
         * @return array Datos del producto recuperado.
         */
        public function recuperarPorId($id) {
            return Productos::recuperarPorId($id);
        }

        /**
         * Cambia el stock de un producto.
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
         * Obtiene los productos más deseados.
         *
         * @return array Lista de los productos más deseados.
         */
        public function masDeseados() {
            return Productos::masDeseados();
        }

        /**
         * Obtiene los productos más recientes.
         *
         * @return array Lista de los productos más recientes.
         */
        public function masRecientes() {
            return Productos::masRecientes();
        }

        /**
         * Alterna el estado de "me gusta" de un producto.
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
