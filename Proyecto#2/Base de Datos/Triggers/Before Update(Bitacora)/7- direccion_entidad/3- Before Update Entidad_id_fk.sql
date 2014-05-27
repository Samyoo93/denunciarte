CREATE OR REPLACE TRIGGER BefUpdate_entidad_id_direccion
     BEFORE UPDATE OF entidad_id
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
               'entidad_id_fk',
               sysdate,
               :old.entidad_id,
               :new.entidad_id);
END BefUpdate_entidad_id_direccion;
