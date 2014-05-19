CREATE OR REPLACE PACKAGE pack_canton IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_canton(nombre VARCHAR2, provinciaId NUMBER);

END pack_canton;
