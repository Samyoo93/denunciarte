<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>DenunciARTE</title>
	<link rel="stylesheet" href="../Estilo/Estilo.css" />
	<script>
		function ajax_post(){
			// Create our XMLHttpRequest object
			var hr = new XMLHttpRequest();
			// Create some variables we need to send to our PHP file
			var url = "procesarBusquedaAvanzada.php";
			
			var busqueda = document.getElementById("busqueda").value;
			var persona = document.getElementById("persona").value;
			var tipoBusqueda = document.getElementById("tipoBusqueda").value;
			
			var vars = '&busqueda=' + busqueda + '&persona=' + persona +'&tipoBusqueda=' + tipoBusqueda;
			
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
		function ajax_post2(){
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

<body style="width:700px;">


	<!--Sección que se actualiza-->
	<section id="mostrar" style="position:absolute; left:200px; top:250px; width:630px; height:400px;">
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
	
	<!--Menu busqueda avanzada-->
	<section>
		<h1 style="position:absolute; left:240px; top:100px;"> Búsqueda avanzada </h1>
		<a style="position:absolute; top:220px; left:230px;">Buscar</a>
		<select id='persona' style="position:absolute; top:220px;left:180px;">
			<option value='personaJuridica'>Persona Jurídica</option>
			<option value='categoria'>Categoría</option>
			<option value='personaFisica'>Persona Física</option>
		</select>
		<a style="position:absolute; top:220px; left:320px;">por</a>
		<select id='tipoBusqueda'style="position:absolute; top:220px; left:350px;">
			<option value='cedula'>Cédula</option>
			<option value='nombre'>Nombre</option>
			<option value='primerApellido'>Primer Apellido</option>
			<option value='segundoApellido'>Segundo Apellido</option>
		</select>
		<input type="text" id="busqueda" style="position:absolute; top:220px; left:500px; width:160px;">
		<button onclick='ajax_post()' type="submit" style="position:absolute; top:220px; left:670px;">Buscar</button>
	</section>
	
	<!-- Encabezado-->
	<section id="CuadroGris" style="position:absolute; left:20px; height:90px; width:960px;">
		<img src="../Imagenes/Denunciarteicono.jpg" style="position:absolute; left:0px;" />
		<input type=search results=5 placeholder='Buscar entidad, persona.'  name='busquedaGeneral' id='busquedaGeneral' style="position:absolute; left:95px; top:30px; width:300px;">
		<button type='submit' onclick='ajax_post2()' style="position:absolute; top:20px; left:400px;" >Buscar</button>		
	</section>	
	
	<section>
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
