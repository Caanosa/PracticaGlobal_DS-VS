<?php
    function getDbConnection(){
        $host = "localhost";
        $db_name = "pokemoncard_shop";
        $username = "arceus";
        $password = "root";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            return null;
        }
    }

?>