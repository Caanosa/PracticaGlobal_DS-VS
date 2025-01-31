<?php
    use PHPUnit\Framework\TestCase;
    require_once "../controller/UsuarioController.php";

    class UsuarioControllerTest extends TestCase
    {

        protected $usuarioController;

        protected function setUp(): void {
            $this->usuarioController = new UsuarioController();
        }

        public function testModificarImagen(){
            $id = 1;
            $numImg = rand(1, 6);
            $this->usuarioController->modificarImagen($id, $numImg);
            $usuairoData = $this->usuarioController->getById($id);
            $this->assertEquals($usuairoData[0]["num_img"], $numImg);
        }
    }
?>