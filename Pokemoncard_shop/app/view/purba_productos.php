<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    <?php
        require "../../app/controller/ProductoController.php";
        $productoController = new ProductoController();
        print_r($productoController->getAllProductos());
    ?>
</body>
</html>