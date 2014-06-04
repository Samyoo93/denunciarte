<?php
    include("conection.php");

	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

	//crea variables ligadas a la pg con html
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
        if(strlen($usuario) < 26 and strlen($password) < 16) {
            //verifica que los largos no se excedan

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
                //valida si el password es correcto, y si lo es conecta al usuario
                $canLogin = "begin :isValid := pack_usuario.confirmarPassword(:password, :usuario); end;";
                $query_canLogin = ociparse($conn, $canLogin);
                ocibindbyname($query_canLogin, ":password", $password);
                ocibindbyname($query_canLogin, ":usuario", $usuario);
                oci_bind_by_name($query_canLogin, ':isValid', $isValid, 100);
                ociexecute($query_canLogin);
                if ($isValid == 1) {
                    //notifica al usuario la conexión exitosa
                    $getid = "begin :ced := pack_usuario.get_cedula(:usuario); end;";
                    $query_getid = ociparse($conn, $getid);
                    ocibindbyname($query_getid, ":usuario", $usuario);
                    ocibindbyname($query_getid, ":ced", $cedula, 100);
                    ociexecute($query_getid);

                    $banned = "begin :isBanned := pack_usuario.getNumRep(cedula_in => :cedula, max_rep => :max_rep); end;";
                    $query_isBanned = ociparse($conn, $banned);
                    ocibindbyname($query_isBanned, ":max_rep",$max_rep);
                    ocibindbyname($query_isBanned, ":cedula", $cedula);
                    ocibindbyname($query_isBanned, ":isBanned",$isBanned, 100);
                    ociexecute($query_isBanned);
                    if($isBanned == 0) {
                        session_start(); //inicia la sesion
                        $_SESSION['usuario']= $usuario;
                        $_SESSION['password']= $password;
                        $_SESSION['cedula'] = $cedula;
                        echo $button . $msgIng;
                    } else {
                        echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                        <a style='font-size:20px; color:#F00; font-size:16px;'>**El usuario " . $usuario . " se encuentra actualmente baneado.</a>
                        </section>";

                    }

                } else {
                    //mensaje de error
                    echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                    <a style='font-size:20px; color:#F00; font-size:16px;'>**Contraseña invalida.</a>
                    </section>";

                }
            }
        } else {
            //mensaje de error
            echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**Máximo 25 caracteres para usuario y 15 para la contraseña.</a>
            </section>";

        }
    } else {
        //mensaje de error
        echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
        <a style='font-size:20px; color:#F00; font-size:16px;'>**Debe de llenar todos los espacios para ingresar.</a>
        </section>";

    }
?>
