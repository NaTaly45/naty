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
if (!empty($_GET["id"])) {
    ?>
        <script>
            history.replaceState(null,null,location.pathname);
        </script>
    <?php
    
    include '../db/DB_CONNEXION.php';
    $id = $_GET["id"];
    $conn = conn();

    $eliminar = $conn->query("delete from guia_ambiente where id_ambiente = $id");
    if ($eliminar == 1) {
        echo '<div class="alert alert-success mt-5" role="alert">
                                Ambiente eliminado exitosamente!!!
                            </div>
                            <div class="alert alert-warning mt-5" role="alert">
                                    Por motivos de seguridad la Sesion se cerro vuelva a ingresar.<br>
                                    <a href="../index.php" class="btn btn-danger">Volver</a>
                            </div>';
    } else {
        echo '<div class="alert alert-danger mt-5" role="alert">
                                Ambiente no eliminado!!!
                            </div>
                            <div class="alert alert-warning mt-5" role="alert">
                                    Por motivos de seguridad la Sesion se cerro vuelva a ingresar.<br>
                                    <a href="../index.php" class="btn btn-danger">Volver</a>
                            </div>';
    }
}else{
    echo '<div class="alert alert-danger mt-5" role="alert">
                                Datos no recibidos!!!
                            </div>
                            <div class="alert alert-warning mt-5" role="alert">
                                    Por motivos de seguridad la Sesion se cerro vuelva a ingresar.<br>
                                    <a href="../index.php" class="btn btn-danger">Volver</a>
                            </div>';
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