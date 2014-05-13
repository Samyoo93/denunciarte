CREATE OR REPLACE PACKAGE pack_review_entidad IS

     --Procedimiento para llenar la tabla pack_review_entidad
     PROCEDURE set_review_entidad(entidadId NUMBER, reviewId NUMBER);

     --Procedimiento para eliminar el contenido de la tabla pack_review_entidad
     PROCEDURE del_review_entidad(reviewId NUMBER);

END pack_review_entidad;
