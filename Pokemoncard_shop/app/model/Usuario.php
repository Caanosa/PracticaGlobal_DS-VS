<?php
    class Usuario{
        private $usuairo_id;
        private $nombre;
        private $email;
        private $contrasena;
        private $direccion;
        private $telefono;
        private $administrador;
        private $fecha_registro;

        public function __construct($usuairo_id, $nombre, $email, $contrasena, $direccion, $telefono,$administrador, $fecha_registro){
            $this->usuairo_id = $usuairo_id;
            $this->nombre = $nombre;
            $this->email = $email;
            $this->contrasena = $contrasena;
            $this->direccion = $direccion;
            $this->telefono = $telefono;
            $this->administrador = $administrador;
            $this->fecha_registro = $fecha_registro;
        }
        
        
        public function getUsuairo_id()
        {
                return $this->usuairo_id;
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

        public function getEmail()
        {
                return $this->email;
        }

        
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        public function getContrasena()
        {
                return $this->contrasena;
        }

        public function setContrasena($contrasena)
        {
                $this->contrasena = $contrasena;

                return $this;
        }

        public function getDireccion()
        {
                return $this->direccion;
        }

        public function setDireccion($direccion)
        {
                $this->direccion = $direccion;

                return $this;
        }
 
        public function getTelefono()
        {
                return $this->telefono;
        }
 
        public function setTelefono($telefono)
        {
                $this->telefono = $telefono;

                return $this;
        }
 
        public function getAdministrador()
        {
                return $this->administrador;
        }
 
        public function setAdministrador($administrador)
        {
                $this->administrador = $administrador;

                return $this;
        }

        public function getFecha_registro()
        {
                return $this->fecha_registro;
        }

        public function setFecha_registro($fecha_registro)
        {
                $this->fecha_registro = $fecha_registro;

                return $this;
        }
    }
?>