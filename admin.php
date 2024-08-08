
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
    <!-- Bootstrap CSS v5.2.1 -->
  <!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />-->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <style>

.selected-image {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
            display: none; /* Oculta la imagen inicialmente */
        }
    </style>
    </head>

    <body style="background:url(/img/fondo2.jpg);background-position: center center;background-repeat: no-repeat;background-size:cover;background-attachment: fixed;">
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="container text-center">
<?php
    include 'db/DB_CONNEXION.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        ?>
        <script>
            history.replaceState(null,null,location.pathname);
        </script>
        <?php
            // Recibir y sanitizar los datos del formulario
        $user = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_STRING);
        $conn = conn();

    // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        $sql = "select * from guia_usuarios where usuario=? and contrasena =?";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error al preparar la consulta: " . $conn->error);
        }

        // Asignar valores a las variables del procedimiento
        $stmt->bind_param(
            "ss",
            $user,           // in_nombre
            $pass          // in_nombre_cargo
        );

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $filas = mysqli_num_rows($result);
            if ($filas) {
                ?>
                <div class="table-resposive  ">
                    <h1 class="text-white">CATEGORIAS</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarCAModal">
                        Agregar +
                    </button>
                    <div class="modal fade" id="agregarCAModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar categoria</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="controlador/registrarCA.php" method="post">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="nombre_categoria" id="floatingInputnombreCa">
                                            <label for="floatingInputnombreCa">Nombre de la nueva categoria</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="descripcion_categoria" id="floatingInputdescripCA">
                                            <label for="floatingInputdescripCA">Descripcion</label>
                                        </div>
                                        <input type="submit" name="btnregistrar" class="form-control btn btn-success" value="registrar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-stripped mt-3">
                        <?php 
                        $sql = $conn->query("select * from guia_categoria");
                        ?>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($datos=$sql->fetch_object()) {?>
                                <tr>
                                    <th scope="row"><?=$datos->id_categoria?></th>
                                    <td><?=$datos->nombre_categoria?></td>
                                    <td><?=$datos->descripcion_categoria?></td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#editarCAModal<?=$datos->id_categoria?>" class="btn btn-info">Editar</a>
                                        <a href="/controlador/eliminarCA.php?id=<?=$datos->id_categoria?>" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            <div class="modal fade" id="editarCAModal<?=$datos->id_categoria?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Categoria N°<?=$datos->id_categoria?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/controlador/editarCA.php" enctype="multipart/form-data" method="POST">
                                            <input type="hidden" value="<?=$datos->id_categoria?>" name="id">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nombre_categoria" value="<?=$datos->nombre_categoria?>" id="nombre_categoria">
                                                <label for="nombre_categoria"> Nombre de la categoria</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="descripcion_categoria" value="<?=$datos->descripcion_categoria?>" id="floatingInputdescripCA">
                                                <label for="floatingInputdescripCA">Descripcion</label>
                                            </div>
                                            <input data-bs-toggle="modal" data-bs-target="#editarCAModal<?=$datos->id_categoria?>" type="submit" value="Editar Piso" name="btneditar" class="form-control btn btn-success">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php }
                            ?>
                        </tbody>
                    </table>
              </div>
              <div class="  table-resposive">
                    <h1 class="text-white">PISOS</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarPIModal">
                        Agregar +
                    </button>
                    <div class="modal fade" id="agregarPIModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar piso</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <div class="modal-body">
                                    <form action="controlador/registrarPI.php" method="post">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="lugar" id="floatingInputnombreCa">
                                            <label for="floatingInput">Lugar del nuevo piso</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="descripcion_piso" id="floatingInputdescripCA">
                                            <label for="floatingInput">Descripcion</label>
                                        </div>
                                        <input type="submit" name="btnregistrar" class="form-control btn btn-success" value="registrar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-stripped mt-3">
                        <?php 
                        $sql = $conn->query("select * from guia_piso");
                        ?>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($datos=$sql->fetch_object()) {?>
                            <tr>
                                <th scope="row"><?=$datos->id_piso?></th>
                                <td><?=$datos->lugar?></td>
                                <td><?=$datos->descripcion_piso?></td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#editarPIModal<?=$datos->id_piso?>" class="btn btn-info">Editar</a>
                                    <a href="/controlador/eliminarPI.php?id=<?=$datos->id_piso?>" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="editarPIModal<?=$datos->id_piso?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Piso N°<?=$datos->id_piso?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/controlador/editarPI.php" enctype="multipart/form-data" method="POST">
                                            <input type="hidden" value="<?=$datos->id_piso?>" name="id">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="lugar" value="<?=$datos->lugar?>" id="lugar_piso">
                                                <label for="lugar_piso">Lugar del piso</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="descripcion_piso" value="<?=$datos->descripcion_piso?>" id="floatingInputdescripCA">
                                                <label for="floatingInput">Descripcion</label>
                                            </div>
                                            <input data-bs-toggle="modal" data-bs-target="#editarPIModal<?=$datos->id_piso?>" type="submit" value="Editar Piso" name="btneditar" class="form-control btn btn-success">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </tbody>
                </table>
              </div>
              <div class="  table-resposive">
                    <h1 class="text-white">IMAGENES</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarIMGModal">
                        Agregar +
                    </button>
                    <div class="modal fade" id="agregarIMGModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar imagen</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/controlador/registrarIMG.php" enctype="multipart/form-data" method="POST">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nombre_img" id="nombre_img">
                                                <label for="nombre_img"> Nombre de la imagen</label>
                                            </div>
                                    <input type="file" class="form-control mb-2" name="imagen">
                                    <input data-bs-toggle="modal" data-bs-target="#agregarIMGModal" type="submit" value="Registrar IMG" name="btnregistrar" class="form-control btn btn-success">
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-stripped mt-3">
                        <?php 
                        $sql = $conn->query("select * from guia_img");
                        ?>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($datos=$sql->fetch_object()) {?>
                            <tr>
                                <th scope="row"><?=$datos->id_img?></th>
                                <td><?=$datos->nombre_img?></td>
                                <td> <img width="80" src="<?=$datos->imagen?>" alt=""> </td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#editarIMGModal<?=$datos->id_img?>" class="btn btn-info">Editar</a>
                                    <a href="/controlador/eliminarIMG.php?id=<?=$datos->id_img?>&nombre=<?=$datos->imagen?>" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="editarIMGModal<?=$datos->id_img?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar imagen N°<?=$datos->id_img?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/controlador/editarIMG.php" enctype="multipart/form-data" method="POST">
                                        <input type="hidden" value="<?=$datos->id_img?>" name="id">
                                        <input type="hidden" value="<?=$datos->imagen?>" name="nombre">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="<?=$datos->nombre_img?>" name="nombre_img" id="nombre_img">
                                            <label for="nombre_img">Nombre de la imagen</label>
                                        </div>
                                        <input type="file" class="form-control mb-2" name="imagen">
                                            <input data-bs-toggle="modal" data-bs-target="#editarIMGModal<?=$datos->id_img?>" type="submit" value="Editar IMG" name="btneditar" class="form-control btn btn-success">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                        ?>
                    </tbody>
                </table>
                </div>
            
                <div class="table-resposive  ">
                    <h1 class="text-white">ENCARGADO</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarEMModal">
                        Agregar +
                    </button>
                    <div class="modal fade" id="agregarEMModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar encargado</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="controlador/registrarEM.php" method="post">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="ci_encargado" id="floatingInputciEN">
                                            <label for="floatingInputciEN">CI:</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="nombres_encargado" id="floatingInputnombreEN">
                                            <label for="floatingInputnombreEN">Nombres</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="apelido_p_encargado" id="floatingInputape">
                                            <label for="floatingInputape">Apellido paterno:</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="apelido_m_encargado" id="floatingInputame">
                                            <label for="floatingInputame">Apellido materno:</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="celular_encargado" id="floatingInputcel">
                                            <label for="floatingInputcel">Celular:</label>
                                        </div>
                                        <input type="submit" name="btnregistrar" class="form-control btn btn-success" value="registrar">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-hover table-stripped mt-3">
                        <?php 
                        $sql = $conn->query("select * from guia_encargado");
                        ?>
                        <thead>
                        <tr>
                            <th scope="col">CI</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">A. Paterno</th>
                            <th scope="col">A. Materno</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($datos=$sql->fetch_object()) {?>
                                <tr>
                                    <th scope="row"><?=$datos->ci_encargado?></th>
                                    <td><?=$datos->nombres_encargado?></td>
                                    <td><?=$datos->apellido_p_encargado?></td>
                                    <td><?=$datos->apellido_m_encargado?></td>
                                    <td><?=$datos->celular_encargado?></td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#editarEMModal<?=$datos->ci_encargado?>" class="btn btn-info">Editar</a>
                                        <a href="/controlador/eliminarEM.php?id=<?=$datos->ci_encargado?>" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            <div class="modal fade" id="editarEMModal<?=$datos->ci_encargado?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar encargado con el CI:<?=$datos->ci_encargado?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/controlador/editarEM.php" enctype="multipart/form-data" method="POST">
                                            <input type="hidden" value="<?=$datos->ci_encargado?>" name="ci">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="ci_encargado_n" value="<?=$datos->ci_encargado?>" id="floatingInputciEN">
                                                <label for="floatingInputciEN">CI:</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="nombres_encargado" value="<?=$datos->nombres_encargado?>" id="floatingInputnombreEN">
                                                <label for="floatingInputnombreEN">Nombres</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="apelido_p_encargado" value="<?=$datos->apellido_p_encargado?>" id="floatingInputape">
                                                <label for="floatingInputape">Apellido paterno:</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="apelido_m_encargado" value="<?=$datos->apellido_m_encargado?>" id="floatingInputame">
                                                <label for="floatingInputame">Apellido materno:</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="celular_encargado" value="<?=$datos->celular_encargado?>" id="floatingInputcel">
                                                <label for="floatingInputcel">Celular:</label>
                                            </div>
                                            <input data-bs-toggle="modal" data-bs-target="#editarEMModal<?=$datos->id_categoria?>" type="submit" value="Editar Encargado" name="btneditar" class="form-control btn btn-success">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php }
                            ?>
                        </tbody>
                    </table>
              </div>
              <div class="table-resposive-lg  ">
                    <h1 class="text-white">AMBIENTE</h1>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarAMModal">
                        Agregar +
                    </button>
                    <div class="modal fade" id="agregarAMModal" tabindex="-1" aria-labelledby="exampleModalToggleLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar ambiente</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="controlador/registrarAM.php" method="post">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="nombre_ambiente" id="floatingInputnmam">
                                            <label for="floatingInputnmam">Nombre del ambiente</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" name="ubicacion_ambiente" id="floatingInputubiEM">
                                            <label for="floatingInputubiEM">Ubicacion del ambiente</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" name="descripcion_ambiente" placeholder="Indique lo que se puede y no hacer aqui" id="floatingTextarea2" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Descripcion del ambiente</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-sm" name="categoria_ambiente">
                                                <option selected>Eliga una categoria</option>
                                                <?php 
                                                $sqlca = $conn->query("select * from guia_categoria");
                                                while ($datosca=$sqlca->fetch_object()) {
                                                ?>
                                                <option value="<?=$datosca->id_categoria?>"><?=$datosca->nombre_categoria?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            <label for="floatingInputape">Categoria</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-sm" name="piso_ambiente">
                                                <option selected>Eliga una piso</option>
                                                <?php 
                                                $sqlpi = $conn->query("select * from guia_piso");
                                                while ($datospi=$sqlpi->fetch_object()) {
                                                ?>
                                                <option value="<?=$datospi->id_piso?>"><?=$datospi->lugar?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            <label for="floatingInputape">Piso</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-sm" name="encargado_ambiente">
                                                <option selected>Eliga una encargado</option>
                                                <?php 
                                                $sqlen = $conn->query("select * from guia_encargado");
                                                while ($datosen=$sqlen->fetch_object()) {
                                                ?>
                                                <option value="<?=$datosen->ci_encargado?>"><?=$datosen->nombres_encargado?> <?=$datosen->apellido_p_encargado?> <?=$datosen->apellido_m_encargado?></option>
                                                <?php }
                                                ?>
                                                <option value="null">No hay encargado</option>
                                            </select>
                                            <label for="floatingInputape">Encargado</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-sm" name="img_ambiente">
                                                <option selected>Eliga una imagen</option>
                                                <?php 
                                                $sqlimg = $conn->query("select * from guia_img");
                                                while ($datosimg=$sqlimg->fetch_object()) {
                                                ?>
                                                <option value="<?=$datosimg->id_img?>" ><?=$datosimg->nombre_img?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            <label for="floatingInputape">Imagen</label>
                                        </div>
                                        <br><br>
                                        <input type="submit" name="btnregistrar" class="form-control btn btn-success" value="registrar">

                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <table class="table table-hover table-stripped mt-3">
                        <?php 
                        $sql = $conn->query("SELECT ga.id_ambiente, ga.nombre_ambiente, ga.descripcion_ambiente, ga.ubicacion_ambiente, gc.nombre_categoria, gp.lugar, CONCAT(ge.nombres_encargado, ' ', ge.apellido_p_encargado,' ',ge.apellido_m_encargado)as nombre_encargado, gi.imagen FROM guia_ambiente ga JOIN guia_categoria gc on ga.categoria_ambiente = gc.id_categoria join guia_piso gp on ga.piso_ambiente = gp.id_piso left JOIN guia_encargado ge on ge.ci_encargado = ga.encargado_ambiente JOIN guia_img gi on gi.id_img = ga.img_ambiente");
                        ?>
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Ubicacion</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Piso</th>
                            <th scope="col">Encargado</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($datos=$sql->fetch_object()) {?>
                                <tr>
                                    <th scope="row"><?=$datos->id_ambiente?></th>
                                    <td><?=$datos->nombre_ambiente?></td>
                                    <td><?=$datos->ubicacion_ambiente?></td>
                                    <td><?=$datos->descripcion_ambiente?></td>
                                    <td><?=$datos->nombre_categoria?></td>
                                    <td><?=$datos->lugar?></td>
                                    <td><?php
                                        if ($datos->nombre_encargado === null) {
                                            echo "<p style='color:red'>Sin encargado</p>";
                                        } else {
                                            echo $datos->nombre_encargado;
                                        }
                                    ?></td>
                                    <td> <img width="80" src="<?=$datos->imagen?>" alt=""> </td>
                                    <td>
                                        <a data-bs-toggle="modal" data-bs-target="#editarAMModal<?=$datos->id_ambiente?>" class="btn btn-info">Editar</a>
                                        <a href="/controlador/eliminarAM.php?id=<?=$datos->id_ambiente?>" class="btn btn-danger">Eliminar</a>
                                    </td>
                                </tr>
                            <div class="modal fade" id="editarAMModal<?=$datos->id_ambiente?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar ambiente N°<?=$datos->id_ambiente?></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="controlador/editarAM.php" method="post">
                                    <input type="hidden" value="<?=$datos->id_ambiente?>" name="id_ambiente">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="<?=$datos->nombre_ambiente?>" name="nombre_ambiente" id="floatingInputnmam">
                                            <label for="floatingInputnmam">Nombre del ambiente</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" value="<?=$datos->descripcion_ambiente?>" name="descripcion_ambiente" placeholder="Indique lo que se puede y no hacer aqui" id="floatingTextarea2" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Descripcion del ambiente</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" value="<?=$datos->ubicacion_ambiente?>" name="ubicacion_ambiente" id="floatingInputubiEM">
                                            <label for="floatingInputubiEM">Ubicacion del ambiente</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-sm" name="categoria_ambiente">
                                                <option selected>Eliga una categoria</option>
                                                <?php 
                                                $sqlca = $conn->query("select * from guia_categoria");
                                                while ($datosca=$sqlca->fetch_object()) {
                                                ?>
                                                <option value="<?=$datosca->id_categoria?>"><?=$datosca->nombre_categoria?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            <label for="floatingInputape">Categoria</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-sm" name="piso_ambiente">
                                                <option selected>Eliga una piso</option>
                                                <?php 
                                                $sqlpi = $conn->query("select * from guia_piso");
                                                while ($datospi=$sqlpi->fetch_object()) {
                                                ?>
                                                <option value="<?=$datospi->id_piso?>"><?=$datospi->lugar?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            <label for="floatingInputape">Piso</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-sm" name="encargado_ambiente">
                                                <option selected>Eliga una encargado</option>
                                                <?php 
                                                $sqlen = $conn->query("select * from guia_encargado");
                                                while ($datosen=$sqlen->fetch_object()) {
                                                ?>
                                                <option value="<?=$datosen->ci_encargado?>"><?=$datosen->nombres_encargado?> <?=$datosen->apellido_p_encargado?> <?=$datosen->apellido_m_encargado?></option>
                                                <?php }
                                                ?>
                                                
                                            </select>
                                            <label for="floatingInputape">Encargado</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-sm" name="img_ambiente">
                                                <option selected>Eliga una imagen</option>
                                                <?php 
                                                $sqlimg = $conn->query("select * from guia_img");
                                                while ($datosimg=$sqlimg->fetch_object()) {
                                                ?>
                                                <option value="<?=$datosimg->id_img?>" ><?=$datosimg->nombre_img?></option>
                                                <?php }
                                                ?>
                                            </select>
                                            <label for="floatingInputape">Imagen</label>
                                        </div>
                                        <br><br>
                                        <input data-bs-toggle="modal" data-bs-target="#editarAMModal<?=$datos->id_ambiente?>" type="submit" value="Editar ambiente" name="btneditar" class="form-control btn btn-success">

                                    </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php }
                            ?>
                        </tbody>
                    </table>
              </div>
                <?php
            } else {
                header('Location:index.php');
                exit;
            }
            
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
