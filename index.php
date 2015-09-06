<?php /* Ininicio de un código en php */

    error_reporting(E_ALL);

    /* Accedemos a la BD */
    $server = "localhost";
    $user = "cuhrtcom_jamini";
    $pass = "jsmini2015";
    $db = "cuhrtcom_jsmini";
    $n = 0; /* número de asistentes registrados */
    $ntotal = 30; /* número total de asistentes */
    $notificacion = "";

    $conn = new mysqli($server, $user, $pass, $db);
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_GET['email'])) {
        $nombre = $_GET['nombre'];
        $email = $_GET['email'];

        /* Se prepara mensaje de aviso de quienes se registran */
        $destino = "rictor@cuhrt.com";
        $subject = "Registro a Javascripting-mini";
        $mensaje = $nombre . "\n". $email;
        $header = "From: rictor@cuhrt.com"; /*direccion de correo de quien envia*/

        /* Hay que ver si el email a registrar ya está registrado */
        $sql = "SELECT * FROM Asistente WHERE email='$email'";
        $irow = $conn->query($sql);
        if($irow->num_rows > 0) {
            /* Si el email ya está registrada, sólo damos aviso y no hacemos nada más */
            $notificacion = "¡$nombre ya se encuentra registrado(a) para el evento, te esperamos!";
        } else {
            /* si el email no está registrada, pos se registra */
            $sql = "INSERT INTO Asistente (`id`, `nombre`, `email`) values (NULL,'$nombre', '$email')";
            $irow = $conn->query($sql);
            if($irow) {
                $notificacion = "¡Su registro se ha realizado con éxito!";

                /* Este email se envía para notificar que este usuario se está registrando */
                $r = mail($destino, $subject, $mensaje, $header);
                /* Hay que determinar si el mensaje con mail() se envió de forma correcta */
                if($r == FALSE) { /* Tenemos error al enviar el mensaje? */
                    $notificacion = "Ha habido un problema con la notificación del registro, pero su registro se ha realizado de forma correcta. Envíe un mensaje a los organizadores, gracias!";
                }

                /* Este email se envía para notifcar al usuario que ya está registrando en la BD */
                $mensajeu = "Hola ".$nombre."\n\nTu registro se a realizado con éxito al taller de Javascripting-mini que se llevará a cabo el día lunes 24 de agosto del 2015 de 10:00 a 14:00 hrs.\n\n Para más información visita el sitio web http://javascripting-mini.cuhrt.com o escribe a:\n rictor@cuhrt.com, kairy159@gmail.com o tallerescomunitarios@fch.org.mx\n\nEsperamos contar con tu asistencia.\n\nAtte: Javascripting-mini";

                mail($email, $subject , $mensajeu, $header);
                /* Hay que determinar si el mensaje con mail() se envió de forma correcta */
                if($r == FALSE) { /* Tenemos error al enviar el mensaje? */
                    $notificacion = "Ha habido un problema con la notificación del registro, pero su registro se ha realizado de forma correcta. Envíe un mensaje a los organizadores, gracias!";
                }
            } else {
                $notificacion = "¡Hay un problema con sus registro, intente de nuevo o notifique a los organizadores. Gracias!";
            }
        }

    }

    /* Se cuentan cuantos registros hay */
    $sql = "SELECT count(*) from Asistente";
    $irow = $conn->query($sql);
    if($irow) {
        $row = $irow->fetch_row();
        $n = $row[0];
    }
    $conn->close();

?>

