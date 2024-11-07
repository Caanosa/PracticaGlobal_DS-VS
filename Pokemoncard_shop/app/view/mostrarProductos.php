<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require "../../app/controller/ProductController.php";
        $productoController = new ProductController();
        $productos = $productoController->getAllProducts();
        echo "<h2>Lista de productos</h2>";
        echo "<pre>";

        //var_dump($productos);
        foreach($productos as $producto){
            echo "<form method='POST'>";
            echo "<input type='hidden' name='producto'>";
            echo "<input type='hidden' name='id' value='".$producto['nombre']."'>";
            echo "<input type='text' name='nombre' value=".$producto['nombre'].">";
            echo "<input type='text' name='precio' value=".$producto['precio'].">";
            echo "<input type='submit' value='Modificar'></input>";
            echo "</form>";
        }
        echo "</pre>";
        $productoGalleas = $productoController->getProductbyName("galletas");
        echo"<h3>".var_dump($productoGalleas)."<h3>";

        echo "<form method='POST' >";
        echo "<input type='hidden' name='Crearproducto'>";
        echo "<label>Nombre producto:</label>";
        echo "<input type='text' name='nombre'>nombre producto:</input>";
        echo "<label>Precio</label>";
        echo "<input type='text' name='precio'>precio:</input>";
        echo "<input type='submit'></input>";
        echo "</form>";

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $campoNombreSaneado = htmlspecialchars(($_POST["nombre"]));
            $campoPrecioSaneado = htmlspecialchars($_POST["precio"]);
            if(!filter_var($campoNombreSaneado, FILTER_VALIDATE_FLOAT)){
                $productoController->crearProducto($campoNombreSaneado, $campoPrecioSaneado);
            }else{
                echo("Precio no valido");
            }
            
        }
        
        
    ?>
</body>
</html>