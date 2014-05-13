CREATE OR REPLACE PACKAGE BODY pack_pais AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre VARCHAR2)
          RETURN NUMBER
          IS
               paisId NUMBER(9);

          BEGIN
               SELECT pais_id
               INTO paisId
               FROM pais
               WHERE pais.nombre = nombre;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(paisId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_pais(nombre VARCHAR2)
          IS
          BEGIN
               INSERT INTO pais
                    (pais_id, nombre)
               VALUES
                    (s_pais.nextval, nombre);
	       COMMIT;
     END;

END pack_pais;
