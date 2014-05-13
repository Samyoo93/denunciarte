CREATE OR REPLACE TRIGGER BefUpdate_calificacion_review
     BEFORE UPDATE OF calificacion
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
               'calificacion',
               sysdate,
               :old.calificacion,
               :new.calificacion);
END BefUpdate_calificacion_review;
