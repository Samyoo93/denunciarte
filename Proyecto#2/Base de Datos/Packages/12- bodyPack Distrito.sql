CREATE OR REPLACE PACKAGE BODY pack_distrito AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre VARCHAR2)
          RETURN NUMBER
          IS
               distritoId NUMBER(9);

          BEGIN
               SELECT distrito_id
               INTO distritoId
               FROM distrito
               WHERE distrito.nombre = nombre;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(distritoId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_distrito(nombre VARCHAR2)
          IS
          BEGIN
               INSERT INTO distrito
                    (distrito_id, nombre)
               VALUES
                    (s_distrito.nextval, nombre);
	       COMMIT;
     END;

END pack_distrito;
