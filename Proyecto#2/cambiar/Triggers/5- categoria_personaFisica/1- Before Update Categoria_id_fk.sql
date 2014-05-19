CREATE OR REPLACE TRIGGER BefUpdate_catId_CatPerFis
     BEFORE UPDATE OF categoria_id
     ON Categoria_Personafisica
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
               'Categoria_Personafisica',
               'categoria_id',
               sysdate,
               :old.categoria_id,
               :new.categoria_id);
END BefUpdate_catId_CatPerFis;
