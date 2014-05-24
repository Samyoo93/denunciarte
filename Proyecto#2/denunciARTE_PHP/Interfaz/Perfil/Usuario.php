<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DenunciARTE</title>
<link rel="stylesheet" href="../Estilo/Estilo.css" />
</head>

<body style="width:700px;" onload="Abrir_ventana('http://URL/ejemplo-popup.html')">

<!-- Menú vertical -->
<section id="CuadroGris" style="position:absolute; top:150px; left:700px; width:270px; height:150px;">
<button type="submit" style="position:absolute; top:20px; left:30px; font-size:18px; width:200px;">Calificar</button>
<button type="submit" style="position:absolute; top:70px;left:30px; font-size:18px; width:200px;" >
<a href="#openModal" style="color: #CFCFCF;
	font: small-caps 100%/200% serif;
	background-color:#914998;
	font-size: 16px;">Reportar</a>
</button>
<div id="openModal" class="modalDialog">
	<div>
		<a href="#close" title="Close" class="close">X</a>
		<h2>Reportar a esta persona</h2>
		<p style="position:absolute; top:70px;">Si desea reportar a NOMBRE DE USUARIO, indique el motivo por el cual desea reportarlo.</p>
		<p style="position:absolute; top:130px;">Motivo</p>
        <textarea style="position:absolute; top:150px; left: 150px; width:350px; height:150px;"></textarea>
        <button type="submit" style="position:absolute; top: 320px; left:150px; width:100px;">Reportar</button>
	</div>
</div>
</section>
<section style="position:absolute; left:20px; top:100px; width:630px; height:400px;">
<div id="mostrar" style="overflow-y:scroll;">
<h1 style="position:absolute; left:150px;"> Nombre: </h1>
<a style="position:absolute; top:150px; left:70px;">Apellidos:</a>
<a style="position:absolute; top:180px; left:70px;">Edad:</a>
<a style="position:absolute; top:210px; left:70px;">Género:</a>
<h2 style="position:absolute; top:240px; left:70px;">Trabajo</h2>
<a style="position:absolute; top:280px; left:70px;">_________</a>
<a style="position:absolute; top:310px; left:70px;">Lugar de trabajo:</a>
<a style="position:absolute; top:340px; left:70px;">Cargo:</a>
<h2 style="position:absolute; top:370px; left:70px;">Calificaciones</h2>
<a style="position:absolute; top:410px; left:70px;">_______________</a>
<a style="position:absolute; top:440px; left:70px;">Promedio:</a>

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
