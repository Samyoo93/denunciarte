<?php
    include("conection.php"); 
									  
	$conn = OCILogon($user, $pass, $db); 
	if (!$conn) {  
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}
	//crea variables ligadas a la pg con html
    $usuario = "fsa1";//$_POST['usuario'];
    $password = "123queso";//$_POST['password'];
    $def = "ECHO DE TODO EL HTML IGNORAR POR AHORA";

    if($usuario != null and $password != null) {
        //verifica que se llenen todos los campos
        if(strlen($usuario) < 26 and strlen($password) < 16) {
            //verifica que los largos no se excedan
            
            //Revisa si el usuario existe ********************************************************
            $check_user =  "SELECT COUNT(*) AS NUM_ROWS FROM usuario WHERE usuario=:usuario";
            $query_check_user = ociparse($conn, $check_user);
            ocibindbyname($query_check_user, ":usuario", $usuario);
            $rows = 0;
            oci_define_by_name($query_check_user, "NUM_ROWS", $rows);
            ociexecute($query_check_user);
            ocifetch($query_check_user);

            //**********************************************************************************
            if ($rows == 0) {
                //Ya existe el usuario
               echo "<section id='error' style='position:absolute; top:10px; left:350px; background-color:#ff3e3e;'>
               <a style='font-size:20px; color:#000;'>El usuario ". $usuario ." no existe.</a>
               </section>";
               echo $def;
            } else {
                //valida si el password es correcto, y si lo es conecta al usuario
                $canLogin = "begin :isValid := pack_usuario.confirmarPassword(:password, :usuario); end;";
                $query_canLogin = ociparse($conn, $canLogin);
                ocibindbyname($query_canLogin, ":password", $password);
                ocibindbyname($query_canLogin, ":usuario", $usuario);
                oci_bind_by_name($query_canLogin, ':isValid', $isValid, 100);
                ociexecute($query_canLogin);
                if ($isValid == 1) {
                    //notifica al usuario la conexión exitosa
                    echo "<section id='success' style='position:absolute; top:15px; left:370px; background-color:#6ae364;'>
                    <a style='font-size:20px; color:#000;'>Login con exito.</a>
                    </section>";
                    echo $def;
                } else {
                    //mensaje de error
                    echo "<section id='error' style='position:absolute; top:10px; left:350px; background-color:#ff3e3e;'>
                    <a style='font-size:20px; color:#000;'>Contraseña invalida.</a>
                    </section>";
                    echo $def;    
                }
            }
        } else {
            //mensaje de error
            echo "<script> alert('Máximo 25 caracteres para usuario y 15 para la contraseña.') </script>";
        
        }
    } else {
        //mensaje de error
        echo "<section id='error' style='position:absolute; top:10px; left:350px; background-color:#ff3e3e;'>
        <a style='font-size:20px; color:#000;'>Debe de llenar los espacios.</a>
        </section>";
        echo $def;        
    }
?>