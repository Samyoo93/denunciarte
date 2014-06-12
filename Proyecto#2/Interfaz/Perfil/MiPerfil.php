<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        $Message = 'Sesión no iniciada.';
        header('Location: ../index.php?Message=' . urlencode($Message));    }
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

    $query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.usuarioPorCedula(:cedula); END;");
    //Genera el cursor donde la informacion sera guardada
	$cursor = oci_new_cursor($conn);

	//Se le pasa el parametro de busqueda
	oci_bind_by_name($query_procedimiento, ':cedula', $_SESSION['cedula']);
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
        $getEdad = "begin :edad := get_edadPersona(:id); end;";
        $queryGetEdad = ociparse($conn, $getEdad);
        ocibindbyname($queryGetEdad, ":edad", $edad, 100);
        ocibindbyname($queryGetEdad, ":id", $fila['PERSONA_ID']);
        ociexecute($queryGetEdad);
        $datos =  "<section id='mostrar' style='position:absolute; left:100px; top:100px; width:630px; height:400px;'>
					<div style='width:600px; height:510px;line-height:3em;overflow:auto;padding:5px;'>
            <h1 style='position:absolute; top:50px; left:200px;'> Nombre: ". $fila['NOMBRE'] ."</h1>
            <a style='position:absolute; top:200px; left:200px;'>Apellidos: ". $fila['PRIMERAPELLIDO'] . " ". $fila['SEGUNDOAPELLIDO'] ."</a>
            <a style='position:absolute; top:250px; left:200px;'>Edad: ". $edad ."</a>
            <a style='position:absolute; top:300px; left:200px;'>Fecha de nacimiento: ". $fila['FECHANACIMIENTO'] ."</a>
            <a style='position:absolute; top:350px; left:200px;'>Género: ". $genero ."</a>
            <a style='position:absolute; top:400px; left:200px;'>Usuario: " . $fila['USUARIO'] . "</a>
            <a style='position:absolute; top:450px; left:200px;'></a>
            <a style='position:absolute; top:400px; left:200px;'></a>
        </div>
        ";



    }
    //Saca todos los reviews que ha hecho el usuario a personas juridicas
    $query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.reviewEntidadPorUsuario(:cedula); END;");
    //Genera el cursor donde la informacion sera guardada
	$cursor = oci_new_cursor($conn);

	//Se le pasa el parametro de busqueda
	oci_bind_by_name($query_procedimiento, ':cedula', $_SESSION['cedula']);
	oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

	ociexecute($query_procedimiento);
	oci_execute($cursor, OCI_DEFAULT);
	oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

    $reviews = '<div style="margin-top:20px;">';
    foreach($array as $fila){
        $reviews = $reviews . '<div>
            <form action="modificarReview.php" method="post" enctype="multipart/form-data">
				<a style="position:absolute; font-size:20px;">Nota: </a><br>
                <input name="nota" value="'. $fila['NOTA'] .'" left="50px"><br>
                <a style="position:absolute; font-size:20px;">Descripción:</a><br>
                <textarea rows="4" cols="50" name="descripcion">'. $fila['DESCRIPCION'] .'</textarea><br>
                <a style="position:absolute;">Hecho a: '. $fila['NOMBRE'] .'</a><br>
                <button type="submit" name="editarReview" value="'. $fila['REVIEW_ID'] .'"style="position:absolute; left:450px; margin-top:-100px;">Modificar</button>
                <button type="submit" name="eliminarReview" value="'. $fila['REVIEW_ID'] .'"style="position:absolute; left:450px; margin-top:-50px;">Eliminar</button>
                <hr size=5></div>
            </form>';
    }
    //Saca todos los reviews que ha hecho el usuario a personas fisicas
    $query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.reviewPersonaFPorUsuario(:cedula); END;");
    //Genera el cursor donde la informacion sera guardada
	$cursor = oci_new_cursor($conn);

	//Se le pasa el parametro de busqueda
	oci_bind_by_name($query_procedimiento, ':cedula', $_SESSION['cedula']);
	oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

	ociexecute($query_procedimiento);
	oci_execute($cursor, OCI_DEFAULT);
	oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

    //Se sacan todos los reviews y se ordenan para mostrarlos en html
    foreach($array as $fila){
        $reviews = $reviews . '<div>
            <form action="modificarReview.php" method="post" enctype="multipart/form-data">
				<a style="position:absolute; font-size:20px;">Nota: </a><br>
                <input name="nota" value="'. $fila['NOTA'] .'" left="50px"><br>
                <a style="position:absolute; font-size:20px;">Descripción:</a><br>
                <textarea rows="4" cols="50" name="descripcion">'. $fila['DESCRIPCION'] .'</textarea><br>
                <a href"" style="position:absolute;">Hecho a: '. $fila['NOMBRE'] .' '. $fila['PRIMERAPELLIDO'] .' '. $fila['SEGUNDOAPELLIDO'] .'</a><br>
                <button type="submit" name="editarReview" value="'. $fila['REVIEW_ID'] .'" style="position:absolute; left:450px; margin-top:-100px;">Modificar</button>
                <button type="submit" name="eliminarReview" value="'. $fila['REVIEW_ID'] .'" id="'. $fila['REVIEW_ID'] .'" style="position:absolute; left:450px; margin-top:-50px;">Eliminar</button>

                <hr size=5></div>
            </form>';
    }

    $reviews = $reviews . '</div>';
    //Ventanas que se muestran al lado izquierdo donde se pueden ver las calificaciones
    $menuVertical =
            '<section id="CuadroGris" style="position:absolute; top:100px; left:-80px; width:240px; height:120px;">

		<button type="submit" style="position:absolute; top:15px;left:18px; font-size:18px; width:200px;" >
		<a href="#openReport" style="color: #CFCFCF;
			font: small-caps 100%/200% serif;
			background-color:#914998;
			font-size: 16px;">Ver Calificaciones</a>
		</button>
        <form method="post" action="procesarDeletePerfil.php" enctype="multipart/form-data">
        <button type="submit" style="position:absolute; top:65px;left:18px; font-size:18px; width:200px;" >
		  Deshabilitar cuenta
		</button>
        </form>
		<div id="openReport" class="modalDialog">

            <div style="width:600px; height:400px;line-height:3em;overflow:auto;padding:5px;">
                <a  style="left:0px; top:1px;" href="#close" title="Close" class="close">X</a>
                
                    <h2>Reviews</h2><br>
                    '. $reviews .'
                
			</div>
		</div>


	</section>
    </section>';//Este es el section que cierra toda el area que se refresca
    echo $datos;
    echo $menuVertical;



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
    <input type=search results=5 placeholder='Buscar entidad, persona.'  name=busquedaGeneral id='busquedaGeneral' style="position:absolute; left:95px; top:30px; width:300px;">
    <button type="submit" onclick='ajax_post2()' style="position:absolute; top:20px; left:400px;">Buscar</button>

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
                    <li style="font-size:16px; width:150px;"><a href="https://sites.google.com/site/denunciarte2014/" target='_blank'>Ayuda</a></li>
                </ul>
            </li>
            <li>
        </ul>
        </nav>
    </section>
</section>

</body>
</html>
