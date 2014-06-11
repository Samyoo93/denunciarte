<?php
    /*
        Archivo encargado de ya sea, volver un usuario un nuevo administrador, o crear el usuario desde cero.
        Cuenta con una serie de validaciones.
    */
    include("../conection.php");
        $conn = OCILogon($user, $pass, $db);
        if (!$conn) {
            echo "Invalid conection" . var_dump (OCIError());
            die();
        }

        $cedula1 = $_POST["cedula1"];
        $cedula2 = $_POST["cedula2"];
        $cedula3 = $_POST["cedula3"];
        $cedula = $cedula1 . $cedula2 . $cedula3;
        $n = $_POST['n'];
        $noExiste = "";
        $div = "<a style='position:absolute; top:20px; left:60px;'>Nombre</a>
                        <input type='text' id='nombre' placeholder='Nombre' style='position:absolute; top: 20px; left:130px; width:80px;' maxlength='25' />
                        <input type='text' id='primerApellido' placeholder='PrimerApellido' style='position:absolute; top: 20px; left:220px; width:100px;' maxlength='25' />
                        <input type='text' id='segundoApellido' placeholder='SegundoApellido' style='position:absolute; top: 20px; left:330px; width:100px;' maxlength='25' />
                        <a style='position:absolute; top:60px; left:60px;'>Usuario</a>
                        <a style='position:absolute; top:80px; left:60px;'>(Nombre que lo identificará al realizar un comentario.)</a>
                        <input type='text' id='usuario' placeholder='Álias para reportes' align='center' style='position:absolute; top: 130px; left:130px; width:300px;' maxlength='25' />
                        <a style='position:absolute; top:160px; left:60px;'>Contraseña</a>
                        <input type='password' id='contrasena'  placeholder='De 1-15 carácteres.'style='position:absolute; top: 180px; left:130px; width:300px;' maxlength='15' />
                        <a style='position:absolute; top:210px; left:60px;'>Fecha de nacimiento</a>
                        <input type='date' id='fecNac'style='position:absolute; top: 230px; left:130px; width:300px;' />
                    <a style='position: absolute; left: 60px; top: 260px;'>Género</a>
                        <input type = 'radio' name = 'genero' id = 'F' value = 'F' checked = 'checked' style='position:absolute; top:280px; left:140px;'>
                        <a for = 'Femenino' style='position:absolute; top:280px; left:160px;'>Femenino</a>

                        <input type = 'radio' name = 'genero' id = 'M' value = 'M' style='position:absolute; top:280px; left:250px;'>
                        <a for = 'Masculino' style='position:absolute; top:280px; left:270px;'>Masculino</a>
        <button type='submit' onClick='agregarAdmin(2)' id='add2' style='position:absolute; top:180px; left:450px; width:100px; '>Agregar</button>";
        if($cedula != 0) {
            //espacio diferente de vacío.
            if(is_numeric($cedula)) {
                //cédula numérica
                $existeCedula = "begin :user := pack_usuario.get_usuario(:cedula); end;";
                $queryExisteCedula = ociparse($conn, $existeCedula);
                ocibindbyname($queryExisteCedula, ":cedula", $cedula);
                ocibindbyname($queryExisteCedula, ":user", $user, 100);
                ociexecute($queryExisteCedula);
                if($cedula != 0) {
                    //cédula existente
                    if ($user != "") {
                        //existe un usuario con esa cédula
                        $makeAdmin = "begin pack_usuario.makeAdmin(:cedula); end;";
                        $queryMakeAdmin = ociparse($conn, $makeAdmin);
                        ocibindbyname($queryMakeAdmin, ":cedula", $cedula);
                        ociexecute($queryMakeAdmin);

                        echo "<section id='error' style='position:absolute; width:2000px;top:-20px; left:100px;'>
                        <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Administrador agregado con éxito.</a>
                        </section>";
                        echo $div;


                    } else if($user == "" and $n == 2) {
                        //no existe usuario

                        $usuario = $_POST['usuario'];
                        $password = $_POST['contrasena'];
                        $nombre =$_POST['nombre'];
                        $primerApellido = $_POST['primerApellido'];
                        $segundoApellido = $_POST['segundoApellido'];
                        $genero = $_POST['genero'];
                        $fechaNacimiento = $_POST['fecNac'];
                        $year = preg_replace("/[^0-9]/","-", $fechaNacimiento);
                        $year = (string)$year;
                        $year = substr($year, 0);
                        $year = intval($year);
                        $estado = 2;
                        if($usuario != null and $password != null and $nombre != null and $primerApellido != null and $segundoApellido != null
                        and $fechaNacimiento != null) {
                            //llenar los espacios
                            if(1899 < $year and $year < 2014) {
                                //año valido

                                //**********************existe usuario************************************
                                $check_user =  "SELECT COUNT(1) AS NUM_ROWS FROM usuario WHERE usuario=:usuario";
                                $query_check_user = ociparse($conn, $check_user);
                                oci_bind_by_name($query_check_user, ":usuario", $usuario);
                                $rows = 0;
                                oci_define_by_name($query_check_user, "NUM_ROWS", $rows);
                                ociexecute($query_check_user);
                                ocifetch($query_check_user);

                                //**********************************************************************************
                                if ($rows > 0) {
                                    echo "<section id='error' style='position:absolute; width:2000px;top:-20px; left:100px;'>
                                    <a style='font-size:20px; color:#F00; font-size:16px;'>**El usuario ".$usuario." ya se encuentra registrado.</a>
                                    </section>";
                                    echo $div;

                                } else {
                                    $cedula = intval($cedula);
                                    $setpersona = "begin pack_persona.set_persona_usuario(:nombre, :primerApellido, :segundoApellido, :genero,
                                    to_date(:fechaNacimiento, 'yyyy-mm-dd'),
                                    :usuario, :password, :cedula, :estado); end;";
                                    $query_setpersona = ociparse($conn, $setpersona);
                                    oci_bind_by_name($query_setpersona, ":nombre", $nombre);
                                    oci_bind_by_name($query_setpersona, ":primerApellido", $primerApellido);
                                    oci_bind_by_name($query_setpersona, ":segundoApellido", $segundoApellido);
                                    oci_bind_by_name($query_setpersona, ":genero", $genero);
                                    oci_bind_by_name($query_setpersona, ":fechaNacimiento", $fechaNacimiento);
                                    oci_bind_by_name($query_setpersona, ":usuario", $usuario);
                                    oci_bind_by_name($query_setpersona, ":password", $password);
                                    oci_bind_by_name($query_setpersona, ":cedula", $cedula);
                                    oci_bind_by_name($query_setpersona, ":estado", $estado);
                                    ociexecute($query_setpersona);
                                    echo "<section id='error' style='position:absolute; width:2000px;top:-20px; left:100px;'>
                                    <a style='font-size:20px; color:#21A33A; font-size:16px;'>**Administrador agregado con éxito.</a>
                                    </section>";
                                    $makeAdmin = "begin pack_usuario.makeAdmin(:cedula); end;";
                                    $queryMakeAdmin = ociparse($conn, $makeAdmin);
                                    ocibindbyname($queryMakeAdmin, ":cedula", $cedula);
                                    ociexecute($queryMakeAdmin);
                                    echo $div;
                                    OCICommit($conn);
                                    ociLogOff($conn);

                                }

                           } else {
                                //mensaje de advertencia
                                echo "<section id='error' style='position:absolute; width:2000px;top:-20px; left:100px;'>
                                    <a style='font-size:20px; color:#F00; font-size:16px;'>**Año invalido.</a>
                                    </section>";
                                echo $div;
                           }
                        } else {
                            //mensaje de advertencia
                            echo "<section id='error' style='position:absolute; width:2000px;top:-20px; left:100px;'>
                            <a style='font-size:20px; color:#F00; font-size:16px;'>**Llene todos los espacios.</a>
                            </section>";
                            echo $div;
                        }
                    } else {
                        //mensaje de advertencia
                        echo "<section id='error' style='position:absolute; width:2000px;top:-20px; left:100px;'>
                            <a style='font-size:20px; color:#F00; font-size:16px;'>**No existe usuario con cédula " .$cedula. ", si desea puede registrarlo.</a>
                            </section>";
                        echo $div;
                    }


                } else {
                    //mensaje de advertencia
                    echo "<section id='error' style='position:absolute; width:2000px;top:-20px; left:100px;'>
                            <a style='font-size:20px; color:#F00; font-size:16px;'>**Llene todos los espacios.</a>
                    </section>";
                    echo $div;
                }
            } else {
                //mensaje de advertencia
                echo "<section id='error' style='position:absolute; width:2000px;top:-20px; left:100px;'>
                    <a style='font-size:20px; color:#F00; font-size:16px;'>**La cédula debe ser un número.</a>
                    </section>";
                echo $div;
            }
        } else {
            //mensaje de advertencia
            echo "<section id='error' style='position:absolute; width:2000px;top:-20px; left:100px;'>
            <a style='font-size:20px; color:#F00; font-size:16px;'>**Llenar el espacio de cédula.</a>
            </section>";
            echo $div;
        }


?>
