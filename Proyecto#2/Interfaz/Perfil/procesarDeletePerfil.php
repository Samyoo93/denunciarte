<?php

    include("../conection.php");
    session_start();

    echo $_SESSION['usuario'];
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

    $delete = "begin pack_usuario.del_usuario(:cedula); end;";
    $query_delete = ociparse($conn, $delete);
    ocibindbyname($query_delete, ":cedula", $_SESSION['cedula']);
    ociexecute($query_delete);
    session_unset();
    session_destroy();
?>
