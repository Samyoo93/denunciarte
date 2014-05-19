CREATE OR REPLACE TRIGGER BefUpdate_catId_CatPerFis
     BEFORE UPDATE OF categoria_id_fk
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
               'categoria_id_fk',
               sysdate,
               :old.categoria_id_fk,
               :new.categoria_id_fk);
END BefUpdate_catId_CatPerFis;
