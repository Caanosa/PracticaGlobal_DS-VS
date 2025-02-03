<?php
    require_once "../../config/dbConnection.php";

    /**
     * Clase Filtro
     * 
     * Representa el modelo de datos para la tabla "filtros" en la base de datos.
     * 
     * @package Model
     */
    class Filtro {
        /**
         * @var int $filtro_id ID del filtro (atributo privado).
         */
        private $filtro_id;

        /**
         * @var string $nombre_filtro Nombre del filtro (atributo privado).
         */
        private $nombre_filtro;

        /**
         * Obtiene todos los filtros de la base de datos ordenados por nombre.
         * 
         * @return array Lista de filtros obtenida de la base de datos.
         * @throws Exception Si ocurre un error durante la ejecución de la consulta.
         */
        static function getAllFiltros(){
            try {
                $conn = getDbConnection();
                $query = $conn->query("SELECT * FROM filtros ORDER BY nombre_filtro");
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;

            } catch(Exception $e) {
                echo "Error al ejecutar la query";
            }
        }

        /**
         * Obtiene el ID del filtro.
         * 
         * @return int El ID del filtro.
         */
        public function getFiltro_id()
        {
            return $this->filtro_id;
        }

        /**
         * Obtiene el nombre del filtro.
         * 
         * @return string El nombre del filtro.
         */
        public function getNombre_filtro()
        {
            return $this->nombre_filtro;
        }

        /**
         * Establece el nombre del filtro.
         * 
         * @param string $nombre_filtro El nombre del filtro a establecer.
         * @return $this La instancia actual de la clase.
         */
        public function setNombre_filtro($nombre_filtro)
        {
            $this->nombre_filtro = $nombre_filtro;
            return $this;
        }
    }
?>
