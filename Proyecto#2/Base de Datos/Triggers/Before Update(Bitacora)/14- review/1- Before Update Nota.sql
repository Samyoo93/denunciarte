CREATE OR REPLACE TRIGGER BefUpdate_nota_review
     BEFORE UPDATE OF nota
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
               'nota',
               sysdate,
               :old.nota,
               :new.nota);
END BefUpdate_nota_review;
