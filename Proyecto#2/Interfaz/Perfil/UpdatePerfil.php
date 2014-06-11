<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        $Message = 'Sesión no iniciada.';
        header('Location: ../index.php?Message=' . urlencode($Message));    }
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DenunciARTE</title>
    <link rel="stylesheet" href="../Estilo/Estilo.css" />
    <link href="../Imagenes/favicon.ico" type="image/x-icon" rel="shortcut icon" />

    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">

    <script>
        function registrar(){
            // Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file
            var url = "procesarUpdateUsuario.php";
            var nombre = document.getElementById("nombre").value;
            var primerApellido = document.getElementById("primerApellido").value;
            var segundoApellido = document.getElementById("segundoApellido").value;
            var fecNac = document.getElementById("fecNac").value;
            var contrasena = document.getElementById("contrasena").value;
            if (document.getElementById('public').checked) {
                var priv = document.getElementById('public').value;
            } else {
                var priv = document.getElementById('private').value;
            }

            var vars = 'nombre='+nombre+'&primerApellido='+primerApellido+"&segundoApellido="+segundoApellido+'&fecNac='+fecNac+'&contrasena='+contrasena+'&priv='+priv;
            hr.open("POST", url, true);
            // Set content type header information for sending url encoded variables in the request
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // Access the onreadystatechange event for the XMLHttpRequest object
            hr.onreadystatechange = function() {
                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    document.getElementById("update").innerHTML = return_data;
                }
            }
            // Send the data to PHP now... and wait for response to update the status div
            hr.send(vars); // Actually execute the request
            document.getElementById("update").innerHTML = "procesando...";
        }

        function busquedGeneral(){
			// Create our XMLHttpRequest object
			var hr = new XMLHttpRequest();
			// Create some variables we need to send to our PHP file
			var url = "procesarBusquedaGeneral.php";

			var busquedaGeneral = document.getElementById("busquedaGeneral").value;

			var vars = 'busquedaGeneral=' + busquedaGeneral;

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
        function deleteP() {
            // Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file
            var url = "procesarBusquedaGeneral.php";

            var x = 'x';

            var vars = 'x=' + x;

            hr.open("POST", url, true);
            // Set content type header information for sending url encoded variables in the request
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // Access the onreadystatechange event for the XMLHttpRequest object
            hr.onreadystatechange = function() {
                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    document.getElementById("delete").innerHTML = return_data;
                }
            }
            // Send the data to PHP now... and wait for response to update the status div
            hr.send(vars); // Actually execute the request
            document.getElementById("delete").innerHTML = "Procesando...";

        }
	</script>
</head>

<body style="width:700px;">
<div id='update'>
    </div>
<section style="position:absolute; left:200px; top:100px; width:730px; height:400px;">
<div id="mostrar" style="overflow-y:scroll;">
<h1 style="position:absolute; left:150px; left:80px; width:500px;"> Actualizar Mi Perfil </h1>
<a style="position:absolute; top:150px; left:70px;">Nombre</a>
<input type="text" id="nombre" style="position:absolute; left:200px; top:150px; width:300px;" maxlength="25">
<a style="position:absolute; top:180px; left:70px;">Apellidos</a>
<input type="text" id="primerApellido" style="position:absolute; left:200px; top:180px; width:130px;" maxlength="25">
<input type="text" id="segundoApellido" style="position:absolute; left:360px; top:180px; width:140px;" maxlength="25">
<a style="position:absolute; top:210px; left:70px;">Fecha de Nacimiento</a>
<input type="date" id="fecNac" style="position:absolute; left:200px; top:230px; width:300px;">


<a style="position:absolute; top:270px; left:70px;">Contraseña</a>
<input type="password" id="contrasena" style="position:absolute; left:200px; top:270px; width:300px;" maxlength="15">

<a style="position:absolute; top:320px; left:140px;">¿Quién puede ver tu información personal?</a>

<input type = "radio" name = "priv" id = "public" value = "public" checked = "checked" style="position:absolute; top:370px; left:200px;">
    <a for = "Femenino" style="position:absolute; top:370px; left:225px;">Público</a>

<input type = "radio" name = "priv" id = "private" value = "private" style="position:absolute; top:370px; left:300px;">
    <a for = "Femenino" style="position:absolute; top:370px; left:325px;">Privado</a>

<button type="submit" onClick='registrar()' style="position:absolute; top:420px; left:170px; width:150px;">Actualizar</button>
<button type='submit' name='eliminarPerfil' id='deleteP()' style='position:absolute; top:420px; width:150px; left:370px;'>Eliminar</button>

</div>
</section>
<div id='delete'>
</div>

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
    <input type=search results=5 placeholder='Buscar entidad, persona.'  name=busquedaGeneral id='busquedaGeneral' style="position:absolute; left:95px; top:30px; width:300px;">
    <button type="submit" onclick='busquedGeneral()' style="position:absolute; top:20px; left:400px;">Buscar</button>

    <section style="position:absolute; left:560px;">
        <nav align="center" >
        <ul id="menu">
            <li><a title="Perfil" href="MiPerfil.php">Usuario</a></li>
            <li><a title="Inicio" href="busquedaAvanzada.php">Inicio</a></li>

            <li><a title="Privacidad"> <img src="../Imagenes/candado.png" /></a>
                <ul>
                    <li style="font-size:16px; width:150px;"><a href="UpdatePerfil.php">Configuración</a></li>
                    <li style="font-size:16px; width:150px;"><a href="agregarAdmin.php">Administrador</a></li>
                </ul>
            </li>
            <li style="width:60px; height:60px;"><img src="../Imagenes/flechafinal.png" style="position:absolute; top:40px;" />
                <ul>
                    <li style="font-size:16px; width:150px;"><a href="crearEntidad.php">Crear una entidad</a></li>
                    <li style="font-size:16px; width:150px;"><a href="crearPersonaFisica.php">Crear una persona</a></li>
                    <li style="font-size:16px; width:150px;"><a href="logout.php">Cerrar sesión</a></li>
                    <li style="font-size:16px; width:150px;"><a     href="https://sites.google.com/site/denunciarte2014/" target='_blank'>Ayuda</a></li>
                </ul>
            </li>
            <li>
        </ul>
        </nav>
    </section>
</section>

</body>
</html>
