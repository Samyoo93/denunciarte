CREATE OR REPLACE PACKAGE pack_pais IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre_in VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_pais(nombre_in VARCHAR2);

END pack_pais;
/
CREATE OR REPLACE PACKAGE BODY pack_pais AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre_in VARCHAR2)
          RETURN NUMBER
          IS
               paisId NUMBER(9);

          BEGIN
               SELECT pais_id
               INTO paisId
               FROM pais
               WHERE nombre = nombre_in;
               RETURN(paisId);
               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(paisId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_pais(nombre_in VARCHAR2)
          IS
          BEGIN
               INSERT INTO pais
                    (pais_id, nombre)
               VALUES
                    (s_pais.nextval, nombre_in);
	       COMMIT;
     END;

END pack_pais;
/
