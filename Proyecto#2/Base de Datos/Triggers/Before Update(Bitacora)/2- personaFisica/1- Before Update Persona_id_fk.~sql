CREATE OR REPLACE TRIGGER BefUpdate_PersId_personaFisica
     BEFORE UPDATE OF persona_id_fk
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
               'persona_id_fk',
               sysdate,
               :old.persona_id_fk,
               :new.persona_id_fk);
END BefUpdate_PersId_personaFisica;
