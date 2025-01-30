<?php
use PHPUnit\Framework\TestCase;

require_once "../../app/controller/MarcarController.php";
require_once "../../app/model/Marcar.php";

class MarcarControllerTest extends TestCase {
    
    protected $marcarController;

    protected function setUp(): void {
        $this->marcarController = new MarcarController();
    }


    public function testRecuperarPorId() {
        $id = 55;
        $expectedData = ['filtro_id' => 21, 'marcar_id' => 1, 'producto_id' => 55, 'nombre_filtro' => 'Crystal Guardians'];
        
        $result = $this->marcarController->recuperarPorId($id);

        $this->assertEquals($expectedData, $result[0]);
    }

}
?>
