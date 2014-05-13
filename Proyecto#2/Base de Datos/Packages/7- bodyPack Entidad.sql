CREATE OR REPLACE PACKAGE BODY pack_entidad AS

     --Funcion para obtener el de la tabla entidad
     FUNCTION get_id(nombre VARCHAR2)
          RETURN NUMBER
          IS
               entidadId NUMBER(9);

          BEGIN
               SELECT entidad_id
               INTO entidadId
               FROM entidad
               WHERE entidad.nombre = nombre;

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

END pack_entidad;
