<?php
    // Se requiere la clase Usuario para gestionar las operaciones relacionadas con usuarios
    // Se requiere ProductoController para manejar los productos deseados en la sesión del usuario
    require_once "../../app/model/Usuario.php";
    require_once "../../app/controller/ProductoController.php";

    /**
     * Clase controladora para gestionar las operaciones relacionadas con los usuarios.
     */
    class UsuarioController {

        /**
         * Inicia sesión de un usuario mediante su correo electrónico y contraseña.
         *
         * @param string $email Correo electrónico del usuario.
         * @param string $contrasena Contraseña del usuario.
         * 
         * @return array|null Datos del usuario si las credenciales son válidas, de lo contrario, null.
         */
        public function getLogin($email, $contrasena) {
            return Usuario::getLogin($email, $contrasena);
        }

        /**
         * Crea un nuevo usuario si el correo electrónico no está registrado.
         *
         * @param string $nombre Nombre del usuario.
         * @param string $email Correo electrónico del usuario.
         * @param string $contrasena Contraseña del usuario.
         * 
         * @return array|null Datos del usuario creado si es exitoso, de lo contrario, null.
         */
        public function crearUsuario($nombre, $email, $contrasena) {
            if (!Usuario::getUsuarioByEmail($email, $nombre)) {
                $nuevoUsuario = new Usuario();
                $nuevoUsuario->setNombre($nombre);
                $nuevoUsuario->setEmail($email);
                $nuevoUsuario->setContrasena($contrasena);
                $nuevoUsuario->setAdministrador(1);
                $nuevoUsuario->create();
                return Usuario::getLogin($email, $contrasena);
            }
        }

        /**
         * Guarda la información del usuario y sus productos deseados en la sesión.
         *
         * @param int $id ID del usuario.
         * @param string $nombre Nombre del usuario.
         * 
         * @return void
         */
        public function guardarEnSesion($id, $nombre) {
            $productoController = new ProductoController();
            $productoController->cargarDeseadosSesion($id);
            $_SESSION['usuario'] = [$id, $nombre];
        }

        /**
         * Recupera la información del usuario desde la sesión.
         *
         * @return array|null Información del usuario en la sesión, o null si no está definida.
         */
        public function getUSesion() {
            if (isset($_SESSION['usuario'])) {
                return $_SESSION['usuario'];
            }
        }

        /**
         * Recupera los datos de un usuario por su ID.
         *
         * @param int $usuario_id ID del usuario.
         * 
         * @return array Datos del usuario.
         */
        public function getById($usuario_id) {
            return Usuario::getById($usuario_id);
        }

        /**
         * Modifica la imagen de perfil del usuario.
         *
         * @param int $usuario_id ID del usuario.
         * @param int $numero_img Número de la nueva imagen de perfil.
         * 
         * @return void
         */
        public function modificarImagen($usuario_id, $numero_img) {
            Usuario::modificarImagen($usuario_id, $numero_img);
        }

        /**
         * Finaliza la sesión del usuario.
         * 
         * @return void
         */
        public function finalizarSesion() {
            session_unset();
        }

        /**
         * Recupera el número de 'me gusta' de un usuario.
         *
         * @param int $id ID del usuario.
         * 
         * @return int Número de 'me gusta'.
         */
        public function recuperarLikes($id) {
            return Usuario::recuperarLikes($id);
        }

        /**
         * Modifica los datos de un usuario si los nuevos valores no están en uso.
         *
         * @param int $id ID del usuario.
         * @param string $nombre Nuevo nombre del usuario.
         * @param string $email Nuevo correo electrónico del usuario.
         * @param string $contrasena Nueva contraseña del usuario.
         * 
         * @return bool True si la modificación fue exitosa, false si no se realizó.
         */
        public function modificar($id, $nombre, $email, $contrasena) {
            if (!Usuario::varificarModificacion($id, $nombre, $email)) {
                Usuario::modificar($id, $nombre, $email, $contrasena, 1);
                $this->guardarEnSesion($id, $nombre);
                return true;
            } else {
                return false;
            }
        }

        /**
         * Recupera un filtro de datos de usuario por su ID.
         *
         * @param int $id ID del usuario.
         * 
         * @return array Datos filtrados del usuario.
         */
        public function getFiltradoById($id) {
            return Usuario::getFiltradoById($id);
        }
    }
?>
