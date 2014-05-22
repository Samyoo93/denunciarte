<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DenunciARTE</title>
<link rel="stylesheet" href="../Estilo/Estilo.css" />
</head>

<body style="width:700px;">

<!-- Menú vertical -->
<section id="CuadroGris" style="position:absolute; top:150px; left:700px; width:270px; height:250px;">
<h2 style="position:absolute; top:10px; left:80px;">Mostrar</h2>
<button type="submit" style="position:absolute; top:90px;left:30px; font-size:18px; width:200px;">Categorías</button>
<button type="submit" style="position:absolute; top:140px; left:30px; font-size:18px; width:200px;">Entidades</button>
</section>

<section style="position:absolute; left:20px; top:100px; width:630px; height:400px;">
<div id="mostrar" style="overflow-y:scroll;">
<h1 style="position:absolute; left:150px;"> Crear Entidad </h1>
<a style="position:absolute; top:150px; left:70px;">Nombre</a>
<input type="text" id="nombre" style="position:absolute; top:150px; left:200px; width:300px;" />
<a style="position:absolute; top:190px; left:70px;">Cédula Jurídica</a>
<input type="text" id="cedJuridica" style="position:absolute; top:190px; left:200px; width:300px;"/>
<h2 style="position:absolute; top:210px; left:70px;">Dirección</h2>
<a style="position:absolute; top:250px; left:70px;">_________</a>
<a style="position:absolute; top:280px; left:70px;">País</a>
<select name='pais' required style="position:absolute; top:280px; text-align:center;
left:200px; width:300px;">
</select>	

<a style="position:absolute; top:310px; left:70px;">Provincia</a>
<select name='provincia' required style="position:absolute; top:310px; text-align:center;
left:200px; width:300px;">
</select>
<a style="position:absolute; top:340px; left:70px;">Cantón</a>
<select name='canton' required style="position:absolute; top:340px; text-align:center;
left:200px; width:300px;">
</select>
<a style="position:absolute; top:370px; left:70px;">Distrito</a>
<select name='distrito' required style="position:absolute; top:370px; text-align:center;
left:200px; width:300px;">
</select>
<a style="position:absolute; top:400px; left:70px;">Barrio</a>
<select name='barrio' required style="position:absolute; top:400px; text-align:center;
left:200px; width:300px;">
</select>
<h2 style="position:absolute; top:440px; left:70px;">Categoría</h2>
<a style="position:absolute; top:480px; left:70px;">_______________</a>
<a style="position:absolute; top:510px; left:70px;">Nombre</a>
<select name='tipoCategoria' required style="position:absolute; top:510px; text-align:center;
left:200px; width:300px;">
	<option value="otra">Otra</option>
</select>
<button type="submit" style="position:absolute; top:570px; left:130px; width:150px;">Cancelar</button>
<button type="submit" style="position:absolute; top:570px; left:310px; width:150px;">Crear</button>
</div>
</section>
<!-- Nueva categoría-->
<section style="position:absolute; top:530px; left:560px; width:400px;">
<a style="color:#FF33D7; left:10px;">_____________________________________</a>
<h2 style="position:absolute; top:10px; left:10px;"> Nueva Categoría</h2>
<a style="position:absolute; left:10px; top:80px;">Nombre</a>
<a style="position:absolute; left:10px; top:115px;">Descripción</a>
<textarea style="position:absolute; left:80px; top:135px; height:65px;"></textarea>
<input type="text" id="categoriaNombre"  style="position:absolute; top:80px; left:80px;" />
<button type="submit" style="position:absolute; top:70px; left:250px;">Agregar</button>
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
<input type=search results=5 placeholder='Buscar entidad, persona.'  name=busqueda style="position:absolute; left:95px; top:30px; width:300px;">
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
