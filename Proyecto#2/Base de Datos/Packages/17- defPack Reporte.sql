CREATE OR REPLACE PACKAGE pack_reporte IS
     
     FUNCTION get_id(descripcion VARCHAR2) RETURN NUMBER;
     --Procedimiento para llenar la tabla de preview
     PROCEDURE set_reporte(descripcion VARCHAR2, cedulaUsuario NUMBER);
     
END pack_reporte;
