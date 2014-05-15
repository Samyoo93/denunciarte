CREATE OR REPLACE PACKAGE pack_direccion_entidad IS

     --Procedimiento para llenar la tabla de categoria_personaFisica
    PROCEDURE set_direccion_entidad (exacta varchar2, nombre_barrio varchar2);

END pack_direccion_entidad;
