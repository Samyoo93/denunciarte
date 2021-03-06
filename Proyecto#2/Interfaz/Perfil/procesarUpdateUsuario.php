<?php
    /*
        Archivo encargado de procesar la modificación del perfil del usuario.
    */
	include("../conection.php");
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

    session_start();
    $cedula = $_SESSION['cedula'];

    //crear variables ligadas a la página con html

	$password = $_POST['contrasena'];
	$nombre =$_POST['nombre'];
	$primerApellido = $_POST['primerApellido'];
	$segundoApellido = $_POST['segundoApellido'];
	$fechaNacimiento = $_POST['fecNac'];
    $year = preg_replace("/[^0-9]/","-", $fechaNacimiento);
	$year = (string)$year;
	$year = substr($year, 0);
	$year = intval($year);
    $priv = $_POST['priv'];
    if($priv == 'public') {
        $priv = 1;
        $privacidad = "público";
    } else {
        $priv = 0;
        $privacidad = "privado";
    }

	if($password != null and $nombre != null and $primerApellido != null and $segundoApellido != null
      and $fechaNacimiento != null and $privacidad != null) {
        //verifica que se llenen todos los campos


        if(1899 < $year && $year < 2014) {
            //año válido

            //luego de validar todo modifica los datos en la base de datos
            $modpersona = "begin pack_persona.mod_persona(:cedula, :nombre, :primerApellido,
            :segundoApellido, to_date(:fechaNacimiento, 'yyyy-mm-dd'), 1); end;";
            $query_modpersona = ociparse($conn, $modpersona);
            ocibindbyname($query_modpersona, ":nombre", $nombre);
            ocibindbyname($query_modpersona, ":primerApellido", $primerApellido);
            ocibindbyname($query_modpersona, ":segundoApellido", $segundoApellido);
            ocibindbyname($query_modpersona, ":fechaNacimiento", $fechaNacimiento);
            ocibindbyname($query_modpersona, ":cedula", $cedula);
            ociexecute($query_modpersona);

            $modusuario = "begin pack_usuario.mod_usuario(:cedula, :password); end;";
            $query_modusuario = ociparse($conn, $modusuario);
            ocibindbyname($query_modusuario, ":cedula", $cedula);
            ocibindbyname($query_modusuario, ":password", $password);
            ociexecute($query_modusuario);

            $modprivacidad = "begin pack_usuario.mod_privacidad(:cedula, :privacidad); end;";
            $query_modprivacidad = ociparse($conn, $modprivacidad);
            ocibindbyname($query_modprivacidad, ":cedula", $cedula);
            ocibindbyname($query_modprivacidad, ":privacidad", $priv);
            ociexecute($query_modprivacidad);
            OCICommit($conn);
            ociLogOff($conn);

            echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
            <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Usuario creado con éxito .</a>
            </section>";
        } else {
            //mensaje de advertencia
            echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
                <a style='font-size:20px; color:#F00; font-size:16px;'>**Año inválido .</a>
                </section>";
        }

    } else {
        //mensaje de advertencia
		echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**Llene todos los espacios.</a>
            </section>";

	}


?>
