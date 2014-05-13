CREATE OR REPLACE PACKAGE BODY pack_categoria_personaFisica AS
   
     --Procedimiento para insertar categoria_personaFisica
     PROCEDURE set_CatPerFis(categoriaId NUMBER, cedulaFisica NUMBER)
          IS
          BEGIN
               INSERT INTO categoria_personaFisica
                    (categoria_persona_id, cedulaFisica_id_fk, categoria_id_fk)
               VALUES
                    (s_categoria_personafisica.nextval, cedulaFisica, categoriaId);
	       COMMIT;
     END;

END pack_categoria_personaFisica;
