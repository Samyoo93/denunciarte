CREATE OR REPLACE PACKAGE pack_persona IS

     --Funcion que retorna el nombre por medio del id.
     FUNCTION get_nombre(persona_id NUMBER)RETURN VARCHAR2;

     --Funcion que retorna el id por medio del nombre.
     FUNCTION get_id(nombre VARCHAR2) RETURN NUMBER;

     --Procedimiento para llenar datos del usuario
     PROCEDURE set_persona_usuario(nombre VARCHAR2, primerApellido VARCHAR2, segundoApellido VARCHAR2, genero VARCHAR2, fechaNacimiento date,
       usuario VARCHAR2, password VARCHAR2, cedula VARCHAR2, PRIVACIDAD number);
     
     --Procedmiento para llenar datos de persona_fisica
     PROCEDURE set_persona_fisica(nombre VARCHAR2, primerApellido VARCHAR2, segundoApellido VARCHAR2, genero VARCHAR2, 
       fechaNacimiento DATE, cedula VARCHAR2);
       
     --Procedimiento para eliminar el contenido de la tabla persona
     PROCEDURE del_persona (persona_id NUMBER);

     --Procedimiento para modificar el contenido de la tabla persona
     PROCEDURE mod_persona(persona_id NUMBER, nombre VARCHAR2, primerApellido VARCHAR2, segundoApellido VARCHAR2, genero VARCHAR2, fechaNacimiento DATE);

END pack_persona;
/
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

     --Procedimiento para insertar usuarios
     PROCEDURE set_persona_usuario(nombre VARCHAR2, primerApellido VARCHAR2, segundoApellido VARCHAR2, genero VARCHAR2, fechaNacimiento DATE,
       usuario VARCHAR2, password VARCHAR2, cedula VARCHAR2, privacidad number)
          IS
          BEGIN
               INSERT INTO persona
                    (persona_id, nombre, primerApellido, segundoApellido, genero, fechaNacimiento)
               VALUES
                    (s_persona.nextval, nombre, primerApellido, segundoApellido, genero, fechaNacimiento);
     	         INSERT INTO usuario
                     (persona_id_fk, usuario, contrasena, cedulausuario_id, privacidad, estado, numbans, numreportes)
               VALUES
                    (s_persona.currval, usuario, password, cedula, privacidad, 1, 0, 0);
             COMMIT;
     END;
     
     --Procedimiento para insertar usuarios
     PROCEDURE set_persona_fisica(nombre VARCHAR2, primerApellido VARCHAR2, segundoApellido VARCHAR2, genero VARCHAR2, 
       fechaNacimiento DATE, cedula VARCHAR2)
          IS
          BEGIN
               INSERT INTO persona
                    (persona_id, nombre, primerApellido, segundoApellido, genero, fechaNacimiento)
               VALUES
                    (s_persona.nextval, nombre, primerApellido, segundoApellido, genero, fechaNacimiento);
     	         INSERT INTO personafisica
                     (persona_id_fk, cedulafisica_id)
               VALUES
                    (s_persona.currval, cedula);
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
/
