<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DenunciARTE</title>
    <link rel="stylesheet" href="../Estilo/Estilo.css" />
    <link href="libs/jquery.qtip.custom/jquery.qtip.css" rel="stylesheet">
    <link href="../Estilo/estilohover.css" rel="stylesheet">
    <link rel="stylesheet" href="rateit/src/rateit.css">
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="libs/jquery.qtip.custom/jquery.qtip.js"></script>
    <script src="rateit/src/jquery.rateit.js" type="text/javascript"></script>
    <script src="script.js" type="text/javascript"></script>
</head>

<body style="width:700px;">

<section style="position:absolute; left:200px; top:100px; width:730px; height:400px;">
<div id="mostrar" style="overflow-y:scroll;">
<h1 style="position:absolute; left:150px; left:80px; width:500px;"> Actualizar Persona </h1>
<a style="position:absolute; top:150px; left:70px;">Nombre</a>
<input type="text" id="nombre" style="position:absolute; left:200px; top:150px; width:300px;">
<a style="position:absolute; top:180px; left:70px;">Apellidos</a>
<input type="text" id="primerApellido" style="position:absolute; left:200px; top:180px; width:130px;">
<input type="text" id="segundoApellido" style="position:absolute; left:360px; top:180px; width:140px;">
<a style="position:absolute; top:210px; left:70px;">Fecha de Nacimiento</a>
<input type="date" id="nombre" style="position:absolute; left:200px; top:230px; width:300px;">
<a style="position:absolute; top:270px; left:70px;">Género</a>
<input type = "radio" name = "genero" id = "genero" value = "F" checked = "checked" style="		     position:absolute; top:270px; left:200px;"/>
    <a for = "Femenino" style="position:absolute; top:270px; left:220px;">Femenino</a>

    <input type = "radio" name = "genero" id = "genero" value = "M" style="position:absolute; top:270px; left:310px;" />
    <a for = "Masculino" style="position:absolute; top:270px; left:330px;">Masculino</a>

<a style="position:absolute; top:310px; left:70px;">Usuario</a>
<input type="text" style="position:absolute; top:310px; left:200px;" id="usuario">
<a style="position:absolute; top:320px; left:70px;">_________</a>
<a style="position:absolute; top:360px; left:70px;">Lugar de trabajo</a>
<input type="text" id="trabajo" style="position:absolute; left:200px; top:360px; width:300px;">
<a style="position:absolute; top:400px; left:70px;">Cargo</a>
<input type="text" id="cargo" style="position:absolute; left:200px; top:400px; width:300px;">
<button type="submit" style="position:absolute; top:460px; left:200px; width:200px;">Actualizar</button>
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
