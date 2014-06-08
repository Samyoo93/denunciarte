CREATE OR REPLACE PACKAGE pack_canton IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre_in VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_canton(nombre_in VARCHAR2, provinciaId NUMBER);

END pack_canton;
/
CREATE OR REPLACE PACKAGE BODY pack_canton AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre_in VARCHAR2)
          RETURN NUMBER
          IS
               cantonId NUMBER(9);

          BEGIN
               SELECT canton_id
               INTO cantonId
               FROM canton
               WHERE nombre = nombre_in;
         RETURN(cantonId);
               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inv?lido');

               RETURN(cantonId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_canton(nombre_in VARCHAR2, provinciaId NUMBER)
          IS
          BEGIN
               INSERT INTO canton
                    (canton_id, nombre, provincia_Id)
               VALUES
                    (s_canton.nextval, nombre_in, provinciaId);
         COMMIT;
     END;

END pack_canton;
/
