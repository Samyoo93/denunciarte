CREATE OR REPLACE PACKAGE pack_categoria IS

     --Procedimiento que retorna el id de la tabla categoria
     FUNCTION get_id(nombre_in VARCHAR2)RETURN NUMBER;

     --Procedimiento para llenar la tabla de categoria
     PROCEDURE set_categoria(nombre VARCHAR2, descripcion VARCHAR2, tipo varchar2);

END pack_categoria;
/
CREATE OR REPLACE PACKAGE BODY pack_categoria AS

     --Funcion get id
     FUNCTION get_id(nombre_in VARCHAR2)
          RETURN NUMBER
          IS
               categoriaId NUMBER(10);
               cursor c1 is
               SELECT categoria_id
               FROM categoria
               WHERE nombre = nombre_in;

          BEGIN
               open c1;
               fetch c1 into categoriaId;
               RETURN(categoriaId);
               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(categoriaId);

     END;

     --Procedimiento para insertar categorias
     PROCEDURE set_categoria(nombre VARCHAR2, descripcion VARCHAR2, tipo varchar2)
          IS
          BEGIN
               INSERT INTO categoria
                    (categoria_id, nombre, descripcion, tipo)
               VALUES
                    (s_categoria.nextval, nombre, descripcion, tipo);
               COMMIT;
     END;

END pack_categoria;
/
