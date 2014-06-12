CREATE OR REPLACE PROCEDURE quitarBans IS
    pestado NUMBER;
    pfechaCreacion DATE;
    maximaFila NUMBER;
    pcedulausuario number;
    numeroBans number;
    estaOno number;
    fecha varchar2(30);
  BEGIN
   SELECT MAX(ROWNUM)
       INTO maximaFila
        FROM usuario u;
    FOR fila in 0..(maximafila-1) LOOP
        select cedulausuario_id
        into pcedulausuario
        from (select * from
             (select u.cedulausuario_id,rownum rn
              from usuario u
              where rownum <=fila+1)
        where rn> fila);
DBMS_OUTPUT.PUT_LINE (pcedulausuario);
        select u.numBans
        into numeroBans
        from usuario u
        where pcedulausuario= u.cedulausuario_id;

       SELECT u.estado
        INTO pestado
        FROM usuario u
        WHERE pcedulausuario  = u.cedulausuario_id;


        select count(reporte.fecha_Creacion)
        into estaOno
        FROM reporte,usuario,reporte_usuario
        WHERE pcedulaUsuario = usuario.cedulausuario_id AND
              reporte_usuario.cedulausuario_id = usuario.cedulausuario_id
              AND reporte_usuario.reporte_id = reporte.reporte_id;
        if estaOno != 0 then
          SELECT *
        INTO pfechaCreacion
        FROM (SELECT reporte.fecha_creacion FROM reporte,usuario,reporte_usuario
              WHERE pcedulaUsuario = usuario.cedulausuario_id AND
              reporte_usuario.cedulausuario_id = usuario.cedulausuario_id
              AND reporte_usuario.reporte_id = reporte.reporte_id
              ORDER BY reporte.fecha_creacion DESC)
        WHERE ROWNUM = 1;
        SELECT TO_CHAR(pfechaCreacion, 'dd/mm/yyyy hh12:mi:ss')
        into fecha from dual;
        else
          pfechaCreacion := SYSTIMESTAMP;
          SELECT TO_CHAR(pfechaCreacion, 'dd/mm/yyyy hh12:mi:ss')
        into fecha from dual;
        end if;

        if (pestado = -1) then
          DBMS_OUTPUT.PUT_LINE ('entre antes del if');
          if (numeroBans = 1) then
            DBMS_OUTPUT.PUT_LINE('entre primer if');
            if (((EXTRACT (MINUTE FROM to_timestamp(fecha,  'dd/mm/yyyy hh12:mi:ss')))- (EXTRACT(MINUTE FROM SYSTIMESTAMP))>=7)
              OR (EXTRACT (MINUTE FROM to_timestamp(fecha,  'dd/mm/yyyy hh12:mi:ss')))- (EXTRACT(MINUTE FROM SYSTIMESTAMP))<=-7)then
             
              update usuario
              set estado = 1
              where pcedulaUsuario = usuario.cedulausuario_id;
             end if;
            elsif (numeroBans = 2) then
              if (((EXTRACT (MINUTE FROM to_timestamp(fecha,  'dd/mm/yyyy hh12:mi:ss')))- (EXTRACT(MINUTE FROM SYSTIMESTAMP))>=28)
              OR (EXTRACT (MINUTE FROM to_timestamp(fecha,  'dd/mm/yyyy hh12:mi:ss')))- (EXTRACT(MINUTE FROM SYSTIMESTAMP))<=-28) then
              

                update usuario
                set estado = 1
                where pcedulaUsuario = usuario.cedulausuario_id;
              end if;
           end if;
        END IF;
    END LOOP;
  END;
/
