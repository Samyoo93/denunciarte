<?php
    /*
        Archivo encargado de deshabilitar una cuenta por completo.
    */
    include("../conection.php");
    session_start();

    echo $_SESSION['usuario'];
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

    //query de deshabilitar perfil
    $delete = "begin pack_usuario.del_usuario(122223424); end;";
    $query_delete = ociparse($conn, $delete);
    //ocibindbyname($query_delete, ":cedula", $_SESSION['cedula']);
    ociexecute($query_delete);
    session_unset();
    session_destroy();
    $message = "Cuenta deshabilitada exitosamente.";
    ocicommit();
    ocilogoff();
    header('Location: ../index.php?Message='. $message);
?>
