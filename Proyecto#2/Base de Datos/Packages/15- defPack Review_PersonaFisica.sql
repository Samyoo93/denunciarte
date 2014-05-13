CREATE OR REPLACE PACKAGE pack_review_personaFisica IS

     --Procedimiento para llenar la tabla review_personaFisica
     PROCEDURE set_review_personaFisica(cedulaFisica NUMBER, reviewId NUMBER);

     --Procedimiento para eliminar el contenido de la tabla review_personaFisica
     PROCEDURE del_review_personaFisica(reviewId NUMBER);

END pack_review_personaFisica;
