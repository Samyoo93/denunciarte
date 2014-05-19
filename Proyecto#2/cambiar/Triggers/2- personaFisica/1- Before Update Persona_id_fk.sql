CREATE OR REPLACE TRIGGER BefUpdate_PersId_personaFisica
     BEFORE UPDATE OF persona_id
     ON personaFisica
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
               'PersonaFisica',
               'persona_id',
               sysdate,
               :old.persona_id,
               :new.persona_id);
END BefUpdate_PersId_personaFisica;
