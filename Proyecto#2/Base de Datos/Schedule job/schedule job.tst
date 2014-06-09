PL/SQL Developer Test script 3.0
17
-- Created on 6/8/2014 by SAM YOO 
declare 
  -- Local variables here
  i integer;
begin
  -- Test statements here
  DBMS_SCHEDULER.create_job(
     job_name => 'elDesBaneador',
     job_type => 'PLSQL_BLOCK',
     job_action => 'BEGIN quitarbans; END;',
     start_date => SYSTIMESTAMP,
     repeat_interval => 'freq = minutely',
     end_date =>to_date ('13-Jun-2014', 'DD-MM-YYYY'),
     enabled => TRUE
  
  );
end;
0
0
