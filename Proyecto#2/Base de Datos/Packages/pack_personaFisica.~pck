CREATE OR REPLACE PACKAGE pack_personaFisica IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_cedula(personaId NUMBER)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_personaFisica(cedulaFisica NUMBER, persona_id NUMBER);

     PROCEDURE mod_perfis(ced_id number, cargo_in varchar2, lugar_in varchar2);
     
END pack_personaFisica;
/
CREATE OR REPLACE PACKAGE BODY pack_personaFisica AS

     --Funcion para obtener la cedula de la tabla personaFisica
     FUNCTION get_cedula(personaId NUMBER)
          RETURN NUMBER
          IS
               cedula NUMBER(9);

          BEGIN
               SELECT cedulaFisica_id
               INTO cedula
               FROM personaFisica
               WHERE personaFisica.Persona_Id = personaId;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(cedula);
     END;

     --Procedimiento para insertar personasFisicas
     PROCEDURE set_personaFisica(cedulaFisica NUMBER, persona_id NUMBER)
          IS
          BEGIN
               INSERT INTO personaFisica
                    (cedulaFisica_id, persona_id)
               VALUES
                    (cedulaFisica, persona_id);
	       COMMIT;
     END;
      PROCEDURE mod_perfis(ced_id number, cargo_in varchar2, lugar_in varchar2)
          IS
               
          BEGIN
               UPDATE personafisica
               SET personafisica.cargo = cargo_in,
                   personafisica.lugartrabajo = lugar_in
               WHERE cedulafisica_id = ced_id;
          COMMIT;
     END;

END pack_personaFisica;
/
