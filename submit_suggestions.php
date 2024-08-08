<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $suggestion = $_POST['suggestion'];
    $rating = $_POST['rating'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "usuario", "contraseña", "nombre_base_datos");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO suggestions (name, email, suggestion, rating) VALUES ('$name', '$email', '$suggestion', '$rating')";

    if ($conn->query($sql) === TRUE) {
        echo "Sugerencia enviada con éxito";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
