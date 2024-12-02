<?php
    require_once "../../config/dbConnection.php";
    class Filtro{
        private $filtro_id;
        private $nombre_filtro;

        static function getAllFiltros(){
            try{
                $conn = getDbConnection();
                $query = $conn->query("Select * from filtros ORDER BY nombre_filtro");
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }catch(Exception $e){
                echo "Error al ejecutar la query";
            }
        }

        public function getFiltro_id()
        {
            return $this->filtro_id;
        }

        public function getNombre_filtro()
        {
            return $this->nombre_filtro;
        }

        public function setNombre_filtro($nombre_filtro)
        {
            $this->nombre_filtro = $nombre_filtro;
            return $this;
        }
    }
?>