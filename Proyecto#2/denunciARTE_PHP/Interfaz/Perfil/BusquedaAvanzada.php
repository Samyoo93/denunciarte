<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DenunciARTE</title>
<link rel="stylesheet" href="../Estilo/Estilo.css" />
</head>

<body style="width:700px;">

<!-- Menú vertical -->
<section id="CuadroGris" style="position:absolute; top:150px; left:20px; width:300px; height:300px;">
<h2 style="font-size:24px; left:100px; top:10px;">Mostrar</h2>
<button type="submit" style="position:absolute; top:80px; left:50px; font-size:18px; width:200px;">Calificaciones</button>
<button type="submit" style="position:absolute; top:130px;left:50px; font-size:18px; width:200px;">Reportes</button>
<button type="submit" style="position:absolute; top:180px;left:50px; font-size:18px; width:200px;">Trabajos</button>
</section>

<!--Sección que se actualiza-->
<div id="mostrar">
<!--Sección que se actualiza-->
<div id="mostrar">
<section style="position:absolute; left:350px; top:100px; width:630px; height:400px;">
<h1 style="position:absolute; left:150px;"> Búsqueda avanzada </h1>
<a style="position:absolute; top:170px; left:70px;">Buscar.</a>
<select style="position:absolute; top:170px;left:130px;">
    <option>Entidad</option>
    <option>Categoría</option>
    <option>Persona Física</option>
</select>
<a style="position:absolute; top:170px; left:270px;">por</a>
<!-- Select de categoría-->
<select style="position:absolute; top:170px; left:320px;">
    <option>Nombre</option>
</select>
<!-- Select de entidad
<select style="position:absolute; top:170px; left:320px;">
    <option>Cédula Jurídica</option>
    <option>Nombre</option>
    <option>Categoría</option>
</select>
-->
<!-- Select de persona
<select style="position:absolute; top:170px; left:320px;">
    <option>Cédula</option>
    <option>Nombre</option>
    <option>Primer Apellido</option>
    <option>Segundo Apellido</option>
</select>
-->
<button type="submit" style="position:absolute; top:160px; left:480px;">Buscar</button>
</section>
</div>
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
<a href=""  style="position:absolute; top:60px; left:125px;">+Busqueda avanzada</a>
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
            <li style="font-size:16px; width:150px;"><a href="">Crear una categoría</a></li>
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
