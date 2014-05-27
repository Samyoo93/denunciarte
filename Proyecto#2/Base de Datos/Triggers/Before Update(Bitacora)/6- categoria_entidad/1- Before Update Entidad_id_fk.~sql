CREATE OR REPLACE TRIGGER BefUpdate_entidId_CategEntidad
     BEFORE UPDATE OF entidad_id_fk
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
               'entidad_id_fk',
               sysdate,
               :old.entidad_id_fk,
               :new.entidad_id_fk);
END BefUpdate_entidId_CategEntidad;
