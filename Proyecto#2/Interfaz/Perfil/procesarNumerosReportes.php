
<?php

    include("../conection.php");
    $conn = OCILogon($user, $pass, $db);
    if (!$conn) {
        echo "Invalid conection" . var_dump (OCIError());
        die();
    }

    $resultado = $_POST['resultadoReporte'];

    if (is_numeric($resultado)){
        echo "<section id='error' style='position:absolute; width:2000px;top:120px;'>
        <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Número de reporte agregado.</a>
        </section>";

        $resultadoReport = oci_parse ($conn, "BEGIN updateMaxNumReportes(:pnumeroMax); END;");
        oci_bind_by_name ($resultadoReport, ':pnumeroMax',$resultado);
        oci_execute ($resultadoReport);


    } else if ($resultado == null) {
        echo "<section id='error' style='position:absolute; width:2000px;top:120px;'>
        <a style='font-size:20px; color:#F00; font-size:16px;'>**No puede ser campo nulo.</a>
        </section>";
    } else {
        echo "<section id='error' style='position:absolute; width:2000px;top:120px;'>
        <a style='font-size:20px; color:#F00; font-size:16px;'>**El campo debe ser numérico.</a>
        </section>";

    }

?>


