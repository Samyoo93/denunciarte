<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>DenunciARTE</title>
    <link rel="stylesheet" href="../Estilo/Estilo.css" />
    <link href="libs/jquery.qtip.custom/jquery.qtip.css" rel="stylesheet">
    <link href="../Estilo/estilohover.css" rel="stylesheet">
    <link rel="stylesheet" href="rateit/src/rateit.css">
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="libs/jquery.qtip.custom/jquery.qtip.js"></script>
    <script src="rateit/src/jquery.rateit.js" type="text/javascript"></script>
    <script src="script.js" type="text/javascript"></script>
	<script>
		function ajax_post(){
			// Create our XMLHttpRequest object
			var hr = new XMLHttpRequest();
			// Create some variables we need to send to our PHP file
			var url = "procesarBusquedaGeneral.php";

			var busquedaGeneral = document.getElementById("busquedaGeneral").value;

			var vars = '&busquedaGeneral=' + busquedaGeneral;

			hr.open("POST", url, true);
			// Set content type header information for sending url encoded variables in the request
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			// Access the onreadystatechange event for the XMLHttpRequest object
			hr.onreadystatechange = function() {
				if(hr.readyState == 4 && hr.status == 200) {
					var return_data = hr.responseText;
					document.getElementById("mostrar").innerHTML = return_data;
				}
			}
			// Send the data to PHP now... and wait for response to update the status div
			hr.send(vars); // Actually execute the request
			document.getElementById("mostrar").innerHTML = "Procesando...";
		}
	</script>
</head>

<body style="width:700px;" onload="Abrir_ventana('http://URL/ejemplo-popup.html')">



<section id="mostrar" style="position:absolute; left:20px; top:100px; width:630px; height:400px;">
	<!-- Menú vertical, lo coloco aquí porque cada vez que se hace la busqueda elimina esta parte y la volverá a poner cuando carge la
	pagina de nuevo-->
	<section id="CuadroGris" style="position:absolute; top:150px; left:700px; width:270px; height:150px;">
		<button type="submit" style="position:absolute; top:20px; left:30px; font-size:18px; width:200px;"><a href="#openRate" style="color: #CFCFCF;
			font: small-caps 100%/200% serif;
			background-color:#914998;
			font-size: 16px;">Calificar</a></button>
		<button type="submit" style="position:absolute; top:70px;left:30px; font-size:18px; width:200px;" >
		<a href="#openReport" style="color: #CFCFCF;
			font: small-caps 100%/200% serif;
			background-color:#914998;
			font-size: 16px;">Reportar</a>
		</button>
		<div id="openReport" class="modalDialog">
			<div>
				<a href="#close" title="Close" class="close">X</a>
				<h2>Reportar a esta persona</h2>
				<p style="position:absolute; top:70px;">Si desea reportar a NOMBRE DE USUARIO, indique el motivo por el cual desea reportarlo.</p>
				<p style="position:absolute; top:130px;">Motivo</p>
				<textarea style="position:absolute; top:150px; left: 150px; width:350px; height:150px;"></textarea>
				<button type="submit" style="position:absolute; top: 320px; left:150px; width:100px;">Reportar</button>
			</div>
		</div>

		<div id="openRate" class="modalDialog">
			<div>
				<a href="#close" title="Close" class="close">X</a>
				<h2>Calificar a esta persona</h2>
				<p style="position:absolute; top:70px;">Si desea calificar a NOMBRE DE USUARIO, rellene los siguientes campos:</p>
				<p style="position:absolute; top:130px;">Título</p>
				<input type="text" style="position:absolute; top:150px; left: 150px; width:200px;"></input>
				<p style="position:absolute; top:160px;">Descripción</p>
				<textarea type="text" style="position:absolute; top:180px; left: 150px;width:300px; height:100px;">
				</textarea>
				<p style="position:absolute; top:280px;">Calificación</p>
				<div class='rateit' data-rateit-max='10' data-rateit-readonly='true' data-rateit-       value="2" style="position:absolute; top:300px; left:150px;"></div>

				<button type="submit" style="position:absolute; top: 350px; left:150px; width:100px;">Calificar</button>
			</div>
		</div>
	</section>

	<?php
		include("conection.php");
		$conn = OCILogon($user, $pass, $db);

		$persona = $_GET['persona'];
		$id = $_GET['id'];

		if($persona == 'personaFisica') {
			//Se inicia el query con el procedimiento asignado
			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.personaPorId(:id); END;");
			//Genera el cursor donde la informacion sera guardada
			$cursor = oci_new_cursor($conn);

			//Se le pasa el parametro de busqueda
			oci_bind_by_name($query_procedimiento, ':id', $id);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

			ociexecute($query_procedimiento);
			oci_execute($cursor, OCI_DEFAULT);
			oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
			$datos = '';
			foreach($array as $fila){
				/*$query_procedimiento = ociparse($conn, "BEGIN :edad := get_edadPersona(:fechaNacimiento); END;");
				$edad = 0;
				oci_bind_by_name($query_procedimiento, ':fechaNacimiento', $fila['PERSONA_ID']);
				oci_bind_by_name($query_procedimiento, ':edad', $edad);
				ociexecute($query_procedimiento);

				oci_execute($cursor, OCI_DEFAULT);*/

				$datos = $datos . '<h1 style="position:absolute; left:150px;"> Persona Física</h1>
				<a style="position:absolute; top:150px; left:70px;">Nombre Completo:'. $fila['NOMBRE'] . $fila['PRIMERAPELLIDO'] .' '. $fila['SEGUNDOAPELLIDO'] .'</a>
				<a style="position:absolute; top:180px; left:70px;">Cédula:'. $fila['CEDULAFISICA_ID'] .'</a>
				<a style="position:absolute; top:210px; left:70px;">Edad:'. $fila['FECHANACIMIENTO'] .'</a>
				<a style="position:absolute; top:240px; left:70px;">Género:'. $fila['GENERO'] .'</a>

				<h2 style="position:absolute; top:240px; left:70px;">Trabajo </h2>
				<a style="position:absolute; top:280px; left:70px;">_________</a>
				<a style="position:absolute; top:310px; left:70px;">Lugar del trabajo:'. $fila['LUGARTRABAJO'] .'</a>
				<a style="position:absolute; top:340px; left:70px;">Cargo:'. $fila['CARGO'] .'</a>
				<h2 style="position:absolute; top:370px; left:70px;">Calificaciones </h2>
				<a style="position:absolute; top:410px; left:70px;">_______________</a>
				<a style="position:absolute; top:440px; left:70px;">Promedio:</a>';

			}
			echo $datos;
		} else if($persona == 'personaJuridica') {
			//Se inicia el query con el procedimiento asignado
			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.entidadPorId(:id); END;");
			//Genera el cursor donde la informacion sera guardada
			$cursor = oci_new_cursor($conn);

			//Se le pasa el parametro de busqueda
			oci_bind_by_name($query_procedimiento, ':id', $id);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

			ociexecute($query_procedimiento);
			oci_execute($cursor, OCI_DEFAULT);
			oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_NUM);
			$datos = '';
			foreach($array as $fila){

				$datos = $datos . '
				<h1 style="position:absolute; left:150px;"> Persona Jurídica</h1>
				<a style="position:absolute; top:150px; left:70px;">Nombre:'. $fila[0] .'</a>
				<a style="position:absolute; top:180px; left:70px;">Cédula:'. $fila[1] .'</a>
				<a style="position:absolute; top:210px; left:70px;">Dirección Exacta:'. $fila[2] . $fila[3] . $fila[4] . $fila[5] . $fila[6] .'</a>
				<a style="position:absolute; top:240px; left:70px;">País:'. $fila[7] .'</a>

				<h2 style="position:absolute; top:240px; left:70px;">Calificaciones </h2>
				<a style="position:absolute; top:280px; left:70px;">_______________</a>
				<a style="position:absolute; top:300px; left:70px;">Promedio:</a>
				';

			}
			echo $datos;

		}
	?>

