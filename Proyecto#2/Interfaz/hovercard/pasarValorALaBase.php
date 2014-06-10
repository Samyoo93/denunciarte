

<?php
    include ("../conection.php");
    $conn =  OCILogon ($user,$pass,$db);
    session_start();


    $nota = $_POST["titulo"];
    echo "nota=". $nota;
    $descripcion =$_POST ["descripcion"];
    echo "descripcion=". $descripcion;
    $cedulaUsuario =  $_SESSION['cedula'];
    $id =  $_SESSION['id'];
    echo "cedulaUsuario=".$cedulaUsuario;
    $cedula = $_SESSION['cedulaTemporal'];
    echo "cedula=". $cedula;
    $calificacion = $_POST["estrellotas"];
    echo "calificacion=".$calificacion;

    //Para que una persona no se pueda calificar a ella misma
    if($cedulaUsuario != $cedula) {
        //El tipo de persona hace la diferencia a la hora de insertar en la tabla
        //Persona Juridica
        if ($_SESSION['tipoPersona'] == 'personaJuridica'){
            //Funcion que cuenta cuantas calificaciones se le ha hecho a una persona juridica
            $verSiPuedeOno = oci_parse ($conn,'BEGIN :result:=estrellas.has_ratedEntidad(:pcedulaUsuario,:pcedulaJuridica); END;');
            oci_bind_by_name ($verSiPuedeOno,':pcedulaUsuario',$cedulaUsuario);
            oci_bind_by_name ($verSiPuedeOno,':pcedulaJuridica',$cedula);
            oci_bind_by_name ($verSiPuedeOno, ':result',$cantidadReviews);
            oci_execute ($verSiPuedeOno);
            echo 'cantidadReviews:' . $cantidadReviews;
            //Revisa la cantidad obtenida y si no hay nada retorna cero
            if ($cantidadReviews == 0){

                $filename = $_FILES["imgfile"]["name"];
                if ((($_FILES["imgfile"]["type"] == "image/gif")
                       || ($_FILES["imgfile"]["type"] == "image/jpeg")
                        || ($_FILES["imgfile"]["type"] == "image/png")
                        || ($_FILES["imgfile"]["type"] == "image/pjpeg"))
                        || ($_FILES["imgfile"]["type"] == "application/pdf")
                        || ($_FILES["imgfile"]["type"] == "text/plain")
                        || ($_FILES["imgfile"]["type"] == "application/msword")
                        || ($_FILES["imgfile"]["type"] == "application/vnd.oasis.opendocument.text")
                        && ($_FILES["imgfile"]["size"] < 200000)) {
                    $random = rand(0,100);
                    move_uploaded_file($_FILES["imgfile"]["tmp_name"],
                                               "C:/xampp/htdocs/Github/Proyecto#2/Interfaz/UploadedImgs/".$random."$filename");
                    $cedulaReportador = $_SESSION['cedula'];

                    /*aqui se guarda en la base*/
                    $url = "C:/xampp/htdocs/Github/Proyecto#2/Interfaz/UploadedImgs/".$random."$filename";
                    $_SESSION['file'] = $url;

                    //Mete a la base la calificacion
                    $calificar = oci_parse ($conn,'begin estrellas.calificarEntidad(:pnota, :pdescripcion,:pcedulaUsuario_id, :pcalificacion, :pcedulaEntidad, :url); end;');
                    //Agrega el review
                    oci_bind_by_name( $calificar,':pnota',$nota);
                    oci_bind_by_name ($calificar,':pdescripcion',$descripcion);
                    oci_bind_by_name($calificar,':pcedulaUsuario_id',$cedulaUsuario);
                    oci_bind_by_name ($calificar,':pcalificacion',$calificacion);
                    oci_bind_by_name ($calificar,':pcedulaEntidad', $cedula);
                    oci_bind_by_name ($calificar,':url', $url);
                    oci_execute ($calificar);
                    //Es para cargar el id de la persona que seintento califica
                    $Message = 'Calificación con éxito.';

                } else { //Validacion del archivo de persona juridica
                    $Message = "Archivo inválido.";
                }

            }else{
                $Message = 'Ya califico anteriormente a esta persona jurídica.';
            }

        //Persona Fisica
        } else if ($_SESSION['tipoPersona'] == 'personaFisica'){

            //Funcion que cuenta cuantas calificaciones se le ha hecho a una persona fisica
            $verSiPuedeOno = oci_parse ($conn,'BEGIN :result :=estrellas.has_ratedPersonaFisica(:pcedulaUsuario,:pcedulaJuridica); END;');
            oci_bind_by_name ($verSiPuedeOno,':pcedulaUsuario',$cedulaUsuario);
            oci_bind_by_name ($verSiPuedeOno,':pcedulaJuridica',$cedula);
            oci_bind_by_name ($verSiPuedeOno, ':result',$cantidadReviews);
            oci_execute ($verSiPuedeOno);
            echo 'cantidadReviews:' . $cantidadReviews;
            //Revisa la cantidad obtenida y si no hay nada retorna cero
            if($cantidadReviews == 0) {

                $filename = $_FILES["imgfile"]["name"];
                if ((($_FILES["imgfile"]["type"] == "image/gif")
                       || ($_FILES["imgfile"]["type"] == "image/jpeg")
                        || ($_FILES["imgfile"]["type"] == "image/png")
                        || ($_FILES["imgfile"]["type"] == "image/pjpeg"))
                        || ($_FILES["imgfile"]["type"] == "application/pdf")
                        || ($_FILES["imgfile"]["type"] == "text/plain")
                        || ($_FILES["imgfile"]["type"] == "application/msword")
                        || ($_FILES["imgfile"]["type"] == "application/vnd.oasis.opendocument.text")
                        && ($_FILES["imgfile"]["size"] < 200000)) {
                    $random = rand(0,100);
                    move_uploaded_file($_FILES["imgfile"]["tmp_name"],
                                               "C:/xampp/htdocs/Github/Proyecto#2/Interfaz/UploadedImgs/".$random."$filename");
                    $cedulaReportador = $_SESSION['cedula'];

                    /*aqui se guarda en la base*/
                    $url = "C:/xampp/htdocs/Github/Proyecto#2/Interfaz/UploadedImgs/".$random."$filename";
                    $_SESSION['file'] = $url;

                    $calificar = oci_parse ($conn,'begin estrellas.calificarPersonaFisica (:pnota, :pdescripcion,:pcedulaUsuario_id, :pcalificacion, :pcedulaFisica, :url); end;');
                    oci_bind_by_name( $calificar,':pnota',$nota);
                    oci_bind_by_name ($calificar,':pdescripcion',$descripcion);
                    oci_bind_by_name($calificar,':pcedulaUsuario_id',$cedulaUsuario);
                    oci_bind_by_name ($calificar,':pcalificacion',$calificacion);
                    oci_bind_by_name ($calificar,':pcedulaFisica', $cedula);
                    oci_bind_by_name ($calificar,':url', $url);
                    oci_execute ($calificar);
                    //Es para cargar el id de la persona que seintento califica
                    $Message = 'Calificación con éxito.';

                } else { //Validacion del archivo de persona juridica
                    $Message = "Archivo inválido.";
                }
            } else { //Calificar dos veces a la persona juridica
                $Message = 'Ya califico anteriormente a esta persona física.';
            }

        }
    } else { //No calificarse a si mismo
        $Message = 'No se puede calificar a usted mismo.';
    }


    //Solo hace falta definirlo una vez en todo, porque se usan las mismas variables
    $linkRetorno = "Location: ../perfil/mostrarDatos.php?persona=". $_SESSION['tipoPersona'] . "&id=" . $_SESSION['id'] . '&Message=' . $Message;

    oci_close($conn);

    //El id es usado para que cuandose recargue mostrarDato pueda volver a cargar los datos actualizados
    header($linkRetorno);


?>
