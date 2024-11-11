<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>preuva</title>
</head>
<body>
    <h1>Crear cuenta</h1>
    <form method="POST">
        Email: <input type="text" name="email"><br>
        contraseña: <input type="text" name="contrasena"><br>
        <input type="submit">
    </form>
    <?php
        require "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $campoEmailSaneado = htmlspecialchars(($_POST["email"]));
            $campoContrasenaSaneado = htmlspecialchars($_POST["contrasena"]);
            $userdata = $usuarioController->getLogin($campoEmailSaneado, $campoContrasenaSaneado);
            if($userdata){
                print_r($userdata);
            }else{
                echo("No existe dicho usuario");
            }
            
            // if(!filter_var($campoEmailSaneado, FILTER_VALIDATE_EMAIL)){
                
            // }else{
            //     echo("Precio no valido");
            // }
            
        }
    ?>
</body>
</html>