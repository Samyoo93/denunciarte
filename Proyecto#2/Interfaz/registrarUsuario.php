<?php
    /*
        Archivo encargado de registrar un nuevo usuario dentro de la base de datos. Se realizan una serie
        de verificaciones previas, y se notifica al usuario si se logró o no (si no, su respectiva razón).
        Finalmente se muestra al usuario un botón que le permite ingresar a la página web.
    */

    include("conection.php");
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}
    //Variables traidas desde la página anterior
	$usuario = $_POST['usuario'];
	$password = $_POST['contrasena'];
    $password2 = $_POST['contrasena2'];
	$nombre =$_POST['nombre'];
	$primerApellido = $_POST['primerApellido'];
	$segundoApellido = $_POST['segundoApellido'];
	$genero = $_POST['genero'];
	$fechaNacimiento = $_POST['fecNac'];
	$privacidad = 1;
    $estado = 1;
    $year = preg_replace("/[^0-9]/","-", $fechaNacimiento);
	$year = (string)$year;
	$year = substr($year, 0);
	$year = intval($year);
    $cedula1 = $_POST["cedula1"];
	$cedula2 = $_POST["cedula2"];
	$cedula3 = $_POST["cedula3"];
    $cedula = $cedula1 . $cedula2 . $cedula3;
    $checka = $_POST['checka'];
    //html del botón y mensaje de creación
    $button = "<button type='submit' onClick='location.href=\"perfil/busquedaAvanzada.php\"'
               style='position:absolute; top:730px; left:770px;
               width:200px;'>Ingresar</button>";
    $msgIng = "<section id='error' style='position:absolute; top:705px; left:770px;'>
                <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Registro exitoso!</a>
                </section>";


    if($checka == 1) {
        //se aceptaron los términos y condiciones
        if($usuario != null and $password != null and $nombre != null and $primerApellido != null and $segundoApellido != null
          and $fechaNacimiento != null and $privacidad != null and $cedula != null) {
            //verifica que se llenen todos los campos

            if(is_numeric($cedula)) {
                //la cédula es un número
                $cedula = intval($cedula); //convierte la cédula a número

                if($password == $password2) {
                    //passwords coincidan
                    if(1899 < $year && $year < 2014) {
                        //año válido
                        //Revisa si el usuario existe ********************************************************
                        $check_user =  "SELECT COUNT(1) AS NUM_ROWS FROM usuario WHERE usuario=:usuario";
                        $query_check_user = ociparse($conn, $check_user);
                        oci_bind_by_name($query_check_user, ":usuario", $usuario);
                        $rows = 0;
                        oci_define_by_name($query_check_user, "NUM_ROWS", $rows);
                        ociexecute($query_check_user);
                        ocifetch($query_check_user);

                        //**********************************************************************************
                        if ($rows > 0) {
                            echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                            <a style='font-size:20px; color:#F00; font-size:16px;'>**El usuario ".$usuario." ya se encuentra registrado.</a>
                            </section>";

                        } else {
                            //Revisa si la cedula existe*********************************************************************
                            $check_ced =  "SELECT COUNT(1) AS NUM_ROWS FROM usuario WHERE cedulausuario_id=:ced";
                            $query_check_ced = ociparse($conn, $check_ced);
                            oci_bind_by_name($query_check_ced, ":ced", $cedula);
                            $rows = 0;
                            oci_define_by_name($query_check_ced, "NUM_ROWS", $rows);
                            ociexecute($query_check_ced);
                            ocifetch($query_check_ced);

                            //**********************************************************************************
                            if ($rows > 0) {
                                echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                                <a style='font-size:20px; color:#F00; font-size:16px;'>**La cedula ".$cedula." ya se encuentra registrada.</a>
                                </section>";

                            } else {
                                //verifica si existe una persona física asociada a esa cédula
                                $check_PF =  "SELECT COUNT(1) AS NUM_ROWS FROM personafisica WHERE cedulafisica_id = :cedula";
                                $query_check_PF = ociparse($conn, $check_PF);
                                oci_bind_by_name($query_check_PF, ":cedula", $cedula);

                                oci_define_by_name($query_check_PF, "NUM_ROWS", $rows);
                                ociexecute($query_check_PF);
                                ocifetch($query_check_PF);

                                if($rows == 0) {
                                    //luego de validar todo agrega a la persona a la base de datos
                                    $setpersona = "begin pack_persona.set_persona_usuario(:nombre, :primerApellido, :segundoApellido, :genero,
                                    to_date(:fechaNacimiento, 'yyyy-mm-dd'),
                                    :usuario, :password, :cedula, :estado); end;";
                                    $query_setpersona = ociparse($conn, $setpersona);
                                    oci_bind_by_name($query_setpersona, ":nombre", $nombre);
                                    oci_bind_by_name($query_setpersona, ":primerApellido", $primerApellido);
                                    oci_bind_by_name($query_setpersona, ":segundoApellido", $segundoApellido);
                                    oci_bind_by_name($query_setpersona, ":genero", $genero);
                                    oci_bind_by_name($query_setpersona, ":fechaNacimiento", $fechaNacimiento);
                                    oci_bind_by_name($query_setpersona, ":usuario", $usuario);
                                    oci_bind_by_name($query_setpersona, ":password", $password);
                                    oci_bind_by_name($query_setpersona, ":cedula", $cedula);
                                    oci_bind_by_name($query_setpersona, ":estado", $estado);
                                    ociexecute($query_setpersona);
                                    session_start(); //inicia la sesion
                                    $_SESSION['usuario']= $usuario;
                                    $_SESSION['password']= $password;
                                    $getid = "begin :ced := pack_usuario.get_cedula(:usuario); end;";
                                    $query_getid = ociparse($conn, $getid);
                                    oci_bind_by_name($query_getid, ":usuario", $usuario);
                                    oci_bind_by_name($query_getid, ":ced", $ced, 100);
                                    ociexecute($query_getid);

                                    $_SESSION['cedula'] = $ced;

                                } else {
                                    //si existe una persona física, los conecta
                                    $insertarByPF = " begin pack_usuario.set_usuario_by_personafisica(:cedula, :usuario, :password, :privacidad); end;";
                                    $query_insertarByPF = ociparse($conn, $insertarByPF);
                                    oci_bind_by_name($query_insertarByPF, ":cedula", $cedula);
                                    oci_bind_by_name($query_insertarByPF, ":usuario", $usuario);
                                    oci_bind_by_name($query_insertarByPF, ":password", $password);
                                    oci_bind_by_name($query_insertarByPF, ":privacidad", $privacidad);
                                    ociexecute($query_insertarByPF);

                                }
                                echo $button;
                                echo $msgIng;
                                OCICommit($conn);
                                ociLogOff($conn);
                            }
                        }
                    } else {
                        //mensaje de advertencia
                        echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                            <a style='font-size:20px; color:#F00; font-size:16px;'>**Año inválido .</a>
                            </section>";
                    }
                } else {
                    //mensaje de advertencia

                    echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                            <a style='font-size:20px; color:#F00; font-size:16px;'>**Ambas contraseñas deben de coincidir.</a>
                            </section>";

                }
            } else {
                //mensaje de advertencia
                echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                <a style='font-size:20px; color:#F00; font-size:16px;'>**La cédula debe de ser un número.</a>
                </section>";
            }

        } else {
            //mensaje de error
            echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                <a style='font-size:20px; color:#F00; font-size:16px;'>**Llene todos los espacios.</a>
                </section>";
        }
    } else {
        //mensaje de advertencia
        echo "<section id='error' style='position:absolute; top:660px; left:545px;'>
                <a style='font-size:20px; color:#F00; font-size:16px;'>**Debe de aceptar los terminos y condiciones de uso.</a>
                </section>";
    }


?>
