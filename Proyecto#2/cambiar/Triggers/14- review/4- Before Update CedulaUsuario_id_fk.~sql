CREATE OR REPLACE TRIGGER BefUpdate_cedulaUsuario_review
     BEFORE UPDATE OF cedulaUsuario_id_fk
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
               'cedulaUsuario_id_fk',
               sysdate,
               :old.cedulaUsuario_id_fk,
               :new.cedulaUsuario_id_fk);
END BefUpdate_cedulaUsuario_review;
