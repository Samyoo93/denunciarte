<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--
    INSTITUTO TECNOLÓGICO DE COSTA RICA
    BASES DE DATOS I
    I SEMESTRE 2014
    II PROYECTO

    DENUNCIARTE

    ESTUDIANTES
    KATHY BRENES GUERRERO.
    BARNUM CASTILLO BARQUERO.
    FRANCO SOLÍS ALVARADO.
    SAM YOO.

    Nombre del archivo: mostrarDatos.php
    Descripción: Permite desplegar la información de las personas
    físicas consultadas, permite que otro usuario las califique.

-->
<head>



    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DenunciARTE</title>
    <link rel="stylesheet" href="../Estilo/Estilo.css" />
    <link href="../Imagenes/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    <link href="../hovercard/libs/jquery.qtip.custom/jquery.qtip.css" rel="stylesheet">
    <link href="../hovercard/estilohover.css" rel="stylesheet">
    <link rel="stylesheet" href="../hovercard/rateit/src/rateit.css">
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../hovercard/libs/jquery.qtip.custom/jquery.qtip.js"></script>
    <script src="../hovercard/rateit/src/jquery.rateit.js" type="text/javascript"></script>
    <script src="../hovercard/estrellas.js" type="text/javascript"></script>
    <script src="../hovercard/ObtenerValor.js" type="text/javascript"></script>

    <script src="../hovercard/script.js" type="text/javascript"></script>
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
<div id='preview'>

</div>

