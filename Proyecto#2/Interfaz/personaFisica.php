<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Denunciarte</title>
<link rel="stylesheet" href="Estilo/Estilo.css" />
<link href="Imagenes/favicon.ico" type="image/x-icon" rel="shortcut icon" />
<script type="text/javascript">
    function registrar(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "perfil/registroPersonaFisica.php";
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
                document.getElementById("registro").innerHTML = return_data;
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        document.getElementById("registro").innerHTML = "procesando...";
	}
    function login(){
        // Create our XMLHttpRequest object
        var hr = new XMLHttpRequest();
        // Create some variables we need to send to our PHP file
        var url = "loginUsuario.php";
        var usuarioLogin = document.getElementById("usuarioLogin").value;
        var contrasenaLogin = document.getElementById("contrasenaLogin").value;
        var vars = 'usuarioLogin='+usuarioLogin+'&contrasenaLogin='+contrasenaLogin;
        hr.open("POST", url, true);
        // Set content type header information for sending url encoded variables in the request
        hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Access the onreadystatechange event for the XMLHttpRequest object
        hr.onreadystatechange = function() {
            if(hr.readyState == 4 && hr.status == 200) {
                var return_data = hr.responseText;
                document.getElementById("logins").innerHTML = return_data;
            }
        }
        // Send the data to PHP now... and wait for response to update the status div
        hr.send(vars); // Actually execute the request
        document.getElementById("logins").innerHTML = "procesando...";
	}
	</script>
</head>

<body>
<!--Iniciar Sesión-->
<section id="CuadroGris" style=" top:20px; position:absolute; left:20px; width:960px; height:120px">
<h1 style="position:absolute; left:30px; top:-20px;"> DenunciARTE </h1>
<a style="position:absolute; left:510px; top:30px;"> Usuario </a>
<input type="text" style="position:absolute; top:50px; left:510px;" placeholder="Usuario" id="usuarioLogin" maxlength="25" />
<a style="position:absolute; left:690px; top:30px;"> Contraseña </a>
<input type="password" style="position:absolute; top:50px; left:690px;" placeholder="Contraseña" id="contrasenaLogin" maxlength="15"/>
<button type="submit" onClick='login()' style="position:absolute; top:50px; left:870px;">Entrar</button>
</section>
<!-- LOGO -->
<img src="Imagenes/logoDenunciARTE2.png" style="position:absolute; top:140px; left:20px;"/>

<div id="registro" style="position:absolute; left:250px;top:170px; width:800px;">
</div>
<div id='logins'>
    </div>
<!-- Registro de usuarios -->
<section style="position:absolute; top:200px; left:250px; width:650px; height:550px;">
<h2 style="position:absolute; left:30px;">Registrar persona física</h2>
<a style="position:absolute; left:30px; top:50px;">________________________________________</a>
<a style="position:absolute; top:90px; left:60px;">Nombre</a>
<input type="text" id="nombre" placeholder="Nombre" style="position:absolute; top: 90px; left:130px; width:80px;" maxlength="25"/>
<input type="text" id="primerApellido" placeholder="PrimerApellido" style="position:absolute; top: 90px; left:220px; width:150px;" maxlength="25"/>
<input type="text" id="segundoApellido" placeholder="SegundoApellido" style="position:absolute; top: 90px; left:380px; width:150px;" maxlength="25" />
<a style="position:absolute; top:130px; left:60px;">Cédula</a>
<input type="text" id="cedula1" align="center" placeholder="1" style="position:absolute; top: 150px; left:130px; width:20px;" maxlength="1" />
<label style="position:absolute; top:155px; left:165px;">-</label>
<input type="text" id="cedula2" align='center' placeholder="1111" style="position:absolute; top: 150px; left:190px; width:100px;" maxlength="4"/>
<label style="position:absolute; top:155px; left:310px;">-</label>
<input type="text" id="cedula3" align="center" placeholder="1111" style="position:absolute; top: 150px; left:330px; width:100px;" maxlength="4"/>
<a style="position:absolute; top:190px; left:60px;">Género</a>
    <input type = "radio" name = "genero" id = "genero" value = "F" checked = "checked" style="		     position:absolute; top:210px; left:140px;"/>
    <a for = "Femenino" style="position:absolute; top:210px; left:160px;">Femenino</a>

    <input type = "radio" name = "genero" id = "genero" value = "M" style="position:absolute; top:210px; left:250px;" />
    <a for = "Masculino" style="position:absolute; top:210px; left:270px;">Masculino</a>

