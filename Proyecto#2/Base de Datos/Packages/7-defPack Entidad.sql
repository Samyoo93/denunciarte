CREATE OR REPLACE PACKAGE pack_entidad IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_entidad(nombre VARCHAR2, cedulaJuridica NUMBER);

END pack_entidad;
