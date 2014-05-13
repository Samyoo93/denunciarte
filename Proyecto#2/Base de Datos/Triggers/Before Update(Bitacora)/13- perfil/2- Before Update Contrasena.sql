CREATE OR REPLACE TRIGGER BefUpdate_contrasena_perfil
     BEFORE UPDATE OF contrasena
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
               'contrasena',
               sysdate,
               :old.contrasena,
               :new.contrasena);
END BefUpdate_contrasena_perfil;
