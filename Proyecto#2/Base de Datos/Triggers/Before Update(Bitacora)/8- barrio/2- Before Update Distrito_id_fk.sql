CREATE OR REPLACE TRIGGER BefUpdate_distrito_id_barrio
     BEFORE UPDATE OF distrito_id_fk
     ON barrio
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
               'barrio',
               'distrito_id_fk',
               sysdate,
               :old.distrito_id_fk,
               :new.distrito_id_fk);
END BefUpdate_distrito_id_barrio;
