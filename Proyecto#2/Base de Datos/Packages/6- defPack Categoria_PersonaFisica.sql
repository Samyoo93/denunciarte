CREATE OR REPLACE PACKAGE pack_categoria_PersonaFisica IS

     --Procedimiento para llenar la tabla de categoria_personaFisica
     PROCEDURE set_CatPerFis(categoriaId NUMBER, cedulaFisica NUMBER);

END pack_categoria_PersonaFisica;