</section>

<!-- Pie de página -->
<section id="CuadroGris" style=" top:810px; position:absolute; left:20px; width:960px; height:90px">
	<a style="position:absolute; left:20px; top:10px;"> Desarrolladores </a>
	<a style="position:absolute; left:40px; top:40px;"> -Kathy Brenes G. </a>
	<a style="position:absolute; left:190px; top:40px;"> -Barnum Castillo B. </a>
	<a style="position:absolute; left:340px; top:40px;"> -Franco Solís A. </a>
	<a style="position:absolute; left:480px; top:40px;"> -Samuel Yoo. </a>

	<a style=" position:absolute; top:70px; left:700px;">DenunciARTE © 2014 · Español </a>

</section>

<!-- Encabezado-->
<section id="CuadroGris" style="position:absolute; left:20px; height:90px; width:960px;">
	<img src="../Imagenes/Denunciarteicono.jpg" style="position:absolute; left:0px;" />

	<input type=search results=5 placeholder='Buscar entidad, persona.'  name='busquedaGeneral' id='busquedaGeneral' style="position:absolute; left:95px; top:30px; width:300px;">
	<a href="busquedaAvanzada.php"  style="position:absolute; top:70px; left:125px;">+Busqueda avanzada</a>
	<button type="submit" onclick='ajax_post()' style="position:absolute; top:20px; left:400px;">Buscar</button>

	<section style="position:absolute; left:560px;">
		<nav align="center" >
			<ul id="menu">
				<li><a title="Perfil" href=”#”>Usuario</a></li>
				<li><a title="Inicio" href="InicioUsuarios.php">Inicio</a></li>

				<li><a title="Privacidad"> <img src="../Imagenes/candado.png" /></a>
					<ul>
					<li style="font-size:16px; width:150px;"><a href="">Configuración</a></li>
					<li style="font-size:16px; width:150px;"><a href="">Privacidad</a></li>
					</ul>
				</li>
				<li style="width:60px; height:60px;"><img src="../Imagenes/flechafinal.png" style="position:absolute; top:40px;" />
					<ul>
						<li style="font-size:16px; width:150px;"><a href="">Crear una entidad</a></li>
						<li style="font-size:16px; width:150px;"><a href="">Cerrar sesión</a></li>
						<li style="font-size:16px; width:150px;"><a href="">Ayuda</a></li>
					</ul>
				</li>
				<li>
			</ul>
		</nav>
	</section>
</section>

</body>
</html>
