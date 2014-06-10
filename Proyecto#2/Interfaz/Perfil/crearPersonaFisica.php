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
    <script>

        function crear() {
            // Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file
            var url = "registroPersonaFisica.php";
            var nombre = document.getElementById('nombre').value;
            var primerApellido = document.getElementById('primerApellido').value;
            var segundoApellido = document.getElementById('segundoApellido').value;
            var cedula1 = document.getElementById('cedula1').value;
            var cedula2 = document.getElementById('cedula2').value;
            var cedula3 = document.getElementById('cedula3').value;
            var genero = document.getElementById('genero').value;
            var fecNac = document.getElementById('fecNac').value;
            var lugartrabajo = document.getElementById('lugartrabajo').value;
            var cargo = document.getElementById('cargo').value;
            var categoria = document.getElementById('categoria').value;
            var categoria2 = document.getElementById('categoria2').value;
            var descripcion = document.getElementById('descripcion').value;


            var vars =  'nombre='+nombre+'&primerApellido='+primerApellido+'&segundoApellido='+segundoApellido+'&cedula1='+cedula1+'&cedula2='+cedula2+'&cedula3='+cedula3+'&genero='+genero+'&fecNac='+fecNac+'&lugartrabajo='+lugartrabajo+'&cargo='+cargo+'&categoria='+categoria+'&categoria2='+categoria2+'&descripcion='+descripcion;
            hr.open("POST", url, true);
            // Set content type header information for sending url encoded variables in the request
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // Access the onreadystatechange event for the XMLHttpRequest object
            hr.onreadystatechange = function() {
                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    document.getElementById("crearPerFis").innerHTML = return_data;
                }
            }
            // Send the data to PHP now... and wait for response to update the status div
            hr.send(vars); // Actually execute the request
            document.getElementById("crearPerFis").innerHTML = "procesando...";
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
        <h2 style="position:absolute; left:30px;">Registrar persona física</h2>
        <a style="position:absolute; left:30px; top:50px;">________________________________________</a>
        <a style="position:absolute; top:90px; left:60px;">Nombre</a>
        <input type="text" id="nombre" placeholder="Nombre" style="position:absolute; top: 90px; left:130px; width:80px;" />
        <input type="text" id="primerApellido" placeholder="PrimerApellido" style="position:absolute; top: 90px; left:220px; width:150px;" />
        <input type="text" id="segundoApellido" placeholder="SegundoApellido" style="position:absolute; top: 90px; left:380px; width:150px;" />
        <a style="position:absolute; top:130px; left:60px;">Cédula</a>
        <input type="text" id="cedula1" align="center" placeholder="1" style="position:absolute; top: 150px; left:130px; width:20px;" />
        <label style="position:absolute; top:155px; left:165px;">-</label>
        <input type="text" id="cedula2" align='center' placeholder="1111" style="position:absolute; top: 150px; left:190px; width:100px;" />
        <label style="position:absolute; top:155px; left:310px;">-</label>
        <input type="text" id="cedula3" align="center" placeholder="1111" style="position:absolute; top: 150px; left:330px; width:100px;" />
        <a style="position:absolute; top:190px; left:60px;">Género</a>
            <input type = "radio" name = "genero" id = "genero" value = "F" checked = "checked" style="		     position:absolute; top:210px; left:140px;"/>
            <a for = "Femenino" style="position:absolute; top:210px; left:160px;">Femenino</a>

            <input type = "radio" name = "genero" id = "genero" value = "M" style="position:absolute; top:210px; left:250px;" />
            <a for = "Masculino" style="position:absolute; top:210px; left:270px;">Masculino</a>

        <a style="position:absolute; top:250px; left:60px;">Fecha de nacimiento</a>
        <input type="date" id="fecNac"style="position:absolute; top: 270px; left:130px; width:300px;" />

        <a style="position:absolute; top:310px; left:60px;">Lugar de trabajo</a>
        <input type="text" id="lugartrabajo"  placeholder="Lugar de trabajo."style="position:absolute; top: 330px; left:130px; width:300px;" />
        <a style="position:absolute; top:370px; left:60px;">Cargo</a>
        <input type="text" id="cargo" placeholder="Cargo que desempeña" style="position:absolute; top: 390px; left:130px; width:300px;" />

        <h2 style="position:absolute; top:430px; left:60px;">Categoría</h2>
        <a style="position:absolute; top:470px; left:60px;">_______________</a>
        <a style="position:absolute; top:500px; left:60px;">Nombre</a>


            <?php
                include('../conection.php');
                $conn = oci_connect($user, $pass, $db);
                $sql = "SELECT nombre FROM categoria where tipo = 'F'";
                $stmt = oci_parse($conn, $sql);
                ociexecute($stmt);
                echo "<select name='categoria' required id='categoria' style='position:absolute;
                top:500px; text-align:center; left:130px; width:300px;'>";
                echo "<option value=''>Seleccione uno</option>";
                while ( $row = oci_fetch_assoc($stmt) ) {

                    echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";

                }
                echo "<option value='otra'>Otra</option>
                </select>";
            ?>
        <button type="submit" onclick="document.getElementById('nuevaCategoria').style.display='block';this.focus(); return false;" style="position:absolute; top:500px; left:440px;">+</button>
        <!-- Nueva categoría-->
        <div id="nuevaCategoria" style="position:absolute; top:420px; left:500px; width:400px; display:None;">
        <a style="color:#FF33D7; left:10px;">_____________________________________</a>
        <h2 style="position:absolute; top:10px; left:10px;"> Nueva Categoría</h2>
        <a style="position:absolute; left:10px; top:80px;">Nombre</a>
        <a style="position:absolute; left:10px; top:115px;">Descripción</a>
        <textarea id='descripcion' style="position:absolute; left:80px; top:135px; height:65px;"></textarea>
        <input type="text" id='categoria2'  style="position:absolute; top:80px; left:80px;" />
        <a style="color:#FF33D7; position:absolute; left:10px; top:200px;">_____________________________________</a>
         <button type="submit" onclick="document.getElementById('nuevaCategoria').style.display='none';return false;" style="position:absolute; top:15px; left:380px;">X</button>
        </div>
        <button type="submit" onclick='crear()' style="position:absolute; top:580px; left:60px; width:150px;">Registrar</button>
    </div>
    <div id='crearPerFis'>
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
<section id="CuadroGris" style="position:absolute; left:20px; height:90px; width:960px; top:0px;">
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
            </ul>
        </nav>
    </section>
</section>

</body>
</html>