<a style="position:absolute; top:250px; left:60px;">Fecha de nacimiento</a>
<input type="date" id="fecNac"style="position:absolute; top: 270px; left:130px; width:300px;" />

<a style="position:absolute; top:310px; left:60px;">Lugar de trabajo</a>
<input type="text" id="lugartrabajo"  placeholder="Lugar de trabajo."style="position:absolute; top: 330px; left:130px; width:300px;" maxlength="25"/>
<a style="position:absolute; top:370px; left:60px;">Cargo</a>
<input type="text" id="cargo" placeholder="Cargo que desempeña" style="position:absolute; top: 390px; left:130px; width:300px;" maxlength="25"/>
<h2 style="position:absolute; top:400px; left:60px;">Categoría</h2>
<a style="position:absolute; top:440px; left:60px;">_______________</a>
<a style="position:absolute; top:470px; left:60px;">Nombre</a>
<?php
    include('conection.php');
    $conn = oci_connect($user, $pass, $db);
    $sql = "SELECT nombre FROM categoria where tipo = 'F'";
    $stmt = oci_parse($conn, $sql);
    ociexecute($stmt);
    echo "<select name='tipoCategoria' required id='categoria' style='position:absolute;
    top:470px; text-align:center; left:130px; width:300px;'>";
    echo "<option value=''>Seleccione uno</option>";
    while ( $row = oci_fetch_assoc($stmt) ) {

        echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";

    }
    echo "<option value='otra'>Otra</option>
    </select>";
?>
<button type="submit" onclick="document.getElementById('nuevaCategoria').style.display='block';this.focus(); return false;" style="position:absolute; top:470px; left:440px;">+</button>
<button type="submit" onclick='registrar()' style="position:absolute; top:520px; left:60px; width:200px;">Registrar</button>

</section>

<div id="nuevaCategoria" style="position:absolute; top:630px; left:720px; width:400px; display:None;" >
<button type="submit" onclick="document.getElementById('nuevaCategoria').style.display='none';return false;" style="position:absolute; top:15px; left:380px;">X</button>
<a style="color:#FF33D7; left:10px;">_____________________________________</a>
<h2 style="position:absolute; top:10px; left:10px;">Nueva Categoría</h2>
<a style="position:absolute; left:10px; top:80px;">Nombre</a>
<a style="position:absolute; left:10px; top:115px;">Descripción</a>
<textarea style="position:absolute; left:80px; top:135px; height:65px;" id='descripcion' maxlength="50"></textarea>
<input type="text" id="categoria2" maxlength="25" style="position:absolute; top:80px; left:80px;" />
<a style="color:#FF33D7; position:absolute; left:10px; top:200px;">_____________________________________</a>
</div>

<!-- Pie de página -->
<section id="CuadroGris" style=" top:865px; position:absolute; left:20px; width:960px; height:90px">
<a style="position:absolute; left:20px; top:10px;"> Desarrolladores </a>
<a style="position:absolute; left:40px; top:40px;"> -Kathy Brenes G. </a>
<a style="position:absolute; left:190px; top:40px;"> -Barnum Castillo B. </a>
<a style="position:absolute; left:340px; top:40px;"> -Franco Solís A. </a>
<a style="position:absolute; left:480px; top:40px;"> -Samuel Yoo. </a>

<a style=" position:absolute; top:70px; left:700px;">DenunciARTE © 2014 · Español </a>

</section>
</body>
</html>
