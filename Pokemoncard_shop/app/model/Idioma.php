<?php
    require_once "../../config/dbConnection.php";

    /**
     * Clase Idioma
     * Representa el modelo de datos para la tabla "idioma" en la base de datos.
     */
    class Idioma{
        /**
         * @var int $idioma ID del idioma (atributo privado).
         */
        private $idioma;

        /**
         * @var string $nomnbre_idioma Nombre del idioma (atributo privado).
         */
        private $nomnbre_idioma;

        /**
         * Obtiene todos los idiomas de la base de datos.
         * 
         * @return array Lista de idiomas obtenida de la base de datos.
         * @throws Exception Si ocurre un error durante la ejecución de la consulta.
         */
        static function getAllIdiomas(){
            try {
                $conn = getDbConnection();
                $sentencia = $conn->prepare("SELECT * FROM idioma");
                $sentencia->execute();
                $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                return $result;

            } catch(Exception $e) {
                echo "Error al ejecutar la query";
            }
        }

        /**
         * Obtiene el ID del idioma.
         * 
         * @return int El ID del idioma.
         */
        public function getIdioma()
        {
            return $this->idioma;
        }

        /**
         * Obtiene el nombre del idioma.
         * 
         * @return string El nombre del idioma.
         */
        public function getNomnbre_idioma()
        {
            return $this->nomnbre_idioma;
        }

        /**
         * Establece el nombre del idioma.
         * 
         * @param string $nomnbre_idioma El nombre del idioma a establecer.
         * @return $this La instancia actual de la clase.
         */
        public function setNomnbre_idioma($nomnbre_idioma)
        {
            $this->nomnbre_idioma = $nomnbre_idioma;
            return $this;
        }
    }
?>
