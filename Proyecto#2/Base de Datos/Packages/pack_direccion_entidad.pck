CREATE OR REPLACE PACKAGE pack_direccion_entidad IS

     --Procedimiento para llenar la tabla de categoria_personaFisica
    PROCEDURE set_direccion_entidad (exacta varchar2, nombre_barrio varchar2);
    
    PROCEDURE mod_direccion_entidad(exacta varchar2, nom_barrio varchar2, nom_entidad varchar2);
END pack_direccion_entidad;
/
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
     
     PROCEDURE mod_direccion_entidad(exacta varchar2, nom_barrio varchar2, nom_entidad varchar2)
       IS
           id_barrio number;
       BEGIN
            select barrio_id into id_barrio from barrio
            where nombre = nom_barrio;
            UPDATE direccion_entidad
            SET direccionexacta = exacta,
                barrio_id = id_barrio
            WHERE entidad_id = pack_entidad.get_id(nom_entidad);
       COMMIT;
       END;
       
END pack_direccion_entidad;
/
