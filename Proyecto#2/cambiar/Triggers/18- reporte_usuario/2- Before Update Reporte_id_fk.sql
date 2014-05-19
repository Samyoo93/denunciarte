CREATE OR REPLACE TRIGGER BefUpdate_report_reporte_usuar
     BEFORE UPDATE OF reporte_id
     ON reporte_usuario
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
               'reporte_usuario',
               'reporte_id',
               sysdate,
               :old.reporte_id,
               :new.reporte_id);
END BefUpdate_report_reporte_usuar;
