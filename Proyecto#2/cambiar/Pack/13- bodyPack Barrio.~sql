CREATE OR REPLACE PACKAGE BODY pack_barrio AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre VARCHAR2)
          RETURN NUMBER
          IS
               barrioId NUMBER(9);

          BEGIN
               SELECT barrio_id
               INTO barrioId
               FROM barrio
               WHERE barrio.nombre = nombre;
	       RETURN(barrioId);
               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inv�lido');

               RETURN(barrioId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_barrio(nombre VARCHAR2, distritoId NUMBER)
          IS
          BEGIN
               INSERT INTO barrio
                    (barrio_id, nombre, distrito_id)
               VALUES
                    (s_barrio.nextval, nombre, distritoId);
	       COMMIT;
     END;

END pack_barrio;
