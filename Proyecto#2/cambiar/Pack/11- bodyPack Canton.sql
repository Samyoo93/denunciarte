CREATE OR REPLACE PACKAGE BODY pack_canton AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre VARCHAR2)
          RETURN NUMBER
          IS
               cantonId NUMBER(9);

          BEGIN
               SELECT canton_id
               INTO cantonId
               FROM canton
               WHERE canton.nombre = nombre;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(cantonId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_canton(nombre VARCHAR2, provinciaId NUMBER)
          IS
          BEGIN
               INSERT INTO canton
                    (canton_id, nombre, provincia_Id)
               VALUES
                    (s_canton.nextval, nombre, provinciaId);
	       COMMIT;
     END;

END pack_canton;
