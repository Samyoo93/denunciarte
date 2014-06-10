    <?php
	include("../conection.php");
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

    //crear variables ligadas a la pg con html

	$nombre = $_POST['nombre'];
	$primerApellido = $_POST['primerApellido'];
	$segundoApellido = $_POST['segundoApellido'];
	$genero = $_POST['genero'];
	$fechaNacimiento = $_POST['fecNac'];
    $cedula1 = $_POST["cedula1"];
	$cedula2 = $_POST["cedula2"];
	$cedula3 = $_POST["cedula3"];
    $cedula = $cedula1 . $cedula2 . $cedula3;
    $categoria = $_POST['categoria'];
    $existe_cat = 1;
    $categoria2 = $_POST['categoria2'];
    $descripcion = $_POST['descripcion'];
    $year = preg_replace("/[^0-9]/","-", $fechaNacimiento);
	$year = (string)$year;
	$year = substr($year, 0);
	$year = intval($year);



	if($nombre != null and $primerApellido != null and $segundoApellido != null and $fechaNacimiento != null
       and $cedula != null and (($categoria2 != null and $descripcion != null and $categoria == 'otra') or $categoria != '' and $categoria != 'otra')) {
        //verifica que se llenen todos los campos

            if(1899 < $year && $year < 2014) {
                if(is_numeric($cedula)) {


                $cedula = intval($cedula);
                //Revisa si la cedula existe*********************************************************************
                $check_ced =  "SELECT COUNT(1) AS NUM_ROWS FROM personafisica WHERE cedulafisica_id=:ced";
                $query_check_ced = ociparse($conn, $check_ced);
                ocibindbyname($query_check_ced, ":ced", $cedula);
                $rows = 0;
                oci_define_by_name($query_check_ced, "NUM_ROWS", $rows);
                ociexecute($query_check_ced);
                ocifetch($query_check_ced);

                //**********************************************************************************
                if ($rows > 0) {
                    echo "<section id='error' style='position:absolute; top:7px; left:90px;'>
                    <a style='font-size:20px; color:#F00; font-size:16px;'>**La cedula ".$cedula." ya se encuentra registrada.</a>
                    </section>";


                } else {

                    if($categoria == 'otra') {

                        $categoria = $categoria2;

                        $check_existe_cat = "SELECT COUNT(1) AS NUM_ROWS FROM categoria WHERE nombre=:categoria and tipo = 'F'";
                        $query_check_existe_cat = ociparse($conn, $check_existe_cat);
                        ocibindbyname($query_check_existe_cat, ":categoria", $categoria);
                        $existe_cat = 0;
                        oci_define_by_name($query_check_existe_cat, "NUM_ROWS", $existe_cat);
                        ociexecute($query_check_existe_cat);
                        ocifetch($query_check_existe_cat);

                        if($existe_cat == 0) {

                            //registra la nueva categoria
                            $createcat = "begin pack_categoria.set_categoria(:nombre, :descripcion, 'F'); end;";
                            $query_createcat = ociparse($conn, $createcat);
                            ocibindbyname($query_createcat, ":nombre", $categoria);
                            ocibindbyname($query_createcat, ":descripcion", $descripcion);
                            ociexecute($query_createcat);
                            $existe_cat = 1;

                        } else {
                            $existe_cat = -1;
                            echo "<section id='error' style='position:absolute; top:7px; left:90px;'>
                            <a style='font-size:20px; color:#F00; font-size:16px;'>**La categoria " . $categoria . " ya se encuentra registrada.</a>
                            </section>";

                        }
                    }
                    if($categoria != 'otra' and $existe_cat > 0) {
                        $puede = true;
                    } elseif($categoria == 'otra' and $existe_cat == 0) {
                        $puede = true;
                    } else {
                        $puede = false;
                    }

                    if($puede) {


                       //luego de validar todo agrega a la persona a la base de datos
                        $getnombre = "begin pack_persona.set_persona_fisica(:nombre, :primerApellido, :segundoApellido, :genero,
                        to_date(:fechaNacimiento, 'yyyy-mm-dd'), :cedula); end;";
                        $query_getnombre = ociparse($conn, $getnombre);
                        ocibindbyname($query_getnombre, ":nombre", $nombre);
                        ocibindbyname($query_getnombre, ":primerApellido", $primerApellido);
                        ocibindbyname($query_getnombre, ":segundoApellido", $segundoApellido);
                        ocibindbyname($query_getnombre, ":genero", $genero);
                        ocibindbyname($query_getnombre, ":fechaNacimiento", $fechaNacimiento);
                        ocibindbyname($query_getnombre, ":cedula", $cedula);
                        ociexecute($query_getnombre);


                         //registra la nueva categoria
                        $setcat = "begin pack_categoria_personaFisica.set_CatPerFis(pack_categoria.get_id(:categoria), :cedula); end;";
                        $query_setcat = ociparse($conn, $setcat);
                        ocibindbyname($query_setcat, ":categoria", $categoria);
                        ocibindbyname($query_setcat, ":cedula", $cedula);
                        ociexecute($query_setcat);
                        echo "<section id='error' style='position:absolute; top:7px; left:90px;'>
                        <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Persona creada exitosamente!</a>
                        </section>";

                    }

                }


            } else {
                //mensaje de error
                echo "<section id='error' style='position:absolute; top:7px; left:90px;'>
                <a style='font-size:20px; color:#F00; font-size:16px;'>**La cédula debe de ser un número.</a>
                </section>";
            }
        } else {
            //mensaje de error
            echo "<section id='error' style='position:absolute; top:7px; left:90px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**Año inválido .</a>
            </section>";
        }

    } else {
        //mensaje de error
        echo "<section id='error' style='position:absolute; top:7px; left:90px;'>
        <a style='font-size:20px; color:#F00; font-size:16px;'>**Debe de llenar los espacios.</a>
        </section>";

	}

?>
