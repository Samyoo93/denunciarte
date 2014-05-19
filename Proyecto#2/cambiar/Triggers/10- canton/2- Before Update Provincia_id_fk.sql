CREATE OR REPLACE TRIGGER BefUpdate_provincia_canton
     BEFORE UPDATE OF provincia_id
     ON canton
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
               'canton',
               'provincia_id',
               sysdate,
               :old.provincia_id,
               :new.provincia_id);
END BefUpdate_provincia_canton;
