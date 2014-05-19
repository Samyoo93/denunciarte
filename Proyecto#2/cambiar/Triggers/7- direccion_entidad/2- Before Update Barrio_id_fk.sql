CREATE OR REPLACE TRIGGER BefUpdate_barrio_id_direccion
     BEFORE UPDATE OF barrio_id
     ON direccion_entidad
     FOR EACH ROW
     BEGIN
     INSERT INTO
          denunciarte_bitacora
               (
               bitacora_id,
               nom_tabla,
               nom_campo,
               fec_cambio,
               valor_anterior,
               valor_actual
               )
         VALUES
               (
               s_denunciarte_bitacora.nextval,
               'direccion_entidad',
               'barrio_id',
               sysdate,
               :old.barrio_id,
               :new.barrio_id);
END BefUpdate_barrio_id_direccion;
