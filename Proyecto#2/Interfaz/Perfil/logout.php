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

    Nombre del archivo: logout.php
    Descripción: Se utiliza para desconectar la
    sesión que se encuentra activa.
-->

<?php
    /*
        Archivo utilizado para desconectarse de la sesión actual.
    */
    session_start();
    session_unset();
    session_destroy();
    $message = "Sesión cerrada con éxito.";
    header("Location: ../index.php?Message=".$message);
    OCICommit($conn);
    ociLogOff($conn);
?>
