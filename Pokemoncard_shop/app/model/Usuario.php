<?php
    require_once "../../config/dbConnection.php";
    class Usuario{
        private $usuairo_id;
        private $nombre;
        private $email;
        private $contrasena;
        private $direccion;
        private $telefono;
        private $administrador;
        private $fecha_registro;
        
        public function getUsuairo_id()
        {
            return $this->usuairo_id;
        }      

        static function getLogin($email, $contrasena){
            try{
                $conn = getDbConnection();
                $sentencia = $conn->prepare("SELECT * FROM usuarios WHERE email=? and contrasena=?");
                $sentencia->bindParam(1, $email);
                $sentencia->bindParam(2, $contrasena);
                $sentencia->execute();
                $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }catch(Exception $e){
                echo "Error".$e->getMessage();
            }
        }

        static function getUsuarioByEmail($email, $nombre){
                try{
                    $conn = getDbConnection();
                    $sentencia = $conn->prepare("SELECT * FROM usuarios WHERE email=? or nombre=?");
                    $sentencia->bindParam(1, $email);
                    $sentencia->bindParam(2, $nombre);
                    $sentencia->execute();
                    $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                    return $result;
                }catch(Exception $e){
                    echo "Error".$e->getMessage();
                }
            }

        public function create(){
            try{
                $conn = getDbConnection();
                $sentencia = $conn->prepare("INSERT INTO `usuarios` (`nombre`,`email`,`contrasena`,`administrador`) VALUES (?,?,?,?)");
                $sentencia->bindParam(1, $this->nombre);
                $sentencia->bindParam(2, $this->email);
                $sentencia->bindParam(3, $this->contrasena);
                $sentencia->bindParam(4, $this->administrador);
                $sentencia->execute();
            }catch(Exception $e){
                echo "Error".$e->getMessage();
            }
        }
        
        static function getById($usuairo_id){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT * FROM usuarios WHERE usuario_id=?");
                        $sentencia->bindParam(1, $usuairo_id);
                        $sentencia->execute();
                        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                }catch(Exception $e){
                        echo "Error".$e->getMessage();
                }
        }

        static function modificarImagen($id,$numImagen){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("UPDATE `usuarios` SET num_img=? WHERE usuario_id=?");
                        $sentencia->bindParam(1, $numImagen);
                        $sentencia->bindParam(2, $id);
                        $sentencia->execute();
                    }catch(Exception $e){
                        echo "Error".$e->getMessage();
                    }
        }

        static function recuperarLikes($id){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT COUNT(m.producto_id) as likes FROM `usuarios` as u JOIN `productos`as p ON p.usuario_id = u.usuario_id JOIN  `me_gusta` AS m ON p.producto_id = m.producto_id WHERE u.usuario_id = ?");
                        $sentencia->bindParam(1, $id);
                        $sentencia->execute();
                        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                }catch(Exception $e){
                        echo "Error".$e->getMessage();
                }
        }

        static function varificarModificacion($id, $nombre, $email){
                try{
                        $conn = getDbConnection();
                        $sentencia = $conn->prepare("SELECT * FROM usuarios WHERE (nombre=? OR email=?) AND usuario_id != ?");
                        $sentencia->bindParam(1, $nombre);
                        $sentencia->bindParam(2, $email);
                        $sentencia->bindParam(3, $id);
                        $sentencia->execute();
                        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                        return $result;
                }catch(Exception $e){
                        echo "Error".$e->getMessage();
                }
        }

        static function modificar($id, $nombre, $email, $contrasena, $administrador){
                try{
                    $conn = getDbConnection();
                    $sentencia = $conn->prepare("UPDATE `usuarios` SET nombre=?, email=?, contrasena=?, administrador=? WHERE usuario_id=?");
                    $sentencia->bindParam(1, $nombre);
                    $sentencia->bindParam(2, $email);
                    $sentencia->bindParam(3, $contrasena);
                    $sentencia->bindParam(4, $administrador);
                    $sentencia->bindParam(5, $id);
                    $sentencia->execute();
                }catch(Exception $e){
                    echo "Error".$e->getMessage();
                }
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