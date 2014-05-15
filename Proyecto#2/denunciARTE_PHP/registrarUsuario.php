<?php
	include("conection.php"); 			  
	$conn = OCILogon($user2, $pass, $db); 
	if (!$conn) {  
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

    //crear variables ligadas a la pg con html

	$usuario = "fsa1";//$_POST['usuario'];
	$password = "123queso";//$_POST['password'];
    $password2 = "123queso";//$_POST['password2'];
	$nombre = "Franco";//$_POST['nombre'];
	$primerApellido = "Solis";//$_POST['primerApellido'];
	$segundoApellido = "Alvarado";//$_POST['segundoApellido'];
	$genero = "M";//$_POST['sexo'];
	$fechaNacimiento = '2010-10-10';// $_POST['fechaNacimiento'];
	$privacidad = 1;//$_POST['privacidad'];
    $cedula1 = 123;//$_POST["cedula1"]; 
	$cedula2 = 321;//$_POST["cedula2"];  
	$cedula3 = 1;//$_POST["cedula3"];  
    $cedula = $cedula1 . $cedula2 . $cedula3; 
    $cedula = intval($cedula);

    $def = "ECHO DE TODO EL HTML IGNORAR POR AHORA";

	if($usuario != null and $password != null and $nombre != null and $primerApellido != null and $segundoApellido != null
      and $fechaNacimiento != null and $privacidad != null and $cedula != null) {
        //verifica que se llenen todos los campos
        if(strlen($nombre) < 26 and strlen($primerApellido) < 26 and strlen($segundoApellido) < 26 and strlen($usuario) < 26) {
            //verifica que los campos tengan un largo permitido
            if(strlen($cedula) < 10 and strlen($password) < 16) {
                //largo permitido
                if($password == $password2) {
                    //passwords coincidan

                    //Revisa si el usuario existe ********************************************************
                    $check_user =  "SELECT COUNT(*) AS NUM_ROWS FROM usuario WHERE usuario=:usuario";
                    $query_check_user = ociparse($conn, $check_user);
                    ocibindbyname($query_check_user, ":usuario", $usuario);
                    $rows = 0;
                    oci_define_by_name($query_check_user, "NUM_ROWS", $rows);
                    ociexecute($query_check_user);
                    ocifetch($query_check_user);

                    //**********************************************************************************
                    if ($rows > 0) {
                        echo "<section id='error' style='position:absolute; top:10px; left:350px; background-color:#ff3e3e;'>
                        <a style='font-size:20px; color:#000;'>El usuario ".$usuario." ya se encuentra registrado.</a>
                        </section>";
                        echo $def;
                    } else {
                        //Revisa si la cedula existe*********************************************************************
                        $check_ced =  "SELECT COUNT(*) AS NUM_ROWS FROM usuario WHERE cedulausuario_id=:ced";
                        $query_check_ced = ociparse($conn, $check_ced);
                        ocibindbyname($query_check_ced, ":ced", $cedula);
                        $rows = 0;
                        oci_define_by_name($query_check_ced, "NUM_ROWS", $rows);
                        ociexecute($query_check_ced);
                        ocifetch($query_check_ced);

                        //**********************************************************************************
                        if ($rows > 0) {
                            echo "<section id='error' style='position:absolute; top:10px; left:350px; background-color:#ff3e3e;'>
                            <a style='font-size:20px; color:#000;'>La cedula ".$cedula." ya se encuentra registrada.</a>
                            </section>";
                            echo $def;
                        } else {
                            //luego de validar todo agrega a la persona a la base de datos
                            $getnombre = "begin pack_persona.set_persona(:nombre, :primerApellido, :segundoApellido, :genero, 
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
                        }
                    }
                } else {
                    //mensaje de error
                    echo "<section id='error' style='position:absolute; top:15px; left:300px; background-color:#ff3e3e;'>
                        <a style='font-size:20px; color:#000;'>Ambas contraseñas deben de coincidir.</a>
                        </section>";
                    echo $def;       
                }
            } else {
                //mensaje de error
                echo "<script> alert('El máximo de caracteres para cédula es de 9 y contraseña es de 15.') </script>";
            }
        } else {
            //mensaje de error
            echo "<script> alert('El máximo de caracteres para nombre, apellidos y usuario es de 25.') </script>";
        }
    } else {
        //mensaje de error
		echo "<section id='error' style='position:absolute; top:15px; left:300px; background-color:#ff3e3e;'>
				<a style='font-size:20px; color:#000;'>Llenar todos los espacios.</a>
				</section>";
		echo $def;
	}
		
?>
