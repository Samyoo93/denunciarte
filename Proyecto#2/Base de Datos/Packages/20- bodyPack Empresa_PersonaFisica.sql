CREATE OR REPLACE PACKAGE BODY pack_empresa_personaFisica AS

     --Procedimiento para insertar categoria_personaFisica
     PROCEDURE set_empresa_personaFisica(empresaId NUMBER, cedulaFisica NUMBER)
          IS
          BEGIN
               INSERT INTO empresa_personaFisica
                    (empresa_personaFisica_id, empresa_id_fk, cedulaFisica_id_fk)
               VALUES
                    (s_empresa_personaFisica.nextval, empresaId, cedulaFisica);
            COMMIT;
     END;

END pack_empresa_personaFisica;
