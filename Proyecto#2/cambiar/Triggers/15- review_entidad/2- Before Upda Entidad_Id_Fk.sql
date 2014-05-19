CREATE OR REPLACE TRIGGER BefUpdate_entidadId_reviewEnt
     BEFORE UPDATE OF entidad_id
     ON review_entidad
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
               'review_entidad',
               'entidad_id',
               sysdate,
               :old.entidad_id,
               :new.entidad_id);
END BefUpdate_entidadId_reviewEnt;
