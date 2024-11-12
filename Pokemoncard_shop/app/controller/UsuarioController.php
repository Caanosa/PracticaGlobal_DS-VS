<?php
    require "../../app/model/Usuario.php";
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
                return $nuevoProducto->create();
            }
        }
    }
?>