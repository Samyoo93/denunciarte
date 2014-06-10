CREATE OR REPLACE PACKAGE pack_categoria_entidad IS

     --Procedimiento para llenar la tabla de categoria_personaFisica
     PROCEDURE set_categoria_entidad(categoriaId NUMBER, cedJur NUMBER);

END pack_categoria_entidad;
/
CREATE OR REPLACE PACKAGE BODY pack_categoria_entidad AS

     --Procedimiento para insertar categoria_personaFisica
     PROCEDURE set_categoria_entidad(categoriaId NUMBER, cedJur NUMBER)
          IS
          entidadId number;
          cursor c1 is
            select entidad_id
            from entidad 
            where cedulajuridica = cedJur;
          BEGIN
            open c1;
            fetch c1 into entidadId;
               INSERT INTO categoria_entidad
                    (categoria_entidad_id, entidad_id, categoria_id)
               VALUES
                    (s_categoria_entidad.nextval, entidadId, categoriaId);
	       COMMIT;
     END;

END pack_categoria_entidad;
/
