<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--
    INSTITUTO TECNOLÓGICO DE COSTA RICA
    BASES DE DATOS I
    I SEMESTRE 2014
    II PROYECTO

    DENUNCIARTE

    ESTUDIANTES
    KATHY BRENES GUERRERO.
    BARNUM CASTILLO BARQUERO.
    FRANCO SOLÍS ALVARADO.
    SAM YOO.

    Nombre del archivo: entidad.php
    Descripción: Posee todos los elementos de la interfaz necesarios para
    crear una nueva entidad en el sistema.
-->
<head>
    <?php
        session_start();
        if (!isset($_SESSION['usuario'])) {
        $Message = 'Sesión no iniciada.';
        header('Location: ../index.php?Message=' . urlencode($Message));        }
    ?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>DenunciARTE</title>
    <link rel="stylesheet" href="../Estilo/Estilo.css" />
    <link href="../Imagenes/favicon.ico" type="image/x-icon" rel="shortcut icon" />
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

<body style="width:700px;" onload="Abrir_ventana('http://URL/ejemplo-popup.html')">

<!-- Menú vertical -->
<section id="CuadroGris" style="position:absolute; top:150px; left:700px; width:270px; height:180px;">
    <button type="submit" style="position:absolute; top:20px;left:30px; font-size:18px; width:200px;" >
    Actualizar</button>
    <button type="submit" style="position:absolute; top:70px; left:30px; font-size:18px; width:200px;"><a href="#openRate" style="color: #CFCFCF;
        font: small-caps 100%/200% serif;
        background-color:#914998;
        font-size: 16px;">Calificar</a></button>
    <button type="submit" style="position:absolute; top:120px;left:30px; font-size:18px; width:200px;" >
    <a href="#openReport" style="color: #CFCFCF;
        font: small-caps 100%/200% serif;
        background-color:#914998;
        font-size: 16px;">Reportar</a>
    </button>
    <div id="openReport" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h2>Reportar a esta persona</h2>
            <p style="position:absolute; top:70px;">Si desea reportar a NOMBRE DE ENTIDAD, indique el motivo por el cual desea reportarlo.</p>
            <p style="position:absolute; top:130px;">Motivo</p>
            <textarea style="position:absolute; top:150px; left: 150px; width:350px; height:150px;"></textarea>
            <button type="submit" style="position:absolute; top: 320px; left:150px; width:100px;">Reportar</button>
        </div>
    </div>

    <div id="openRate" class="modalDialog">
        <div>
            <a href="#close" title="Close" class="close">X</a>
            <h2>Calificar a esta persona</h2>
            <p style="position:absolute; top:70px;">Si desea calificar a NOMBRE DE ENTIDAD, rellene los siguientes campos:</p>
            <p style="position:absolute; top:130px;">Título</p>
            <input type="text" style="position:absolute; top:150px; left: 150px; width:200px;"></input>
            <p style="position:absolute; top:160px;">Descripción</p>
            <textarea type="text" style="position:absolute; top:180px; left: 150px;width:300px; height:100px;">
            </textarea>
            <p style="position:absolute; top:280px;">Calificación</p>
            <div class='rateit' data-rateit-max='10' data-rateit-readonly='true' data-rateit-       value="2" style="position:absolute; top:300px; left:150px;"></div>

            <button type="submit" style="position:absolute; top: 350px; left:150px; width:100px;">Calificar</button>
        </div>
    </div>
</section>
<section style="position:absolute; left:20px; top:100px; width:630px; height:400px;">
    <div id="mostrar" style="overflow-y:scroll;">
        <h1 style="position:absolute; left:150px;"> Nombre: </h1>
        <a style="position:absolute; top:150px; left:70px;">Cédula Jurídica:</a>
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


