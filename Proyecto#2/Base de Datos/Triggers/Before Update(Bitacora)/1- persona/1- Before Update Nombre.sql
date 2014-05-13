CREATE OR REPLACE TRIGGER BefUpdate_nombre_persona
     BEFORE UPDATE OF nombre
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
               'nombre',
               sysdate,
               :old.nombre,
               :new.nombre);
END BefUpdate_nombre_persona;
