CREATE OR REPLACE PACKAGE pack_barrio IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre_in VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_barrio(nombre_in VARCHAR2, distritoId NUMBER);

END pack_barrio;
/
CREATE OR REPLACE PACKAGE BODY pack_barrio AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre_in VARCHAR2)
          RETURN NUMBER
          IS
               barrioId NUMBER(9);

          BEGIN
               SELECT barrio_id
               INTO barrioId
               FROM barrio
               WHERE nombre = nombre_in;
	             RETURN(barrioId);
               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inv?lido');

               RETURN(barrioId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_barrio(nombre_in VARCHAR2, distritoId NUMBER)
          IS
          BEGIN
               INSERT INTO barrio
                    (barrio_id, nombre, distrito_id)
               VALUES
                    (s_barrio.nextval, nombre_in, distritoId);
	       COMMIT;
     END;

END pack_barrio;
/
