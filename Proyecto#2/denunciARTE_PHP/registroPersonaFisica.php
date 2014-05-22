<?php
	include("conection.php"); 			  
	$conn = OCILogon($user, $pass, $db); 
	if (!$conn) {  
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}

    //crear variables ligadas a la pg con html

	$nombre = "Franco";//$_POST['nombre'];
	$primerApellido = "Solis";//$_POST['primerApellido'];
	$segundoApellido = "Alvarado";//$_POST['segundoApellido'];
	$genero = "M";//$_POST['sexo'];
	$fechaNacimiento = '2010-10-10';// $_POST['fechaNacimiento'];
    $cedula1 = 1535;//$_POST["cedula1"]; 
	$cedula2 = 34;//$_POST["cedula2"];  
	$cedula3 = 21;//$_POST["cedula3"];
    $cedula = $cedula1 . $cedula2 . $cedula3; 
    $categoria = 'otra';//$_POST['categoria'];
    $existe_cat = 1;

    

	if($nombre != null and $primerApellido != null and $segundoApellido != null
      and $fechaNacimiento != null and $cedula != null) {
        //verifica que se llenen todos los campos
        if(strlen($nombre) < 26 and strlen($primerApellido) < 26 and strlen($segundoApellido) < 26) {
            //verifica que los campos tengan un largo permitido
            if(is_numeric($cedula)) {
                if(strlen($cedula) < 10) {
                    //largo permitido

                    $cedula = intval($cedula);
                    //Revisa si la cedula existe*********************************************************************
                    $check_ced =  "SELECT COUNT(*) AS NUM_ROWS FROM personafisica WHERE cedulafisica_id=:ced";
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
                        
                    } else {
                      
                        if($categoria == 'otra') {
                            $categoria2 = 'categoriaNew';//$_POST['categoria2'];
                            $descripcion = 'DI esta';//$_POST['descripcion'];    
                            $categoria = $categoria2;

                            $check_existe_cat = "SELECT COUNT(*) AS NUM_ROWS FROM categoria WHERE nombre=:categoria and tipo = 'F'";
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
                                echo "<section id='error' style='position:absolute; top:170px; left:545px;'>
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
                            echo "entro al final";
                        }

                    }

                } else {
                    //mensaje de error
                    echo "<section id='error' style='position:absolute; top:15px; left:300px; background-color:#ff3e3e;'>
                    <a style='font-size:20px; color:#000;'>El máximo de caracteres para cédula es de 9 y contraseña es de 15.</a>
                    </section>";
                }
            } else {
                //mensaje de error
                echo "<section id='error' style='position:absolute; top:15px; left:300px; background-color:#ff3e3e;'>
                <a style='font-size:20px; color:#000;'>La cédula debe de ser un número.</a>
                </section>";

            }
        } else {
            //mensaje de error
            echo "<section id='error' style='position:absolute; top:15px; left:300px; background-color:#ff3e3e;'>
            <a style='font-size:20px; color:#000;'>El máximo de caracteres para nombre, apellidos y usuario es de 25.</a>
            </section>";
        }
    } else {
        //mensaje de error
        echo "<section id='error' style='position:absolute; top:15px; left:300px; background-color:#ff3e3e;'>
        <a style='font-size:20px; color:#000;'>Llenar todos los espacios.</a>
		</section>";
		
	}
		
?>
