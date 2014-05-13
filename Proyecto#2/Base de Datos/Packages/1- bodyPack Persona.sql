CREATE OR REPLACE PACKAGE BODY pack_persona AS

     --Funcion get nombre
     FUNCTION get_nombre(persona_id NUMBER)
          RETURN VARCHAR2  
     IS
          nombrePersona VARCHAR2(25);
     BEGIN
          SELECT nombre 
          INTO nombrePersona
          FROM persona
          WHERE persona.persona_id = persona_id;
          
          EXCEPTION

          WHEN NO_DATA_FOUND THEN
               DBMS_OUTPUT.put_line('El id es inválido');
          RETURN(nombrePersona);
     END;
     
     -- funcion get id
     FUNCTION get_id(nombre VARCHAR2) 
          RETURN NUMBER
          IS
               personaId NUMBER(6);
            
          BEGIN
               SELECT persona_id
               INTO personaId
               FROM persona
               WHERE persona.nombre = nombre;
           
               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');
               
               RETURN(personaId);

     END;

     --Procedimiento para insertar personas    
     PROCEDURE set_persona(nombre VARCHAR2, primerApellido VARCHAR2, segundoApellido VARCHAR2, genero VARCHAR2, fechaNacimiento DATE)
          IS
          BEGIN
               INSERT INTO persona
                    (persona_id, nombre, primerApellido, segundoApellido, genero, fechaNacimiento)
               VALUES          
                    (s_persona.nextval, nombre, primerApellido, segundoApellido, genero, fechaNacimiento);
     	       COMMIT;
     END;

     --Procedimiento para eliminar personas 
     PROCEDURE del_persona (persona_id NUMBER) 
          IS
          BEGIN
               DELETE FROM persona
               WHERE persona.persona_id = persona_id;
	       COMMIT;
     END;
     
     --Procedimiento para modificar personas
     PROCEDURE mod_persona(persona_id NUMBER, nombre VARCHAR2, primerApellido VARCHAR2, segundoApellido VARCHAR2, genero VARCHAR2, fechaNacimiento DATE)
          IS
          BEGIN
               UPDATE persona
               SET (nombre,primerApellido, segundoApellido, genero, fechaNacimiento) = (SELECT nombre,primerApellido, segundoApellido, genero, fechaNacimiento FROM DUAL)
               WHERE persona.persona_id = persona_id;
	       COMMIT;
     END;
     
END pack_persona;
