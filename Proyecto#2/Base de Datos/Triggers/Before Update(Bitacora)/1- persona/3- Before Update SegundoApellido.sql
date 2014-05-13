CREATE OR REPLACE TRIGGER BefUpdate_SegApellido_persona
     BEFORE UPDATE OF segundoApellido
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
               'segundoApellido',
               sysdate,
               :old.segundoApellido,
               :new.segundoApellido);
END BefUpdate_SegApellido_persona;
