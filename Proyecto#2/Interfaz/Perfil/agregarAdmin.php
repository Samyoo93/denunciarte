<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    include("../conection.php");
    $conn = OCILogon($user, $pass, $db);
    session_start();
    if (!isset($_SESSION['usuario'])) {
        $Message = 'Sesión no iniciada.';
        header('Location: ../index.php?Message=' . urlencode($Message));
    }
    $query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.usuarioPorCedula(:cedula); END;");
    //Genera el cursor donde la informacion sera guardada
	$cursor = oci_new_cursor($conn);

	//Se le pasa el parametro de busqueda
	oci_bind_by_name($query_procedimiento, ':cedula', $_SESSION['cedula']);
	oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

	ociexecute($query_procedimiento);
	oci_execute($cursor, OCI_DEFAULT);
	oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
    foreach($array as $fila){
        $estado = $fila['ESTADO'];
    }
    if($estado != 2) {
        $message = "Debe ser administrador para ingresar a esta página.";
        header('Location: busquedaAvanzada.php?Message='. $message);
    }
    ?>
<script>

    function agregarNumReportes(){
        var hr = new XMLHttpRequest();

        var url = "procesarNumerosReportes.php";

        var resultadoReporte = document.getElementById('resultadoReporte').value;

        var vars = 'resultadoReporte='+resultadoReporte;


        hr.open("POST", url, true);
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
            if(hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                document.getElementById("resultado").innerHTML = return_data;
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        document.getElementById("resultado").innerHTML = "procesando...";


    }


    function agregarAdmin(num){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "procesarAgregarAdmin.php";

        var cedula1 = document.getElementById('cedula1').value;
        var cedula2 = document.getElementById('cedula2').value;
        var cedula3 = document.getElementById('cedula3').value;
        if(num == 2) {
            var n =2;
            var nombre = document.getElementById("nombre").value;
            var primerApellido = document.getElementById("primerApellido").value;
            var segundoApellido = document.getElementById("segundoApellido").value;
            var fecNac = document.getElementById("fecNac").value;
            if (document.getElementById('M').checked) {
                var genero = document.getElementById('M').value;
            } else {
                var genero = document.getElementById("F").value;
            }
            var contrasena = document.getElementById("contrasena").value;
            var usuario = document.getElementById("usuario").value;
            var vars = 'cedula1='+cedula1+'&cedula2='+cedula2+'&cedula3='+cedula3+'&nombre='+nombre+'&primerApellido='+primerApellido+
                        '&segundoApellido='+segundoApellido+'&fecNac='+fecNac+'&genero='+genero+'&contrasena='+contrasena
                        +'&usuario='+usuario+'&n='+n;
        } else {
            document.getElementById('datos').style.display='block';this.focus();
            var n = 1;
            var vars = 'cedula1='+cedula1+'&cedula2='+cedula2+'&cedula3='+cedula3   +'&n='+n;
        }

        hr.open("POST", url, true);
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
            if(hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                document.getElementById("datos").innerHTML = return_data;
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        document.getElementById("datos").innerHTML = "procesando...";
	}
    function show() {
        document.getElementById('datos').style.display='block';this.focus();return false;

    }

    function showReportes() {
        document.getElementById('maxReportes').style.display='block';this.focus();return false;

    }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DenunciARTE</title>
<link rel="stylesheet" href="../Estilo/Estilo.css" />
<link href="../Imagenes/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<link href="../Imagenes/favicon.ico" type="image/x-icon" rel="shortcut icon" />
</head>

<body style="width:700px;">

<!--Sección que se actualiza-->
<div id='privac'>
</div>
<section style="position:absolute; left:10px; top:100px; width:630px; height:400px;">
<div id="mostrar" style="overflow-y:scroll;">
<h1 style="position:absolute; left:70px; font-size:45px; width:2000px;"> Agregar un nuevo administrador </h1>
<a style="position:absolute; top:150px; left:140px;">Digite la cédula de la persona que desea hacer administrador.</a>


<a style="position:absolute; top:187px; left:80px;">Cédula</a>
<input type="text" id="cedula1" align="center" placeholder="1" style="position:absolute; top: 185px; left:152px; width:20px;" maxlength="1" />
<label style="position:absolute; top:185px; left:180px;">-</label>
<input type="text" id="cedula2" align='center' placeholder="1111" style="position:absolute; top: 185px; left:190px; width:100px;" maxlength="4"/>
<label style="position:absolute; top:185px; left:299px;">-</label>
<input type="text" id="cedula3" align="center" placeholder="1111" style="position:absolute; top: 185px; left:310px; width:100px;" maxlength="4" />

<button type="submit" onClick='agregarAdmin(1)' id='add' style="position:absolute; top:180px; left:430px; width:100px;">Agregar</button>
</div>

<button type="submit" onclick="show()" style="position:absolute; top:300px; left:480px;">+</button>
<div id="datos" style="position:absolute; top:250px; left:30px; width:400px; display:none;" >
    <a style='position:absolute; top:20px; left:60px;'>Nombre</a>
                    <input type='text' id='nombre' placeholder='Nombre' style='position:absolute; top: 20px; left:130px; width:80px;' maxlength='25' />
                    <input type='text' id='primerApellido' placeholder='PrimerApellido' style='position:absolute; top: 20px; left:220px; width:100px;' maxlength='25' />
                    <input type='text' id='segundoApellido' placeholder='SegundoApellido' style='position:absolute; top: 20px; left:330px; width:100px;' maxlength='25' />
                    <a style='position:absolute; top:60px; left:60px;'>Usuario</a>
                    <a style='position:absolute; top:80px; left:60px;'>(Nombre que lo identificará al realizar un comentario.)</a>
                    <input type='text' id='usuario' placeholder='Álias para reportes' align='center' style='position:absolute; top: 130px; left:130px; width:300px;' maxlength='25' />
                    <a style='position:absolute; top:160px; left:60px;'>Contraseña</a>
                    <input type='password' id='contrasena'  placeholder='De 1-15 carácteres.'style='position:absolute; top: 180px; left:130px; width:300px;' maxlength='15' />
                    <a style='position:absolute; top:210px; left:60px;'>Fecha de nacimiento</a>
                    <input type='date' id='fecNac'style='position:absolute; top: 230px; left:130px; width:300px;' />
                <a style='position: absolute; left: 60px; top: 260px;'>Género</a>
                    <input type = 'radio' name = 'genero' id = 'F' value = 'F' checked = 'checked' style='position:absolute; top:280px; left:140px;'>
                    <a for = 'Femenino' style='position:absolute; top:280px; left:160px;'>Femenino</a>

                    <input type = 'radio' name = 'genero' id = 'M' value = 'M' style='position:absolute; top:280px; left:250px;'>
                    <a for = 'Masculino' style='position:absolute; top:280px; left:270px;'>Masculino</a>
    <button type='submit' onClick='agregarAdmin(2)' id='add2' style='position:absolute; top:180px; left:450px; width:100px; '>Agregar</button>
</div>

</section>
<div id = 'resultado' style='position:absolute; top:250px; left:700px;'>
</div>
<button type='submit' onclick='showReportes()' style="position:absolute; top:250px; left:700px;" >Cambiar número máximo de reportes</button>

<div id ='maxReportes' style="position:absolute; top:300px; left:700px; width:200px; display:none;">
    <a> Número máximo de reportes</a>
    <input type = 'text' id = 'resultadoReporte'>
    <button type ='submit' style = 'position:absolute; left:180px; top:25px;' onclick='agregarNumReportes()' > Agregar </button>
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
    <li style="font-size:16px; width:150px;"><a href="agregarAdmin.php">Administrador</a></li>
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
