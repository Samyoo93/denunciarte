

<?php
    include ("../conection.php");
    $conn =  OCILogon ($user,$pass,$db);
    session_start();

    $url = "url";

    $nota = $_POST["titulo"];
    echo "nota=". $nota;
    $descripcion =$_POST ["descripcion"];
    echo "descripcion=". $descripcion;
    $cedulaUsuario =  $_SESSION['cedula'];
    echo "cedulaUsuario=".$cedulaUsuario;
    $cedula = $_SESSION['cedulaTemporal'];
    echo "cedula=". $cedula;
    $calificacion = $_POST["estrellotas"];
    echo "calificacion=".$calificacion;

    //ara que una persona no se pueda calificar a ella misma
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
                $calificar = oci_parse ($conn,'begin estrellas.calificarEntidad (:pnota, :pdescripcion,:pcedulaUsuario_id, :pcalificacion, :pcedulaEntidad, :url); end;');
                //Agrega el review
                oci_bind_by_name( $calificar,':pnota',$nota);
                oci_bind_by_name ($calificar,':pdescripcion',$descripcion);
                oci_bind_by_name($calificar,':pcedulaUsuario_id',$cedulaUsuario);
                oci_bind_by_name ($calificar,':pcalificacion',$calificacion);
                oci_bind_by_name ($calificar,':pcedulaEntidad', $cedula);
                oci_bind_by_name ($calificar,':url', $url);
                oci_execute ($calificar);

            }else{
                echo 'Ya calificó a esta persona anteriormente';
            }

        //Persona Fisica
        }else if ($_SESSION['tipoPersona'] == 'personaFisica'){

            //Funcion que cuenta cuantas calificaciones se le ha hecho a una persona fisica
            $verSiPuedeOno = oci_parse ($conn,'BEGIN :result :=estrellas.has_ratedPersonaFisica(:pcedulaUsuario,:pcedulaJuridica); END;');
            oci_bind_by_name ($verSiPuedeOno,':pcedulaUsuario',$cedulaUsuario);
            oci_bind_by_name ($verSiPuedeOno,':pcedulaJuridica',$cedula);
            oci_bind_by_name ($verSiPuedeOno, ':result',$cantidadReviews);
            oci_bind_by_name ($verSiPuedeOno, ':result',$cantidadReviews);
            oci_execute ($verSiPuedeOno);
            echo 'cantidadReviews:' . $cantidadReviews;
            //Revisa la cantidad obtenida y si no hay nada retorna cero
            if($cantidadReviews == 0){

                $calificar = oci_parse ($conn,'begin estrellas.calificarPersonaFisica (:pnota, :pdescripcion,:pcedulaUsuario_id, :pcalificacion, :pcedulaFisica, :url); end;');
                oci_bind_by_name( $calificar,':pnota',$nota);
                oci_bind_by_name ($calificar,':pdescripcion',$descripcion);
                oci_bind_by_name($calificar,':pcedulaUsuario_id',$cedulaUsuario);
                oci_bind_by_name ($calificar,':pcalificacion',$calificacion);
                oci_bind_by_name ($calificar,':pcedulaFisica', $cedula);
                oci_bind_by_name ($calificar,':url', $url);
                oci_execute ($calificar);

            } else {
                echo 'Ya calificó a esta persona anteriormente';
            }

        }
    }
    //Es para cargar el id de la persona que seintento califica
    if($_SESSION['tipoPersona'] == 'personaFisica') {
        $query_getid = ociparse($conn, "begin :personaId := pack_personaFisica.get_personaId(:cedula); end;");
        ocibindbyname($query_getid, ":cedula", $cedula);
        ocibindbyname($query_getid, ":personaId", $personaId, 100);
        ociexecute($query_getid);
        $linkRetorno = "location:http://localhost/github/Proyecto%232/Interfaz/perfil/mostrarDatos.php?persona=". $_SESSION['tipoPersona'] . "&id=". $personaId;

    } else if($_SESSION['tipoPersona'] == 'personaJuridica'){
        $query_getid = ociparse($conn, "begin :personaId := pack_entidad.get_idPorCedula(:cedula); end;");
        ocibindbyname($query_getid, ":cedula", $cedula);
        ocibindbyname($query_getid, ":personaId", $personaId, 100);
        ociexecute($query_getid);
        $linkRetorno = "location:http://localhost/github/Proyecto%232/Interfaz/perfil/mostrarDatos.php?persona=". $_SESSION['tipoPersona'] . "&id=". $personaId;

    }

    oci_close($conn);

    //El id es usado para que cuandose recargue mostrarDato puedav volver a cargar los datos actualizados
    //header($linkRetorno);
?>