<section id="mostrar" style="position:absolute; left:20px; top:100px; width:630px; height:400px;">
	<!-- Menú vertical, lo coloco aquí porque cada vez que se hace la busqueda elimina esta parte y la volverá a poner cuando carge la
	pagina de nuevo-->
	<?php

        //Carga todos los datos que provienen del id obtenido del url
        include("../conection.php");
		$conn = OCILogon($user, $pass, $db);
        session_start();


        if (!isset($_SESSION['usuario'])) {
            $Message = 'Sesión no iniciada.';
            header('Location: ../index.php?Message=' . urlencode($Message));
        }

        if(!isset($_GET['id'])){
            $Message = 'No ha realizado una busqueda antes.';
            header('Location: busquedaAvanzada.php?Message=' . urlencode($Message));
        }

        if (isset($_GET['Message'])) {
            print '<script type="text/javascript">alert("' . $_GET['Message'] . '");</script>';
        }
        //Hace la diferencia entre persona fisca y juridica
        $persona = $_GET['persona'];
        $_SESSION['tipoPersona'] = $persona;
        //Variable que se usará para sacar los datos que se van a mostrar
		$id = $_GET['id'];

        //Carga los elementos encontrados dependiendo de si es personaFisica o personaJuridica obtenido del url 
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
                if($fila['GENERO'] == 'F') {
                    $genero = 'Femenino';
                } else {
                    $genero = 'Masculino';
                }
                //Calcula la edad de nacimiento
                $getEdad = "begin :edad := get_edadPersona(:id); end;";
                $queryGetEdad = ociparse($conn, $getEdad);
                ocibindbyname($queryGetEdad, ":edad", $edad, 100);
                ocibindbyname($queryGetEdad, ":id", $fila['PERSONA_ID']);
                ociexecute($queryGetEdad);
                $_SESSION['id'] = $fila['PERSONA_ID'];

                $nombre = $fila['NOMBRE'] .' '. $fila['PRIMERAPELLIDO'] .' '. $fila['SEGUNDOAPELLIDO'];
                //Variable también utilizada para sacar las calificaciones de la persona
                $cedula = $fila['CEDULAFISICA_ID'];
				//Guarda variables necesaria para procesos como calificar que se procesa en pasarValorALaBase
                $_SESSION['cedulaTemporal'] = $cedula;
                $datos = $datos . '<h1 style="position:absolute; left:150px;"> Persona Física</h1>
				<a style="position:absolute; top:150px; left:70px;">Nombre Completo: '. $nombre .'</a>
				<a style="position:absolute; top:180px; left:70px;">Cédula: '. $fila['CEDULAFISICA_ID'] .'</a>
				<a style="position:absolute; top:210px; left:70px;">Edad: '. $edad .'</a>
				<a style="position:absolute; top:240px; left:70px;">Género: '. $genero .'</a>

				<h2 style="position:absolute; top:240px; left:70px;">Trabajo </h2>
				<a style="position:absolute; top:280px; left:70px;">_________</a>
				<a style="position:absolute; top:310px; left:70px;">Lugar del trabajo:'. $fila['LUGARTRABAJO'] .'</a>
				<a style="position:absolute; top:340px; left:70px;">Cargo:'. $fila['CARGO'] .'</a>
				<h2 style="position:absolute; top:370px; left:70px;">Calificaciones </h2>
				<a style="position:absolute; top:410px; left:70px;">_______________</a>
				<a style="position:absolute; top:440px; left:70px;">Promedio: </a>';

			}
            //Carga los review que sele hicieron a la persona

            //Se inicia el query con el procedimiento asignado
		    $query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.reviewPorCedulaPersona(:cedula); END;");
            //Genera el cursor donde la informacion sera guardada
		    $cursor = oci_new_cursor($conn);

            //Se le pasa el parametro de la cedula
		    oci_bind_by_name($query_procedimiento, ':cedula', $cedula);
		    oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

		    ociexecute($query_procedimiento);
		    oci_execute($cursor, OCI_DEFAULT);
		    oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		    //<div style="width:600px; height:510px;line-height:3em;overflow:auto;padding:5px;">
            $reviews = '<div style="margin-top:0px;">
            <form target="_blank" action="../UploadedImgs/showImg.php" method="post" enctype="multipart/form-data">';
            foreach($array as $fila){
                $url = substr($fila['URL_FILE'], 56);
                if ($fila['PRIVACIDAD'] == 1){
                    $nombreReviews = $fila['NOMBRE'] .' '. $fila['PRIMERAPELLIDO'] .' '. $fila['SEGUNDOAPELLIDO'];
                }else {
                    $nombreReviews = $fila['USUARIO'];
                }

                $reviews = $reviews . '
				<a style="position:absolute;">Nota: '. $fila['NOTA'] .'</a><br>

                <a style="position:absolute; font-size:20px;">Descripción:</a><br>
                <p1 rows="100" cols="0">"'. $fila['DESCRIPCION'] .'"</p1><br>

                <a href="mostrarUsuarios.php?cedula='.$fila['CEDULAUSUARIO_ID'].'&privacidad='. $fila['PRIVACIDAD'] .'" style="position:absolute;">-'. $nombreReviews .'</a><br>
                
                <button type="submit" name="evidencia"  value="'.$url.'" style="position:absolute; left:500px; margin-top:-50px;">Evidencia
                </button>
               
                <hr size=5>';
            }
            $reviews = $reviews . '</form></div>';

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
                $nombre = $fila[0];
                //Variable también utilizada para sacar las calificaciones de la persona
                $cedula = $fila[1];
                //Guarda variables necesaria para procesos como calificar que se procesa en pasarValorALaBase
				$_SESSION['cedulaTemporal'] = $cedula;
                $_SESSION['id'] = $fila[8];
                $datos = $datos . '
				<h1 style="position:absolute; left:150px;"> Persona Jurídica</h1>
				<a style="position:absolute; top:170px; left:70px;">Nombre:'. $nombre .'</a>
				<a style="position:absolute; top:200px; left:70px;">Cédula:'. $fila[1] .'</a>
				<a style="position:absolute; top:230px; left:70px;">Dirección Exacta: '. $fila[2] . '</a>
				<a style="position:absolute; top:260px; left:70px;">Barrio: '. $fila[3] . '</a>
				<a style="position:absolute; top:285px; left:70px;">Distrito: '. $fila[4] . '</a>
				<a style="position:absolute; top:313px; left:70px;">Cantón: '. $fila[5] . '</a>
				<a style="position:absolute; top:340px; left:70px;">Provincia: '. $fila[6] . '</a>
				<a style="position:absolute; top:370px; left:70px;">País: '. $fila[7] .'</a>
				<h2 style="position:absolute; top:370px; left:70px;">Calificaciones </h2>
				<a style="position:absolute; top:410px; left:70px;">_______________</a>
				<a style="position:absolute; top:440px; left:70px;">Promedio: </a>';

			}

			//Carga los review que sele hicieron a la persona

            //Se inicia el query con el procedimiento asignado
		    $query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.reviewPorCedulaPersonaEntidad(:cedula); END;");
            //Genera el cursor donde la informacion sera guardada
		    $cursor = oci_new_cursor($conn);

            //Se le pasa el parametro de la cedula
		    oci_bind_by_name($query_procedimiento, ':cedula', $cedula);
		    oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

		    ociexecute($query_procedimiento);
		    oci_execute($cursor, OCI_DEFAULT);
		    oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		    //<div style="width:600px; height:510px;line-height:3em;overflow:auto;padding:5px;">
            $reviews = '<div style="margin-top:0px;">
            <form target="_blank" action="../UploadedImgs/showImg.php" method="post" enctype="multipart/form-data">';
            foreach($array as $fila){
                if ($fila['PRIVACIDAD'] == 1){
                    $nombreReviews = $fila['NOMBRE'] .' '. $fila['PRIMERAPELLIDO'] .' '. $fila['SEGUNDOAPELLIDO'];
                }else {
                    $nombreReviews = $fila['USUARIO'];
                }
                $url = substr($fila['URL_FILE'], 56);
                $_SESSION['url'] = $url;
                $reviews = $reviews . '
				<a style="position:absolute;">Nota: '. $fila['NOTA'] .'</a><br>
                <a style="position:absolute; font-size:20px;">Descripción:</a><br>
                <p1 rows="4" cols="50" disabled>"'. $fila['DESCRIPCION'] .'"</p1><br>
                <a href="mostrarUsuarios.php?cedula='.$fila['CEDULAUSUARIO_ID'].'&privacidad='. $fila['PRIVACIDAD'] . '" style="position:absolute;">-'. $nombreReviews .'</a><br>
                <button type="submit" name="evidencia" id="evidencia" value="'.$url.'" style="position:absolute; left:500px; margin-top:-50px;">Evidencia
                </button>
                <hr size=5>';

            }
            $reviews = $reviews . '</form></div>';

		}

        //El unico objetivo de esto es para cargar el nombre en la ventana emergente de clasificacion
        $menuVertical = 
            '<section id="CuadroGris" style="position:absolute; top:150px; left:700px; width:270px; height:150px;">
		<button type="submit" style="position:absolute; top:20px; left:30px; font-size:18px; width:200px;"><a href="#openRate" style="color: #CFCFCF;
			font: small-caps 100%/200% serif;
			background-color:#914998;
			font-size: 16px;">Calificar</a></button>
		<button type="submit" style="position:absolute; top:70px;left:30px; font-size:18px; width:200px;" >
            <a href="#openReport" style="color: #CFCFCF;
                font: small-caps 100%/200% serif;
                background-color:#914998;
                font-size: 16px;">Ver Calificaciones
            </a>
		</button>
		<div id="openReport" class="modalDialog">

            <div style="width:600px; height:400px;line-height:3em;overflow:auto;padding:5px;">
                <a  style="left:0px; top:1px;" href="#close" title="Close" class="close">X</a>
                <h2>Reviews</h2><br>'.
                $reviews .'
			</div>
		</div>

		<div id="openRate" class="modalDialog">
				   <div>
                <form action="../hovercard/pasarValorALaBase.php" method="post" enctype="multipart/form-data">
                    <a href="#close" title="Close" class="close">X</a>
                    <h2>Calificar a esta persona</h2>
                    <a style="position:absolute; top:60px;">Si desea calificar a '. $nombre .', rellene los siguientes campos:</a>
                    <a style="position:absolute; top:150px;">Título</a>
                    <input type="text" required name ="titulo" style="position:absolute; top:150px; left: 150px; width:200px;">
                    <a style="position:absolute; top:180px;">Descripción</a>
                    <textarea required type="text" name="descripcion" style="position:absolute; top:180px; left: 150px;width:300px; height:100px;"></textarea>
                    <a style="position:absolute; top:300px;">Calificación</a>
                    <a style="position:absolute; top:115px;">Archivo:</a> <input type="file" required id="imgfile" style="position:absolute; top:115px; left:145px;" name="imgfile"><br>

                    <div class="rateit" id="estrellas" data-rateit-max="10" data-rateit-step=1 data-rateit-value=1 data-rateit-resetable="false"  style="position:absolute; top:300px; left:150px;">
                        <input type="number" class="numCalf" name="estrellotas">
                    </div>

                    <button type="submit" style="position:absolute; top: 350px; left:150px; width:100px;">Calificar</button>

                </form>
            </div>
		</div>
	</section>';
        echo $menuVertical;
        echo $datos;
	
    ?>
    
    <div class="pruebaReview"  style="position:absolute; top:440px; left:150px;">

    <a href="#">
    <?php
        /*If que hace la diferencia entre las sentencias SQL, si espersona fisica se elegiran sus correspondientes
         y si es persona juridica se eligen las sentencias equivalente para persona juridica*/
        if($persona == 'personaFisica'){
            $sumaCalificacion = "begin :result:= estrellas.get_sumaCaliPersonaFisica(:pcedula);end;";

            $totalUsuarios = "begin :result:=estrellas.get_totalUsuarioDePF(:pcedula); end;";

            $countPersona = "begin :result:=estrellas.get_countPersonaFisica(:c, :pcedula); end;";

        } else if($persona == 'personaJuridica') {
            $sumaCalificacion = "begin :result:= estrellas.get_sumaCaliEntidad(:pcedula);end;";

            $totalUsuarios = "begin :result:=estrellas.get_totalUsuarioDeEntidad(:pcedula); end;";

            $countPersona = "begin :result:=estrellas.get_countEntidad(:c, :pcedula); end;";
        }

        $query_sumaCalificacion = oci_parse($conn, $sumaCalificacion);
        oci_bind_by_name ($query_sumaCalificacion,':pcedula',$cedula);
        oci_bind_by_name($query_sumaCalificacion,':result',$result2,20);
        oci_execute($query_sumaCalificacion);

        $query_totalUsuarios = oci_parse ($conn, $totalUsuarios);
        oci_bind_by_name ($query_totalUsuarios,':pcedula',$cedula);
        oci_bind_by_name($query_totalUsuarios,':result',$result1,20);
        oci_execute($query_totalUsuarios);

        if ($result1 == 0){
            $rating = 0;

        }else{
            $rating = $result2/$result1;
        }


        echo " <div class='rateit' data-rateit-max='10'  data-rateit-readonly='true' data-rateit-value=".$rating."></div>";
    ?>
                    <!--para cambiar el relleno de las estrellas-->

        </a>


        </div>


        <div class="review">
            <div>
                <?php

                if ($result1 == 0){
                    $rating =  0;
                }else{
                    $rating = $result2/$result1;
                }


                echo "<div class='left'>";
                echo   " <h1>".round($rating)."</h1>";
                echo   " <p>avg of<span>".$result1."</span>ratings";
                echo   " <p>";
                echo "</div>";

                ?>


                <div class="right">
                    <table>

                    <?php

                        for ($i = 1; $i<=10; $i++){
                            $count = oci_parse ($conn, $countPersona);
                            oci_bind_by_name($count,':c',$i);
                            oci_bind_by_name($count,':pcedula',$cedula);
                            oci_bind_by_name($count,':result',$resultado,20);


                            oci_execute($count);
                            $total = oci_parse ($conn, $totalUsuarios);
                            oci_bind_by_name ($total,':pcedula',$cedula);
                            oci_bind_by_name($total,':result',$resultado3,20);
                            oci_execute($total);


                            if ($result1 == 0){
                                $porcentaje = 0;
                            }else{
                                $porcentaje = ($resultado/$resultado3)*100;
                            }


                            echo "<tr>";
                            echo "<td> ",$i,"★","   </td>";
                            echo     "<td>";
                            echo           "<svg width='100' height='10'>";
                            echo"        <rect x='0' y='0' width=".$porcentaje." height='10' fill='#914998' rx='10' ry='20' stroke-width='8'/>";
                            echo "</svg>";
                            echo "</td>";
                            echo "<td>",$resultado,"</td>";
                            echo "</tr>" ;


                        }
                    ?>
                    </table>
                </div>
            </div>
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
	<img src="../Imagenes/denunciarte2.png" style="position:absolute; left:0px;" />

	<input type=search results=5 placeholder='Buscar entidad, persona.'  name='busquedaGeneral' id='busquedaGeneral' style="position:absolute; left:95px; top:30px; width:300px;">
	<button type="submit" onclick='ajax_post()' style="position:absolute; top:20px; left:400px;">Buscar</button>

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
