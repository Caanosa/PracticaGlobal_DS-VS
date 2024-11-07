<?php
    class FavoritosController{
        public function __construct(){
            if(!(session_status() == PHP_SESSION_NONE)){
                session_start();
            }

            if(isset($_SESSION["favoritos"])){
                $_SESSION["favoritos"] = [];
            }
        }

        public function addFavorito(){
            $favorito = new Favorito($_POST["idProducto"],'1',$_POST["nombre"]);
        }
    }
?>