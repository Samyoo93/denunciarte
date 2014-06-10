CREATE OR REPLACE PACKAGE pack_reporte_usuario IS

     --Procedimiento para llenar la tabla de reporte_usuario
     PROCEDURE set_reporte_usuario(cedulaUsuario NUMBER);
     
     FUNCTION count_reportes_usuario(cedulaReportado NUMBER, cedulaUsuario NUMBER)RETURN NUMBER;

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
     
     FUNCTION count_reportes_usuario(cedulaReportado NUMBER, cedulaUsuario NUMBER)
          RETURN NUMBER
          IS
               numReportes NUMBER(6);

          BEGIN
               SELECT count(1)
               INTO numReportes
               FROM reporte_usuario ru, reporte r
               WHERE ru.cedulausuario_id = cedulaReportado and r.cedulausuario_id = cedulaUsuario
                     and r.reporte_id = ru.reporte_id;
               RETURN(numReportes);

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(numReportes);

     END;

END pack_reporte_usuario;
/

