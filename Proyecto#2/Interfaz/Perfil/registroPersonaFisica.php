<?php
    /*
        Archivo encargado de registrar una nueva persona física, con su respectiva categoría, realizando las
        validaciones necesarias anteriormente.
    */
	include("../conection.php");
	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

    //crear variables ligadas a la página con html

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
    $lugar = $_POST['lugartrabajo'];
    $cargo = $_POST['cargo'];
    $existe_cat = 1;
    $categoria2 = $_POST['categoria2'];
    $descripcion = $_POST['descripcion'];
    $year = preg_replace("/[^0-9]/","-", $fechaNacimiento);
	$year = (string)$year;
	$year = substr($year, 0);
	$year = intval($year);

                        
	if($nombre != null and $primerApellido != null and $segundoApellido != null and $fechaNacimiento != null
       and $cedula != null and (($categoria2 != null and $descripcion != null and $categoria == 'otra') or $categoria != '' and $categoria != 'otra') and $lugar != null and $cargo != null) {
        //verifica que se llenen todos los campos

            if(1899 < $year && $year < 2014) {
                //año válido
                if(is_numeric($cedula)) {
                    //cédula numérica

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
                        //si elige agregar una categoría nueva, verifica que llene los campos correspondientes

                        $categoria = $categoria2;

                        $check_existe_cat = "SELECT COUNT(1) AS NUM_ROWS FROM categoria WHERE nombre=:categoria and tipo = 'F'";
                        $query_check_existe_cat = ociparse($conn, $check_existe_cat);
                        ocibindbyname($query_check_existe_cat, ":categoria", $categoria);
                        $existe_cat = 0;
                        oci_define_by_name($query_check_existe_cat, "NUM_ROWS", $existe_cat);
                        ociexecute($query_check_existe_cat);
                        ocifetch($query_check_existe_cat);

                        if($existe_cat == 0) {

                            //registra la nueva categoría
                            $createcat = "begin pack_categoria.set_categoria(:nombre, :descripcion, 'F'); end;";
                            $query_createcat = ociparse($conn, $createcat);
                            ocibindbyname($query_createcat, ":nombre", $categoria);
                            ocibindbyname($query_createcat, ":descripcion", $descripcion);
                            ociexecute($query_createcat);
                            $existe_cat = 1;

                        } else {
                            //mensaje de advertencia
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

                        //verifica si existe una persona física asociada a esa cédula
                        $check_PF =  "SELECT COUNT(1) AS NUM_ROWS FROM usuario WHERE cedulausuario_id = :cedula";
                        $query_check_PF = ociparse($conn, $check_PF);
                        oci_bind_by_name($query_check_PF, ":cedula", $cedula);
                        oci_define_by_name($query_check_PF, "NUM_ROWS", $rows);
                        ociexecute($query_check_PF);
                        ocifetch($query_check_PF);

                        if($rows == 0) {
                            
                           //luego de validar todo agrega a la persona a la base de datos
                            $setPerFis = "begin pack_persona.set_persona_fisica(:nombre, :primerApellido, :segundoApellido, :genero,
                            to_date(:fechaNacimiento, 'yyyy-mm-dd'), :cedula, :lugar, :cargo); end;";
                            $query_setPerFis = ociparse($conn, $setPerFis);
                            ocibindbyname($query_setPerFis, ":nombre", $nombre);
                            ocibindbyname($query_setPerFis, ":primerApellido", $primerApellido);
                            ocibindbyname($query_setPerFis, ":segundoApellido", $segundoApellido);
                            ocibindbyname($query_setPerFis, ":genero", $genero);
                            ocibindbyname($query_setPerFis, ":fechaNacimiento", $fechaNacimiento);
                            ocibindbyname($query_setPerFis, ":cedula", $cedula);
                            ocibindbyname($query_setPerFis, ":lugar", $cedula);
                            ocibindbyname($query_setPerFis, ":cargo", $cedula);
                            ociexecute($query_setPerFis);
                        } else {
                            $setPerFisByUser = "begin pack_personafisica.set_personaFisica_by_usuario(:cedula, :lugar, :cargo); end;";
                            $query_setPerFisByUser = ociparse($conn, $setPerFisByUser);
                            ocibindbyname($query_setPerFisByUser, ":cedula", $cedula);
                            ocibindbyname($query_setPerFisByUser, ":lugar", $lugar);
                            ocibindbyname($query_setPerFisByUser, ":cargo", $cargo);
                            ociexecute($query_setPerFisByUser);
                            echo "<section id='error' style='position:absolute; top:300px; left:460px;'>
                            <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Ya existe un usuario con                                esa cédula, se mantuvieron los datos anteriores y solo se agregó el lugar de trabajo                              y el cargo.</a>
                            </section>";
   

                        }
                         //registra la nueva categoria
                        $setcat = "begin pack_categoria_personaFisica.set_CatPerFis(pack_categoria.get_id(:categoria), :cedula); end;";
                        $query_setcat = ociparse($conn, $setcat);
                        ocibindbyname($query_setcat, ":categoria", $categoria);
                        ocibindbyname($query_setcat, ":cedula", $cedula);
                        ociexecute($query_setcat);
                        echo "<section id='error' style='position:absolute; top:7px; left:90px;'>
                        <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Persona creada exitosamente!</a>
                        </section>";
                        OCICommit($conn);
                        ociLogOff($conn);

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
