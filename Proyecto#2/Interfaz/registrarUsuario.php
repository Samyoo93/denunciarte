<?php
	include("conection.php");
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

    //crear variables ligadas a la pg con html



	$usuario = $_POST['usuario'];
	$password = $_POST['contrasena'];
    $password2 = $_POST['contrasena2'];
	$nombre =$_POST['nombre'];
	$primerApellido = $_POST['primerApellido'];
	$segundoApellido = $_POST['segundoApellido'];
	$genero = $_POST['genero'];
	$fechaNacimiento = $_POST['fecNac'];
	$privacidad = 1;
    $year = preg_replace("/[^0-9]/","", $fechaNacimiento);
	$year = (string)$year;
	$year = substr($year, 0, 4);
	$year = intval($year);
    $cedula1 = $_POST["cedula1"];
	$cedula2 = $_POST["cedula2"];
	$cedula3 = $_POST["cedula3"];
    $cedula = $cedula1 . $cedula2 . $cedula3;
    $cedula = intval($cedula);
    $checka = $_POST['checka'];
    $button = "<button type='submit' onClick='location.href=\"perfil/busquedaAvanzada.php\"'
               style='position:absolute; top:730px; left:770px;
               width:200px;'>Ingresar</button>";
    $msgIng = "<section id='error' style='position:absolute; top:705px; left:770px;'>
                <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Registro exitoso!</a>
                </section>";

    $existeEnPF = "SELECT COUNT(1) AS NUM_ROWS FROM personafisica WHERE cedulafisica_id=:cedula";
    $query_existeEnPF = ociparse($conn, $existeEnPF);
    $rows = 0;
    oci_define_by_name($query_check_user, "NUM_ROWS", $rows);
    ocibindbyname($conn, ":cedula", $cedula);
    ociexecute($query_existeEnPF);

    if($rows == 0) {
        if($checka == 1) {
            if($usuario != null and $password != null and $nombre != null and $primerApellido != null and $segundoApellido != null
              and $fechaNacimiento != null and $privacidad != null and $cedula != null) {
                //verifica que se llenen todos los campos
                if(strlen($nombre) < 26 and strlen($primerApellido) < 26 and strlen($segundoApellido) < 26 and strlen($usuario) < 26) {
                    //verifica que los campos tengan un largo permitido
                    if(strlen($cedula) < 10 and strlen($password) < 16) {
                        //largo permitido
                        if($password == $password2) {
                            //passwords coincidan
                            if(1899 < $year && $year < 2014) {
                                //Revisa si el usuario existe ********************************************************
                                $check_user =  "SELECT COUNT(1) AS NUM_ROWS FROM usuario WHERE usuario=:usuario";
                                $query_check_user = ociparse($conn, $check_user);
                                ocibindbyname($query_check_user, ":usuario", $usuario);
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
                                    ocibindbyname($query_check_ced, ":ced", $cedula);
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

                                        //print 'window.location.href="RegistroUsuarios.php";</script>';
                                        //location.reload();
                                        //luego de validar todo agrega a la persona a la base de datos
                                        $getnombre = "begin pack_persona.set_persona_usuario(:nombre, :primerApellido, :segundoApellido, :genero,
                                        to_date(:fechaNacimiento, 'yyyy-mm-dd'),
                                        :usuario, :password, :cedula, :privacidad); end;";
                                        $query_getnombre = ociparse($conn, $getnombre);
                                        ocibindbyname($query_getnombre, ":nombre", $nombre);
                                        ocibindbyname($query_getnombre, ":primerApellido", $primerApellido);
                                        ocibindbyname($query_getnombre, ":segundoApellido", $segundoApellido);
                                        ocibindbyname($query_getnombre, ":genero", $genero);
                                        ocibindbyname($query_getnombre, ":fechaNacimiento", $fechaNacimiento);
                                        ocibindbyname($query_getnombre, ":usuario", $usuario);
                                        ocibindbyname($query_getnombre, ":password", $password);
                                        ocibindbyname($query_getnombre, ":cedula", $cedula);
                                        ocibindbyname($query_getnombre, ":privacidad", $privacidad);
                                        ociexecute($query_getnombre);
                                        session_start(); //inicia la sesion
                                        $_SESSION['usuario']= $usuario;
                                        $_SESSION['password']= $password;
                                        $getid = "begin :ced := pack_usuario.get_cedula(:usuario); end;";
                                        $query_getid = ociparse($conn, $getid);
                                        ocibindbyname($query_getid, ":usuario", $usuario);
                                        ocibindbyname($query_getid, ":ced", $ced, 100);
                                        ociexecute($query_getid);

                                        $_SESSION['cedula'] = $ced;
                                        echo $button;
                                        echo $msgIng;
                                        OCICommit($conn);

                                    }
                                }
                            } else {

                                echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                                    <a style='font-size:20px; color:#F00; font-size:16px;'>**Año inválido .</a>
                                    </section>";

                            }
                        } else {
                            //mensaje de error

                            echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                                    <a style='font-size:20px; color:#F00; font-size:16px;'>**Ambas contraseñas deben de coincidir.</a>
                                    </section>";

                        }
                    } else {
                        //mensaje de error
                        echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                        <a style='font-size:20px; color:#F00; font-size:16px;'>**El máximo de caracteres para cédula es de 9 y contraseña es de 15.</a>
                        </section>";
                    }
                } else {
                    //mensaje de error
                    echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                    <a style='font-size:20px; color:#F00; font-size:16px;'>**El máximo de caracteres para nombre, apellidos y usuario es de 25.</a>
                    </section>";
                }
            } else {
                //mensaje de error
                echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
                    <a style='font-size:20px; color:#F00; font-size:16px;'>**Llene todos los espacios.</a>
                    </section>";
            }
        } else {
            echo "<section id='error' style='position:absolute; top:660px; left:545px;'>
                    <a style='font-size:20px; color:#F00; font-size:16px;'>**Debe de aceptar los terminos y condiciones de uso.</a>
                    </section>";
        }
    } else {
        $insertarByPF = " begin pack_usuario.set_usuario_by_personafisica(:cedula, :usuario, :password, :privacidad, 1); end;";
        $query_insertarByPF = ociparse($conn, $insertarByPF);
        ocibindbyname($query_insertarByPF, ":cedula", $cedula);
        ocibindbyname($query_insertarByPF, ":usuario", $usuario);
        ocibindbyname($query_insertarByPF, ":password", $password);
        ocibindbyname($query_insertarByPF, ":privacidad", $privacidad);

    }
    OCILogOff($conn);
?>
