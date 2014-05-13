--Definición del paquete perfil
--Para encontrar las funciones que corresponden a esta tabla.

CREATE OR REPLACE PACKAGE pack_perfil IS

     --Funcion que retorna el nickname por medio de la cedula.
     FUNCTION get_usuario(cedulaUsuario NUMBER)RETURN VARCHAR2;

     --Funcion que retorna la cedula por medio del nickname.
     FUNCTION get_cedula(usuario VARCHAR2) RETURN NUMBER;

     --Procedimiento para llenar la tabla de perfil
     PROCEDURE set_perfil(cedulaUsuario NUMBER, usuario VARCHAR2, contrasena VARCHAR2, privacidad NUMBER, estado NUMBER);

     --Procedimiento para eliminar el contenido de la tabla perfil
     PROCEDURE del_perfil(cedulaUsuario NUMBER);

     --Procedimiento para modificar el contenido de la tabla perfil
     PROCEDURE mod_perfil(cedulaUsuario NUMBER, usuario VARCHAR2, contrasena VARCHAR2, privacidad NUMBER);

END pack_perfil;
