CREATE OR REPLACE TRIGGER BefUpdate_reviewId_reviewEnt
     BEFORE UPDATE OF review_id
     ON review_entidad
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
               'review_entidad',
               'review_id',
               sysdate,
               :old.review_id,
               :new.review_id);
END BefUpdate_reviewId_reviewEnt;
