<?php
    // Se requiere la clase Marcar para manejar las operaciones relacionadas con las marcas
    require_once "../../app/model/Marcar.php";

    /**
     * Clase controladora que gestiona las operaciones relacionadas con la entidad Marcar.
     */
    class MarcarController {

        /**
         * Crea una nueva relación entre un filtro y un producto.
         *
         * @param int $filtro_id El ID del filtro asociado.
         * @param int $producto_id El ID del producto asociado.
         * 
         * @return void
         */
        public function crear($filtro_id, $producto_id) {
            // Crea una nueva instancia de Marcar y establece los valores correspondientes
            $marcar = new Marcar();
            $marcar->setFiltro_id($filtro_id);
            $marcar->setProducto_id($producto_id);
            
            // Guarda la nueva relación en la base de datos
            $marcar->crear();
        }

        /**
         * Recupera una relación por su ID.
         *
         * @param int $id El ID de la relación a recuperar.
         * 
         * @return array Un array con los datos de la relación recuperada.
         */
        public function recuperarPorId($id) {
            return Marcar::recuperarPorId($id);
        }

        public function elimarPorId($id){
            return Marcar::elimarPorId($id);
        }
    }
?>
