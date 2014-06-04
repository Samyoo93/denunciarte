

<?php
    include ("../conection.php");
    $conn =  OCILogon ($user,$pass,$db);
    session_start();

    $nota = $_POST["titulo"];
    $descripcion =$_POST ["descripcion"];
    $cedulaUsuario =  $_SESSION['cedula'];
    $cedula = $_SESSION['cedulaTemporal'];
    $calificacion = $_POST["estrellotas"];


    $calificar = oci_parse ($conn,'begin estrellas.calificarPersonaFisica (:pnota, :pdescripcion,:pcedulaUsuario_id, :pcalificacion, :pcedulaFisica); end;');
    oci_bind_by_name( $calificar,':pnota',$nota);
    oci_bind_by_name ($calificar,':pdescripcion',$descripcion);
    oci_bind_by_name($calificar,':pcedulaUsuario_id',$cedulaUsuario);
    oci_bind_by_name ($calificar,':pcalificacion',$calificacion);
    oci_bind_by_name ($calificar,':pcedulaFisica', $cedula);
    oci_execute ($calificar);
    oci_close($conn);


    //header("location:http://localhost/github/Proyecto%232/Interfaz/perfil/mostrarDatos.php");
?>

