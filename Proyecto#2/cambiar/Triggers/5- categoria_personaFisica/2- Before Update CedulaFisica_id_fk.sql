CREATE OR REPLACE TRIGGER BefUpdate_cedula_CatPerFis
     BEFORE UPDATE OF cedulaFisica_id
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
               'cedulaFisica_id',
               sysdate,
               :old.cedulaFisica_id,
               :new.cedulaFisica_id);
END BefUpdate_cedula_CatPerFis;
