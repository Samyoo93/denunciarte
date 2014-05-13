CREATE OR REPLACE TRIGGER BefUpdate_usuario_perfil
     BEFORE UPDATE OF usuario
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
               'usuario',
               sysdate,
               :old.usuario,
               :new.usuario);
END BefUpdate_usuario_perfil;
