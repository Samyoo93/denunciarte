CREATE OR REPLACE PACKAGE pack_pais IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_pais(nombre VARCHAR2);

END pack_pais;
