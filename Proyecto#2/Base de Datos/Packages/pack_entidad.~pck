CREATE OR REPLACE PACKAGE pack_entidad IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre_in VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_entidad(nombre VARCHAR2, cedulaJuridica NUMBER);
     
     PROCEDURE mod_entidad(nombre_in VARCHAR2, cedulaJuridica_in NUMBER);
END pack_entidad;
/
CREATE OR REPLACE PACKAGE BODY pack_entidad AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre_in VARCHAR2)
          RETURN NUMBER
          IS
               entidadId NUMBER(9);

          BEGIN
               SELECT entidad_id
               INTO entidadId
               FROM entidad
               WHERE entidad.nombre = nombre_in;
               RETURN(entidadId);
               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(entidadId);
     END;

     --Procedimiento para insertar entidades
     PROCEDURE set_entidad(nombre VARCHAR2, cedulaJuridica NUMBER)
          IS
          BEGIN
               INSERT INTO entidad
                    (entidad_id, nombre, cedulaJuridica)
               VALUES
                    (s_entidad.nextval, nombre, cedulaJuridica);
	       COMMIT;
     END;
     
     PROCEDURE mod_entidad(nombre_in VARCHAR2, cedulaJuridica_in NUMBER)
       IS
       BEGIN
           UPDATE entidad
           SET nombre = nombre_in
           WHERE cedulaJuridica = cedulaJuridica_in;
       COMMIT;
     END;

END pack_entidad;
/
