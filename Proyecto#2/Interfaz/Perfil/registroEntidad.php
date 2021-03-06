<?php
    /*
        Archivo encargado de registrar una nueva entidad, con su respectiva categoría, realizando las
        validaciones necesarias anteriormente.
    */
    include("../conection.php");

	$conn = OCILogon($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}


	//crea variables ligadas a la página con html
    $nombre = $_POST['nombre'];
    $pais = $_POST['pais'];
    $provincia = $_POST['provincia'];
    $canton = $_POST['canton'];
    $distrito = $_POST['distrito'];
    $barrio = $_POST['barrio'];
    $direccionExacta = $_POST['direccionExacta'];
    $cedJuridica = $_POST['cedJuridica'];
    $categoria = $_POST['tipoCategoria'];
    $existe_cat = 1;


    $categoria2 = $_POST['categoria2'];
    $descripcion = $_POST['descripcion'];




    if ($barrio != null and $categoria != null and (($categoria2 != null and $descripcion != null and $categoria == 'otra') or $categoria != '' and $categoria != 'otra') and $direccionExacta != null and $cedJuridica != null) {
        //revisa que los campos se llenen

        if(is_numeric($cedJuridica)) {
            //cédula jurídica numérica

            //Revisa si la cédula jurídica existe ********************************************************
            $check_ced =  "SELECT COUNT(1) AS NUM_ROWS FROM entidad WHERE cedulajuridica=:cedJuridica";
            $query_check_ced = ociparse($conn, $check_ced);
            ocibindbyname($query_check_ced, ":cedJuridica", $cedJuridica);
            $rows = 0;
            oci_define_by_name($query_check_ced, "NUM_ROWS", $rows);
            ociexecute($query_check_ced);
            ocifetch($query_check_ced);

            //**********************************************************************************
            if ($rows > 0) {
                echo "<section id='error' style='position:absolute; top:140px; left:200px;'>
                <a style='font-size:20px; color:#F00; font-size:16px;'>**La cédula jurídica " . $cedJuridica . " ya se encuentra registrada.</a>
                </section>";

            } else {


                if($categoria == 'otra') {
                    //si elige agregar una categoría nueva, verifica que llene los campos correspondientes
                    $categoria = $categoria2;

                    $check_existe_cat = "SELECT COUNT(1) AS NUM_ROWS FROM categoria WHERE nombre=:categoria and tipo = 'E'";
                    $query_check_existe_cat = ociparse($conn, $check_existe_cat);
                    ocibindbyname($query_check_existe_cat, ":categoria", $categoria);
                    $existe_cat = 0;
                    oci_define_by_name($query_check_existe_cat, "NUM_ROWS", $existe_cat);
                    ociexecute($query_check_existe_cat);
                    ocifetch($query_check_existe_cat);

                    if($existe_cat == 0) {

                        //registra la nueva categoría
                        $createcat = "begin pack_categoria.set_categoria(:nombre, :descripcion, 'E'); end;";
                        $query_createcat = ociparse($conn, $createcat);
                        ocibindbyname($query_createcat, ":nombre", $categoria);
                        ocibindbyname($query_createcat, ":descripcion", $descripcion);
                        ociexecute($query_createcat);
                        $existe_cat = 1;

                    } else {
                        //mensaje de advertencia
                        $existe_cat = -1;
                        echo "<section id='error' style='position:absolute; top:140px; left:200px;'>
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


                    //registra la nueva entidad
                    $setentidad = "begin pack_entidad.set_entidad(:nombre, :cedJuridica); end;";
                    $query_setentidad = ociparse($conn, $setentidad);
                    ocibindbyname($query_setentidad, ":nombre", $nombre);
                    ocibindbyname($query_setentidad, ":cedJuridica", $cedJuridica);
                    ociexecute($query_setentidad);

                     //registra la nueva categoría
                    $setcat = "begin pack_categoria_entidad.set_categoria_entidad(pack_categoria.get_id(:categoria), :cedJuridica); end;";
                    $query_setcat = ociparse($conn, $setcat);
                    ocibindbyname($query_setcat, ":categoria", $categoria);
                    ocibindbyname($query_setcat, ":cedJuridica", $cedJuridica);
                    ociexecute($query_setcat);

                    //registra la dirección de la entidad nueva
                    $setdireccion = "begin pack_direccion_entidad.set_direccion_entidad(:direccionExacta, :barrio); end;";
                    $query_setdireccion = ociparse($conn, $setdireccion);
                    ocibindbyname($query_setdireccion, ":barrio", $barrio);
                    ocibindbyname($query_setdireccion, ":direccionExacta", $direccionExacta);
                    ociexecute($query_setdireccion);

                    echo "<section id='error' style='position:absolute; top:140px; left:200px;'>
                    <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Entidad creada exitosamente!</a>
                    </section>";
                    OCICommit($conn);
                    ociLogOff($conn);

                }
            }
        } else {
            //mensaje de advertencia
            echo "<section id='error' style='position:absolute; top:140px; left:200px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**La cédula debe de ser un número.</a>
            </section>";
        }


    } else {
        //mensaje de advertencia
        echo "<section id='error' style='position:absolute; top:140px; left:200px;'>
        <a style='font-size:20px; color:#F00; font-size:16px;'>**Debe de llenar los espacios.</a>
        </section>";

    }
?>
