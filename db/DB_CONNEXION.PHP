<?php
function conn() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "guia";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);
    $conn ->set_charset("utf8");
    date_default_timezone_set('America/La_Paz');
    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}
?>
