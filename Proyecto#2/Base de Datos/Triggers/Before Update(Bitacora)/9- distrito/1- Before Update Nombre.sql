CREATE OR REPLACE TRIGGER BefUpdate_nombre_distrito
     BEFORE UPDATE OF nombre
     ON distrito
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
               'distrito',
               'nombre',
               sysdate,
               :old.nombre,
               :new.nombre);
END BefUpdate_nombre_distrito;
