--Definici�n del paquete perfil
--Para encontrar las funciones que corresponden a esta tabla.

CREATE OR REPLACE PACKAGE pack_usuario IS

     --Funcion que retorna el nickname por medio de la cedula.
     FUNCTION get_usuario(cedulaUsuario NUMBER)RETURN VARCHAR2;

     --Funcion que retorna la cedula por medio del nickname.
     FUNCTION get_cedula(usuario VARCHAR2) RETURN NUMBER;

     --Procedimiento para llenar la tabla de usuario
     PROCEDURE set_usuario(cedulaUsuario NUMBER, usuario VARCHAR2, contrasena VARCHAR2, privacidad NUMBER, estado NUMBER);

     --Procedimiento para eliminar el contenido de la tabla usuario
     PROCEDURE del_usuario(cedulaUsuario NUMBER);

     --Procedimiento para modificar el contenido de la tabla usuario
     PROCEDURE mod_usuario(cedulaUsuario NUMBER, usuario VARCHAR2, contrasena VARCHAR2, privacidad NUMBER);
     
     --Funcion para confirmacion del password
     FUNCTION confirmarPassword (Pcontrasena VARCHAR2, pusuario VARCHAR2)
       RETURN NUMBER;
       
END pack_usuario;
