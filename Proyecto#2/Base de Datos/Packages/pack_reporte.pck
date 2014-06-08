CREATE OR REPLACE PACKAGE pack_reporte IS

     FUNCTION get_id(descripcion VARCHAR2) RETURN NUMBER;
     --Procedimiento para llenar la tabla de preview
     PROCEDURE set_reporte(descripcion_in VARCHAR2, cedulaUsuario NUMBER);
     
     FUNCTION has_reported(cedulaReportado NUMBER, cedulaReportando NUMBER) RETURN NUMBER;
     
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
                         DBMS_OUTPUT.put_line('El nombre es inv�lido');

               RETURN(reporteId);

     END;

     --Procedimiento para insertar categorias
     PROCEDURE set_reporte(descripcion_in VARCHAR2, cedulaUsuario NUMBER)
          IS
          
          BEGIN
               INSERT INTO reporte
                    (reporte_id, descripcion, cedulaUsuario_id)
               VALUES
                    (s_reporte.nextval, descripcion_in, cedulaUsuario);
               
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


END pack_reporte;
/
