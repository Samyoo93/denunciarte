<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Denunciarte</title>
<link rel="stylesheet" href="Estilo/Estilo.css" />
<script type="text/javascript">
function registrar(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "registrarUsuario.php";
    var nombre = document.getElementById("nombre").value;
    var primerApellido = document.getElementById("primerApellido").value;
    var segundoApellido = document.getElementById("segundoApellido").value;
    var fecNac = document.getElementById("fecNac").value;
    var email = document.getElementById("email").value;
    var email2 = document.getElementById("email2").value;
    var genero = document.getElementById("genero").value;
    var contrasena = document.getElementById("contrasena").value;
	var contrasena = document.getElementById("contrasena2").value;
    var usuario = document.getElementById("usuario").value;
	var nick= document.getElementById("nick").value;
	var cedula1= document.getElementById("cedula1").value;
	var cedula2=document.getElementById("cedula2").value;
	var cedula3= document.getElementById("cedula3").value;
	

    var vars = 'nombre='+nombre+'&primerApellido='+primerApellido+"&segundoApellido="+segundoApellido+'&fecNac='+fecNac+'&email='+email+'&email2='+email2+'&genero='+genero+'&usuario='+usuario+'&contrasena='+contrasena+'&contrasena2='+contrasena2;
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
	</script>
</head>

<body>
<!--Iniciar Sesión-->
<section id="CuadroGris" style=" top:20px; position:absolute; left:20px; width:960px; height:120px">
<h1 style="position:absolute; left:30px; top:-20px;"> DenunciARTE </h1>
<a style="position:absolute; left:510px; top:30px;"> Usuario </a>
<input type="text" style="position:absolute; top:50px; left:510px;" placeholder="Usuario" />
<a style="position:absolute; left:690px; top:30px;"> Contraseña </a>
<a href="" style="position:absolute; left:690px; font-size:12px; top:80px;">¿Olvidaste tu contraseña?</a>
<input type="text" style="position:absolute; top:50px; left:690px;" placeholder="Contraseña" />
<button type="submit" style="position:absolute; top:50px; left:870px;">Entrar</button>
</section>
<!-- LOGO -->
<img src="Imagenes/logoDenunciARTE2.png" style="position:absolute; top:140px; left:20px;"/>


<!--Android-->
<section style="position:absolute; top:300px; left:20px; width:450px; height:450px;">
<h2 style="position:absolute; top:30px; left:50px;">¡Puedes utilizarlo desde tu teléfono o tablet con Sistema Operativo Android!</h2>
<img src="Imagenes/android.jpg" style="position:absolute; top:170px; left:80px;"/>
<a style="position:absolute; top:450px; left:120px;">Descárgalo desde</a>
<img src="Imagenes/playStore.jpg" style="position:absolute; top:430px; left:250px;" />
</section>

<section id='error' style='position:absolute; top:170px; left:545px;'>
</section>

<!-- Registro de usuarios -->
<section style="position:absolute; top:170px; left:480px; width:450px; height:300px;">
<h2 style="position:absolute; left:30px;">Regístrate</h2>
<a style="position:absolute; left:30px; top:50px;">________________________________________</a>
<a style="position:absolute; top:90px; left:60px;">Nombre</a>
<input type="text" id="nombre" placeholder="Nombre" style="position:absolute; top: 90px; left:130px; width:80px;" />
<input type="text" id="primerApellido" placeholder="PrimerApellido" style="position:absolute; top: 90px; left:220px; width:100px;" />
<input type="text" id="segundoApellido" placeholder="SegundoApellido" style="position:absolute; top: 90px; left:330px; width:100px;" />
<a style="position:absolute; top:130px; left:60px;">Cédula</a>
<input type="text" id="cedula1" align="center" placeholder="1" style="position:absolute; top: 150px; left:130px; width:20px;" />
<label style="position:absolute; top:155px; left:165px;">-</label>
<input type="text" id="cedula2" align='center' placeholder="1111" style="position:absolute; top: 150px; left:190px; width:100px;" />
<label style="position:absolute; top:155px; left:310px;">-</label>
<input type="text" id="cedula3" align="center" placeholder="1111" style="position:absolute; top: 150px; left:330px; width:100px;" />
<a style="position:absolute; top:190px; left:60px;">Nick</a>
<input type="text" id="nick" placeholder="Alías para reportes" align="center" style="position:absolute; top: 210px; left:130px; width:300px;" />
<a style="position:absolute; top:250px; left:60px;">Usuario</a>
<input type="text" id="usuario" placeholder="De 1-24 carácteres." style="position:absolute; top: 250px; left:130px; width:300px;" />
<a style="position:absolute; top:290px; left:60px;">Contraseña</a>
<input type="password" id="contrasena"  placeholder="De 1-15 carácteres."style="position:absolute; top: 310px; left:130px; width:300px;" />
<a style="position:absolute; top:350px; left:60px;">Confirmar la contraseña</a>
<input type="password" id="contrasena2" placeholder="Verifique las contraseñas" style="position:absolute; top: 370px; left:130px; width:300px;" />
<a style="position:absolute; top:410px; left:60px;">Fecha de nacimiento</a>
<input type="date" id="fecNac"style="position:absolute; top: 430px; left:130px; width:300px;" />
<a style="position: absolute; left: 60px; top: 470px;">Género</a>
	<input type = "radio" name = "genero" id = "genero" value = "F" checked = "checked" style="		     position:absolute; top:470px; left:140px;"/>
    <a for = "Femenino" style="position:absolute; top:470px; left:160px;">Femenino</a>
          
    <input type = "radio" name = "genero" id = "genero" value = "M" style="position:absolute; top:470px; left:250px;" />
    <a for = "Masculino" style="position:absolute; top:470px; left:270px;">Masculino</a>
    
	<a style="position:absolute; top:470px; left:"
    <input type="checkbox" style="position:absolute; top:510px; left:60px;" />
    <a style="position:absolute; left:80px; top:510px;"> Aceptas las </a> <a href="" style="position:absolute; top:510px; left:170px;"> Condiciones de uso </a><a style="position:absolute; top:510px; left:310px"> y que has leído la </a> <a href="" style="position:absolute; top:530px; left:80px;">Política de uso de datos.</a>
    <button type="submit" onclick='registrar()' style="position:absolute; top:560px; left:60px; width:200px;">Registrarse</button> 
</section>

<!-- Registro Entidad-->
<!-- Registro de usuarios -->
<section style="position:absolute; top:750px; left:480px; width:450px; height:100px;">
<a style="position:absolute; left:30px; top:30px;">________________________________________</a>
<a href="" style="position:absolute; top:60px; left:30px; color:#00F;">Crear un perfil</a>
<a style="position:absolute; top:60px; left:140px;">para una compañía.</a>

</section>
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
