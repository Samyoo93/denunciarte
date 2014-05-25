-- Creación de tablespace
--
-- DenunciARTE: DATA
CREATE TABLESPACE DenunciARTE_Data
DATAFILE 'C:\app\Kathy\oradata\KathyOracle\DenunciARTEdata01.dbf'
SIZE 10M
REUSE
AUTOEXTEND ON
NEXT 512k
MAXSIZE 200M;
-- DenunciARTE: INDEX
CREATE TABLESPACE DenunciARTE_Ind
DATAFILE 'C:\app\Kathy\oradata\KathyOracle\DenunciARTEind01.dbf'
SIZE 10M
REUSE
AUTOEXTEND ON
NEXT 512k
MAXSIZE 200M;
-- Creacion usuario
CREATE USER DenunciARTE
IDENTIFIED BY DenunciARTE
DEFAULT TABLESPACE DenunciARTE_data
QUOTA 10M ON DenunciARTE_data
TEMPORARY TABLESPACE temp
--Roles de la BD
CREATE ROLE DenunciARTEAdm
IDENTIFIED BY DenunciARTEAdm
GRANT CONNECT TO DenunciARTEAdm
grant create public synonym to DenunciARTE;
grant create session to DenunciARTE;
grant create table to DenunciARTE;
grant create view to DenunciARTE;



