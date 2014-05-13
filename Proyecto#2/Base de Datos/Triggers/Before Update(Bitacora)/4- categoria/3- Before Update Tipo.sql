CREATE OR REPLACE TRIGGER BefUpdate_tipo_categoria
     BEFORE UPDATE OF tipo
     ON categoria
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
               'categoria',
               'tipo',
               sysdate,
               :old.tipo,
               :new.tipo);
END BefUpdate_tipo_categoria;
