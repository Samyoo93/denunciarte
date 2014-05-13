CREATE OR REPLACE PACKAGE pack_categoria IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre VARCHAR2)RETURN NUMBER;
     
     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_categoria(nombre VARCHAR2, descripcion VARCHAR2, tipo NUMBER);

END pack_categoria;
