<?php
    include("../conection.php");
	$conn = OCILogon($user, $pass, $db);

    session_start();
    $priv = $_POST['priv'];
    if($priv == 'publico') {
        $priv = 1;
        $privacidad = "público";
    } else {
        $priv = 0;
        $privacidad = "privado";
    }

    $modprivacidad = "begin pack_usuario.mod_privacidad(:cedula, :privacidad); end;";
    $query_modprivacidad = ociparse($conn, $modprivacidad);
    ocibindbyname($query_modprivacidad, ":cedula", $_SESSION['cedula']);
    ocibindbyname($query_modprivacidad, ":privacidad", $priv);

    ociexecute($query_modprivacidad);
    echo "<a style='position:absolute; top:280px; left:480px; color:#21A33A'>Su perfil se cambió exitosamente a $privacidad.</a>";

?>
