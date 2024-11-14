<?php
    require_once "../../config/dbConnection.php";
    class Idioma{
        private $idioma;
        private $nomnbre_idioma;

        static function getAllIdiomas(){
            try{
                $conn = getDbConnection();
                $sentencia = $conn->prepare("SELECT * FROM idioma");
                $sentencia->execute();
                $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }catch(Exception $e){
                echo "Error al ejecutar la query";
            }
        }

        public function getIdioma()
        {
            return $this->idioma;
        }

        public function getNomnbre_idioma()
        {
            return $this->nomnbre_idioma;
        }

        public function setNomnbre_idioma($nomnbre_idioma)
        {
            $this->nomnbre_idioma = $nomnbre_idioma;
            return $this;
        }
    }
?>