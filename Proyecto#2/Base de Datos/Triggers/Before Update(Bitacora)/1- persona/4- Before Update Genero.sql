CREATE OR REPLACE TRIGGER BefUpdate_genero_persona
     BEFORE UPDATE OF genero
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
               'genero',
               sysdate,
               :old.genero,
               :new.genero);
END BefUpdate_genero_persona;
