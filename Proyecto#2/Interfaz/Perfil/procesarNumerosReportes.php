<?php
    /*
        Archivo encargado de modificar el parámetro de número de reportes máximo en la base de datos, proporcionado por
        un administrador.
    */
    include("../conection.php");
    $conn = OCILogon($user, $pass, $db);
    if (!$conn) {
        echo "Invalid conection" . var_dump (OCIError());
        die();
    }

    $resultado = $_POST['resultadoReporte'];

    if (is_numeric($resultado) && $resultado > 0){
        //verifica que sea un número positivo
        echo "<section id='error' style='position:absolute; width:2000px;top:120px;'>
        <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Número de reporte agregado.</a>
        </section>";

        $resultadoReport = oci_parse ($conn, "BEGIN updateMaxNumReportes(:pnumeroMax); END;");
        oci_bind_by_name ($resultadoReport, ':pnumeroMax',$resultado);
        oci_execute ($resultadoReport);
        OCICommit($conn);
        ociLogOff($conn);


    } else if ($resultado == null) {
        //mensaje de advertencia
        echo "<section id='error' style='position:absolute; width:2000px;top:120px;'>
        <a style='font-size:20px; color:#F00; font-size:16px;'>**No puede ser campo nulo.</a>
        </section>";
    } else {
        //mensaje de advertencia
        echo "<section id='error' style='position:absolute; width:2000px;top:120px;'>
        <a style='font-size:20px; color:#F00; font-size:16px;'>**El campo debe ser un número positivo.</a>
        </section>";

    }

?>


