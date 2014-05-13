CREATE OR REPLACE TRIGGER BefUpdate_nombre_categoria
     BEFORE UPDATE OF nombre
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
               'nombre',
               sysdate,
               :old.nombre,
               :new.nombre);
END BefUpdate_nombre_categoria;
