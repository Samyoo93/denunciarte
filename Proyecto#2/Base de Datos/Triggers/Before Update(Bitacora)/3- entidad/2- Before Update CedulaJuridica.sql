CREATE OR REPLACE TRIGGER BefUpdate_cedulaJuridi_entidad
     BEFORE UPDATE OF cedulaJuridica
     ON entidad
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
               'Entidad',
               'cedulaJuridica',
               sysdate,
               :old.cedulaJuridica,
               :new.cedulaJuridica);
END BefUpdate_cedulaJuridi_entidad;
