

<?php
    include ("../conection.php");
    $conn =  OCILogon ($user,$pass,$db);


    $n = $_POST["titulo"];
    $des =$_POST ["descripcion"];
    $usuario = 123;
    $cal = $_POST["estrellotas"];
    $cf = 123;

    $calificar = oci_parse ($conn,'call estrellas.calificarPersonaFisica (:pnota, :pdescripcion,:pcedulaUsuario_id,:pcalificacion, :pcedulaFisica)');
    oci_bind_by_name( $calificar,':pnota',$n);
    oci_bind_by_name ($calificar,':pdescripcion',$des);
    oci_bind_by_name ($calificar,':pcalificacion',$cal);
    oci_bind_by_name($calificar,':pcedulaUsuario_id',$usuario);
    oci_bind_by_name ($calificar,':pcedulaFisica', $cf);
    oci_execute ($calificar);
    oci_close($conn);

    // aqui se pone la funcion y el procedure de la base de datos.
    //$stid = oci_parse($conn, 'call DOREV(:c,:m,:cal)');
        //oci_bind_by_name($stid, ':c', $cod);
        //oci_bind_by_name($stid, ':m', $message);
        //oci_bind_by_name($stid, ':cal', $calificacion);


    //oci_execute($stid);
    //oci_close($conn);
    header("location: http://localhost/github/Proyecto#2/Interfaz/Perfil/mostrarDatos.php");
?>

