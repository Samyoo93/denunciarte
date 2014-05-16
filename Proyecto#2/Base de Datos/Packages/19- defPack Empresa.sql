CREATE OR REPLACE PACKAGE pack_empresa IS

     --Procedimiento que retorna el id de la tabla empresa
     FUNCTION get_id(nombre VARCHAR2)RETURN NUMBER;
     
     --Procedimiento para llenar la tabla de empresa
     PROCEDURE set_empresa(nombre VARCHAR2);

END pack_empresa;
