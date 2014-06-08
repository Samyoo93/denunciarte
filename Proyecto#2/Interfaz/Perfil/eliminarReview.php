<?php

    include("../conection.php");
    $conn = OCILogon($user, $pass, $db);

    $reviewId = $_POST['eliminarReview'];


    $query_eliminarReviewE = ociparse($conn, "begin pack_review_entidad.del_review_entidad(:reviewId); end;");
    ocibindbyname($query_eliminarReviewE, ":reviewId", $reviewId);
    ociexecute($query_eliminarReviewE);

    $query_eliminarReviewPF = ociparse($conn, "begin pack_review_personafisica.del_review_personaFisica(:reviewId); end;");
    ocibindbyname($query_eliminarReviewPF, ":reviewId", $reviewId);
    ociexecute($query_eliminarReviewPF);

    header('Location: MiPerfil.php')

?>
