<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
       header("Location: ../index.php");
    }
    ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DenunciARTE</title>
    <link rel="stylesheet" href="../Estilo/Estilo.css" />

    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>

<body style="width:700px;">

<!-- Menú vertical -->
<section id="CuadroGris" style="position:absolute; top:150px; left:20px; width:300px; height:250px;">
<h2 style="font-size:24px; left:100px; top:10px;">Mostrar</h2>
<button type="submit" style="position:absolute; top:80px; left:50px; font-size:18px; width:200px;">Calificaciones</button>
<button type="submit" style="position:absolute; top:130px;left:50px; font-size:18px; width:200px;">Reportes</button>
</section>

<section style="position:absolute; left:350px; top:100px; width:630px; height:400px;">
    <div id="mostrar" style="overflow-y:scroll;">
        <h1 style="position:absolute; left:150px;"> Nombre: </h1>
        <a style="position:absolute; top:160px; left:70px;">Apellidos:</a>
        <a style="position:absolute; top:200px; left:70px;">Edad:</a>
        <a style="position:absolute; top:240px; left:70px;">Género:</a>
        <a style="position:absolute; top:270px; left:70px;">Fecha de nacimiento:</a>
        <a style="position:absolute; top:310px; left:70px;">Usuario:</a>
        <a style="position:absolute; top:350px; left:70px;"></a>
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
<button type="submit" style="position:absolute; top:20px; left:400px;">Buscar</button>
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
