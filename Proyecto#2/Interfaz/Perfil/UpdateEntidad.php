<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    session_start();
    if (session_status() == PHP_SESSION_NONE) {
       header("Location: ../index.php");
    }
    ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DenunciARTE</title>
    <link rel="stylesheet" href="../Estilo/Estilo.css" />
    <script>
    function refresh(changed){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "locationRefreshEntidadUPDATE.php";
        var which = changed;

        var pais = document.getElementById("pais").value;
        var provincia = document.getElementById("provincia").value;
        var canton = document.getElementById("canton").value;
        var distrito = document.getElementById("distrito").value;
        var barrio = document.getElementById("barrio").value;

        var vars = 'pais='+pais+'&provincia='+provincia+'&canton='+canton+'&distrito='+distrito+'&which='+which+'&barrio='+barrio;
        hr.open("POST", url, true);
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
            if(hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                document.getElementById("direccion").innerHTML = return_data;
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        document.getElementById("direccion").innerHTML = "procesando...";
	}
    function registrar(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "procesarUpdateEntidad.php";
        var nombre = document.getElementById("nombre").value;
        var cedulaJuridica = document.getElementById("cedulaJuridica").value;
        var pais = document.getElementById("pais").value;
        var provincia = document.getElementById("provincia").value;
        var canton = document.getElementById("canton").value;
        var distrito = document.getElementById("distrito").value;
        var barrio = document.getElementById("barrio").value;
        var exacta = document.getElementById("exacta").value;


        var vars = 'nombre='+nombre+'&cedulaJuridica='+cedulaJuridica+"&pais="+pais+'&provincia='+provincia+'&canton='+canton+'&distrito='+distrito+'&barrio='+barrio+'&exacta='+exacta;
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
    </script>
</head>

<body style="width:700px;" onload="Abrir_ventana('http://URL/ejemplo-popup.html')">

<div id='update'>
    </div>
<section style="position:absolute; left:200px; top:100px; width:630px; height:400px;">
<div id="mostrar" style="overflow-y:scroll;">
<h1 style="position:absolute; left:150px; left:120px;"> Modificar Entidad </h1>
<a style="position:absolute; top:150px; left:70px;">Nombre</a>
<input type="text" id="nombre" style="position:absolute; left:200px; top:150px; width:300px;">
<a style="position:absolute; top:180px; left:70px;">Cédula Jurídica</a>
    <input type="text" id="cedulaJuridica" style="position:absolute; left:200px; top:180px; width:300px;">
<div id='direccion'>
<h2 style="position:absolute; top:200px; left:70px;">Dirección</h2>
<a style="position:absolute; top:240px; left:70px;">_________</a>
<a style="position:absolute; top:270px; left:70px;">País</a>

    <?php
		include('../conection.php');
		$conn = oci_connect($user, $pass, $db);
		$sql = "SELECT nombre FROM pais";
		$stmt = oci_parse($conn, $sql);
		ociexecute($stmt);
		echo "<select name='pais' required id='pais' onchange='refresh(1)' style='position:absolute; left:200px; top:270px; width:300px;'>";
        echo "<option value=''>Seleccione uno</option>";
		while ( $row = oci_fetch_assoc($stmt) ) {

			if($row['NOMBRE']==$pais) {
				echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
			} else {
				echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
			}
		}

	echo "</select>"; ?>
<a style="position:absolute; top:300px; left:70px;">Provincia</a>
<select id="provincia" onchange='refresh(2)' style="position:absolute; left:200px; top:300px; width:300px;">
    <option value=''>Seleccione uno</option>";
</select>
<a style="position:absolute; top:330px; left:70px;">Cantón</a>
<select id="canton" onchange='refresh(3)' style="position:absolute; left:200px; top:330px; width:300px;">
    <option value=''>Seleccione uno</option>";
</select>
<a style="position:absolute; top:360px; left:70px;">Distrito</a>
<select id="distrito" onchange='refresh(4)' style="position:absolute; left:200px; top:360px; width:300px;">
    <option value=''>Seleccione uno</option>";
</select>
<a style='position:absolute; top:390px; left:70px;'>Barrio</a>
<select id='barrio' onchange='refresh(5)' style='position:absolute; top:390px; text-align:center; left:200px; width:300px;'>
    <option value=''>Seleccione uno</option>";
</select>
</div>
<a style="position:absolute; top:420px; left:70px;">Dirección Exacta</a>
<textarea id='exacta' style="position:absolute; top:420px; left:200px; width:300px; height:100px;"></textarea>
<button type="submit" onClick='registrar()' style="position:absolute; top:550px; left:220px; width:200px;">Actualizar</button>

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
<input type=search results=5 placeholder='Buscar entidad, persona.'  name=busqueda style="position:absolute; left:95px; top:30px; width:300px;">
<a href=""  style="position:absolute; top:70px; left:125px;">+Busqueda avanzada</a>
<button type="submit" style="position:absolute; top:20px; left:400px;">Buscar</button>
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
