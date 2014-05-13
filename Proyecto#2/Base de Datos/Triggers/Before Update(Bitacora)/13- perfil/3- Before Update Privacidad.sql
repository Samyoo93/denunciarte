CREATE OR REPLACE TRIGGER BefUpdate_privacidad_perfil
     BEFORE UPDATE OF privacidad
     ON perfil
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
               'perfil',
               'privacidad',
               sysdate,
               :old.privacidad,
               :new.privacidad);
END BefUpdate_privacidad_perfil;
