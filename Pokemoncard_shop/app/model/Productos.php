<?php

/**
 * Clase Productos
 * 
 * Esta clase representa la lógica de negocio para los productos, incluyendo métodos para crear, recuperar, y filtrar productos en la base de datos.
 * 
 * @package Productos
 */

require_once "../../config/dbConnection.php";

class Productos
{
        /** @var int $producto_id Identificador único del producto */
        private $producto_id;

        /** @var int $usuario_id Identificador del usuario que creó el producto */
        private $usuario_id;

        /** @var int $idioma_id Identificador del idioma asociado al producto */
        private $idioma_id;

        /** @var string $nombre Nombre del producto */
        private $nombre;

        /** @var string $descripcion Descripción del producto */
        private $descripcion;

        /** @var float $precio Precio del producto */
        private $precio;

        /** @var int $stock Cantidad de unidades disponibles del producto */
        private $stock;

        /** @var string $categoria Categoría del producto */
        private $categoria;

        /** @var string $tipo Tipo del producto */
        private $tipo;

        /** @var string $imagen_url URL de la imagen del producto */
        private $imagen_url;

        /** @var string $fecha_agregado Fecha en que el producto fue agregado */
        private $fecha_agregado;

        /**
         * Obtiene el identificador único del producto.
         * 
         * @return int Identificador del producto.
         */
        public function getProducto_id()
        {
                return $this->producto_id;
        }

