CREATE OR REPLACE PROCEDURE Banear (pcedulausuario_id NUMBER) IS numeroReportes number; numeroBans number;
BEGIN
  select u.numreportes
  into numeroReportes
  from usuario u
  where pcedulausuario_id = u.cedulausuario_id;
  select u.numBans
  into numeroBans
  from usuario u
  where pcedulausuario_id = u.cedulausuario_id;

  if (numeroBans = 2 and numeroReportes = 9) then
    update usuario
    set estado = -2,
        numbans = 3,
        numreportes = 0
        where pcedulausuario_id = cedulaUsuario_id;

  elsif ( numeroBans!=2 and numeroReportes = 9) then
    update usuario
    set  numBans = numbans + 1,
         estado = -1,
         numreportes = 0
         where pcedulausuario_id = cedulaUsuario_id;

  else
    update usuario
    set numreportes = numreportes + 1
    where pcedulausuario_id = cedulaUsuario_id;
  end if;
END;
/
