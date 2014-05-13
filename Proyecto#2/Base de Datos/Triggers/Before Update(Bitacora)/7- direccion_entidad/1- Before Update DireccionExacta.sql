CREATE OR REPLACE TRIGGER BefUpdate_direccion_direccion
     BEFORE UPDATE OF direccionExacta
     ON direccion_entidad
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
               'direccion_entidad',
               'direccionExacta',
               sysdate,
               :old.direccionExacta,
               :new.direccionExacta);
END BefUpdate_direccion_direccion;
