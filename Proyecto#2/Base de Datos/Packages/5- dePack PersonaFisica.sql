CREATE OR REPLACE PACKAGE pack_personaFisica IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_cedula(personaId NUMBER)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_personaFisica(cedulaFisica NUMBER, persona_id NUMBER);

END pack_personaFisica;
