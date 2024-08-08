<!doctype html>
<html lang="en">

<head>
    <title>Inicio</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="https://sistemas.upea.edu.bo/Instituciones/logoCarrera.png">
    <link rel="icon" href="https://serviciopagina.upea.bo/InstitucionUpea/b16ea605-ea25-4803-a5df-7b88f715e639.png"
        type="image/x-icon">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>
<style>
form {
    max-width: 600px;
    margin: auto;
}

form .form-label {
    font-weight: bold;
}

form .btn-primary {
    background-color: #007bff;
    border: none;
}

form .btn-primary:hover {
    background-color: #0056b3;
}

footer {
    background-color: #000;
    color: #fff;
    padding: 20px 0;
    text-align: left;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    padding: 0 10%;
}

.footer-section {
    flex: 1;
    margin: 10px;
    min-width: 200px;
}

.footer-section h3 {
    border-bottom: 1px solid #fff;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin: 5px 0;
}

.footer-section ul li a {
    color: #fff;
    text-decoration: none;
}

.footer-section ul li a:hover {
    text-decoration: underline;
}

.social-media {
    display: flex;
    align-items: center;
    flex-direction: column;
}

.social-media p {
    margin-bottom: 10px;
}

.social-media a {
    margin: 5px;
}

.social-media img {
    width: 24px;
    height: 24px;
}

.footer-bottom {
    text-align: center;
    margin-top: 20px;
}
    </style>

