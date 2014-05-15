<?php
    include("conection.php"); 
									  
	$conn = OCILogon($user, $pass, $db); 
	if (!$conn) {  
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

	//crea variables ligadas a la pg con html
    $nombre = 'Los patitos';//$_POST['nombre'];
    $pais = 'Costa Rica';//$_POST['pais'];
    $provincia = 'San Jose';// = $_POST['provincia'];
    $canton = 'Santa Ana';//= $_POST['canton'];
    $distrito = 'Santa Ana centro';//$_POST['distrito'];
    $barrio = 'Machete';//$_POST['barrio'];
    $direccionExacta = 'Del palo de mango 100 oeste al otro lado del chino';//$_POST['direccionExacta'];
    $cedJuridica = 12412;//$_POST['cedJuridica'];
    /*
    $cedJuridica1 = $_POST['cedJuridica1'];
    $cedJuridica2 = $_POST['cedJuridica2'];
    $cedJuridica3 = $_POST['cedJuridica3'];  
    $cedJuridica = $cedJuridica1 . $cedJuridica2 . $cedJuridica3;
    $cedJuridica = intval($cedJuridica);
    */
    $def = "ECHO DE TODO EL HTML IGNORAR POR AHORA";


    if ($barrio != null and $direccionExacta != null and $cedJuridica != null) {
        //revisa que los campos se llenen
        if(strlen($nombre) < 26 and strlen($cedJuridica) < 10 and strlen($direccionExacta) < 51) {
            //verifica que los cambos tengan un largo correcto
            
            //Revisa si la cedula juridica existe ********************************************************
            $check_ced =  "SELECT COUNT(*) AS NUM_ROWS FROM entidad WHERE cedulajuridica=:cedJuridica";
            $query_check_ced = ociparse($conn, $check_ced);
            ocibindbyname($query_check_ced, ":cedJuridica", $cedJuridica);
            $rows = 0;
            oci_define_by_name($query_check_ced, "NUM_ROWS", $rows);
            ociexecute($query_check_ced);
            ocifetch($query_check_ced);

            //**********************************************************************************
            if ($rows > 0) {
                echo "<section id='error' style='position:absolute; top:10px; left:350px; background-color:#ff3e3e;'>
                <a style='font-size:20px; color:#000;'>La cédula jurídica " . $cedJuridica . " ya se encuentra registrada.</a>
                </section>";
                echo $def;
            } else {
                
                //registra la nueva entidad
                $setentidad = "begin pack_entidad.set_entidad(:nombre, :cedJuridica); end;";
                $query_setentidad = ociparse($conn, $setentidad);
                ocibindbyname($query_setentidad, ":nombre", $nombre);
                ocibindbyname($query_setentidad, ":cedJuridica", $cedJuridica);
                ociexecute($query_setentidad);
                
                //registra la direccion de la entidad nueva
                $setdireccion = "begin pack_direccion_entidad.set_direccion_entidad(:direccionExacta, :barrio); end;";
                $query_setdireccion = ociparse($conn, $setdireccion);
                ocibindbyname($query_setdireccion, ":barrio", $barrio);
                ocibindbyname($query_setdireccion, ":direccionExacta", $direccionExacta);
                ociexecute($query_setdireccion);
            }
            
        } else {
            //mensaje de error
            echo "<section id='error' style='position:absolute; top:10px; left:350px; background-color:#ff3e3e;'>
            <a style='font-size:20px; color:#000;'>Debe de llenar los espacios.</a>
            </section>";
            echo $def;  
        }
    
    } else {
        //mensaje de error
        echo "<section id='error' style='position:absolute; top:10px; left:350px; background-color:#ff3e3e;'>
        <a style='font-size:20px; color:#000;'>Debe de llenar los espacios.</a>
        </section>";
        echo $def;  
    }
?>
