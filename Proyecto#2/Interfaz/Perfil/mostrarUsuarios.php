<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        $Message = 'Sesión no iniciada.';
        header('Location: ../index.php?Message=' . urlencode($Message));    }

    if (isset($_GET['Message'])) {
        print '<script type="text/javascript">alert("' . $_GET['Message'] . '");</script>';
    }
    ?>

    <script>
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DenunciARTE</title>
    <link rel="stylesheet" href="../Estilo/Estilo.css" />
    <link href="../Imagenes/favicon.ico" type="image/x-icon" rel="shortcut icon" />

    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>

<body style="width:700px;">

<!-- Menú vertical -->

<?php
    include("../conection.php");
	$conn = OCILogon($user, $pass, $db);



    $cedulaUsuario = $_GET['cedula'];
    $privacidad = $_GET['privacidad'];
    $_SESSION['privacidad'] = $privacidad;


    //Saca los datos del usuario que intenta ver el perfil ajeno, para saber si es administrador o no
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



    //Saca los datos del usuario que se quiere ver
    $query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.usuarioPorCedula(:cedula); END;");
    //Genera el cursor donde la informacion sera guardada
	$cursor = oci_new_cursor($conn);

	//Se le pasa el parametro de busqueda que se obtiene del url
	oci_bind_by_name($query_procedimiento, ':cedula', $cedulaUsuario);
	oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

	ociexecute($query_procedimiento);
	oci_execute($cursor, OCI_DEFAULT);
	oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
	$datos = '';

	foreach($array as $fila){
        //Para poner la palabra completa Masculino o Femenino
        if($fila['GENERO'] == 'F') {
            $genero = 'Femenino';
        } else {
            $genero = 'Masculino';
        }
        //Calcula la edad de nacimiento
        /*
	    $fechaNacimiento = new DateTime($fila['FECHANACIMIENTO']);
        $fechaActual = new DateTime('today');
        $edad = $fechaNacimiento->diff($fechaActual)->y;
*/
        //Variable guardada para mostrarla en la ventana de reportar
        $_SESSION['cedulaReportado'] = $fila['CEDULAUSUARIO_ID'];
        $nombre = $fila['NOMBRE'] .' '. $fila['PRIMERAPELLIDO'] .' '. $fila['SEGUNDOAPELLIDO'];
        $usuario = $fila['USUARIO'];
        //Los datos se separan porque dependiendo de la privacidad mostrará algunos y otros no
        $datosPrivados =  "<section id='mostrar' style='position:absolute; left:200px; top:100px; width:630px; height:400px;'>
					<div style='width:600px; height:510px;line-height:3em;overflow:auto;padding:5px;'>
            <h1 style='position:absolute; top:50px; left:200px;'> Nombre: ". $fila['NOMBRE'] ."  </h1>
            <a style='position:absolute; top:200px; left:200px;'>Apellidos: ". $fila['PRIMERAPELLIDO'] . " ". $fila['SEGUNDOAPELLIDO'] ."</a>
            <a style='position:absolute; top:250px; left:200px;'>Cédula: ". $fila['CEDULAUSUARIO_ID'] ."</a>
            <a style='position:absolute; top:300px; left:200px;'>Género: " . $genero ."</a>
            <a style='position:absolute; top:350px; left:200px;'>Edad: "./* $edad .*/"</a>
            <a style='position:absolute; top:400px; left:200px;'>Usuario: " . $fila['USUARIO'] . "</a>
            <a style='position:absolute; top:450px; left:200px;'></a>
        </div>";

    }
    //Dependiendo de la privacidad cambiará el nombre para que en el menu vertical no salga el nombre
    if($estado != 2 and $privacidad != 1){
        $nombre = $usuario;
    }
    //Se encarga de reportar
     $menuVertical =
            '<section id="CuadroGris" style="position:absolute; top:100px; left:-80px; width:240px; height:80px;">

		<button type="submit" style="position:absolute; top:20px;left:18px; font-size:18px; width:200px;" >
		<a href="#openReport" style="color: #CFCFCF;
			font: small-caps 100%/200% serif;
			background-color:#914998;
			font-size: 16px;">Reportar a</a>
		</button>
		<div id="openReport" class="modalDialog">

            <div style="width:650px; height:400px;line-height:3em; overflow:auto; padding:5px;">
                <a style="left:634px; top:1px;" href="#close" title="Close" class="close">X</a>
                <form action="reportarUsuario.php" method="post" enctype="multipart/form-data">
                    <h2>Reportar a esta persona</h2>
                    <a style="position:absolute; width:600px; top:70px; ">Si desea reportar a '. $nombre .', rellene el siguiente campo:</a>
                    <a style="position:absolute; top:160px; left:70px;">Razón</a>
                    <textarea type="text" name="descripcion" style="position:absolute; top:180px; left: 150px;width:300px; height:100px;"></textarea>

                    <button type="submit" style="position:absolute; top: 300px; left:150px; width:100px;">Reportar</button>

                </form>
			</div>
		</div>


	</section>
    </section>';

    //El primer if es si el usuario es publico y si el que lo quiere ver es administrador que pueda ver los datos
    if($estado == 2 or $privacidad == 1){
        echo $datosPrivados;
        
        echo $menuVertical;
    //El else ocurre si el perfil es privado y el que lo quiere ver no es administrador
    } else {
        $datosPrivados =  "<section id='mostrar' style='position:absolute; left:200px; top:100px; width:630px; height:400px;'>
					<div style='width:600px; height:510px;line-height:3em;overflow:auto;padding:5px;'>
            <h1 style='position:absolute; top:50px; left:200px;'>Nombre: ". $usuario ."  </h1>
            <a style='position:absolute; top:200px; left:200px;'>El resto de los datos son privados.</a>
        </div>";
        echo $datosPrivados;
        echo $menuVertical;
    }
?>


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
    <button type='submit' onclick='ajax_post2()' style="position:absolute; top:20px; left:400px;" >Buscar</button>

    <section style="position:absolute; left:560px;">
        <nav align="center" >
        <ul id="menu">
            <li><a title="Perfil" href="MiPerfil.php">Usuario</a></li>
            <li><a title="Inicio" href="busquedaAvanzada.php">Inicio</a></li>

            <li><a title="Privacidad"> <img src="../Imagenes/candado.png" /></a>
                <ul>
                    <li style="font-size:16px; width:150px;"><a href="UpdatePerfil.php">Configuración</a></li>
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
