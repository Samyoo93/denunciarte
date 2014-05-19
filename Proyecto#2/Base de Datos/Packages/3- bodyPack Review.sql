CREATE OR REPLACE PACKAGE BODY pack_review AS

     --Procedimiento para insertar personas
     PROCEDURE set_review(nota VARCHAR2, descripcion VARCHAR2, calificacion NUMBER, cedulaUsuario NUMBER)
          IS
          BEGIN
               INSERT INTO review
                    (review_id, nota, descripcion, calificacion, cedulaUsuario_id)
               VALUES
                    (s_review.nextval, nota, descripcion, calificacion, cedulaUsuario);
 	       COMMIT;
     END;

     --Procedimiento para eliminar personas
     PROCEDURE del_review(reviewId NUMBER)
          IS
          BEGIN
               DELETE FROM review
               WHERE review.review_id = reviewId;
     END;

     --Procedimiento para modificar personas
     PROCEDURE mod_review(reviewId NUMBER, nota VARCHAR2, descripcion VARCHAR2, calificacion NUMBER)
          IS
          BEGIN
               UPDATE review
               SET (nota, descripcion, calificacion) = (SELECT nota, descripcion, calificacion FROM DUAL)
               WHERE review.review_id = reviewId;
	       COMMIT;
     END;

END pack_review;
