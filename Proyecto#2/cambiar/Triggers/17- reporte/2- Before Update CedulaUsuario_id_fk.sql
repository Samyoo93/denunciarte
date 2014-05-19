CREATE OR REPLACE TRIGGER BefUpdate_cedulaUsuari_reporte
     BEFORE UPDATE OF cedulausuario_id
     ON reporte
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
               'reporte',
               'cedulausuario_id',
               sysdate,
               :old.cedulausuario_id,
               :new.cedulausuario_id);
END BefUpdate_cedulaUsuari_reporte;
