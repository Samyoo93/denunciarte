CREATE OR REPLACE TRIGGER BefUpdate_cedula_CatPerFis
     BEFORE UPDATE OF cedulaFisica_id_fk
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
               'cedulaFisica_id_fk',
               sysdate,
               :old.cedulaFisica_id_fk,
               :new.cedulaFisica_id_fk);
END BefUpdate_cedula_CatPerFis;
