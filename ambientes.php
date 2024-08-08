<?php
include 'db/DB_CONNEXION.php';

?>
<!doctype html>
<html lang="en">
    <head>
        <title>Ambiente</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body style="background:url(/img/fondo2.jpg);background-position: center center;background-repeat: no-repeat;background-size:cover;background-attachment: fixed;">
        <header>
            <!-- place navbar here -->
        </header>
            <main>
            <div class="container text-center">
                <?php 
                    if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        $id_ambiente = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
                        $conn = conn();
                        $sql = $conn->query("SELECT ga.id_ambiente, ga.nombre_ambiente, ga.descripcion_ambiente, ga.ubicacion_ambiente, gc.nombre_categoria, gp.lugar, CONCAT(ge.nombres_encargado, ' ', ge.apellido_p_encargado,' ',ge.apellido_m_encargado)as nombre_encargado, ge.celular_encargado, gi.imagen FROM guia_ambiente ga JOIN guia_categoria gc on ga.categoria_ambiente = gc.id_categoria join guia_piso gp on ga.piso_ambiente = gp.id_piso left JOIN guia_encargado ge on ge.ci_encargado = ga.encargado_ambiente JOIN guia_img gi on gi.id_img = ga.img_ambiente where ga.id_ambiente = '$id_ambiente' ");
                        if ($sql->num_rows > 0) {
                            $row = $sql->fetch_assoc();
                            ?>
                            
                            <div class="card mb-4 mt-5 mx-auto" style="max-width: 1000px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="<?=$row['imagen']?>" class="img-fluid rounded-start" alt="<?=$row['nombre_ambiente']?>">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?=$row['nombre_ambiente']?></h5>
                                            <p class="card-text"><strong>Descripcion:</strong><br> <?=$row['descripcion_ambiente']?></p>
                                            <p class="card-text"><strong>Ubicación:</strong><br> <?=$row['ubicacion_ambiente']?></p>
                                            <p class="card-text"><strong>Categoría:</strong> <?=$row['nombre_categoria']?></p>
                                            <p class="card-text"><strong>Piso:</strong> <?=$row['lugar']?></p>
                                            <p class="card-text"><strong>Encargado:</strong> <?=$row['nombre_encargado']?></p>
                                            <p class="card-text"><strong>Numero del encargado:</strong> <?=$row['celular_encargado']?></p>
                                            <a href="https://wa.me/591<?=$datosam->celular_encargado?>?text=A%20que%20hora%20llega??" class="btn btn-success">Comunicate</a><br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                            echo '
                            <div class="alert alert-danger mt-5" role="alert">
                                No se encontró el ambiente.
                            </div>';
                        }
                    } else {
                        echo '
                        <div class="alert alert-danger mt-5" role="alert">
                            Acceso denegado.
                        </div>';
                    }
                ?>
            </div>
            </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
