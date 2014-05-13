CREATE OR REPLACE PACKAGE pack_categoria_entidad IS

     --Procedimiento para llenar la tabla de categoria_personaFisica
     PROCEDURE set_categoria_entidad(categoriaId NUMBER, entidadId NUMBER);

END pack_categoria_entidad;
