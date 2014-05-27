CREATE OR REPLACE TRIGGER BefUpdate_entidId_CategEntidad
     BEFORE UPDATE OF entidad_id
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
               'entidad_id',
               sysdate,
               :old.entidad_id,
               :new.entidad_id);
END BefUpdate_entidId_CategEntidad;
