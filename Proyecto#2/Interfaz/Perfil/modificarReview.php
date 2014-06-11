<?php
    /*
        Archivo usado tanto para borrar como para modificar los reviews.
    */
    include("../conection.php");
    $conn = OCILogon($user, $pass, $db);


    if (isset($_POST['eliminarReview'])) {
        //para eliminar
        echo $_POST['eliminarReview'];
        $reviewId = $_POST['eliminarReview'];


        $query_eliminarReviewE = ociparse($conn, "begin pack_review_entidad.del_review_entidad(:reviewId); end;");
        ocibindbyname($query_eliminarReviewE, ":reviewId", $reviewId);
        ociexecute($query_eliminarReviewE);

        $query_eliminarReviewPF = ociparse($conn, "begin pack_review_personafisica.del_review_personaFisica(:reviewId); end;");
        ocibindbyname($query_eliminarReviewPF, ":reviewId", $reviewId);
        ociexecute($query_eliminarReviewPF);

    }
    if (isset($_POST['editarReview'])) {
       //para modificar
        
        
        $reviewId = $_POST['editarReview'];
        $nota = $_POST['nota'];
        $descripcion = $_POST['descripcion'];
        echo $reviewId . '<br>';
        echo $nota . '<br>';
        echo $descripcion . '<br>';
        
        $query_editarReview = ociparse($conn, "begin pack_review.mod_review(:reviewId, :nota, :descripcion); end;");
        ocibindbyname($query_editarReview, ":reviewId", $reviewId);
        ocibindbyname($query_editarReview, ":nota", $nota);
        ocibindbyname($query_editarReview, ":descripcion", $descripcion);
        ociexecute($query_editarReview);

    }
    OCICommit($conn);
    ociLogOff($conn);
    header('Location: MiPerfil.php')
?>
