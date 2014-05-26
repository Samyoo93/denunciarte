<?php

	include("../conection.php");
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}


    session_start();
    $cedula = 152346325;//$_SESSION['cedula'];

    //crear variables ligadas a la pg con html

	$password = $_POST['contrasena'];
	$nombre =$_POST['nombre'];
	$primerApellido = $_POST['primerApellido'];
	$segundoApellido = $_POST['segundoApellido'];
	$genero = $_POST['genero'];
	$fechaNacimiento = $_POST['fecNac'];
    $year = preg_replace("/[^0-9]/","", $fechaNacimiento);
	$year = (string)$year;
	$year = substr($year, 0, 4);
	$year = intval($year);
    $privacidad = 1; //$_POST['privacidad'];

	if($password != null and $nombre != null and $primerApellido != null and $segundoApellido != null
      and $fechaNacimiento != null and $privacidad != null) {
        //verifica que se llenen todos los campos
        if(strlen($nombre) < 26 and strlen($primerApellido) < 26 and strlen($segundoApellido) < 26) {
            //verifica que los campos tengan un largo permitido
            if(strlen($password) < 16) {
                //largo permitido

                //passwords coincidan
                if(1899 < $year && $year < 2014) {


                    //luego de validar todo modifica los datos en la base de datos
                    $modpersona = "begin pack_persona.mod_persona(:cedula, :nombre, :primerApellido,
                    :segundoApellido, :genero, to_date(:fechaNacimiento, 'yyyy-mm-dd'), 1); end;";
                    $query_modpersona = ociparse($conn, $modpersona);
                    ocibindbyname($query_modpersona, ":nombre", $nombre);
                    ocibindbyname($query_modpersona, ":primerApellido", $primerApellido);
                    ocibindbyname($query_modpersona, ":segundoApellido", $segundoApellido);
                    ocibindbyname($query_modpersona, ":genero", $genero);
                    ocibindbyname($query_modpersona, ":fechaNacimiento", $fechaNacimiento);
                    ocibindbyname($query_modpersona, ":cedula", $cedula);
                    ociexecute($query_modpersona);

                    $modusuario = "begin pack_usuario.mod_usuario(:cedula, :password, :privacidad); end;";
                    $query_modusuario = ociparse($conn, $modusuario);
                    ocibindbyname($query_modpersona, ":cedula", $cedula);
                    ocibindbyname($query_modpersona, ":password", $password);
                    ocibindbyname($query_modpersona, ":privacidad", $privacidad);



                } else {

                    echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
                        <a style='font-size:20px; color:#F00; font-size:16px;'>**Año inválido .</a>
                        </section>";

                }

            } else {
                //mensaje de error
                echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
                     <a style='font-size:20px; color:#F00; font-size:16px;'>**El máximo de caracteres para contraseña es de 15.</a>
                     </section>";
            }
        } else {
            //mensaje de error
            echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**El máximo de caracteres para nombre y apellidos es de 25.</a>
            </section>";
        }
    } else {
        //mensaje de error
		echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**Llene todos los espacios.</a>
            </section>";

	}

?>