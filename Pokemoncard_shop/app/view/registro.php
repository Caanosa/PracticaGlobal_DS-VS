<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Registro</title>
    <link rel="stylesheet" href="registro.css">
</head>
<body>
    <div class="contenedor-registro">
        <img src="imagenes/PokemonCard_shop_LOGO.png" alt="logo">
        <div class="registro-div">
            <form id="registroForm" onsubmit="return validarFormulario(event)" method="POST">
              <p class="tituloRegistro">Registro</p>
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" placeholder="Nombre" name="nombre">

              <label for="email">Correo</label>
              <input type="email" id="email" placeholder="Correo" name="email">
        
              <label for="password">Contraseña</label>
              <input type="password" id="password" placeholder="Contraseña" name="contrasena">

              <label for="confirmarPassword">Repetir contraseña</label>
              <input type="password" id="confirmarPassword" placeholder="Repetir Contraseña">
        
              <p id="error-mensage" class="error-mensage"></p>
        
              <button type="submit">Entrar</button>

              <a href="login.php" class="login-link">Ya tengo una cuenta</a>

            </form>
          </div>
    </div>
    <?php
        require "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $campoNombreSaneado = htmlspecialchars(($_POST["nombre"]));
            $campoEmailSaneado = htmlspecialchars(($_POST["email"]));
            $campoContrasenaSaneado = htmlspecialchars($_POST["contrasena"]);
            $userdata = $usuarioController->crearUsuario($campoNombreSaneado, $campoEmailSaneado, $campoContrasenaSaneado);
            if($userdata){
                header('Location: http://localhost/PracticaGlobal_DS-VS/Pokemoncard_shop/app/view/tienda.html');
            }else{
                echo ("<script>
                var errorMensage = document.getElementById('error-mensage');
                errorMensage.textContent = 'Ya existe un usuario con esta direcion de correo';
                </script>");
            }
            
        }
    ?>

    <script>
        function validarFormulario(event) {
            var password = document.getElementById("password").value;
            var confirmarPassword = document.getElementById("confirmarPassword").value;
            var errorMensage = document.getElementById("error-mensage");

            if (password !== confirmarPassword) {
                errorMensage.style.display = "block";
                errorMensage.textContent = "Las contraseñas no coinciden.";
                event.preventDefault();
                return false;
            }
            errorMensage.textContent = "";
            return true;
        }
    </script>
</body>
</html>
