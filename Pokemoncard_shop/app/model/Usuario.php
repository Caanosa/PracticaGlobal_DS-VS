<?php

/**
 * Se incluye el archivo para obtener la conexión a la base de datos.
 */
require_once "../../config/dbConnection.php";

/**
 * Clase Usuario que representa un usuario del sistema.
 */
class Usuario
{
        /** @var int $usuairo_id Identificador único del usuario. */
        private $usuairo_id;

        /** @var string $nombre Nombre del usuario. */
        private $nombre;

        /** @var string $email Correo electrónico del usuario. */
        private $email;

        /** @var string $contrasena Contraseña del usuario. */
        private $contrasena;

        /** @var string $direccion Dirección del usuario. */
        private $direccion;

        /** @var string $telefono Teléfono del usuario. */
        private $telefono;

        /** @var bool $administrador Indica si el usuario es administrador. */
        private $administrador;

        /** @var string $fecha_registro Fecha de registro del usuario. */
        private $fecha_registro;

        /**
         * Obtiene el ID del usuario.
         * 
         * @return int El ID del usuario.
         */
        public function getUsuairo_id()
        {
                return $this->usuairo_id;
        }

        /**
         * Valida las credenciales de inicio de sesión de un usuario.
         * 
         * @param string $email Correo electrónico del usuario.
         * @param string $contrasena Contraseña del usuario.
         * @return array Resultado de la consulta a la base de datos.
         */
        static function getLogin($email, $contrasena)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT * FROM usuarios WHERE email=? and contrasena=?");
                        $sentencia->bindParam(1, $email);
                        $sentencia->bindParam(2, $contrasena);
                        $sentencia->execute();
                        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error" . $e->getMessage();
                }
        }

        /**
         * Obtiene un usuario por su correo electrónico o nombre.
         * 
         * @param string $email Correo electrónico del usuario.
         * @param string $nombre Nombre del usuario.
         * @return array Resultado de la consulta a la base de datos.
         */
        static function getUsuarioByEmail($email, $nombre)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT * FROM usuarios WHERE email=? or nombre=?");
                        $sentencia->bindParam(1, $email);
                        $sentencia->bindParam(2, $nombre);
                        $sentencia->execute();
                        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error" . $e->getMessage();
                }
        }

        /**
         * Crea un nuevo usuario en la base de datos.
         * 
         * @return void
         */
        public function create()
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("INSERT INTO `usuarios` (`nombre`, `email`, `contrasena`, `administrador`) VALUES (?,?,?,?)");
                        $sentencia->bindParam(1, $this->nombre);
                        $sentencia->bindParam(2, $this->email);
                        $sentencia->bindParam(3, $this->contrasena);
                        $sentencia->bindParam(4, $this->administrador);
                        $sentencia->execute();
                } catch (Exception $e) {
                        echo "Error" . $e->getMessage();
                }
        }

        /**
         * Obtiene un usuario por su ID.
         * 
         * @param int $usuairo_id ID del usuario.
         * @return array Resultado de la consulta a la base de datos.
         */
        static function getById($usuairo_id)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT * FROM usuarios WHERE usuario_id=?");
                        $sentencia->bindParam(1, $usuairo_id);
                        $sentencia->execute();
                        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
                } catch (Exception $e) {
                        echo "Error" . $e->getMessage();
                }
        }

        /**
         * Modifica el número de imagen de un usuario.
         * 
         * @param int $id ID del usuario.
         * @param int $numImagen Nuevo número de imagen.
         * @return void
         */
        static function modificarImagen($id, $numImagen)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("UPDATE `usuarios` SET num_img=? WHERE usuario_id=?");
                        $sentencia->bindParam(1, $numImagen);
                        $sentencia->bindParam(2, $id);
                        $sentencia->execute();
                } catch (Exception $e) {
                        echo "Error" . $e->getMessage();
                }
        }


        /**
         * Recupera el número total de "me gusta" de los productos de un usuario.
         *
         * @param int $id ID del usuario.
         * @return array Resultado de la consulta con la suma de "me gusta".
         */
        static function recuperarLikes($id)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("
                SELECT SUM(me_gusta) as likes 
                FROM `pedidos` as pe 
                JOIN productos as p ON p.producto_id = pe.producto_id 
                WHERE p.usuario_id = ?
            ");
                        $sentencia->bindParam(1, $id);
                        $sentencia->execute();
                        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                } catch (Exception $e) {
                        echo "Error" . $e->getMessage();
                }
        }

        /**
         * Verifica si un nombre o email ya está en uso por otro usuario diferente al proporcionado.
         *
         * @param int $id ID del usuario actual.
         * @param string $nombre Nombre a verificar.
         * @param string $email Correo electrónico a verificar.
         * @return array Resultado de la consulta indicando si ya existe un conflicto.
         */
        static function varificarModificacion($id, $nombre, $email)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("
                SELECT * FROM usuarios 
                WHERE (nombre=? OR email=?) AND usuario_id != ?
            ");
                        $sentencia->bindParam(1, $nombre);
                        $sentencia->bindParam(2, $email);
                        $sentencia->bindParam(3, $id);
                        $sentencia->execute();
                        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                } catch (Exception $e) {
                        echo "Error" . $e->getMessage();
                }
        }

        /**
         * Modifica los datos de un usuario en la base de datos.
         *
         * @param int $id ID del usuario.
         * @param string $nombre Nuevo nombre del usuario.
         * @param string $email Nuevo correo electrónico del usuario.
         * @param string $contrasena Nueva contraseña del usuario.
         * @param bool $administrador Indica si el usuario será administrador.
         * @return void
         */
        static function modificar($id, $nombre, $email, $contrasena, $administrador)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("
                UPDATE `usuarios` 
                SET nombre=?, email=?, contrasena=?, administrador=? 
                WHERE usuario_id=?
            ");
                        $sentencia->bindParam(1, $nombre);
                        $sentencia->bindParam(2, $email);
                        $sentencia->bindParam(3, $contrasena);
                        $sentencia->bindParam(4, $administrador);
                        $sentencia->bindParam(5, $id);
                        $sentencia->execute();
                } catch (Exception $e) {
                        echo "Error" . $e->getMessage();
                }
        }

        /**
         * Obtiene información filtrada de un usuario por su ID.
         *
         * @param int $usuairo_id ID del usuario.
         * @return array Resultado de la consulta con los datos filtrados.
         */
        static function getFiltradoById($usuairo_id)
        {
                try {
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("
                SELECT usuario_id, nombre, num_img 
                FROM usuarios 
                WHERE usuario_id=?
            ");
                        $sentencia->bindParam(1, $usuairo_id);
                        $sentencia->execute();
                        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                } catch (Exception $e) {
                        echo "Error" . $e->getMessage();
                }
        }

        /**
         * Obtiene el nombre del usuario.
         *
         * @return string El nombre del usuario.
         */
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Establece el nombre del usuario.
         *
         * @param string $nombre Nuevo nombre del usuario.
         * @return self
         */
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;
                return $this;
        }

        /**
         * Obtiene el correo electrónico del usuario.
         *
         * @return string El correo electrónico del usuario.
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Establece el correo electrónico del usuario.
         *
         * @param string $email Nuevo correo electrónico del usuario.
         * @return self
         */
        public function setEmail($email)
        {
                $this->email = $email;
                return $this;
        }

        /**
         * Obtiene la contraseña del usuario.
         *
         * @return string La contraseña del usuario.
         */
        public function getContrasena()
        {
                return $this->contrasena;
        }

        /**
         * Establece la contraseña del usuario.
         *
         * @param string $contrasena Nueva contraseña del usuario.
         * @return self
         */
        public function setContrasena($contrasena)
        {
                $this->contrasena = $contrasena;
                return $this;
        }

        /**
         * Obtiene la dirección del usuario.
         *
         * @return string La dirección del usuario.
         */
        public function getDireccion()
        {
                return $this->direccion;
        }

        /**
         * Establece la dirección del usuario.
         *
         * @param string $direccion Nueva dirección del usuario.
         * @return self
         */
        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;
                return $this;
        }

        /**
         * Obtiene el teléfono del usuario.
         *
         * @return string El teléfono del usuario.
         */
        public function getTelefono()
        {
                return $this->telefono;
        }

        /**
         * Establece el teléfono del usuario.
         *
         * @param string $telefono Nuevo teléfono del usuario.
         * @return self
         */
        public function setTelefono($telefono)
        {
                $this->telefono = $telefono;
                return $this;
        }

        /**
         * Obtiene el rol de administrador del usuario.
         *
         * @return bool Si el usuario es administrador.
         */
        public function getAdministrador()
        {
                return $this->administrador;
        }

        /**
         * Establece el rol de administrador del usuario.
         *
         * @param bool $administrador Nuevo valor de administrador.
         * @return self
         */
        public function setAdministrador($administrador)
        {
                $this->administrador = $administrador;
                return $this;
        }

        /**
         * Obtiene la fecha de registro del usuario.
         *
         * @return string La fecha de registro del usuario.
         */
        public function getFecha_registro()
        {
                return $this->fecha_registro;
        }

        /**
         * Establece la fecha de registro del usuario.
         *
         * @param string $fecha_registro Nueva fecha de registro del usuario.
         * @return self
         */
        public function setFecha_registro($fecha_registro)
        {
                $this->fecha_registro = $fecha_registro;
                return $this;
        }
}
