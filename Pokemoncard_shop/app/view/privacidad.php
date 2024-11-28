<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso legal</title>
    <link rel="stylesheet" href="/app/view/enlacesFooter.css">
</head>

<body>
    <?php
        require_once "../../app/controller/UsuarioController.php";
        $usuarioController = new UsuarioController();
    ?>
    <header>
        <img class="img-logo" src="/app/view/imagenes/image.png" alt="logo">
        <nav>
            <ul>
                <li><a href="/app/view/inicio.php">Inicio</a></li>
                <li><a href="/app/view/deseados.php">Deseados</a></li>
                <li><a href="/app/view/tienda.php">Tienda</a></li>
                <li><a href="/app/view/publicar.php">Publicar</a></li>
                <li><a href="<?php session_start();  echo $usuarioController->getUSesion() != null?"/app/view/cuenta.php":"/app/view/login.php"?>"><?php echo $usuarioController->getUSesion() != null?$usuarioController->getUSesion()[1]:"Cuenta"?></a></li>
            </ul>
        </nav>
    </header>

    <div class="divTexto">
        <h1>POLÍTICA DE PRIVACIDAD DEL SITIO WEB</h1>
        <p><a href="/app/view/inicio.php">http://www.pokemonCard_shop.es</a></p>

        <h2>I. POLÍTICA DE PRIVACIDAD Y PROTECCIÓN DE DATOS</h2>
        <p>Respetando lo establecido en la legislación vigente, Poke Bank (en adelante, también Sitio Web) se compromete
            a adoptar las medidas técnicas y organizativas necesarias, según el nivel de seguridad adecuado al riesgo de
            los datos recogidos.</p>

        <h3>Leyes que incorpora esta política de privacidad</h3>
        <p>Esta política de privacidad está adaptada a la normativa española y europea vigente en materia de protección
            de datos personales en internet. En concreto, la misma respeta las siguientes normas:</p>
        <ul>
            <li>El Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la
                protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre
                circulación de estos datos (RGPD).</li>
            <li>La Ley Orgánica 3/2018, de 5 de diciembre, de Protección de Datos Personales y garantía de los derechos
                digitales (LOPD-GDD).</li>
            <li>El Real Decreto 1720/2007, de 21 de diciembre, por el que se aprueba el Reglamento de desarrollo de la
                Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal (RDLOPD).</li>
            <li>La Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y de Comercio Electrónico
                (LSSI-CE).</li>
        </ul>

        <h3>Identidad del responsable del tratamiento de los datos personales</h3>
        <p>El responsable del tratamiento de los datos personales recogidos en Poke Bank es:</p>
        <ul>
            <li>Teléfono de contacto: 722 20 44 71</li>
            <li>Email de contacto: <a href="mailto:pokemonCard_shopfree@gmail.com">pokemonCard_shopfree@gmail.com</a></li>
        </ul>

        <h3>Registro de Datos de Carácter Personal</h3>
        <p>En cumplimiento de lo establecido en el RGPD y la LOPD-GDD, le informamos que los datos personales recabados
            por Poke Bank, mediante los formularios extendidos en sus páginas quedarán incorporados y serán tratados en
            nuestro fichero con el fin de poder facilitar, agilizar y cumplir los compromisos establecidos entre Poke
            Bank y el Usuario o el mantenimiento de la relación que se establezca en los formularios que este rellene, o
            para atender una solicitud o consulta del mismo. Asimismo, de conformidad con lo previsto en el RGPD y la
            LOPD-GDD, salvo que sea de aplicación la excepción prevista en el artículo 30.5 del RGPD, se mantiene un
            registro de actividades de tratamiento que especifica, según sus finalidades, las actividades de tratamiento
            llevadas a cabo y las demás circunstancias establecidas en el RGPD.</p>

        <h3>Principios aplicables al tratamiento de los datos personales</h3>
        <p>El tratamiento de los datos personales del Usuario se someterá a los siguientes principios recogidos en el
            artículo 5 del RGPD y en el artículo 4 y siguientes de la Ley Orgánica 3/2018, de 5 de diciembre, de
            Protección de Datos Personales y garantía de los derechos digitales:</p>
        <ul>
            <li><strong>Principio de licitud, lealtad y transparencia:</strong> se requerirá en todo momento el
                consentimiento del Usuario previa información completamente transparente de los fines para los cuales se
                recogen los datos personales.</li>
            <li><strong>Principio de limitación de la finalidad:</strong> los datos personales serán recogidos con fines
                determinados, explícitos y legítimos.</li>
            <li><strong>Principio de minimización de datos:</strong> los datos personales recogidos serán únicamente los
                estrictamente necesarios en relación con los fines para los que son tratados.</li>
            <li><strong>Principio de exactitud:</strong> los datos personales deben ser exactos y estar siempre
                actualizados.</li>
            <li><strong>Principio de limitación del plazo de conservación:</strong> los datos personales solo serán
                mantenidos de forma que se permita la identificación del Usuario durante el tiempo necesario para los
                fines de su tratamiento.</li>
            <li><strong>Principio de integridad y confidencialidad:</strong> los datos personales serán tratados de
                manera que se garantice su seguridad y confidencialidad.</li>
            <li><strong>Principio de responsabilidad proactiva:</strong> el Responsable del tratamiento será responsable
                de asegurar que los principios anteriores se cumplen.</li>
        </ul>

        <h3>Categorías de datos personales</h3>
        <p>Las categorías de datos que se tratan en Poke Bank son únicamente datos identificativos. En ningún caso, se
            tratan categorías especiales de datos personales en el sentido del artículo 9 del RGPD.</p>

        <h3>Base legal para el tratamiento de los datos personales</h3>
        <p>La base legal para el tratamiento de los datos personales es el consentimiento. Poke Bank se compromete a
            recabar el consentimiento expreso y verificable del Usuario para el tratamiento de sus datos personales para
            uno o varios fines específicos.</p>

        <h3>Fines del tratamiento a que se destinan los datos personales</h3>
        <p>Los datos personales son recabados y gestionados por Poke Bank con la finalidad de poder facilitar, agilizar
            y cumplir los compromisos establecidos entre el Sitio Web y el Usuario o el mantenimiento de la relación que
            se establezca en los formularios que este último rellene o para atender una solicitud o consulta.</p>

        <h3>Períodos de retención de los datos personales</h3>
        <p>Los datos personales solo serán retenidos durante el tiempo mínimo necesario para los fines de su tratamiento
            y, en todo caso, únicamente durante el siguiente plazo: 18 meses, o hasta que el Usuario solicite su
            supresión.</p>

        <h3>Destinatarios de los datos personales</h3>
        <p>Los datos personales del Usuario serán compartidos con los siguientes destinatarios o categorías de
            destinatarios: pokemonCard_shop.es</p>

        <h3>Datos personales de menores de edad</h3>
        <p>Solo los mayores de 14 años podrán otorgar su consentimiento para el tratamiento de sus datos personales de
            forma lícita por Poke Bank. Si se trata de un menor de 14 años, será necesario el consentimiento de los
            padres o tutores para el tratamiento.</p>

        <h3>Secreto y seguridad de los datos personales</h3>
        <p>Poke Bank se compromete a adoptar las medidas técnicas y organizativas necesarias para garantizar la
            seguridad de los datos de carácter personal y evitar la destrucción, pérdida o alteración accidental o
            ilícita de datos personales transmitidos, conservados o tratados de otra forma.</p>

        <h3>Derechos derivados del tratamiento de los datos personales</h3>
        <p>El Usuario tiene sobre Poke Bank y podrá, por tanto, ejercer frente al Responsable del tratamiento los
            siguientes derechos reconocidos en el RGPD y la Ley Orgánica 3/2018:</p>
        <ul>
            <li><strong>Derecho de acceso</strong></li>
            <li><strong>Derecho de rectificación</strong></li>
            <li><strong>Derecho de supresión</strong></li>
            <li><strong>Derecho a la limitación del tratamiento</strong></li>
            <li><strong>Derecho a la portabilidad de los datos</strong></li>
            <li><strong>Derecho de oposición</strong></li>
            <li><strong>Derecho a no ser objeto de una decisión basada únicamente en el tratamiento
                    automatizado</strong></li>
        </ul>

        <h2>II. ACEPTACIÓN Y CAMBIOS EN ESTA POLÍTICA DE PRIVACIDAD</h2>
        <p>Es necesario que el Usuario haya leído y esté conforme con las condiciones sobre la protección de datos de
            carácter personal contenidas en esta Política de Privacidad.</p>

    </div>
    <footer class="footer">
        <div class="copyright">
            <a href="https://creatuweb.xyz/">Copyright © 2024 PokemonCard_shop</a>
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