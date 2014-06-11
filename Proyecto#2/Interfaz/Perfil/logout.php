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
