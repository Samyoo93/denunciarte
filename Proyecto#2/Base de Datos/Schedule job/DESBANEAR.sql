CREATE OR REPLACE PROCEDURE quitarBans IS
    pestado NUMBER;
    pfechaCreacion DATE;
    maximaFila NUMBER;
    pcedulausuario number;
    numeroBans number;
    estaOno number;
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

        select u.numBans
        into numeroBans
        from usuario u
        where pcedulausuario= u.cedulausuario_id;
--        select estado
--        into pestado
--          from(select *
--          from (select u.estado,rownum rn
--                from usuario u
--                where rownum <= fila+1)
--                 where rn > fila);


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
        else
          pfechaCreacion := sysdate;
        end if;
        
        if (pestado = -1) then
          if (numeroBans = 1) then
            if ((sysdate - pfechaCreacion) >= 7) then
              update usuario
              set estado = 1
              where pcedulaUsuario = usuario.cedulausuario_id;
             end if;
            elsif (numeroBans = 2) then
              if ((sysdate-pfechaCreacion )>=28) then
                update usuario
                set estado = 1
                where pcedulaUsuario = usuario.cedulausuario_id;
              end if;
           end if;
        END IF;
    END LOOP;
  END;
