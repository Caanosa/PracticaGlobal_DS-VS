<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="editarUsuario.css">
</head>

<body>
    <?php
        require_once "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
        session_start();
    ?>
    <header>
        <img class="img-logo" src="/app/view/imagenes/image.png" alt="logo">
        <nav>
            <ul>
                <li><a href="/app/view/inicio.php">Inicio</a></li>
                <li><a href="<?php echo $usuarioController->getUSesion() != null?"/app/view/deseados.php":"/app/view/login.php"?>">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <li><a href="<?php echo $usuarioController->getUSesion() != null ? "/app/view/cuenta.php" : "/app/view/login.php" ?>"><?php echo $usuarioController->getUSesion() != null ? $usuarioController->getUSesion()[1] : "Cuenta" ?></a></li>
            </ul>
        </nav>
    </header>

    <div class="contenido">
    <div class="contenedor-registro">
        <div class="registro-div">
            <form id="registroForm" onsubmit="return validarFormulario(event)" method="POST">
              <p class="tituloRegistro">Editar usuario</p>
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" placeholder="Nombre" name="nombre">

              <label for="email">Correo</label>
              <input type="email" id="email" placeholder="Correo" name="email">

              <label for="password">Contraseña</label>
              <input type="password" id="password" placeholder="Contraseña" name="contrasena">

              <label for="confirmarPassword">Repetir contraseña</label>
              <input type="password" id="confirmarPassword" placeholder="Repetir Contraseña">

              <p id="error-mensage" class="error-mensage"></p>

              <button type="submit">Guardar cambios</button>

            </form>
          </div>
    </div>

    </div>

    <footer class="footer">
        <div class="copyright">
            <a href="">Copyright © 2024 PokemonCard_shop</a>
        </div>
        <div>
            <a href="avisoLegal.php">Aviso legal</a> |
            <a href="privacidad.php">Política de privacidad</a> |
            <a href="coockies.php">Política de Cookies</a> |
            <a href="envios.php">Política de envíos</a> |
            <a href="reembolso.php">Política de reembolso</a>
        </div>
    </footer>
</body>

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

</html>