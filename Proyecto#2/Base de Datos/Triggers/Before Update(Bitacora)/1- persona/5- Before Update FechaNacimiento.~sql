CREATE OR REPLACE TRIGGER BefUpdate_fecNacimien_persona
     BEFORE UPDATE OF fechaNacimiento
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
               :old.fechaNacimiento,
               :new.fechaNacimiento);
END BefUpdate_fecNacimien_persona;
