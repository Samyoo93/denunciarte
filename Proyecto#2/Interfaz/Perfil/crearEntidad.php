<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        $Message = 'Sesión no iniciada.';
        header('Location: ../index.php?Message=' . urlencode($Message));
    }
    ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DenunciARTE</title>
<link rel="stylesheet" href="../Estilo/Estilo.css" />
<link href="../Imagenes/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    <script>

        function crear(){
            // Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file
            var url = "registroEntidad.php";
            var nombre = document.getElementById('nombre').value;
            var cedJuridica = document.getElementById('cedJuridica').value;
            var pais = document.getElementById('pais').value;
            var provincia = document.getElementById('provincia').value;
            var canton = document.getElementById('canton').value;
            var distrito = document.getElementById('distrito').value;
            var barrio = document.getElementById('barrio').value;
            var tipoCategoria = document.getElementById('tipoCategoria').value;
            var categoria2 = document.getElementById('categoria2').value;
            var direccionExacta = document.getElementById('direccionExacta').value;
            var descripcion = document.getElementById('descripcion').value;

            var vars = 'nombre='+nombre+'&cedJuridica='+cedJuridica+'&pais='+pais+'&provincia='+provincia+'&canton='+canton+'&distrito='+distrito+
                '&barrio='+barrio+'&tipoCategoria='+tipoCategoria+'&categoria2='+categoria2+'&direccionExacta='+direccionExacta+
                '&descripcion='+descripcion;
            hr.open("POST", url, true);
            // Set content type header information for sending url encoded variables in the request
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // Access the onreadystatechange event for the XMLHttpRequest object
            hr.onreadystatechange = function() {
                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    document.getElementById("crearEntidad").innerHTML = return_data;
                }
            }
            // Send the data to PHP now... and wait for response to update the status div
            hr.send(vars); // Actually execute the request
            document.getElementById("crearEntidad").innerHTML = "procesando...";
        }
        function refresh(changed){
            // Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file
            var url = "locationRefreshEntidad.php";
            var which = changed;

            var pais = document.getElementById("pais").value;
            var provincia = document.getElementById("provincia").value;
            var canton = document.getElementById("canton").value;
            var distrito = document.getElementById("distrito").value;
            var barrio = document.getElementById("barrio").value;

            var vars = 'pais='+pais+'&provincia='+provincia+'&canton='+canton+'&distrito='+distrito+'&barrio='+barrio+'&which='+which;
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

        function busquedGeneral(){
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


<section style="position:absolute; left:50px; top:100px; width:900px; height:550px;">
    <div id="mostrar" style="overflow-y:scroll;">
    <h1 style="position:absolute; left:150px;"> Crear Entidad </h1>
    <a style="position:absolute; top:150px; left:70px;">Nombre</a>
    <input type="text" id="nombre" style="position:absolute; top:150px; left:200px; width:300px;" />
    <a style="position:absolute; top:190px; left:70px;">Cédula Jurídica</a>
    <input type="text" id="cedJuridica" style="position:absolute; top:190px; left:200px; width:300px;"/>
    <div id='direccion'>
    <h2 style="position:absolute; top:210px; left:70px;">Dirección</h2>
    <a style="position:absolute; top:250px; left:70px;">_________</a>
    <a style="position:absolute; top:280px; left:70px;">País</a>
    <!-- Select de país creado dinámicamente con php desde la base de datos. -->
        <?php
            include('../conection.php');
            $conn = oci_connect($user, $pass, $db);
            $sql = "SELECT nombre FROM pais";
            $stmt = oci_parse($conn, $sql);
            ociexecute($stmt);
            echo "<select name='pais' required id='pais' onchange='refresh(1)' style='position:absolute; top:280px; text-align:center;
    left:200px; width:300px;'>";
            echo "<option value=''>Seleccione uno</option>";
            while ( $row = oci_fetch_assoc($stmt) ) {

                if($row['NOMBRE']==$pais) {
                    echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
                } else {
                    echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
                }
            }

        echo "</select>"; ?>

    <a style="position:absolute; top:310px; left:70px;">Provincia</a>
    <select name='provincia' required id='provincia' onchange='refresh(2)' style="position:absolute; top:310px; text-align:center;
    left:200px; width:300px;">
        <option value=''>Seleccione uno</option>
    </select>
    <a style="position:absolute; top:340px; left:70px;">Cantón</a>
    <select name='canton' required id='canton' onchange='refresh(3)' style="position:absolute; top:340px; text-align:center;
    left:200px; width:300px;">
        <option value=''>Seleccione uno</option>
    </select>
    <a style="position:absolute; top:370px; left:70px;">Distrito</a>
    <select name='distrito' required id='distrito' onchange='refresh(4)' style="position:absolute; top:370px; text-align:center;
    left:200px; width:300px;">
        <option value=''>Seleccione uno</option>
    </select>
    <a style="position:absolute; top:400px; left:70px;">Barrio</a>
    <select name='barrio' required id='barrio' onchange='refresh(5)' style="position:absolute; top:400px; text-align:center;
    left:200px; width:300px;">
        <option value=''>Seleccione uno</option>
    </select>
    </div>
    <a style="position:absolute; top:430px; left:70px;"> Dirección exacta </a>
    <textarea id='direccionExacta' style="position:absolute; top:450px; left:200px; width:290px; height:50px;" ></textarea>
    <h2 style="position:absolute; top:490px; left:70px;">Categoría</h2>
    <a style="position:absolute; top:530px; left:70px;">_______________</a>
    <a style="position:absolute; top:560px; left:70px;">Nombre</a>

        <?php
            include('../conection.php');
            $conn = oci_connect($user, $pass, $db);
            $sql = "SELECT nombre FROM categoria where tipo = 'E'";
            $stmt = oci_parse($conn, $sql);
            ociexecute($stmt);
            echo "<select name='tipoCategoria' required id='tipoCategoria' style='position:absolute;
            top:560px; text-align:center; left:200px; width:300px;'>";
            echo "<option value=''>Seleccione uno</option>";
            while ( $row = oci_fetch_assoc($stmt) ) {

                echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";

            }
            echo "<option value='otra'>Otra</option>
            </select>";
        ?>

        <button type="submit" onClick='crear()' style="position:absolute; top:620px; left:250px; width:150px;">Registrar</button>
    </div>
</section>

<div id='crearEntidad'>
</div>

<!-- Nueva categoría-->
<section style="position:absolute; top:580px; left:560px; width:400px;">
    <a style="color:#FF33D7; left:10px;">_____________________________________</a>
    <h2 style="position:absolute; top:10px; left:10px;"> Nueva Categoría</h2>
    <a style="position:absolute; left:10px; top:80px;">Nombre</a>
    <a style="position:absolute; left:10px; top:115px;">Descripción</a>
    <textarea id='descripcion' style="position:absolute; left:80px; top:135px; height:65px;"></textarea>
    <input type="text" id='categoria2'  style="position:absolute; top:80px; left:80px;" />
    <a style="color:#FF33D7; position:absolute; left:10px; top:200px;">_____________________________________</a>
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
