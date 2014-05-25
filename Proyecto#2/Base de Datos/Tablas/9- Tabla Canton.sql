CREATE TABLE Canton
(
     canton_id NUMBER(6)
          CONSTRAINT canton_id_nn NOT NULL
          CONSTRAINT canton_id_pk PRIMARY KEY,
     nombre VARCHAR2(25)
          CONSTRAINT nombre_canton NOT NULL,
     provincia_id NUMBER(6)
          CONSTRAINT provincia_id_fk_nn NOT NULL,
          CONSTRAINT provincia_id_fk_canton FOREIGN KEY(provincia_id)
               REFERENCES provincia(provincia_id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(50),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(50)   
);
