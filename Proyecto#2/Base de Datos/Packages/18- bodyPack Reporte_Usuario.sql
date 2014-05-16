CREATE OR REPLACE PACKAGE BODY pack_reporte_usuario AS
   
     --Procedimiento para insertar categoria_personaFisica
     PROCEDURE set_reporte_usuario(cedulaUsuario NUMBER, reporte_id NUMBER)
          IS
          BEGIN
               INSERT INTO reporte_usuario
                    (reporte_usuario_id, cedulaUsuario_id_fk, reporte_id_fk)
               VALUES
                    (s_reporte_usuario.nextval, cedulaUsuario, reporte_id);
            COMMIT;
     END;

END pack_reporte_usuario;
