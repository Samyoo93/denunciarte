<?php

	include("../conection.php");
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}


    session_start();
    $cedulaJuridica = 243234;//$_SESSION['cedula'];

    //crear variables ligadas a la pg con html

	$nombre =$_POST['nombre'];
	$pais = $_POST['pais'];
	$provincia = $_POST['provincia'];
	$canton = $_POST['canton'];
    $distrito = $_POST['distrito'];
    $barrio = $_POST['barrio'];
    $exacta = $_POST['exacta'];

	if ($barrio != null and $exacta != null and $cedulaJuridica != null) {
        //verifica que se llenen todos los campos
        if(strlen($nombre) < 26 and strlen($cedulaJuridica) < 10 and strlen($exacta) < 51) {            //verifica que los campos tengan un largo permitido


            //passwords coincidan

            //luego de validar todo modifica los datos en la base de datos
            $modentidad = "begin pack_entidad.mod_entidad(nombre_in => :nombre, cedulaJuridica_in => :cedulaJuridica); end;";
            $query_modentidad = ociparse($conn, $modentidad);
            ocibindbyname($query_modentidad, ":nombre", $nombre);
            ocibindbyname($query_modentidad, ":cedulaJuridica", $cedulaJuridica);
            ociexecute($query_modentidad);

            $mod_direccion = "begin pack_direccion_entidad.mod_direccion_entidad(:exacta, :barrio, :nombre); end;";
            $query_mod_direccion = ociparse($conn, $mod_direccion);
            ocibindbyname($query_mod_direccion, ":nombre", $nombre);
            ocibindbyname($query_mod_direccion, ":exacta", $exacta);
            ocibindbyname($query_mod_direccion, ":barrio", $barrio);
            ociexecute($query_mod_direccion);
            echo "END";

        } else {
            //mensaje de error
            echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**El máximo de caracteres para nombre es de 25.</a>
            </section>";
        }
    } else {
        //mensaje de error
		echo "<section id='error' style='position:absolute; top:130px; left:420px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**Llene todos los espacios.</a>
            </section>";

	}

?>
