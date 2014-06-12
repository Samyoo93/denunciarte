create or replace procedure updateMaxNumReportes(pnumeroMax number) is
begin
  update parametrizable
  set parametro = pnumeroMax
  where parametrizable_id = 1;
end;
/
