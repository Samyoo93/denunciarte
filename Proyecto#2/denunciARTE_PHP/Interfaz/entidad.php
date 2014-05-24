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
    var genero = document.getElementById("genero").value;
    var contrasena = document.getElementById("contrasena").value;
	var contrasena2 = document.getElementById("contrasena2").value;
    var usuario = document.getElementById("usuario").value;
	var nick= document.getElementById("nick").value;
	var cedula1= document.getElementById("cedula1").value;
	var cedula2=document.getElementById("cedula2").value;
	var cedula3= document.getElementById("cedula3").value;


    var vars = 'nombre='+nombre+'&primerApellido='+primerApellido+"&segundoApellido="+segundoApellido+'&fecNac='+fecNac+'&nick='+nick+'&cedula1='+cedula1+'&cedula2='+cedula2+'&cedula3='+cedula3+'&genero='+genero+'&usuario='+usuario+'&contrasena='+contrasena+'&contrasena2='+contrasena2;
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
<input type="text" style="position:absolute; top:50px; left:510px;" placeholder="Usuario" id="usuarioLogin" />
<a style="position:absolute; left:690px; top:30px;"> Contraseña </a>
<a href="" style="position:absolute; left:690px; font-size:12px; top:80px;">¿Olvidaste tu contraseña?</a>
<input type="text" style="position:absolute; top:50px; left:690px;" placeholder="Contraseña" id="contrasenaLogin" />
<button type="submit" style="position:absolute; top:50px; left:870px;">Entrar</button>
</section>
<!-- LOGO -->
<img src="Imagenes/logoDenunciARTE2.png" style="position:absolute; top:140px; left:20px;"/>

<div id="registro">
</div>
<!-- Registro de usuarios -->
<section style="position:absolute; top:200px; left:200px; width:800px; height:550px;">
<h2 style="position:absolute; left:30px;">Registrar entidad</h2>
<a style="position:absolute; left:30px; top:50px;">________________________________________</a>
<a style="position:absolute; top:90px; left:60px;">Nombre</a>
<input type="text" id="nombre" style="position:absolute; top:90px; left:130px; width:300px;" />
<a style="position:absolute; top:130px; left:60px;">Cédula Jurídica</a>
<input type="text" id="cedJuridica" style="position:absolute; top:150px; left:130px; width:300px;"/>
<h2 style="position:absolute; top:170px; left:60px;">Dirección</h2>
<a style="position:absolute; top:210px; left:60px;">__________</a>
<a style="position:absolute; top:250px; left:60px;">País</a>
<select name='pais' required style="position:absolute; top:250px; text-align:center;
left:130px; width:300px;">
</select>

<a style="position:absolute; top:290px; left:60px;">Provincia</a>
<select name='provincia' required style="position:absolute; top:290px; text-align:center;
left:130px; width:300px;">
</select>
<a style="position:absolute; top:330px; left:60px;">Cantón</a>
<select name='canton' required style="position:absolute; top:330px; text-align:center;
left:130px; width:300px;">
</select>
<a style="position:absolute; top:370px; left:60px;">Distrito</a>
<select name='distrito' required style="position:absolute; top:370px; text-align:center;
left:130px; width:300px;">
</select>
<a style="position:absolute; top:400px; left:60px;">Barrio</a>
<select name='barrio' required style="position:absolute; top:400px; text-align:center;
left:130px; width:300px;">
</select>
<a style="position:absolute; top:430px; left:60px;"> Dirección exacta </a>
<textarea style="position:absolute; top:450px; left:130px; width:290px; height:50px;" ></textarea>
<h2 style="position:absolute; top:490px; left:60px;">Categoría</h2>
<a style="position:absolute; top:530px; left:60px;">_______________</a>
<a style="position:absolute; top:560px; left:60px;">Nombre</a>
<select name='tipoCategoria' required style="position:absolute; top:560px; text-align:center;
left:130px; width:300px;">
	<option value="otra">Otra</option>
</select>
<button type="submit" style="position:absolute; top:620px; left:130px; width:150px;">Cancelar</button>
<button type="submit" style="position:absolute; top:620px; left:310px; width:150px;">Crear</button>
</div>
</section>
<!-- Nueva categoría-->
<section style="position:absolute; top:580px; left:660px; width:400px;">
<a style="color:#FF33D7; left:10px;">_____________________________________</a>
<h2 style="position:absolute; top:10px; left:10px;"> Nueva Categoría</h2>
<a style="position:absolute; left:10px; top:80px;">Nombre</a>
<a style="position:absolute; left:10px; top:115px;">Descripción</a>
<textarea style="position:absolute; left:80px; top:135px; height:65px;"></textarea>
<input type="text" id="categoriaNombre"  style="position:absolute; top:80px; left:80px;" />
<button type="submit" style="position:absolute; top:70px; left:250px;">Agregar</button>
<a style="color:#FF33D7; position:absolute; left:10px; top:200px;">_____________________________________</a>
</section>
</section>


<!-- Pie de página -->
<section id="CuadroGris" style=" top:965px; position:absolute; left:20px; width:960px; height:90px">
<a style="position:absolute; left:20px; top:10px;"> Desarrolladores </a>
<a style="position:absolute; left:40px; top:40px;"> -Kathy Brenes G. </a>
<a style="position:absolute; left:190px; top:40px;"> -Barnum Castillo B. </a>
<a style="position:absolute; left:340px; top:40px;"> -Franco Solís A. </a>
<a style="position:absolute; left:480px; top:40px;"> -Samuel Yoo. </a>

<a style=" position:absolute; top:70px; left:700px;">DenunciARTE © 2014 · Español </a>

</section>
</body>
</html>