CREATE OR REPLACE PACKAGE pack_distrito IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre_in VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_distrito(nombre_in VARCHAR2, cantonId NUMBER);

END pack_distrito;
/
CREATE OR REPLACE PACKAGE BODY pack_distrito AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre_in VARCHAR2)
          RETURN NUMBER
          IS
               distritoId NUMBER(9);

          BEGIN
               SELECT distrito_id
               INTO distritoId
               FROM distrito
               WHERE nombre = nombre_in;
               RETURN(distritoId);
               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(distritoId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_distrito(nombre_in VARCHAR2, cantonId NUMBER)
          IS
          BEGIN
               INSERT INTO distrito
                    (distrito_id, nombre)
               VALUES
                    (s_distrito.nextval, nombre_in);
	       COMMIT;
     END;

END pack_distrito;
/
