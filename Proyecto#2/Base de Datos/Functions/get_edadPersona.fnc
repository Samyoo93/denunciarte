CREATE OR REPLACE FUNCTION get_edadPersona(pid_persona NUMBER)
RETURN NUMBER
IS nacimiento DATE;
BEGIN
  SELECT p.fechanacimiento
  INTO nacimiento
  FROM persona p
  WHERE pid_persona = persona_id;
  RETURN(TRUNC((SYSDATE - nacimiento)/365));
END;
/
