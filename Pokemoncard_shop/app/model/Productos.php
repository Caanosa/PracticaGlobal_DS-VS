<?php
    require_once "../../config/dbConnection.php";
    class Productos{
        private $producto_id;
        private $usuario_id;
        private $idioma_id;
        private $nombre;
        private $descripcion;
        private $precio;
        private $stock;
        private $categoria;
        private $tipo;
        private $imagen_url;
        private $fecha_agregado;


        public function getProducto_id()
        {
                return $this->producto_id;
        }

        public function create(){
                try{
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
                }catch(Exception $e){
                    echo "Error".$e->getMessage();
                }
            } 

        static function getAllProductos(){
            try{
                $conn = getDbConnection();
                $query = $conn->query("Select * from productos NATURAL JOIN idioma");
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }catch(Exception $e){
                echo "Error al ejecutar la query";
            }
        }

        static function getAllProductosFiltered(){
                try{
                    $conn = getDbConnection();
                    $query = $conn->query("Select * from productos NATURAL JOIN idioma");
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }catch(Exception $e){
                    echo "Error al ejecutar la query";
                }
            }

        public function getIdioma_id()
        {
                return $this->idioma_id;
        }

        public function setIdioma_id($idioma_id)
        {
                $this->idioma_id = $idioma_id;

                return $this;
        }

        public function getUsuario_id()
        {
                return $this->usuario_id;
        }

        public function setUsuario_id($usuario_id)
        {
                $this->usuario_id = $usuario_id;

                return $this;
        }

        public function getNombre()
        {
                return $this->nombre;
        }

        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        public function getDescripcion()
        {
                return $this->descripcion;
        }
 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }
 
        public function getPrecio()
        {
                return $this->precio;
        }

        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }

        public function getStock()
        {
                return $this->stock;
        }

        public function setStock($stock)
        {
                $this->stock = $stock;

                return $this;
        }
 
        public function getCategoria()
        {
                return $this->categoria;
        }

        public function setCategoria($categoria)
        {
                $this->categoria = $categoria;

                return $this;
        }

        public function getTipo()
        {
                return $this->tipo;
        }
 
        public function setTipo($tipo)
        {
                $this->tipo = $tipo;

                return $this;
        }

        public function getImagen_url()
        {
                return $this->imagen_url;
        }

        public function setImagen_url($imagen_url)
        {
                $this->imagen_url = $imagen_url;

                return $this;
        }

        public function getFecha_agregado()
        {
                return $this->fecha_agregado;
        }

        public function setFecha_agregado($fecha_agregado)
        {
                $this->fecha_agregado = $fecha_agregado;

                return $this;
        }
    }
?>