<!-- EMPIEZAN LAS ESTRELLAS -->
 <?php
        $pcedulaFisica = 123; //aqui se pone la cedulafisica que se necesita hacer el review;
        $hola = oci_parse($conn,"begin :result:= estrellas.get_sumaCaliPersonaFisica(:pcedulaFisica);end;");
        oci_bind_by_name ($hola,':pcedulaFisica',$pcedulaFisica);
        oci_bind_by_name($hola,':result',$result2,20);
        oci_execute($hola);


        $total1 = oci_parse ($conn,"begin :result:=estrellas.get_totalUsuarioDePF(:pcedulaFisica); end;");
        oci_bind_by_name ($total1,':pcedulaFisica',$pcedulaFisica);
        oci_bind_by_name($total1,':result',$result1,20);
        oci_execute($total1);
        if ($result1 == 0){
            $rating = 0;

        }else{
            $rating = $result2/$result1;
        }


        echo " <div class='rateit' data-rateit-max='10'  data-rateit-readonly='true' data-rateit-value=".$rating."></div>";
    ?>
            <!--para cambiar el relleno de las estrellas-->

    </a>


</div>


<div class="review">
    <div>
        <?php

        $total1 = oci_parse ($conn,"begin :result:=estrellas.get_totalUsuarioDePF(:pcedulaFisica); end;");
        oci_bind_by_name($total1,'pcedulaFisica',$pcedulaFisica);
        oci_bind_by_name($total1,':result',$result1,20);
        oci_execute($total1);
        if ($result1 == 0){
            $rating =  0;
        }else{
            $rating = $result2/$result1;
        }


        echo "<div class='left'>";
        echo   " <h1>".round($rating)."</h1>";
        echo   " <p>avg of<span>".$result1."</span>ratings";
        echo   " <p>";
        echo "</div>";

        ?>


        <div class="right">
            <table>

            <?php

                for ($i = 1; $i<=10; $i++){
                    $count = oci_parse ($conn,"begin :result:=estrellas.get_countPersonaFisica(:c, :pcedulaFisica); end;");
                    oci_bind_by_name($count,':c',$i);
                    oci_bind_by_name($count,':pcedulaFisica',$pcedulaFisica);
                    oci_bind_by_name($count,':result',$resultado,20);


                    oci_execute($count);
                    $total = oci_parse ($conn,"begin :result:=estrellas.get_totalUsuarioDePF(:pcedulaFisica); end;");
                    oci_bind_by_name ($total,':pcedulaFisica',$pcedulaFisica);
                    oci_bind_by_name($total,':result',$resultado3,20);
                    oci_execute($total);

                    if ($resultado3 == 0){
                        $porcentaje = 0;
                    }else{
                        $porcentaje = ($resultado/$resultado3)*100;
                    }


                    echo "<tr>";
                     echo "<td> ",$i,"★","   </td>";
                     echo     "<td>";
                    echo           "<svg width='100' height='10'>";
                    echo"        <rect x='0' y='0' width=".$porcentaje." height='10' fill='#914998' rx='10' ry='20' stroke-width='8'/>";
                    echo "</svg>";
                    echo "</td>";
                    echo "<td>",$resultado,"</td>";
                echo "</tr>" ;


                }
            ?>


            </table>

        </div>
    </div>
</div>

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
            <li style="font-size:16px; width:150px;"><a href="agregarAdmin.php">Administrador</a></li>
          </ul>
         </li>
            <li style="width:60px; height:60px;"><img src="../Imagenes/flechafinal.png" style="position:absolute; top:40px;" />
                <ul>
                    <li style="font-size:16px; width:150px;"><a href="crearEntidad.php">Crear una entidad</a></li>
                    <li style="font-size:16px; width:150px;"><a href="crearPersonaFisica.php">Crear una persona</a></li>
                    <li style="font-size:16px; width:150px;"><a href="logout.php">Cerrar sesión</a></li>
                    <li style="font-size:16px; width:150px;"><a href="https://sites.google.com/site/denunciarte2014/" target='_blank'>Ayuda</a></li>
                </ul>
          </li>
            <li>
        </ul>
        </nav>
    </section>
</section>

</body>
</html>
