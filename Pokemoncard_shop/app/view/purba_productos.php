<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<style>
    table{
        border-collapse: collapse;
    }
    td{
        border: solid black 1px;
        padding: 7px;
        text-align: center;
        justify-content: center;
    }
</style>
<body>

    <form method="POST">
        
        usuario_id: <input type="text" name="usuario"><br>
        idioma_id<input type="text" name="idioma"><br>
        nombre<input type="text" name="nombre"><br>
        descripcion<input type="text" name="descripcion"><br>
        precio<input type="text" name="precio"><br>
        stock<input type="text" name="stock"><br>
        categoria<input type="text" name="categoria"><br>
        tipo<input type="text" name="tipo"><br>
        imagen_url<input type="text" name="imagen_url"><br>
        <input type="submit">
    </form>
    <?php
        require_once "../../app/controller/ProductoController.php";
        $productoController = new ProductoController();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $campoUsuarioSaneado = htmlspecialchars(($_POST["usuario"]));
            $campoIdiomaSaneado = htmlspecialchars($_POST["idioma"]);
            $campoNombreSaneado = htmlspecialchars(($_POST["nombre"]));
            $campoDescripcionSaneado = htmlspecialchars(($_POST["descripcion"]));
            $campoPrecioSaneado = htmlspecialchars($_POST["precio"]);
            $campoStockSaneado = htmlspecialchars($_POST["stock"]);
            $campoCategoriaSaneado = htmlspecialchars($_POST["categoria"]);
            $campoTipoSaneado = htmlspecialchars($_POST["tipo"]);
            $campoImagen_urlSaneado = htmlspecialchars($_POST["imagen_url"]);
                                                                                                // <!-- $usuario_id, $idioma_id, $nombre, $descripcion, $precio,$stock, $categoria, $tipo, $imagen_url -->
            $productoController->crearProducto($campoUsuarioSaneado, $campoIdiomaSaneado, $campoNombreSaneado, $campoDescripcionSaneado, $campoPrecioSaneado,$campoStockSaneado,$campoCategoriaSaneado,$campoTipoSaneado,$campoImagen_urlSaneado);
            // if(!filter_var($campoEmailSaneado, FILTER_VALIDATE_EMAIL)){
                
            // }else{
            //     echo("Precio no valido");
            // }
            
        }
        $procuctos = $productoController->getAllProductos();
        echo "<table>";
        foreach ($procuctos as $producto) {
            echo "<tr>";
            echo "<td>".$producto['producto_id']."</td>";
            echo "<td>".$producto['usuario_id']."</td>";
            echo "<td>".$producto['nombre_idioma']."</td>";
            echo "<td>".$producto['nombre']."</td>";
            echo "<td>".$producto['descripcion']."</td>";
            echo "<td>".$producto['precio']."</td>";
            echo "<td>".$producto['stock']."</td>";
            echo "<td>".$producto['categoria']."</td>";
            echo "<td>".$producto['tipo']."</td>";
            echo "<td>".$producto['imagen_url']."</td>";
            echo "<td>".$producto['fecha_agregado']."</td>";
            echo "</tr>";
        }
        echo "</table>";
        //print_r($productoController->getAllProductos());
    ?>
</body>
</html>