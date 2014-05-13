CREATE OR REPLACE TRIGGER BefUpdate_estado_perfil
     BEFORE UPDATE OF estado
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
               'estado',
               sysdate,
               :old.estado,
               :new.estado);
END BefUpdate_estado_perfil;
