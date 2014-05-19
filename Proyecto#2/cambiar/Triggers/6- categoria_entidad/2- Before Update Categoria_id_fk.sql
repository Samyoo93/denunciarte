CREATE OR REPLACE TRIGGER BefUpdate_categId_CategEntidad
     BEFORE UPDATE OF categoria_id
     ON Categoria_Entidad
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
               'Categoria_Entidad',
               'categoria_id',
               sysdate,
               :old.categoria_id,
               :new.categoria_id);
END BefUpdate_categId_CategEntidad;
