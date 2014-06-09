<?php

    include("../conection.php");
    $conn = OCILogon($user, $pass, $db);
    session_start();

    $descripcion = $_POST['descripcion'];

    $verSiPuedeOno = oci_parse ($conn,'BEGIN :result:= pack_reporte_usuario.count_reportes_usuario(:cedulaReportado,:cedulaUsuario); END;');
    oci_bind_by_name ($verSiPuedeOno,':cedulaReportado', $_SESSION['cedulaReportado']);
    oci_bind_by_name ($verSiPuedeOno,':cedulaUsuario', $_SESSION['cedula']);
    oci_bind_by_name ($verSiPuedeOno, ':result',$cantidadReviews);
    oci_execute ($verSiPuedeOno);
    echo 'cantidadReviews:' . $cantidadReviews;

    if($cantidadReviews == 0){
        $query_eliminarReviewE = ociparse($conn, "begin pack_reporte.set_reporte(:descripcion, :cedulaUsuario , :cedulaReportado); end;");
        ocibindbyname($query_eliminarReviewE, ":descripcion", $descripcion);
        ocibindbyname($query_eliminarReviewE, ":cedulaUsuario", $_SESSION['cedula']);
        ocibindbyname($query_eliminarReviewE, ":cedulaReportado", $_SESSION['cedulaReportado']);

        ociexecute($query_eliminarReviewE);

        $query_addBan = ociparse($conn, "begin pack_reporte.Banear(:cedula); end;");
        ocibindbyname($query_addBan, ":cedula", $_SESSION['cedulaReportado']);
        ociexecute($query_addBan);

        header('Location: mostrarUsuarios.php?cedula='. $_SESSION['cedulaReportado'] .'&privacidad='.$_SESSION['privacidad']);
    } else {
        $message = 'Ya ha reportado anteriormente a este usuario';
        header('Location: mostrarUsuarios.php?cedula='. $_SESSION['cedulaReportado'] .'&privacidad='.$_SESSION['privacidad'] .'&Message='. $message);

    }
    ociLogOff($conn);
?>
