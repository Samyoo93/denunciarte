CREATE OR REPLACE TRIGGER BefUpdate_PriApellido_persona
     BEFORE UPDATE OF primerApellido
     ON persona
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
               'Persona',
               'primerApellido',
               sysdate,
               :old.primerApellido,
               :new.primerApellido);
END BefUpdate_PriApellido_persona;
