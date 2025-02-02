<?php
/**
 * Clase Marcar
 * Responsable de gestionar la relación entre filtros y productos en la base de datos.
 */
require_once "../../config/dbConnection.php";
class Marcar {
    /**
     * @var int ID de la relación "marcar".
     */
    private $marcar_id;

    /**
     * @var int ID del filtro asociado.
     */
    private $filtro_id;

    /**
     * @var int ID del producto asociado.
     */
    private $producto_id;

    /**
     * Crea una nueva entrada en la tabla `marcar`.
     *
     * Inserta una relación entre un filtro y un producto en la base de datos.
     */
    public function crear() {
        try {
            $conn = getDbConnection();
            $sentencia = $conn->prepare("INSERT INTO `marcar`(`filtro_id`, `producto_id`) VALUES (?, ?)");
            $sentencia->bindParam(1, $this->filtro_id);
            $sentencia->bindParam(2, $this->producto_id);
            $sentencia->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    /**
     * Elimina una entrada en la tabla `marcar`.
     *
     * Borra la relación entre un filtro y un producto en la base de datos.
     */
    static function elimarPorId($id){
            try{
                    $conn = getDbConnection();
                    $sentencia = $conn->prepare("DELETE FROM `marcar` WHERE producto_id = ?");
                    $sentencia->bindParam(1, $id);
                    $sentencia->execute();
            }catch(Exception $e){
                    echo "Error".$e->getMessage();
            }
    }
    

    /**
     * Recupera las relaciones marcadas por ID de producto.
     *
     * Busca todas las relaciones entre un producto y sus filtros correspondientes.
     *
     * @param int $id ID del producto.
     * @return array|null Lista de relaciones encontradas o null en caso de error.
     */
    static function recuperarPorId($id) {
        try {
            $conn = getDbConnection();
            $sentencia = $conn->prepare("SELECT * FROM `marcar` NATURAL JOIN filtros WHERE producto_id = ?");
            $sentencia->bindParam(1, $id);
            $sentencia->execute();
            $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * Obtiene el ID de la relación "marcar".
     *
     * @return int ID de la relación "marcar".
     */
    public function getMarcar_id() {
        return $this->marcar_id;
    }

    /**
     * Obtiene el ID del filtro asociado.
     *
     * @return int ID del filtro.
     */
    public function getFiltro_id() {
        return $this->filtro_id;
    }

    /**
     * Establece el ID del filtro asociado.
     *
     * @param int $filtro_id ID del filtro.
     * @return $this Instancia actual del objeto.
     */
    public function setFiltro_id($filtro_id) {
        $this->filtro_id = $filtro_id;
        return $this;
    }

    /**
     * Obtiene el ID del producto asociado.
     *
     * @return int ID del producto.
     */
    public function getProducto_id() {
        return $this->producto_id;
    }

    /**
     * Establece el ID del producto asociado.
     *
     * @param int $producto_id ID del producto.
     * @return $this Instancia actual del objeto.
     */
    public function setProducto_id($producto_id) {
        $this->producto_id = $producto_id;
        return $this;
    }
}
?>
