CREATE OR REPLACE PACKAGE pack_review IS

     --Procedimiento para llenar la tabla de preview
     PROCEDURE set_review(nota VARCHAR2, descripcion VARCHAR2, calificacion NUMBER, cedulaUsuario NUMBER);

     --Procedimiento para eliminar el contenido de la tabla preview
     PROCEDURE del_review(reviewId NUMBER);

     --Procedimiento para modificar el contenido de la tabla preview
     PROCEDURE mod_review(reviewId NUMBER, nota VARCHAR2, descripcion VARCHAR2, calificacion NUMBER);

END pack_review;
