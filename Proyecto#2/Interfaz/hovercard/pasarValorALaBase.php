

<?php
    include ("../conection.php");
    $conn =  OCILogon ($user,$pass,$db);
    session_start();



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
            $calificar = oci_parse ($conn,'begin estrellas.calificarEntidad (:pnota, :pdescripcion,:pcedulaUsuario_id, :pcalificacion, :pcedulaEntidad); end;');
            //Agrega el review
            oci_bind_by_name( $calificar,':pnota',$nota);
            oci_bind_by_name ($calificar,':pdescripcion',$descripcion);
            oci_bind_by_name($calificar,':pcedulaUsuario_id',$cedulaUsuario);
            oci_bind_by_name ($calificar,':pcalificacion',$calificacion);
            oci_bind_by_name ($calificar,':pcedulaEntidad', $cedula);
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
        oci_execute ($verSiPuedeOno);
        echo 'cantidadReviews:' . $cantidadReviews;
        //Revisa la cantidad obtenida y si no hay nada retorna cero
        if($cantidadReviews == 0){

            $calificar = oci_parse ($conn,'begin estrellas.calificarPersonaFisica (:pnota, :pdescripcion,:pcedulaUsuario_id, :pcalificacion, :pcedulaFisica); end;');
            oci_bind_by_name( $calificar,':pnota',$nota);
            oci_bind_by_name ($calificar,':pdescripcion',$descripcion);
            oci_bind_by_name($calificar,':pcedulaUsuario_id',$cedulaUsuario);
            oci_bind_by_name ($calificar,':pcalificacion',$calificacion);
            oci_bind_by_name ($calificar,':pcedulaFisica', $cedula);
            oci_execute ($calificar);

        } else {
            echo 'Ya calificó a esta persona anteriormente';
        }

    }

    oci_close($conn);

    header("location:http://localhost/github/Proyecto%232/Interfaz/perfil/mostrarDatos.php");
?>

