<?php

	include("../conection.php");
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}


    session_start();
    $cedula = 552125123;//$_SESSION['cedula'];

    //crear variables ligadas a la pg con html

	$nombre =$_POST['nombre'];
	$primerApellido = $_POST['primerApellido'];
	$segundoApellido = $_POST['segundoApellido'];
	$genero = $_POST['genero'];
	$fechaNacimiento = $_POST['fecNac'];
    $year = preg_replace("/[^0-9]/","", $fechaNacimiento);
	$year = (string)$year;
	$year = substr($year, 0, 4);
	$year = intval($year);
    $lugartrabajo = $_POST['trabajo'];
    $cargo = $_POST['cargo'];

	if($nombre != null and $primerApellido != null and $segundoApellido != null
      and $fechaNacimiento != null and $lugartrabajo != null and $cargo != null) {
        //verifica que se llenen todos los campos
        if(strlen($nombre) < 26 and strlen($primerApellido) < 26 and strlen($segundoApellido) < 26) {
            //verifica que los campos tengan un largo permitido
            if(strlen($lugartrabajo) < 50 and strlen($cargo) < 50) {
                //largo permitido

                //passwords coincidan
                if(1899 < $year && $year < 2014) {


                    //luego de validar todo modifica los datos en la base de datos
                    $modpersona = "begin pack_persona.mod_persona(:cedula, :nombre, :primerApellido,
                    :segundoApellido, :genero, to_date(:fechaNacimiento, 'yyyy-mm-dd'), 2); end;";
                    $query_modpersona = ociparse($conn, $modpersona);
                    ocibindbyname($query_modpersona, ":nombre", $nombre);
                    ocibindbyname($query_modpersona, ":primerApellido", $primerApellido);
                    ocibindbyname($query_modpersona, ":segundoApellido", $segundoApellido);
                    ocibindbyname($query_modpersona, ":genero", $genero);
                    ocibindbyname($query_modpersona, ":fechaNacimiento", $fechaNacimiento);
                    ocibindbyname($query_modpersona, ":cedula", $cedula);
                    ociexecute($query_modpersona);

                    $modusuario = "begin pack_personafisica.mod_perfis(ced_id => :cedula, cargo_in => :cargo ,lugar_in => :lugartrabajo); end;";
                    $query_modusuario = ociparse($conn, $modusuario);
                    ocibindbyname($query_modusuario, ":cedula", $cedula);
                    ocibindbyname($query_modusuario, ":cargo", $cargo);
                    ocibindbyname($query_modusuario, ":lugartrabajo", $lugartrabajo);

                    ociexecute($query_modusuario);


                } else {

                    echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
                        <a style='font-size:20px; color:#F00; font-size:16px;'>**Año inválido .</a>
                        </section>";
                }

            } else {
                //mensaje de error
                echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
                     <a style='font-size:20px; color:#F00; font-size:16px;'>**El máximo de caracteres es 15 para contraseña, 50 para lugar de trabajo                        y 50 para cargo.</a>
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
