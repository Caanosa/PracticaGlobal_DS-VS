<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokémonCS - Aviso legal</title>
    <link rel="icon" href="/app/view/imagenes/logo_ventana3.png">
    <link rel="stylesheet" href="/app/view/enlacesFooter.css">
</head>

<body>
    <?php
        require_once "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
    ?>
    <header>
        <a href="http://pokemoncardshop.com"><img class="img-logo" src="/app/view/imagenes/image.png" alt="logo"></a>
        <nav>
            <ul>
                <li><a href="http://pokemoncardshop.com">Inicio</a></li>
                <li><a href="<?php session_start();  echo $usuarioController->getUSesion() != null?"/app/view/deseados.php":"/app/view/login.php"?>">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <?=$usuarioController->getUSesion() != null&& $usuarioController->getAdminId($usuarioController->getUSesion()[0])[0]['administrador']==1?"<li><a href='/app/view/listaAdmin.php'>Modificar</a></li>":""?>
                <li><a href="<?php session_start();  echo $usuarioController->getUSesion() != null?"/app/view/cuenta.php":"/app/view/login.php"?>"><?php echo $usuarioController->getUSesion() != null?$usuarioController->getUSesion()[1]:"Cuenta"?></a></li>
            </ul>
        </nav>
    </header>
    
    <div class="divTexto">
        <title>Aviso Legal y Condiciones Generales de Uso</title>
        <h1>AVISO LEGAL Y CONDICIONES GENERALES DE USO</h1>
        <p><a href="http://pokemoncardshop.com">http://www.pokemonCard_shop.es</a></p>
    
        <h2>I. INFORMACIÓN GENERAL</h2>
        <p>En cumplimiento con el deber de información dispuesto en la Ley 34/2002 de Servicios de la Sociedad de la
            Información y el Comercio Electrónico (LSSI-CE) de 11 de julio, se facilitan a continuación los siguientes datos
            de información general de este sitio web:</p>
        <p>La titularidad de este sitio web, <a href="http://pokemoncardshop.com">https://www.pokemonCard_shop.es</a>, (en adelante,
            Sitio Web) la ostenta:</p>
        <p>y cuyos datos de contacto son:</p>
        <ul>
            <li>Teléfono de contacto: 722 20 44 71</li>
            <li>Email de contacto: pokemonCard_shopfree@gmail.com</li>
        </ul>
    
        <h2>II. TÉRMINOS Y CONDICIONES GENERALES DE USO</h2>
        <p><strong>El objeto de las condiciones: El Sitio Web</strong></p>
        <p>El objeto de las presentes Condiciones Generales de Uso (en adelante, Condiciones) es regular el acceso y la
            utilización del Sitio Web...</p>
    
        <h2>III. ACCESO Y NAVEGACIÓN EN EL SITIO WEB: EXCLUSIÓN DE GARANTÍAS Y RESPONSABILIDAD</h2>
        <p>Poke Bank no garantiza la continuidad, disponibilidad y utilidad del Sitio Web, ni de los Contenidos o Servicios.
            Poke Bank hará todo lo posible por el buen funcionamiento del Sitio Web...</p>
    
        <h2>IV. POLÍTICA DE ENLACES</h2>
        <p>Se informa que el Sitio Web de Poke Bank pone o puede poner a disposición de los Usuarios medios de enlace...</p>
    
        <h2>V. PROPIEDAD INTELECTUAL E INDUSTRIAL</h2>
        <p>Poke Bank por sí o como parte cesionaria, es titular de todos los derechos de propiedad intelectual e industrial
            del Sitio Web...</p>
    
        <h2>VI. ACCIONES LEGALES, LEGISLACIÓN APLICABLE Y JURISDICCIÓN</h2>
        <p>Poke Bank se reserva la facultad de presentar las acciones civiles o penales que considere necesarias por la
            utilización indebida del Sitio Web y Contenidos...</p>
    
    </div>
    
    <footer class="footer">
        <div class="copyright">
            <a href="http://pokemoncardshop.com">Copyright © 2024 PokemonCard_shop</a>
        </div>
        <div>
            <a href="/app/view/avisoLegal.php">Aviso legal</a> |
            <a href="/app/view/privacidad.php">Política de privacidad</a> |
            <a href="/app/view/coockies.php">Política de Cookies</a> |
            <a href="/app/view/envios.php">Política de envíos</a> |
            <a href="/app/view/reembolso.php">Política de reembolso</a>
        </div>
    </footer>
</body>

</html>