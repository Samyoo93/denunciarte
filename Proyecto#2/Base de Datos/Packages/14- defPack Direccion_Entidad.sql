CREATE OR REPLACE PACKAGE pack_direccion_entidad IS

     --Procedimiento para llenar la tabla de categoria_personaFisica
     PROCEDURE set_direccion_entidad(direccion VARCHAR2, barrioId NUMBER, entidadId NUMBER);

END pack_direccion_entidad;
