--Definici�n del paquete persona
--Para encontrar las funciones que corresponden a esta tabla.

CREATE OR REPLACE PACKAGE pack_persona IS

     --Funcion que retorna el nombre por medio del id.
     FUNCTION get_nombre(persona_id NUMBER)RETURN VARCHAR2;

     --Funcion que retorna el id por medio del nombre.
     FUNCTION get_id(nombre VARCHAR2) RETURN NUMBER;

     --Procedimiento para llenar la tabla de persona
     PROCEDURE set_persona(nombre VARCHAR2, primerApellido VARCHAR2, segundoApellido VARCHAR2, genero VARCHAR2, fechaNacimiento date,
       usuario VARCHAR2, password VARCHAR2, cedula VARCHAR2, PRIVACIDAD number);

     --Procedimiento para eliminar el contenido de la tabla persona
     PROCEDURE del_persona (persona_id NUMBER);

     --Procedimiento para modificar el contenido de la tabla persona
     PROCEDURE mod_persona(persona_id NUMBER, nombre VARCHAR2, primerApellido VARCHAR2, segundoApellido VARCHAR2, genero VARCHAR2, fechaNacimiento DATE);

END pack_persona;
