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
/
CREATE OR REPLACE PACKAGE BODY pack_usuario AS

     --Funcion get nombre
     FUNCTION get_usuario(cedulaUsuario NUMBER)
          RETURN VARCHAR2
     IS
          nickName VARCHAR2(25);
     BEGIN
          SELECT usuario
          INTO nickName
          FROM usuario
          WHERE usuario.cedulaUsuario_id = cedulaUsuario;

          EXCEPTION

          WHEN NO_DATA_FOUND THEN
               DBMS_OUTPUT.put_line('La cedula es inválido');
          RETURN(nickName);
     END;

     -- funcion get cedula
     FUNCTION get_cedula(usuario VARCHAR2)
          RETURN NUMBER
          IS
               usuarioId NUMBER(9);

          BEGIN
               SELECT cedulaUsuario_id
               INTO usuarioId
               FROM usuario
               WHERE usuario.usuario = usuario;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nickName es inválido');

               RETURN(usuarioId);

     END;

     --Procedimiento para insertar personas
     PROCEDURE set_usuario(cedulaUsuario NUMBER, usuario VARCHAR2, contrasena VARCHAR2, privacidad NUMBER, estado NUMBER)
          IS
          BEGIN
               INSERT INTO usuario
                    (cedulaUsuario_id, usuario, contrasena, privacidad, estado)
               VALUES
                    (cedulaUsuario, usuario, contrasena, privacidad, estado);
  	       COMMIT;
     END;

     --Procedimiento para eliminar personas
     PROCEDURE del_usuario(cedulaUsuario NUMBER)
          IS
          BEGIN
               DELETE FROM usuario
               WHERE usuario.cedulausuario_id = cedulaUsuario;
	       COMMIT;
     END;

     --Procedimiento para modificar personas
     PROCEDURE mod_usuario(cedulaUsuario NUMBER, usuario VARCHAR2, contrasena VARCHAR2, privacidad NUMBER)
          IS
          BEGIN
               UPDATE usuario
               SET (cedulaUsuario_id, usuario, contrasena, privacidad) = (SELECT cedulaUsuario, usuario, contrasena, privacidad FROM DUAL)
               WHERE usuario.cedulausuario_id = cedulaUsuario;
	       COMMIT;
     END;
     
      FUNCTION confirmarPassword (Pcontrasena VARCHAR2, pusuario VARCHAR2)
        RETURN NUMBER
        IS contra VARCHAR2(30);
        BEGIN
          SELECT contrasena
          INTO contra
          from usuario
          where usuario.Usuario = pusuario;

          IF contra = Pcontrasena THEN
             update usuario
             set estado = 2
             where usuario = pusuario;
             return 1;
          else
            RETURN 0;
          end if;
      end;

END pack_usuario;
/
