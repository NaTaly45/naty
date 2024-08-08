<!doctype html>
<html lang="en">
    <head>
        <title>Admin</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
  <!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />-->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    </head>

    <body style="background:url(/img/fondo2.jpg);background-position: center center;background-repeat: no-repeat;background-size:cover;background-attachment: fixed;">
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="container text-center">
<?php
if (!empty($_POST["btneditar"])) {
    include '../db/DB_CONNEXION.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Recibir y sanitizar los datos del formulario
        $ci_antiguo = filter_input(INPUT_POST, 'ci',  FILTER_SANITIZE_NUMBER_INT);
        $ci_encargado = filter_input(INPUT_POST, 'ci_encargado_n',  FILTER_SANITIZE_NUMBER_INT);
        $nombres_encargado = filter_input(INPUT_POST, 'nombres_encargado', FILTER_SANITIZE_STRING);
        $apelido_p_encargado = filter_input(INPUT_POST, 'apelido_p_encargado', FILTER_SANITIZE_STRING);
        $apelido_m_encargado = filter_input(INPUT_POST, 'apelido_m_encargado', FILTER_SANITIZE_STRING);
        $celular_encargado = filter_input(INPUT_POST, 'celular_encargado', FILTER_SANITIZE_STRING);
        $conn = conn();

    // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "UPDATE guia_encargado SET ci_encargado = ?, nombres_encargado = ?, apellido_p_encargado = ?, apellido_m_encargado = ?, celular_encargado = ? WHERE ci_encargado = '$ci_antiguo'";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        // Asignar valores a las variables del procedimiento
        $stmt->bind_param(
            "issss",
            $ci_encargado,
            $nombres_encargado ,
            $apelido_p_encargado,
            $apelido_m_encargado,
            $celular_encargado 
        );
        if ($stmt->execute()) {
            echo '
            <div class="alert alert-success mt-5" role="alert">
            Encargado Editado correctamente.
            </div>
            <div class="alert alert-warning mt-5" role="alert">
                        Por motivos de seguridad la Sesion se cerro vuelva a ingresar.<br>
                        <a href="../index.php" class="btn btn-danger">Volver</a>
                </div>
            ';
        } else {
            echo '
            <div class="alert alert-warning" role="alert">
            Algo salio mal: ' . $stmt->error.'
            </div>';
        }

        // Cerrar la conexión y liberar recursos
        $stmt->close();
        $conn->close();
    } else {
        echo '
        <div class="alert alert-danger mt-5" role="alert">
            Acceso denegado
        </div>';
    }
}
?>
</div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
  <!--   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>-->
    <script src="/js/bootstrap.bundle.js" ></script>
    <script src="/js/bootstrap.js" ></script>
    </body>
</html>