<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Diseño Web 2.0</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="landing">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1 id="logo"><a href="index.html">Avisos</a></h1>
					<nav id="nav">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li>
								<a href="#">Layouts</a>
								<ul>
									<li><a href="left-sidebar.html">Barra izquierda</a></li>
									<li><a href="right-sidebar.html">Barra derecha</a></li>
									<li><a href="no-sidebar.html">Sin barra</a></li>
									<li>
										<a href="#">Submenu</a>
										<ul>
											<li><a href="#">Option 1</a></li>
											<li><a href="#">Option 2</a></li>
											<li><a href="#">Option 3</a></li>
											<li><a href="#">Option 4</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li><a href="ubicacion.html">Ubicación</a></li>
							<li><a href="#" class="button special">Registro</a></li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner">
					<div class="content">
						<header>
							<h2>Diseño Web 2.0</h2>
							<p>Sigue desarrollando tus habiliades para crear paginas web.</p>
						</header>
						<span class="image"><img src="images/response-plantila-gratis-html.jpg" alt="" /></span>
					</div>
					<a href="#onedes" class="goto-next scrolly">Next</a>
				</section>

        
            <!--one descrip-->
               <section id="onedes" class="spotlight style3 left">
					<span class="image fit main bottom"><img src="images/pic04.jpg" alt="" /></span>
					<div class="content">
					    <header>
						    <h2>Programación con Javasciprt y PHP</h2>
				        </header>
				        <p>Conocerás los conceptos básicos de programación en los lenguajes de Javascript y PHP realizando distintas prácticas que abarcarán temas desde el clásico "Hola mundo!" hasta lograr automatizar tu página web con la posibilidad de ganar premios de todas partes del mundo.</p>
					</div>
					<a href="#one" class="goto-next scrolly">Next</a>
				</section>
			<!-- One temas -->
				<section id="one" class="spotlight style1 bottom">
					<span class="image fit main"><img src="images/pic02.jpg" alt="" /></span>
					<div class="content">
						<div class="container">
                           <div class="row">
								<div class="12u 12u$(medium)">
									<header>
										<h2>Algunos de los temas a abarcar son: </h2>
									</header>
								</div>
								<div class="6u 12u$(medium)">
									<ul>
                                        <li>Hola mundo!</li>
                                        <li>(variables)</li>
                                        <li>(tipos de datos)</li>
                                        <li>(condicionales o ramificaciones)</li>
                                        <li>(ciclos)</li>
                                        <li>Adivina un número PHP y Javascipt (ciclos, ramificaciones, datos numéricos, strings, lecturas de datos e impresión de resultados)</li>
                                    </ul>
								</div>
								<div class="6u$ 12u$(medium)">
								<ul>
									<li>Calculadora usando javascipt (eventos, datos numéricos, operadores, strings)</li>
                                        <li>(arreglos o vectores)</li>
                                        <li>(funciones)</li>
                                        <li>Memorama simple (varios, un chingo!)</li>
                                        <li>Catálogo + cotización catálogo en línea</li>
                                </ul>
								</div>
							</div>
						</div>
					</div>
					<a href="#twodes" class="goto-next scrolly">Next</a>
				</section>

			<!-- Two descripcion -->
				<section id="twodes" class="spotlight style2 right">
					<span class="image fit main"><img src="images/pic03.jpg" alt="" /></span>
					<div class="content">
						<header>
							<h2>Bases de datos con PHP o Python</h2>
						</header>
						<p>Conocerás los conceptos básicos de una base de datos, ¿qué es? ¿cómo se come? ¿cómo se cocina? ¿cómo podemos hacer una base de datos sabrosa?. Al igual que con la programación realizarás bases de datos que guarden el "Hola mundo!" hasta unas un poquitín más complejas.</p>
					</div>
					<a href="#two" class="goto-next scrolly">Next</a>
				</section>
				
				<!-- two temas -->
				<section id="two" class="spotlight style1 bottom">
					<span class="image fit main"><img src="images/pic02.jpg" alt="" /></span>
					<div class="content">
						<div class="container">
                           <div class="row">
								<div class="12u 12u$(medium)">
									<header>
										<h2>Algunos de los temas a abarcar son: </h2>
									</header>
								</div>
								<div class="6u 12u$(medium)">
									<ul>
                                        <li>Instalación (antes que nada)</li>
                                        <li>Aprendiendo a ser organizados (Creando una base de datos)</li>
                                        <li>Creando la llave maestra (usuario y claves)</li>
                                        <li>Tipos de datos (¿puedo guardar todo lo que quiera?</li>
                                    </ul>
								</div>
								<div class="6u$ 12u$(medium)">
								<ul>
                                        <li> Organización de 2do nivel (Tabla, tabla y más tabla!)</li>
                                        <li>Poblando la tierra (y sin tener una gota de sexo)</li>
                                        <li>Erradicación total (obteniendo y filtrando información)</li>
                                </ul>
								</div>
							</div>
						</div>
					</div>
					<a href="#threedes" class="goto-next scrolly">Next</a>
				</section>

			<!-- Three descripcion -->
				<section id="threedes" class="spotlight style3 left">
					<span class="image fit main bottom"><img src="images/pic04.jpg" alt="" /></span>
					<div class="content">
						<header>
							<h2>Automatización de sitios web</h2>
						</header>
						<p>Feugiat accumsan lorem eu ac lorem amet ac arcu phasellus tortor enim mi mi nisi praesent adipiscing. Integer mi sed nascetur cep aliquet augue varius tempus lobortis porttitor lorem et accumsan consequat adipiscing lorem.</p>
					</div>
					<a href="#three" class="goto-next scrolly">Next</a>
				</section>
				
				<!--Three lista-->
				<section id="three" class="spotlight style1 bottom">
					<span class="image fit main"><img src="images/pic02.jpg" alt="" /></span>
					<div class="content">
						<div class="container">
                           <div class="row">
								<div class="12u 12u$(medium)">
									<header>
										<h2>Algunos de los temas a abarcar son: </h2>
									</header>
								</div>
								<div class="6u 12u$(medium)">
									<ul>
                                        <li>Instalación (antes que nada)</li>
                                        <li>Aprendiendo a ser organizados (Creando una base de datos)</li>
                                        <li>Creando la llave maestra (usuario y claves)</li>
                                        <li>Tipos de datos (¿puedo guardar todo lo que quiera?</li>
                                    </ul>
								</div>
								<div class="6u$ 12u$(medium)">
								<ul>
                                        <li> Organización de 2do nivel (Tabla, tabla y más tabla!)</li>
                                        <li>Poblando la tierra (y sin tener una gota de sexo)</li>
                                        <li>Erradicación total (obteniendo y filtrando información)</li>
                                </ul>
								</div>
							</div>
						</div>
					</div>
					<a href="#fourdes" class="goto-next scrolly">Next</a>
				</section>
				
<!-- Four descripcion -->
				<section id="fourdes" class="spotlight style2 right">
					<span class="image fit main"><img src="images/pic03.jpg" alt="" /></span>
					<div class="content">
						<header>
							<h2>Creación de sitios web responsivos</h2>
						</header>
						<p>Conocerás los conceptos básicos de una base de datos, ¿qué es? ¿cómo se come? ¿cómo se cocina? ¿cómo podemos hacer una base de datos sabrosa?. Al igual que con la programación realizarás bases de datos que guarden el "Hola mundo!" hasta unas un poquitín más complejas.</p>
					</div>
					<a href="#four" class="goto-next scrolly">Next</a>
				</section>
				
				<!-- four temas -->
				<section id="four" class="spotlight style1 bottom">
					<span class="image fit main"><img src="images/pic02.jpg" alt="" /></span>
					<div class="content">
						<div class="container">
                           <div class="row">
								<div class="12u 12u$(medium)">
									<header>
										<h2>Algunos de los temas a abarcar son: </h2>
									</header>
								</div>
								<div class="6u 12u$(medium)">
									<ul>
                                        <li>Instalación (antes que nada)</li>
                                        <li>Aprendiendo a ser organizados (Creando una base de datos)</li>
                                        <li>Creando la llave maestra (usuario y claves)</li>
                                        <li>Tipos de datos (¿puedo guardar todo lo que quiera?</li>
                                    </ul>
								</div>
								<div class="6u$ 12u$(medium)">
								<ul>
                                        <li> Organización de 2do nivel (Tabla, tabla y más tabla!)</li>
                                        <li>Poblando la tierra (y sin tener una gota de sexo)</li>
                                        <li>Erradicación total (obteniendo y filtrando información)</li>
                                </ul>
								</div>
							</div>
						</div>
					</div>
					<a href="#fivedes" class="goto-next scrolly">Next</a>
				</section>

        <!-- Five descripcion -->
				<section id="fivedes" class="spotlight style3 left">
					<span class="image fit main bottom"><img src="images/pic04.jpg" alt="" /></span>
					<div class="content">
						<header>
							<h2>Uso de frameworks Bootstrap + Skel + AngularJS</h2>
						</header>
						<p>Feugiat accumsan lorem eu ac lorem amet ac arcu phasellus tortor enim mi mi nisi praesent adipiscing. Integer mi sed nascetur cep aliquet augue varius tempus lobortis porttitor lorem et accumsan consequat adipiscing lorem.</p>
					</div>
					<a href="#five" class="goto-next scrolly">Next</a>
				</section>
				
				<!--Five lista-->
				<section id="five" class="spotlight style1 bottom">
					<span class="image fit main"><img src="images/pic02.jpg" alt="" /></span>
					<div class="content">
						<div class="container">
                           <div class="row">
								<div class="12u 12u$(medium)">
									<header>
										<h2>Algunos de los temas a abarcar son: </h2>
									</header>
								</div>
								<div class="6u 12u$(medium)">
									<ul>
                                        <li>Instalación (antes que nada)</li>
                                        <li>Aprendiendo a ser organizados (Creando una base de datos)</li>
                                        <li>Creando la llave maestra (usuario y claves)</li>
                                        <li>Tipos de datos (¿puedo guardar todo lo que quiera?</li>
                                    </ul>
								</div>
								<div class="6u$ 12u$(medium)">
								<ul>
                                        <li> Organización de 2do nivel (Tabla, tabla y más tabla!)</li>
                                        <li>Poblando la tierra (y sin tener una gota de sexo)</li>
                                        <li>Erradicación total (obteniendo y filtrando información)</li>
                                </ul>
								</div>
							</div>
						</div>
					</div>
					<a href="#six" class="goto-next scrolly">Next</a>
				</section>
			<!-- Six -->
				<section id="six" class="wrapper style2 special fade">
				<h2><i class="fa fa-pencil-square-o fa-3x"></i>Registro</h2>
					<div class="container">
						<form action="index.php" method="get">
                        <div class="row uniform">

                            <section class="8u 12u$(small)">
                              <input type="text" name="nombre" required placeholder="Escribe tu nombre" required /> </br>
                              <input type="email" name="email" required placeholder="Escribe tu correo electronico" required /></br>
                            </section>
                            <section class="4u$ 6(xsmall)">
                               <input type="submit" value="R" />
                            </section>

                        </div>
                    </form>
                    <div class="container 75%">
                        <?php echo $notificacion; ?>
                    </div>
                    <div class="row">
                        <p class="6u">Inscritos: <?php echo $n; ?></p>
                        <p class="6u">Quedan: <?php echo $ntotal-$n; ?> Conexiones disponibles</p>
                    </div>
					</div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon alt fa-linkedin"><span class="label">LinkedIn</span></a></li>
						<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
						<li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>