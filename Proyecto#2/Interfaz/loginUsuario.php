<?php
    /*
        Archivo encargado de iniciar la sesión de un usuario. Se realizan una serie
        de verificaciones previas, y se notifica al usuario si se logró o no (si no, su respectiva razón).
        Finalmente se muestra al usuario un botón que le permite ingresar a la página web.
    */
    include("conection.php");

	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

	//crea variables ligadas a la página anterior
    $usuario = $_POST['usuarioLogin'];
    $password = $_POST['contrasenaLogin'];
    $button = "<button type='submit' onClick='location.href=\"perfil/busquedaAvanzada.php\"'
    style='position:absolute; top:95px; left:570px;
    width:80px;'>Ingresar</button>";
    $msgIng = "<section id='error' style='position:absolute; top:170px; left:545px;'>
    <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Inicio de sesión con éxito!</a>
    </section>";
    $max_rep = 10;

    if($usuario != null and $password != null) {
        //verifica que se llenen todos los campos

        //Revisa si el usuario existe ********************************************************
        $check_user =  "SELECT COUNT(1) AS NUM_ROWS FROM usuario WHERE usuario=:usuario";
        $query_check_user = ociparse($conn, $check_user);
        ocibindbyname($query_check_user, ":usuario", $usuario);
        $rows = 0;
        oci_define_by_name($query_check_user, "NUM_ROWS", $rows);
        ociexecute($query_check_user);
        ocifetch($query_check_user);

        //**********************************************************************************
        if ($rows == 0) {
            //Ya existe el usuario
            echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**El usuario ". $usuario ." no existe.</a>
            </section>";

        } else {

            //notifica al usuario la conexión exitosa
            $getid = "begin :ced := pack_usuario.get_cedula(:usuario); end;";
            $query_getid = ociparse($conn, $getid);
            ocibindbyname($query_getid, ":usuario", $usuario);
            ocibindbyname($query_getid, ":ced", $cedula, 100);
            ociexecute($query_getid);

            $enabled = "begin :isEnabled := pack_usuario.getEstado(:cedula); end;";
            $query_isEnabled = ociparse($conn, $enabled);
            ocibindbyname($query_isEnabled, ":cedula", $cedula);
            ocibindbyname($query_isEnabled, ":isEnabled", $isEnabled, 100);
            ociexecute($query_isEnabled);

            //verifica si el usuario tiene permitido ingresar (no está baneado o
          if($isEnabled == 1 or $isEnabled == 2) {
                $canLogin = "begin :isValid := pack_usuario.confirmarPassword(:password, :usuario); end;";
                $query_canLogin = ociparse($conn, $canLogin);
                ocibindbyname($query_canLogin, ":password", $password);
                ocibindbyname($query_canLogin, ":usuario", $usuario);
                oci_bind_by_name($query_canLogin, ':isValid', $isValid, 100);
                ociexecute($query_canLogin);
                //verifica si la contraseña es correcta
                if($isValid) {
                    session_start(); //inicia la sesion
                    //crea variables de sesión
                    $_SESSION['usuario']= $usuario;
                    $_SESSION['password']= $password;
                    $_SESSION['cedula'] = $cedula;
                    echo $button . $msgIng;
                    OCICommit($conn);
                    ociLogOff($conn);
                } else {
                    //mensaje de advertencia
                    echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                    <a style='font-size:20px; color:#F00; font-size:16px;'>**Contraseña invalida.</a>
                    </section>";
                }
            } else if($isEnabled == -2) {
              //mensaje de advertencia
                echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                <a style='font-size:20px; color:#F00; font-size:16px;'>**El usuario " . $usuario . " se encuentra actualmente deshabilitado.</a>
                </section>";

            } else {
              //mensaje de advertencia
                echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                <a style='font-size:20px; color:#F00; font-size:16px;'>**El usuario " . $usuario . " se encuentra actualmente baneado.</a>
                </section>";

            }
        }

    } else {
        //mensaje de advertencia
        echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
        <a style='font-size:20px; color:#F00; font-size:16px;'>**Debe de llenar todos los espacios para ingresar.</a>
        </section>";

    }
?>
