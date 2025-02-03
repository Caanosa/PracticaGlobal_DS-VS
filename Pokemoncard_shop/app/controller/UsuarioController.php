<?php
require_once "../../app/model/Usuario.php";
require_once "../../app/controller/ProductoController.php";

/**
 * Clase UsuarioController
 * 
 * Proporciona métodos para manejar operaciones relacionadas con los usuarios.
 * 
 * @package Controller
 */
class UsuarioController {

    /**
     * Inicia sesión de un usuario verificando su correo y contraseña.
     *
     * @param string $email Correo electrónico del usuario.
     * @param string $contrasena Contraseña del usuario.
     * @return array|null Datos del usuario si la autenticación es exitosa, de lo contrario null.
     */
    public function getLogin($email, $contrasena) {
        return Usuario::getLogin($email, $contrasena);
    }

    /**
     * Crea un nuevo usuario si el correo electrónico o nombre no están registrados previamente.
     *
     * @param string $nombre Nombre del usuario.
     * @param string $email Correo electrónico del usuario.
     * @param string $contrasena Contraseña del usuario.
     * @return array|null Datos del usuario recién creado, de lo contrario null.
     */
    public function crearUsuario($nombre, $email, $contrasena) {
        if (!Usuario::getUsuarioByEmail($email, $nombre)) {
            $nuevoProducto = new Usuario();
            $nuevoProducto->setNombre($nombre);
            $nuevoProducto->setEmail($email);
            $nuevoProducto->setContrasena($contrasena);
            $nuevoProducto->setAdministrador(1);
            $nuevoProducto->create();
            return Usuario::getLogin($email, $contrasena);
        }
    }

    /**
     * Guarda la información del usuario en la sesión y carga productos deseados.
     *
     * @param int $id ID del usuario.
     * @param string $nombre Nombre del usuario.
     */
    public function guardarEnSesion($id, $nombre) {
        $productoController = new ProductoController();
        $productoController->cargarDeseadosSesion($id);
        $_SESSION['usuario'] = [$id, $nombre];
    }

    /**
     * Obtiene la información del usuario almacenada en la sesión.
     *
     * @return array|null Datos del usuario si existe en la sesión, de lo contrario null.
     */
    public function getUSesion() {
        if (isset($_SESSION['usuario'])) {
            return $_SESSION['usuario'];
        }
    }

    /**
     * Obtiene un usuario por su ID.
     *
     * @param int $usuario_id ID del usuario.
     * @return array|null array con la informacion del usuario si se encuentra, de lo contrario null.
     */
    public function getById($usuario_id) {
        return Usuario::getById($usuario_id);
    }

    /**
     * Modifica la imagen de perfil de un usuario.
     *
     * @param int $usuario_id ID del usuario.
     * @param int $numero_img Número de la nueva imagen de perfil.
     */
    public function modificarImagen($usuario_id, $numero_img) {
        Usuario::modificarImagen($usuario_id, $numero_img);
    }

    /**
     * Finaliza la sesión del usuario.
     */
    public function finalizarSesion() {
        session_unset();
    }

    /**
     * Recupera el número total de "me gusta" de los productos de un usuario
     *
     * @param int $id ID del usuario.
     * @return array Resultado de la consulta con la suma de "me gusta".
     */
    public function recuperarLikes($id) {
        return Usuario::recuperarLikes($id);
    }

    /**
     * Modifica la información de un usuario.
     *
     * @param int $id ID del usuario.
     * @param string $nombre Nuevo nombre del usuario.
     * @param string $email Nuevo correo electrónico del usuario.
     * @param string $contrasena Nueva contraseña del usuario.
     * @return bool True si la modificación fue exitosa, false en caso contrario.
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
     * Recupera el atributo de administrador del usuairo con dicho id.
     *
     * @param int $id ID del usuario.
     * @return array|null Array con el atributo administrador o null en caso de fallo.
     */
    public function getAdminId($id){
        return Usuario::getAdminId($id);
    }

    /**
     * Obtiene informacion filtrada del usuario por su ID.
     *
     * @param int $id ID del usuario.
     * @return array Resultado filtrado del usuario.
     */
    public function getFiltradoById($id) {
        return Usuario::getFiltradoById($id);
    }
}
?>
