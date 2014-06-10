 CREATE OR REPLACE PACKAGE pack_reporte IS

     FUNCTION get_id(descripcion VARCHAR2) RETURN NUMBER;
     --Procedimiento para llenar la tabla de preview
     PROCEDURE set_reporte(descripcion_in VARCHAR2, cedulaUsuario NUMBER, cedulaReportado NUMBER);

     FUNCTION has_reported(cedulaReportado NUMBER, cedulaReportando NUMBER) RETURN NUMBER;
     
     PROCEDURE Banear (pcedulausuario_id NUMBER);

END pack_reporte;
/
CREATE OR REPLACE PACKAGE BODY pack_reporte AS

     FUNCTION get_id(descripcion VARCHAR2)
          RETURN NUMBER
          IS
               reporteId NUMBER(6);

          BEGIN
               SELECT reporte_id
               INTO reporteId
               FROM reporte
               WHERE reporte.descripcion = descripcion;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(reporteId);

     END;

     --Procedimiento para insertar categorias
     PROCEDURE set_reporte(descripcion_in VARCHAR2, cedulaUsuario NUMBER, cedulaReportado NUMBER)
          IS

          BEGIN
               INSERT INTO reporte
                    (reporte_id, descripcion, cedulaUsuario_id)
               VALUES
                    (s_reporte.nextval, descripcion_in, cedulaUsuario);
               INSERT INTO reporte_usuario
                    (reporte_usuario_id, cedulaUsuario_id, reporte_id)
               VALUES
                    (s_reporte_usuario.nextval, cedulaReportado, s_reporte.currval);

               COMMIT;

     END;

     FUNCTION has_reported(cedulaReportado NUMBER, cedulaReportando NUMBER)

        return NUMBER
        is countCed NUMBER;
        BEGIN
            SELECT count(1) into countCed
            from reporte r, reporte_usuario ru
            where ru.cedulausuario_id = cedulaReportado and r.cedulausuario_id = cedulaReportando;
            return countCed;
    END;
    
    PROCEDURE Banear (pcedulausuario_id NUMBER) 
            IS 
               numeroReportes number; numeroBans number;
            BEGIN
                select u.numreportes
                into numeroReportes
                from usuario u
                where pcedulausuario_id = u.cedulausuario_id;
                select u.numBans
                into numeroBans
                from usuario u
                where pcedulausuario_id = u.cedulausuario_id;
                
                if (numeroBans = 2 and numeroReportes = 9) then
                  update usuario
                  set estado = -2,
                      numbans = 3,
                      numreportes = 0
                      where pcedulausuario_id = cedulaUsuario_id;

                elsif ( numeroBans!=2 and numeroReportes = 9) then
                  update usuario
                  set  numBans = numbans + 1,
                       estado = -1,
                       numreportes = 0
                       where pcedulausuario_id = cedulaUsuario_id;
                
                else
                  update usuario
                  set numreportes = numreportes + 1
                  where pcedulausuario_id = cedulaUsuario_id;
                end if;
     END;


END pack_reporte;
/
