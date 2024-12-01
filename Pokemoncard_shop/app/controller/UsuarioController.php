<?php
    require_once "../../app/model/Usuario.php";
    require_once "../../app/controller/ProductoController.php";
    class UsuarioController{
        public function getLogin($email, $contrasena){
            return Usuario::getLogin($email, $contrasena);
        }

        public function crearUsuario($nombre,$email,$contrasena){
            if(!Usuario::getUsuarioByEmail($email, $nombre)){
                $nuevoProducto = new Usuario();
                $nuevoProducto->setNombre($nombre);
                $nuevoProducto->setEmail($email);
                $nuevoProducto->setContrasena($contrasena);
                $nuevoProducto->setAdministrador(1);
                $nuevoProducto->create();
                return Usuario::getLogin($email, $contrasena);
            }
        }

        public function guardarEnSesion($id, $nombre){
           
            $productoController = new ProductoController();
            $productoController->cargarDeseadosSesion($id);
            $_SESSION['usuario'] = [$id, $nombre];
        }

        public function getUSesion(){
            if(isset($_SESSION['usuario'])){
                return $_SESSION['usuario'];
            }
        }

        public function getById($usuario_id){
            return Usuario::getById($usuario_id);
        }

        public function modificarImagen($usuario_id, $numero_img){
            Usuario::modificarImagen($usuario_id,$numero_img);
        }

        public function finalizarSesion(){
            session_unset();
        }

        public function recuperarLikes($id){
            return Usuario::recuperarLikes($id);
        }

        public function modificar($id,$nombre,$email,$contrasena){
            if(!Usuario::varificarModificacion($id, $nombre, $email)){
                Usuario::modificar($id,$nombre,$email,$contrasena,1);
                $this->guardarEnSesion($id, $nombre);
                return true;
            }else{
                return false;
            }
        }
    }
?>