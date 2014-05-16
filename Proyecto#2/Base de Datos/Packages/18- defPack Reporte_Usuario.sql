CREATE OR REPLACE PACKAGE pack_reporte_usuario IS

     --Procedimiento para llenar la tabla de reporte_usuario 
     PROCEDURE set_reporte_usuario(cedulaUsuario NUMBER, reporte_id NUMBER);

END pack_reporte_usuario;
