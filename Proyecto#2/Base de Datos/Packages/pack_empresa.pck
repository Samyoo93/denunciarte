CREATE OR REPLACE PACKAGE pack_empresa IS

     --Procedimiento que retorna el id de la tabla empresa
     FUNCTION get_id(nombre VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de empresa
     PROCEDURE set_empresa(nombre VARCHAR2);

END pack_empresa;
/
CREATE OR REPLACE PACKAGE BODY pack_empresa AS

     --Funcion get id
     FUNCTION get_id(nombre VARCHAR2)
          RETURN NUMBER
          IS
               empresaId NUMBER(6);

          BEGIN
               SELECT empresa_id
               INTO empresaId
               FROM empresa
               WHERE empresa.nombre = nombre;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(empresaId);
     END;

     --Procedimiento para insertar empresa
     PROCEDURE set_empresa(nombre VARCHAR2)
          IS
          BEGIN
               INSERT INTO empresa
                    (empresa_id, nombre)
               VALUES
                    (s_empresa.nextval, nombre);
               COMMIT;
     END;

END pack_empresa;
/
