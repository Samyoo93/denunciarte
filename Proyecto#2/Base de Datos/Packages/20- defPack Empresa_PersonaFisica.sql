CREATE OR REPLACE PACKAGE pack_empresa_personaFisica IS

     --Procedimiento para llenar la tabla de categoria_personaFisica
     PROCEDURE set_empresa_personaFisica(empresaId NUMBER, cedulaFisica NUMBER);

END pack_empresa_personaFisica;
