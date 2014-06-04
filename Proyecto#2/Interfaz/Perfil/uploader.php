<?php
    include("../conection.php");
    $conn = OCILogon($user, $pass, $db);
    header('Location: mostrarDatos.php');
    $descripcion = $_POST['descripcion'];

     //EXISTE REPORTE i := pack_reporte.has_reported(cedulaReportado => , cedulaReportando => )

        if(isset($_REQUEST['submit'])) {
            $filename=  $_FILES["imgfile"]["name"];
            if ((($_FILES["imgfile"]["type"] == "image/gif")
                   || ($_FILES["imgfile"]["type"] == "image/jpeg")
                    || ($_FILES["imgfile"]["type"] == "image/png")
                    || ($_FILES["imgfile"]["type"] == "image/pjpeg"))
                    || ($_FILES["imgfile"]["type"] == "application/pdf")
                    || ($_FILES["imgfile"]["type"] == "text/plain")
                    || ($_FILES["imgfile"]["type"] == "application/msword")
                    || ($_FILES["imgfile"]["type"] == "application/vnd.oasis.opendocument.text")
                    && ($_FILES["imgfile"]["size"] < 200000)) {

                $random = rand(0,100);
                move_uploaded_file($_FILES["imgfile"]["tmp_name"],
                                           "C:/xampp/htdocs/Github/Proyecto#2/Interfaz/UploadedImgs/".$random."$filename");
                session_start();
                $cedulaReportador = 115870334;//$_SESSION['cedula'];

                /*aqui se guarda en la base*/
                $url = "C:/xampp/htdocs/Github/Proyecto#2/Interfaz/UploadedImgs/".$random."$filename";

                $setReporte = oci_parse($conn, "begin pack_reporte.set_reporte(:descripcion, :cedulaReportador, :urlFile); end;");
                oci_bind_by_name($setReporte,':descripcion',$descripcion);
                oci_bind_by_name($setReporte,':urlFile',$url);
                oci_bind_by_name($setReporte,':cedulaReportador', $cedulaReportador);
                oci_execute($setReporte);
                $cedulaReportado =  199384812;
                $setReporteUsuario = oci_parse($conn, "begin pack_reporte_usuario.set_reporte_usuario(:cedulaReportado); end;");
                oci_bind_by_name($setReporteUsuario,':cedulaReportado', $cedulaReportado);
                oci_execute($setReporteUsuario);

                echo "Archivo agregado con éxito";
            } else {
                echo "Archivo inválido.";
            }
        }


?>


