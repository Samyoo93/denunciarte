CREATE OR REPLACE TRIGGER BefUpdate_descrip_categoria
     BEFORE UPDATE OF descripcion
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
               'descripcion',
               sysdate,
               :old.descripcion,
               :new.descripcion);
END BefUpdate_descrip_categoria;
