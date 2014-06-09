CREATE OR REPLACE PACKAGE pack_reporte_usuario IS

     --Procedimiento para llenar la tabla de reporte_usuario
     PROCEDURE set_reporte_usuario(cedulaUsuario NUMBER);

END pack_reporte_usuario;
/
CREATE OR REPLACE PACKAGE BODY pack_reporte_usuario AS

     --Procedimiento para insertar categoria_personaFisica
     PROCEDURE set_reporte_usuario(cedulaUsuario NUMBER)
          IS
          BEGIN
               INSERT INTO reporte_usuario
                    (reporte_usuario_id, cedulaUsuario_id, reporte_id)
               VALUES
                    (s_reporte_usuario.nextval, cedulaUsuario, s_reporte.currval);
            COMMIT;
     END;

END pack_reporte_usuario;
/