<header>
        <nav class="navbar bg-body-tertiary"
            style="background: rgb(2,0,36);background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
            <div class="container-fluid">
                <a href="https://sistemas.upea.edu.bo/">
                    <img src="https://serviciopagina.upea.bo/InstitucionUpea/b16ea605-ea25-4803-a5df-7b88f715e639.png"
                        alt="Logo" width="60" height="54" class="d-inline-block align-text-top">
                </a><a class="navbar-brand text-white fw-bolder">GUIA ESTUDIANTIL</a>
                <div class="conatiner-fluid">
                    <button type="button" class="btn btn-outline-secondar text-white" data-bs-toggle="modal"
                        data-bs-target="#modalLogin">|</button>
                    <a class="btn btn-primary" href="https://biblioteca.upea.bo/">Biblioteca Virtual</a>
                    <a class="btn btn-primary" href="https://inscripcionessistemas.upea.bo/">Inscripciones</a>
                    <a class="btn btn-success" href="https://matriculacion.upea.bo/">Matriculacion</a>
                </div>
            </div>
        </nav>
    </header>
    <div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content  text-center"
                style="background: rgb(63,94,251);background: radial-gradient(circle, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%);">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Iniciar sesion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="logo-container">
                        <img class="logo" class="rounded" src="img/admin.png" alt="Logo">
                    </div>
                    <form action="admin.php" id="miFormulario" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="usuario" id="usuario">
                            <label class="form-leabel" for="usuario">Usuario</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="contrasena" id="contrasena">
                            <label class="form-leabel" for="contrasena">Contraseña</label>
                        </div>
                        <div class="buttons-group mt-3">
                            <button type="submit" class="btn btn-success">Ingresar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="container">
            <div class="container-fluid mt-3">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" onkeyup="buscar_ahora($('#buscar_1').val());" id="buscar_1" name="buscar_1" type="search" placeholder="Busca por nombre del ambiente." aria-label="Search">
                    <button class="btn btn-warning" type="submit">Buscar</button>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="datos_buscador" class="conteiner"></div>
                </div>
            </div>
            <div class="row gx-5 mt-3">
                <div class="col-sm-12 col-md-6 text-center">
                    <div class="row alert alert-dark" role="alert">
                        <spam class="fw-bold">Categorias</spam>
                    </div>
                    <?php 
                    include 'db/DB_CONNEXION.php';
                    $conn = conn();
                    $sqlca = $conn->query("select id_categoria,nombre_categoria from guia_categoria");
                    while ($datosca = $sqlca->fetch_object()) {
                        ?>
                        <div class="accordion accordion-flush gx-5" id="accordionCategoria">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapse<?=$datosca->id_categoria?>" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <?=$datosca->nombre_categoria?>
                                </button>
                            </h2>
                            <div id="flush-collapse<?=$datosca->id_categoria?>" class="accordion-collapse collapse"
                                data-bs-parent="#accordionCategoria">
                                <div class="row accordion-body">
                                    <?php
                                    $sqlam = $conn->query("SELECT ga.id_ambiente, ga.nombre_ambiente, ga.ubicacion_ambiente, CONCAT(ge.nombres_encargado, ' ', ge.apellido_p_encargado,' ',ge.apellido_m_encargado)as nombre_encargado,ge.celular_encargado,gi.imagen FROM guia_ambiente ga left join guia_encargado ge on ga.encargado_ambiente = ge.ci_encargado JOIN guia_img gi on gi.id_img = ga.img_ambiente where ga.categoria_ambiente = '$datosca->id_categoria'");
                                    while ($datosam=$sqlam->fetch_object()) {
                                        ?>
                                    <div class=" card" style="width: 10rem;">
                                        <img src="<?=$datosam->imagen?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"><?=$datosam->nombre_ambiente?></h5>
                                            <h6>Encargado:</h6> <p class="card-text"><?php
                                        if ($datosam->nombre_encargado === null) {
                                            echo "<p style='color:red'>Sin encargado</p>";
                                        } else {
                                            echo $datosam->nombre_encargado."<br><h6>Celular: </h6><p class='card-text'>".$datosam->celular_encargado."</p>";
                                        }
                                    ?>      </p> 
                                            <a href="https://wa.me/591<?=$datosam->celular_encargado?>?text=A%20que%20hora%20llega??" class="btn btn-success">Comunicate</a><br><br>
                                            <a href="ambientes.php?id=<?=$datosam->id_ambiente?>" class="btn btn-primary">Ver</a>
                                        </div>
                                    </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row alert alert-dark mt-3" role="alert">
                        <spam class="fw-bold">PISOS</spam>
                    </div>
                    <?php
                    $sqlpi = $conn->query("select * from guia_piso");
                    while ($datospi = $sqlpi->fetch_object()) {
                    ?>
                    <div class="accordion accordion-flush gx-5" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne<?=$datospi->id_piso?>" aria-expanded="false"
                                    aria-controls="flush-collapseOne<?=$datospi->id_piso?>">
                                    <?=$datospi->lugar?>
                                </button>
                            </h2>
                            <div id="flush-collapseOne<?=$datospi->id_piso?>" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <?=$datospi->descripcion_piso?>
                                </div>
                            </div>
                        </div>
                        <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br>

        <div class="container mt-5">
    <h2>Sugerencias y Calificación</h2>
    <form action="submit_suggestions.php" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="suggestion" class="form-label">Sugerencia:</label>
            <textarea class="form-control" id="suggestion" name="suggestion" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="rating" class="form-label">Calificación:</label>
            <select class="form-select" id="rating" name="rating" required>
                <option value="1">1 - Muy Malo</option>
                <option value="2">2 - Malo</option>
                <option value="3">3 - Regular</option>
                <option value="4">4 - Bueno</option>
                <option value="5">5 - Muy Bueno</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
    </main>
    <footer>
     
    <div class="footer-container">
        <div class="footer-section">
            <h3>ATENCIÓN AL CLIENTE</h3>
            <ul>
                <li><a href="#">Canales de Contacto</a></li>
                <li><a href="#">Ayuda</a></li>
                <li><a href="#">Formulario de solicitud y reclamos</a></li>
                <li><a href="#">Preguntas frecuentes</a></li>
                <li><a href="#">Términos y condiciones</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>SERVICIOS</h3>
            <ul>
                <li><a href="#">Kardex</a></li>
                <li><a href="#">Aulas y laboratorios</a></li>
                <li><a href="#">Horarios</a></li>
                <li><a href="#">Preuniversitarios</a></li>
                <li><a href="#">Direccion</a></li>
                <li><a href="#">Centro de estudiantes</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>ACERCA DE LA GUIA ESTUDIANTIL</h3>
            <ul>
                <li><a href="#">¿Quienes somos?</a></li>
                <li><a href="#">Ayuda con nosotros</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <div class="social-media">
                <p>SIGUE LAS REDES SOCIALES PARA INFORMARTE MAS:</p>
                <a href="https://www.facebook.com/Ingenieriadesistemasupeafuturo"><img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/2023_Facebook_icon.svg" alt=" Facebook"></a>
                <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Instagram_logo_2022.svg/800px-Instagram_logo_2022.svg.png" alt="https://www.instagram.com/"></a>
                <a href="#"><img src="https://img.freepik.com/fotos-premium/nuevo-diseno-logotipo-twitter_763111-28951.jpg" alt="https://x.com/i/flow/login"></a>
                <a href="#"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT_4N37TIgWC_QLpspNwGddZH8DhzljeYMFnA&s" alt="https://www.youtube.com/?app=desktop&hl=es"></a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© GUIA ESTUDIANTIL 2024. TODOS LOS DERECHOS RESERVADOS</p>
    </div>


    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <!--   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>-->
    <script src="/js/bootstrap.js" ></script>
    <script type="text/javascript">
        function buscar_ahora(buscar) {
    var parametros = { "buscar": buscar };
    $.ajax({
        data: parametros,
        type: "POST",
        url: 'controlador/buscador.php',
        success: function (data) {
            document.getElementById("datos_buscador").innerHTML = data;
        }
    });
}
    </script>

<footer  style="width:100%; margin-left: 0px;"  >
</style>
</div></div><div class="footer_mobile_version" data-content-type="row" data-appearance="full-bleed" data-enable-parallax="0" data-parallax-speed="0.5" data-background-images="{}" data-background-type="image" data-video-loop="true" data-video-play-only-visible="true" data-video-lazy-load="true" data-video-fallback-src="" data-element="main" style="justify-content: flex-start; display: flex; flex-direction: column; background-position: left top; background-size: cover; background-repeat: no-repeat; background-attachment: scroll; border-style: none; border-width: 1px; border-radius: 0px; margin: 0px; padding: 0px;"><div data-content-type="html" data-appearance="default" data-element="main" style="border-style: none; border-width: 1px; border-radius: 0px; margin: 0px 0px 50px; padding: 0px;" data-decoded="true"><!-- NewLetter Container -->

</style> <!-- End of Custom CSS On Footer -->
<!-- Facebook/Messenger plugin de chat Code -->
<div id="fb-root"></div>
<div id="fb-customer-chat" class="fb-customerchat"></div>
<script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "210009985716151");
    chatbox.setAttribute("attribution", "biz_inbox");
    chatbox.setAttribute("greeting_dialog_display", "icon");
    window.fbAsyncInit = function() {
    	FB.init({
    		xfbml: true,
    		version: 'v11.0'
    	});
    	FB.Event.subscribe('customerchat.dialogShow', (response) => {
    		// Google analytics Tracking - Facebook Button
    		ta_gtag('event', 'chat_button_click', {
    			'chat_type': 'Facebook',
    			'button_location': 'footer'
    		});
    	});
    };
    (function(d, s, id) {
    	var js, fjs = d.getElementsByTagName(s)[0];
    	if(d.getElementById(id)) return;
    	js = d.createElement(s);
    	js.id = id;
    	js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
    	fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!--End of Facebook/Messenger plugin de chat Code -->
<!-- Doofinder Configuration -->
<script>
    const dfLayerOptions = {
    	installationId: 'cd31357b-7a96-45d2-ae80-7e445afd9a08',
    	zone: 'us1'
    };
    (function(l, a, y, e, r, s) {
    	r = l.createElement(a);
    	r.onload = e;
    	r.async = 1;
    	r.src = y;
    	s = l.getElementsByTagName(a)[0];
    	s.parentNode.insertBefore(r, s);
    })(document, 'script', 'https://cdn.doofinder.com/livelayer/1/js/loader.min.js', function() {
    	doofinderLoader.load(dfLayerOptions);
    });
</script> <!-- End of Doofinder Configuration -->
<!-- Custom JS Script on Footer -->
<script>
    // Listen for messages from the child frame
    window.addEventListener('message', function(event) {
    	// Check if the message is from the child frame
    	const {
    		type,
    		data
    	} = event.data;
    	if(type === "GAEvent") {
            // Get event from GA
            const ga_event_id = data.event;
    		// If GA Event is begin called. trigger analytics Event.
            if(ga_event_id && ga_event_id !== ''){
                ta_gtag('event', ga_event_id, {
                    'module': 'Identity Widget'
                });
            }

            // If GA Event for Success Page is Called - 
            if(data.label == "Sucess Page" && ga_event_id != 'checkout_identity_widget_success_page'){
                // Trigger Hotjar Modal
                hj('event','onboarding_process_completed');
            }
    	}
    });
</script> <!-- End of Custom JS Script on Footer -->

<input style="display:none !important" id="search_ghost"/>
<script>
     require(['jquery'], function ($) {
       $(document).ready(function () {
         $("#search").prop("readonly", true);
         $("#search").on("click", function() {
                // Trigget Magento Loading Screen
                $("body").trigger('processStart');

                // Click Element with ID "search"
                $("#search_ghost").click();

                // Trigger Doofinder Waiting Process
                // Check every second if the element with class "dfd-root" have child elements
                var interval = setInterval(function() {
                    if ($(".dfd-root").children().length > 0) {
                        // Stop the interval
                        clearInterval(interval);
                        // Trigger Magento Loading Screen
                        $("body").trigger('processStop');
                    }
                }, 500);

          });
         
       });
    });
</script>
<script type="text/javascript">
    require([
        "jquery",
        "Magento_Ui/js/modal/modal",
        "mage/cookies"
    ],function($, modal) {

        var options = {
            type: 'popup',
            responsive: false,
            title: 'Regístrate'
        };

        var popup = modal(options, $('#once-modal'));
        if (! $.cookie('once-modal')) {
            $('#once-modal').modal('openModal');
            $.cookie('once-modal', 'ok');
        }   
    });
</script></div></div></div></div>

<div class="widget block block-static-block">
    </div>
</div><div class="magebig-mobile-menu overlay-contentpush">



</div>
<div class="modal-cart"><button type="button" class="action addToCartModal" data-trigger="triggerAddToCart" style="display:none;">
    <span data-bind="i18n: 'Open Modal Success'"></span>
</button>
<div data-bind="mageInit: {
        'Magento_Ui/js/modal/modal':{
            'type': 'popup',
            'title': '',
            'modalClass': 'modalAddToCart',
            'trigger': '[data-trigger=triggerAddToCart]',
            'responsive': true,
            'buttons': []
        }}">
    <div class="slider" id="product-recommendation-detailpage-related-placeholder"></div>
</div>
</div>    <script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","licenseKey":"NRJS-7800f6871a304887160","applicationID":"557281124","transactionName":"MVJVZ0AHDEZTW01dCggYdlBGDw1bHVtYQAQKWFAcUQcWUFVXS01KEF5SRA==","queueTime":0,"applicationTime":1789,"atts":"HRVWEQgdH0g=","errorBeacon":"bam.nr-data.net","agent":""}</script></body>
</html>




    </div>
</div>
</body>

</html>