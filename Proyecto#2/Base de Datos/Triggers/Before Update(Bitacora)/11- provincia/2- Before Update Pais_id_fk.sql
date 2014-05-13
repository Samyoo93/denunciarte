CREATE OR REPLACE TRIGGER BefUpdate_pais_id_fk_provincia
     BEFORE UPDATE OF pais_id_fk
     ON provincia
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
               'provincia',
               'pais_id_fk',
               sysdate,
               :old.pais_id_fk,
               :new.pais_id_fk);
END BefUpdate_pais_id_fk_provincia;
