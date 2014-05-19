CREATE OR REPLACE TRIGGER BefUpdate_cedula_reporte_usuar
     BEFORE UPDATE OF cedulaUsuario_id
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
               'cedulaUsuario_id',
               sysdate,
               :old.cedulaUsuario_id,
               :new.cedulaUsuario_id);
END BefUpdate_cedula_reporte_usuar;
