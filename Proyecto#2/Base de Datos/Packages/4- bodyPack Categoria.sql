CREATE OR REPLACE PACKAGE BODY pack_categoria AS

     --Funcion get id
     FUNCTION get_id(nombre VARCHAR2)
          RETURN NUMBER
          IS
               categoriaId NUMBER(6);

          BEGIN
               SELECT categoria_id
               INTO categoriaId
               FROM categoria
               WHERE categoria.nombre = nombre;

               EXCEPTION
                    WHEN NO_DATA_FOUND THEN
                         DBMS_OUTPUT.put_line('El nombre es inválido');

               RETURN(categoriaId);

     END;

     --Procedimiento para insertar categorias
     PROCEDURE set_categoria(nombre VARCHAR2, descripcion VARCHAR2, tipo NUMBER)
          IS
          BEGIN
               INSERT INTO categoria
                    (categoria_id, nombre, descripcion, tipo)
               VALUES
                    (s_categoria.nextval, nombre, descripcion, tipo);
               COMMIT;
     END;

END pack_categoria;
