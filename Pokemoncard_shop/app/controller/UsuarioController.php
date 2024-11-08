<?php
    require "../../app/model/Usuario.php";
    class UsuarioController{
        public function getLogin($email, $contrasena){
            return Usuario::getLogin($email, $contrasena);
        }

        public function crearUsuario($nombre,$email,$contrasena){
            $nuevoProducto = new Usuario();
            $nuevoProducto->setNombre($nombre);
            $nuevoProducto->setEmail($email);
            $nuevoProducto->setAdministrador(1);
            $nuevoProducto->create();
        }
    }
?>