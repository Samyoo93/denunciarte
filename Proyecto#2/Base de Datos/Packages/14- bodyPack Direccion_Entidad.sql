CREATE OR REPLACE PACKAGE BODY pack_direccion_entidad AS

     --Procedimiento para insertar categoria_personaFisica
     PROCEDURE set_direccion_entidad(direccion VARCHAR2, barrioId NUMBER, entidadId NUMBER)
          IS
          BEGIN
               INSERT INTO direccion_entidad
                    (direccion_entidad_id, entidad_id_fk, barrio_id_fk)
               VALUES
                    (s_direccion_entidad.nextval, entidadId, barrioId);
	       COMMIT;
     END;

END pack_direccion_entidad;
