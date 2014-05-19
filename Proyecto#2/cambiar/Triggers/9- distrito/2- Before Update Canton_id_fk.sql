CREATE OR REPLACE TRIGGER BefUpdate_canton_id_distrito
     BEFORE UPDATE OF canton_id
     ON distrito
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
               'distrito',
               'canton_id',
               sysdate,
               :old.canton_id,
               :new.canton_id);
END BefUpdate_canton_id_distrito;
