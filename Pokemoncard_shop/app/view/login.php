<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokémonCS - Login</title>
    <link rel="icon" href="/app/view/imagenes/logo_ventana3.png">
    <link rel="stylesheet" href="/app/view/login.css">
</head>
<body>
    <div class="contenedor-login">
        <a href="http://pokemoncardshop.com"><img src="/app/view/imagenes/PokemonCard_shop_LOGO.png" alt="logo"></a>
        <div class="login-div">
            <form  method="POST">
              <p class="tituloLogin">Iniciar sesión</p>
              <label for="email">Correo</label>
              <input type="email" id="email" placeholder="Correo" name="email">
        
              <label for="password">Contraseña</label>
              <input type="password" id="password" placeholder="Contraseña" name="contrasena">

              <p id="error-mensage" class="error-mensage"></p>

              <button type="submit">Entrar</button>
        
              <a href="registro.php" class="registro-link">Si no tienes cuenta registrate aquí</a>
            </form>
            
          </div>
    </div>
    <?php
        session_start();
        require_once "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $campoEmailSaneado = htmlspecialchars(($_POST["email"]));
            $campoContrasenaSaneado = htmlspecialchars($_POST["contrasena"]);
            $userdata = $usuarioController->getLogin($campoEmailSaneado, $campoContrasenaSaneado);
            if($userdata){
                $usuarioController->guardarEnSesion($userdata[0]["usuario_id"],$userdata[0]["nombre"]);
                header('Location: http://pokemoncardshop.com');
            }else{
                echo ("<script>
                var errorMensage = document.getElementById('error-mensage');
                errorMensage.textContent = 'El correo o la contraseña son incorrectos';
                </script>");
                
            }
            
        }
    ?>
    
</body>
</html>
