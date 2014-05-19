CREATE OR REPLACE TRIGGER BefUpdate_personaId_usuario
     BEFORE UPDATE OF persona_id
     ON usuario
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
               'usuario',
               'persona_id',
               sysdate,
               :old.persona_id,
               :new.persona_id);
END BefUpdate_numReportes_usuario;
