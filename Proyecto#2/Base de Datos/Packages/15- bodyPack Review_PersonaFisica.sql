CREATE OR REPLACE PACKAGE BODY pack_review_personaFisica AS

     --Procedimiento para insertar review_personaFisica
     PROCEDURE set_review_personaFisica(cedulaFisica NUMBER, reviewId NUMBER)
          IS
          BEGIN
               INSERT INTO review_personaFisica
                    (review_personaFisica_id, cedulaFisica_id_fk, review_id_fk)
               VALUES
                    (s_review_personaFisica.Nextval, cedulaFisica, reviewId);
	       COMMIT;
     END;

     --Procedimiento para eliminar review_personaFisica
     PROCEDURE del_review_personaFisica(reviewId NUMBER)
          IS
          BEGIN
               DELETE FROM review_personaFisica
               WHERE review_personaFisica_id = reviewId;
	       COMMIT;
     END;


END pack_review_personaFisica;
