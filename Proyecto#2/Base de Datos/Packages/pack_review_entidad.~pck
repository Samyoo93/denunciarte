CREATE OR REPLACE PACKAGE pack_review_entidad IS

     --Procedimiento para llenar la tabla pack_review_entidad
     PROCEDURE set_review_entidad(entidadId NUMBER, reviewId NUMBER);

     --Procedimiento para eliminar el contenido de la tabla pack_review_entidad
     PROCEDURE del_review_entidad(reviewId NUMBER);

END pack_review_entidad;
/
CREATE OR REPLACE PACKAGE BODY pack_review_entidad AS

     --Procedimiento para insertar review_personaFisica
     PROCEDURE set_review_entidad(entidadId NUMBER, reviewId NUMBER)
          IS

          BEGIN
               INSERT INTO review_entidad
                    (review_entidad_id, entidad_id, review_id)
               VALUES
                    (s_review_entidad.Nextval, entidadId, reviewId);
	       COMMIT;
     END;

     --Procedimiento para eliminar review_personaFisica
     PROCEDURE del_review_entidad(reviewId NUMBER)
          IS
          BEGIN
               DELETE FROM review_entidad
               WHERE review_entidad.review_id = reviewId;
	     COMMIT;
     END;


END pack_review_entidad;
/
