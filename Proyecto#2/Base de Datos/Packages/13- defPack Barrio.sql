CREATE OR REPLACE PACKAGE pack_barrio IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_barrio(nombre VARCHAR2);

END pack_barrio;
