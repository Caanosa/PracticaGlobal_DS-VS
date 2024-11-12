<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="contenedor-login">
        <img src="imagenes/PokemonCard_shop_LOGO.png" alt="logo">
        <div class="login-div">
            <form  method="POST">
              <p>Iniciar sesión</p>
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
        require "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $campoEmailSaneado = htmlspecialchars(($_POST["email"]));
            $campoContrasenaSaneado = htmlspecialchars($_POST["contrasena"]);
            $userdata = $usuarioController->getLogin($campoEmailSaneado, $campoContrasenaSaneado);
            if($userdata){
                header('Location: http://localhost/PracticaGlobal_DS-VS/Pokemoncard_shop/app/view/tienda.html');
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
