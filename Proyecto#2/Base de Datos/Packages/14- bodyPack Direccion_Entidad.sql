CREATE OR REPLACE PACKAGE BODY pack_direccion_entidad AS

     --Procedimiento para insertar categoria_personaFisica
    procedure set_direccion_entidad (exacta varchar2, nombre_barrio varchar2)
         is
              id_barrio number;
      begin
        select barrio_id into id_barrio from barrio
        where nombre = nombre_barrio;

        insert into direccion_entidad
               (direccionexacta, barrio_id, entidad_id, direccion_entidad_id)
        values
               (exacta, id_barrio, s_entidad.currval, s_direccion_entidad.nextval);
	       COMMIT;
     END;

END pack_direccion_entidad;
