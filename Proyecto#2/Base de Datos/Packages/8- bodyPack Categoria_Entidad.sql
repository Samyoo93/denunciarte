CREATE OR REPLACE PACKAGE BODY pack_categoria_entidad AS

     --Procedimiento para insertar categoria_personaFisica
     PROCEDURE set_categoria_entidad(categoriaId NUMBER, entidadId NUMBER)
          IS
          BEGIN
               INSERT INTO categoria_entidad
                    (categoria_entidad_id, entidad_id, categoria_id)
               VALUES
                    (s_categoria_entidad.nextval, entidadId, categoriaId);
	       COMMIT;
     END;

END pack_categoria_entidad;
