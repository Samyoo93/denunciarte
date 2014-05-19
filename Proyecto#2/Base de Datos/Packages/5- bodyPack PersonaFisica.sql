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
                         DBMS_OUTPUT.put_line('El nombre es inv�lido');

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

END pack_personaFisica;
