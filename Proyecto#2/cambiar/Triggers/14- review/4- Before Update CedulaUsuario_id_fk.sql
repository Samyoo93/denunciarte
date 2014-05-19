CREATE OR REPLACE TRIGGER BefUpdate_cedulaUsuario_review
     BEFORE UPDATE OF cedulaUsuario_id
     ON review
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
               'review',
               'cedulaUsuario_id',
               sysdate,
               :old.cedulaUsuario_id,
               :new.cedulaUsuario_id);
END BefUpdate_cedulaUsuario_review;
