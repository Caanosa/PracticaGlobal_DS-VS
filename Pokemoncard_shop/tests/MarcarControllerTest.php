<?php
use PHPUnit\Framework\TestCase;

require_once "../../app/controller/MarcarController.php";
require_once "../../app/model/Marcar.php";

class MarcarControllerTest extends TestCase {
    
    protected $marcarController;

    protected function setUp(): void {
        $this->marcarController = new MarcarController();
    }

    public function testCrear() {
        $filtro_id = 1;
        $producto_id = 2;

        $marcarMock = $this->createMock(Marcar::class);
        $marcarMock->expects($this->once())->method('crear');

        $this->marcarController->crear($filtro_id, $producto_id);
        
        $this->assertTrue(true); // Solo para asegurar que el método se ejecutó sin errores
    }

    public function testRecuperarPorId() {
        $id = 1;
        $expectedData = ['id' => 1, 'filtro_id' => 1, 'producto_id' => 2];
        
        $marcarMock = $this->createMock(Marcar::class);
        $marcarMock->expects($this->once())
                   ->method('recuperarPorId')
                   ->with($id)
                   ->willReturn($expectedData);
        
        $result = $this->marcarController->recuperarPorId($id);
        
        $this->assertEquals($expectedData, $result);
    }

    public function testEliminarPorId() {
        $id = 1;
        
        $marcarMock = $this->createMock(Marcar::class);
        $marcarMock->expects($this->once())
                   ->method('elimarPorId')
                   ->with($id)
                   ->willReturn(true);
        
        $result = $this->marcarController->elimarPorId($id);
        
        $this->assertTrue($result);
    }
}
?>
