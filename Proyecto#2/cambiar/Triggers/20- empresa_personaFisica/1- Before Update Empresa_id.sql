CREATE OR REPLACE TRIGGER BefUpdate_empresa_id_EmpPerFis
     BEFORE UPDATE OF empresa_id
     ON empresa_personaFisica
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
               'empresa_personaFisica',
               'empresa_id',
               sysdate,
               :old.empresa_id,
               :new.empresa_id);
END BefUpdate_empresa_id_EmpPerFis;
