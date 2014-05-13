CREATE OR REPLACE PACKAGE BODY pack_provincia AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre VARCHAR2)
          RETURN NUMBER
          IS
               provinciaId NUMBER(9);

          BEGIN
               SELECT provincia_id
               INTO provinciaId
               FROM provincia
               WHERE provincia.nombre = nombre;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(provinciaId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_provincia(nombre VARCHAR2)
          IS
          BEGIN
               INSERT INTO provincia
                    (provincia_id, nombre)
               VALUES
                    (s_provincia.nextval, nombre);
     END;

END pack_provincia;