        /**
         * Crea un nuevo producto en la base de datos.
         * 
         * @return int|null Identificador del producto creado o null en caso de error.
         */
        public function create()
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("INSERT INTO `productos` (`usuario_id`, `idioma_id`, `nombre`, `descripcion`, `precio`,`stock`, `categoria`, `tipo`, `imagen_url`) VALUES (?,?,?,?,?,?,?,?,?)");
                        $sentencia->bindParam(1, $this->usuario_id);
                        $sentencia->bindParam(2, $this->idioma_id);
                        $sentencia->bindParam(3, $this->nombre);
                        $sentencia->bindParam(4, $this->descripcion);
                        $sentencia->bindParam(5, $this->precio);
                        $sentencia->bindParam(6, $this->stock);
                        $sentencia->bindParam(7, $this->categoria);
                        $sentencia->bindParam(8, $this->tipo);
                        $sentencia->bindParam(9, $this->imagen_url);
                        $sentencia->execute();
                        return $conn->lastInsertId();
                } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                }
        }

        /**
         * Recupera todos los productos disponibles.
         * 
         * @return array|null Lista de productos o null en caso de error.
         */
        static function getAllProductos()
        {
                try {
                        $conn = getDbConnection();
                        $query = $conn->query("SELECT * FROM productos NATURAL JOIN idioma WHERE stock != 0 ORDER BY fecha_agregado DESC");
                        return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error al ejecutar la query";
                }
        }

        /**
         * Recupera productos filtrados según los parámetros proporcionados.
         * 
         * @param string $expansion Filtros de expansión.
         * @param array $tipos Lista de tipos de productos.
         * @param array $categorias Lista de categorías de productos.
         * @param string $idioma Identificador del idioma.
         * @param float $min Precio mínimo.
         * @param float $max Precio máximo.
         * @return array|null Lista de productos filtrados o null en caso de error.
         */
        static function getAllProductosFiltered($expansion, $tipos, $categorias, $idioma, $min, $max)
        {
                $expansion = $expansion != "" ? "AND producto_id IN (SELECT producto_id FROM marcar NATURAL JOIN filtros WHERE filtro_id IN (\"" . $expansion . "\"))" : "";
                $tipos = $tipos != [] ? "AND tipo IN (\"" . implode('","', $tipos) . "\")" : "";
                $categorias = $categorias != [] ? "AND categoria IN (\"" . implode('","', $categorias) . "\")" : "";
                $idioma = $idioma != "" ? "AND idioma_id IN (\"" . $idioma . "\")" : "";

                try {
                        $conn = getDbConnection();
                        $query = $conn->query("SELECT * FROM productos WHERE stock != 0 AND precio >= $min AND precio <= $max $expansion $tipos $categorias $idioma ORDER BY fecha_agregado DESC");
                        return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error al ejecutar la query";
                }
        }

        /**
         * Recupera los productos vendidos por un usuario específico.
         * 
         * @param int $id Identificador del usuario.
         * @return array|null Lista de productos vendidos o null en caso de error.
         */
        static function recuperarVendidos($id)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT p.producto_id AS producto_id, p.nombre AS nombre, p.precio AS precio, p.imagen_url AS imagen_url, pe.pedido_id AS pedido_id FROM `usuarios` AS u JOIN `productos` AS p ON p.usuario_id = u.usuario_id JOIN `pedidos` AS pe ON p.producto_id = pe.producto_id WHERE u.usuario_id = ? ORDER BY pe.fecha_pedido DESC");
                        $sentencia->bindParam(1, $id);
                        $sentencia->execute();
                        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                }
        }

        /**
         * Recupera los productos comprados por un usuario específico.
         * 
         * @param int $id Identificador del usuario.
         * @return array|null Lista de productos comprados o null en caso de error.
         */
        static function recuperarComprados($id)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT p.producto_id AS producto_id, p.nombre AS nombre, p.precio AS precio, p.imagen_url AS imagen_url, pe.pedido_id AS pedido_id FROM `usuarios` AS u JOIN `pedidos` AS pe ON u.usuario_id = pe.usuario_id JOIN `productos` AS p ON p.producto_id = pe.producto_id WHERE u.usuario_id = ? ORDER BY pe.fecha_pedido DESC");
                        $sentencia->bindParam(1, $id);
                        $sentencia->execute();
                        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                }
        }




        /**
         * Recupera los productos que un usuario ha marcado como "me gusta".
         * 
         * @param int $id Identificador del usuario.
         * @return array|null Lista de productos que el usuario ha marcado como "me gusta" o null en caso de error.
         */
        static function recuperarLikes($id)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT p.producto_id AS producto_id, p.nombre AS nombre, p.precio AS precio, p.imagen_url AS imagen_url, pe.pedido_id AS pedido_id 
                                             FROM `usuarios` AS u 
                                             JOIN `pedidos` AS pe ON u.usuario_id = pe.usuario_id 
                                             JOIN `productos` AS p ON p.producto_id = pe.producto_id 
                                             WHERE u.usuario_id = ? AND pe.me_gusta = 1 
                                             ORDER BY pe.fecha_pedido DESC");
                        $sentencia->bindParam(1, $id);
                        $sentencia->execute();
                        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                }
        }

        /**
         * Recupera los productos que un usuario ha agregado a su lista de deseos.
         * 
         * @param int $id Identificador del usuario.
         * @return array|null Lista de productos deseados por el usuario o null en caso de error.
         */
        static function recuperarDeseados($id)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT p.producto_id AS producto_id, p.nombre AS nombre, p.precio AS precio, p.imagen_url AS imagen_url 
                                             FROM `usuarios` AS u 
                                             JOIN `lista_deseados` AS l ON u.usuario_id = l.usuario_id 
                                             JOIN `productos` AS p ON p.producto_id = l.producto_id 
                                             WHERE u.usuario_id = ? 
                                             ORDER BY l.fecha_agregado DESC");
                        $sentencia->bindParam(1, $id);
                        $sentencia->execute();
                        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                }
        }

        /**
         * Recupera un producto específico a través de su identificador único.
         * 
         * @param int $id Identificador único del producto.
         * @return array|null Detalles del producto o null en caso de error.
         */
        static function recuperarPorId($id)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT * FROM `productos` NATURAL JOIN idioma WHERE producto_id = ?");
                        $sentencia->bindParam(1, $id);
                        $sentencia->execute();
                        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                }
        }

        /**
         * Actualiza el stock de un producto restando una cantidad específica.
         * 
         * @param int $id Identificador único del producto.
         * @param int $cantidad Cantidad a restar del stock.
         * @return void
         */
        static function cambiarStock($id, $cantidad)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("UPDATE `productos` SET `stock` = (SELECT stock FROM `productos` WHERE producto_id = ?) - ? WHERE producto_id = ?");
                        $sentencia->bindParam(1, $id);
                        $sentencia->bindParam(2, $cantidad);
                        $sentencia->bindParam(3, $id);
                        $sentencia->execute();
                } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                }
        }

        /**
         * Recupera los tres productos más deseados.
         * 
         * @return array|null Lista de los tres productos más deseados o null en caso de error.
         */
        static function masDeseados()
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT p.producto_id AS producto_id, p.nombre AS nombre, p.precio AS precio, p.imagen_url AS imagen_url, COUNT(d.producto_id) AS veces_deseado 
                                             FROM productos p 
                                             JOIN lista_deseados d ON p.producto_id = d.producto_id 
                                             GROUP BY p.producto_id 
                                             ORDER BY veces_deseado DESC LIMIT 3");
                        $sentencia->execute();
                        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                }
        }

        /**
         * Recupera los tres productos más recientes agregados.
         * 
         * @return array|null Lista de los tres productos más recientes o null en caso de error.
         */
        static function masRecientes()
        {
                try {
                        $conn = getDbConnection();
                        $query = $conn->query("SELECT * FROM productos NATURAL JOIN idioma ORDER BY fecha_agregado DESC LIMIT 3");
                        return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error al ejecutar la query";
                }
        }
        /**
         * Modifica un producto en la base de datos.
         * 
         * @return int|null Identificador del producto modificado o null en caso de error.
         */
        public function modificar($id){
                try{
                    $conn = getDbConnection();
                    $sentencia = $conn->prepare("UPDATE `productos` SET `usuario_id`= ?,`idioma_id`= ?,`nombre`= ?,`descripcion`= ?,`precio`= ?,`stock`= ?,`categoria`= ?,`tipo`= ?,`imagen_url`= ? WHERE producto_id = ?");
                    $sentencia->bindParam(1, $this->usuario_id);
                    $sentencia->bindParam(2, $this->idioma_id);
                    $sentencia->bindParam(3, $this->nombre);
                    $sentencia->bindParam(4, $this->descripcion);
                    $sentencia->bindParam(5, $this->precio);
                    $sentencia->bindParam(6, $this->stock);
                    $sentencia->bindParam(7, $this->categoria);
                    $sentencia->bindParam(8, $this->tipo);
                    $sentencia->bindParam(9, $this->imagen_url);
                    $sentencia->bindParam(10, $id);
                    $sentencia->execute();
                    return $conn->lastInsertId();
                }catch(Exception $e){
                    echo "Error".$e->getMessage();
                }
        } 

        /**
         * Recupera todos los productos.
         * 
         * @return array|null Lista de productos o null en caso de error.
         */
        static function getAllProductosAdmin(){
                try{
                    $conn = getDbConnection();
                    $query = $conn->query("Select * from productos NATURAL JOIN idioma ORDER BY fecha_agregado DESC");
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }catch(Exception $e){
                    echo "Error al ejecutar la query";
                }
            }




        /**
         * Establece el identificador del idioma asociado al producto.
         * 
         * @param int $idioma_id Identificador del idioma a asignar.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setIdioma_id($idioma_id)
        {
                $this->idioma_id = $idioma_id;
                return $this;
        }

        /**
         * Obtiene el identificador del usuario asociado al producto.
         * 
         * @return int Identificador del usuario.
         */
        public function getUsuario_id()
        {
                return $this->usuario_id;
        }

        /**
         * Establece el identificador del usuario asociado al producto.
         * 
         * @param int $usuario_id Identificador del usuario a asignar.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setUsuario_id($usuario_id)
        {
                $this->usuario_id = $usuario_id;
                return $this;
        }

        /**
         * Obtiene el nombre del producto.
         * 
         * @return string Nombre del producto.
         */
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Establece el nombre del producto.
         * 
         * @param string $nombre Nombre a asignar al producto.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;
                return $this;
        }

        /**
         * Obtiene la descripción del producto.
         * 
         * @return string Descripción del producto.
         */
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Establece la descripción del producto.
         * 
         * @param string $descripcion Descripción a asignar al producto.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;
                return $this;
        }

        /**
         * Obtiene el precio del producto.
         * 
         * @return float Precio del producto.
         */
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Establece el precio del producto.
         * 
         * @param float $precio Precio a asignar al producto.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setPrecio($precio)
        {
                $this->precio = $precio;
                return $this;
        }

        /**
         * Obtiene el stock disponible del producto.
         * 
         * @return int Cantidad de stock del producto.
         */
        public function getStock()
        {
                return $this->stock;
        }

        /**
         * Establece el stock disponible del producto.
         * 
         * @param int $stock Cantidad de stock a asignar al producto.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setStock($stock)
        {
                $this->stock = $stock;
                return $this;
        }

        /**
         * Obtiene la categoría del producto.
         * 
         * @return string Categoría del producto.
         */
        public function getCategoria()
        {
                return $this->categoria;
        }

        /**
         * Establece la categoría del producto.
         * 
         * @param string $categoria Categoría a asignar al producto.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setCategoria($categoria)
        {
                $this->categoria = $categoria;
                return $this;
        }

        /**
         * Obtiene el tipo de producto.
         * 
         * @return string Tipo de producto.
         */
        public function getTipo()
        {
                return $this->tipo;
        }

        /**
         * Establece el tipo de producto.
         * 
         * @param string $tipo Tipo a asignar al producto.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setTipo($tipo)
        {
                $this->tipo = $tipo;
                return $this;
        }

        /**
         * Obtiene la URL de la imagen del producto.
         * 
         * @return string URL de la imagen del producto.
         */
        public function getImagen_url()
        {
                return $this->imagen_url;
        }

        /**
         * Establece la URL de la imagen del producto.
         * 
         * @param string $imagen_url URL de la imagen a asignar al producto.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setImagen_url($imagen_url)
        {
                $this->imagen_url = $imagen_url;
                return $this;
        }

        /**
         * Obtiene la fecha en que el producto fue agregado.
         * 
         * @return string Fecha de agregado del producto.
         */
        public function getFecha_agregado()
        {
                return $this->fecha_agregado;
        }

        /**
         * Establece la fecha en que el producto fue agregado.
         * 
         * @param string $fecha_agregado Fecha a asignar al producto.
         * @return Productos La instancia actual de la clase, para permitir encadenamiento de métodos.
         */
        public function setFecha_agregado($fecha_agregado)
        {
                $this->fecha_agregado = $fecha_agregado;
                return $this;
        }
}
