<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
       header("Location: ../index.php");
    }
    ?>
<script>
    function setPrivacidad(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "procesarPrivacidad.php";

        if (document.getElementById('public').checked) {
                var priv = document.getElementById('public').value;
            } else {
                var priv = document.getElementById('private').value;
            }


        var vars = 'priv='+priv;
        hr.open("POST", url, true);
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
            if(hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                document.getElementById("privac").innerHTML = return_data;
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        document.getElementById("privac").innerHTML = "procesando...";
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DenunciARTE</title>
<link rel="stylesheet" href="../Estilo/Estilo.css" />
</head>

<body style="width:700px;">

<!--Sección que se actualiza-->
<div id='privac'>
</div>
<section style="position:absolute; left:200px; top:100px; width:630px; height:400px;">
<div id="mostrar" style="overflow-y:scroll;">
<h1 style="position:absolute; left:70px; font-size:45px;"> Configuración de privacidad </h1>
<a style="position:absolute; top:150px; left:140px;">¿Quién puede ver tu información personal?</a>

<input type = "radio" name = "priv" id = "public" value = "public" checked = "checked" style="position:absolute; top:180px; left:200px;">
    <a for = "Femenino" style="position:absolute; top:180px; left:225px;">Público</a>

<input type = "radio" name = "priv" id = "private" value = "private" style="position:absolute; top:180px; left:300px;">
    <a for = "Femenino" style="position:absolute; top:180px; left:325px;">Privado</a>

<button type="submit" onClick='setPrivacidad()' style="position:absolute; top:220px; left:200px; width:100px;">Configurar</button>

    </div>
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
<input type=search id="nombreBuscar" results=5 placeholder='Buscar entidad, persona.'  name=busqueda style="position:absolute; left:95px; top:30px; width:300px;">
<button type="submit" style="position:absolute; top:20px; left:400px;">Buscar</button>
<section style="position:absolute; left:560px;" onClick='BusquedaNombre()'>
<nav align="center" >
<ul id="menu">
	 <li><a title="Perfil" href="MiPerfil.php">Usuario</a></li>
    <li><a title="Inicio" href="busquedaAvanzada.php">Inicio</a></li>

 	<li><a title="Privacidad"> <img src="../Imagenes/candado.png" /></a>
 	<ul>
     <li style="font-size:16px; width:150px;"><a href="UpdatePerfil.php">Configuración</a></li>
    <li style="font-size:16px; width:150px;"><a href="privacidad.php">Privacidad</a></li>
  </ul>
 </li>
    <li style="width:60px; height:60px;"><img src="../Imagenes/flechafinal.png" style="position:absolute; top:40px;" />
    	<ul>
        	<li style="font-size:16px; width:150px;"><a href="crearEntidad.php">Crear una entidad</a></li>
            <li style="font-size:16px; width:150px;"><a href="crearPersonaFisica.php">Crear una persona</a></li>
     		<li style="font-size:16px; width:150px;"><a href="logout.php">Cerrar sesión</a></li>
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
