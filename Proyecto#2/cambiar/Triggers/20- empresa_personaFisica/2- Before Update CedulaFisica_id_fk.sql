CREATE OR REPLACE TRIGGER BefUpdate_perFis_id_EmpPerFis
     BEFORE UPDATE OF cedulaFisica_id
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
               'cedulaFisica_id',
               sysdate,
               :old.cedulaFisica_id,
               :new.cedulaFisica_id);
END BefUpdate_perFis_id_EmpPerFis;
