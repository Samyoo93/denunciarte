<?php
    /*
        Archivo encargado de reportar usuarios, realizando todas las validaciones necesarias anteriormente.
    */
    include("../conection.php");
    $conn = OCILogon($user, $pass, $db);
    session_start();

    $descripcion = $_POST['descripcion'];

    //verifica si puede o no realizar el reporte
    $verSiPuedeOno = oci_parse ($conn,'BEGIN :result:= pack_reporte_usuario.count_reportes_usuario(:cedulaReportado,:cedulaUsuario); END;');
    oci_bind_by_name ($verSiPuedeOno,':cedulaReportado', $_SESSION['cedulaReportado']);
    oci_bind_by_name ($verSiPuedeOno,':cedulaUsuario', $_SESSION['cedula']);
    oci_bind_by_name ($verSiPuedeOno, ':result',$cantidadReviews);
    oci_execute ($verSiPuedeOno);
    echo 'cantidadReviews:' . $cantidadReviews;

    //si no ha hecho reportes a éste usuario, lo hace
    if($cantidadReviews == 0){
        $query_eliminarReviewE = ociparse($conn, "begin pack_reporte.set_reporte(:descripcion, :cedulaUsuario , :cedulaReportado); end;");
        ocibindbyname($query_eliminarReviewE, ":descripcion", $descripcion);
        ocibindbyname($query_eliminarReviewE, ":cedulaUsuario", $_SESSION['cedula']);
        ocibindbyname($query_eliminarReviewE, ":cedulaReportado", $_SESSION['cedulaReportado']);

        ociexecute($query_eliminarReviewE);

        $query_addBan = ociparse($conn, "begin pack_reporte.Banear(:cedula); end;");
        ocibindbyname($query_addBan, ":cedula", $_SESSION['cedulaReportado']);
        ociexecute($query_addBan);

        $message = 'Reporte hecho con exito.';

    } else if($_SESSION['cedulaReportado'] == $_SESSION['cedula']) {
        //verificación que no puede reportarse a si mismo
        $message = 'No puede reportar a su propio usuario.';
    } else {
        //verificación que no puede reportar a un usuario anteriormente reportado
        $message = 'Ya ha reportado anteriormente a este usuario';
    }


    header('Location: mostrarUsuarios.php?cedula='. $_SESSION['cedulaReportado'] .'&privacidad='.$_SESSION['privacidad'] .'&Message='. $message);
    OCICommit($conn);
    ociLogOff($conn);
?>
