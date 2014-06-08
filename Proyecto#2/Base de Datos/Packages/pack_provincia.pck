CREATE OR REPLACE PACKAGE pack_provincia IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre_in VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_provincia(nombre_in VARCHAR2, paisId NUMBER);

END pack_provincia;
/
CREATE OR REPLACE PACKAGE BODY pack_provincia AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre_in VARCHAR2)
          RETURN NUMBER
          IS
               provinciaId NUMBER(9);

          BEGIN
               SELECT provincia_id
               INTO provinciaId
               FROM provincia
               WHERE nombre = nombre_in;
               RETURN(provinciaId);
               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inv?lido');

               RETURN(provinciaId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_provincia(nombre_in VARCHAR2, paisId NUMBER)
          IS
          BEGIN
               INSERT INTO provincia
                    (provincia_id, nombre, pais_id)
               VALUES
                    (s_provincia.nextval, nombre_in, paisId);
     END;

END pack_provincia;
/
