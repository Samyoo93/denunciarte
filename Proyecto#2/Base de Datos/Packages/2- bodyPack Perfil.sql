CREATE OR REPLACE PACKAGE BODY pack_perfil AS

     --Funcion get nombre
     FUNCTION get_usuario(cedulaUsuario NUMBER)
          RETURN VARCHAR2
     IS
          nickName VARCHAR2(25);
     BEGIN
          SELECT usuario
          INTO nickName
          FROM perfil
          WHERE perfil.cedulaUsuario_id = cedulaUsuario;

          EXCEPTION

          WHEN NO_DATA_FOUND THEN
               DBMS_OUTPUT.put_line('La cedula es inválido');
          RETURN(nickName);
     END;

     -- funcion get cedula
     FUNCTION get_cedula(usuario VARCHAR2)
          RETURN NUMBER
          IS
               perfilId NUMBER(9);

          BEGIN
               SELECT cedulaUsuario_id
               INTO perfilId
               FROM perfil
               WHERE perfil.usuario = usuario;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nickName es inválido');

               RETURN(perfilId);
               
     END;

     --Procedimiento para insertar personas
     PROCEDURE set_perfil(cedulaUsuario NUMBER, usuario VARCHAR2, contrasena VARCHAR2, privacidad NUMBER, estado NUMBER)
          IS
          BEGIN
               INSERT INTO perfil
                    (cedulaUsuario_id, usuario, contrasena, privacidad, estado)
               VALUES
                    (cedulaUsuario, usuario, contrasena, privacidad, estado);
  	       COMMIT;
     END;

     --Procedimiento para eliminar personas
     PROCEDURE del_perfil(cedulaUsuario NUMBER)
          IS
          BEGIN
               DELETE FROM perfil
               WHERE perfil.cedulausuario_id = cedulaUsuario;
	       COMMIT;
     END;

     --Procedimiento para modificar personas
     PROCEDURE mod_perfil(cedulaUsuario NUMBER, usuario VARCHAR2, contrasena VARCHAR2, privacidad NUMBER)
          IS
          BEGIN
               UPDATE perfil
               SET (cedulaUsuario_id, usuario, contrasena, privacidad) = (SELECT cedulaUsuario, usuario, contrasena, privacidad FROM DUAL)
               WHERE perfil.cedulausuario_id = cedulaUsuario;
	       COMMIT;
     END;

END pack_perfil;
