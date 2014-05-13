CREATE OR REPLACE TRIGGER BefUpdate_descripcion_review
     BEFORE UPDATE OF descripcion
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
               'descripcion',
               sysdate,
               :old.descripcion,
               :new.descripcion);
END BefUpdate_descripcion_review;
