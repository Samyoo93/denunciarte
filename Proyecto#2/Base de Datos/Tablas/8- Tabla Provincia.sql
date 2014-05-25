CREATE TABLE Provincia
(
     provincia_id NUMBER(6)
          CONSTRAINT provincia_id_nn NOT NULL
          CONSTRAINT provincia_id_pk PRIMARY KEY,
     nombre VARCHAR2(25)
          CONSTRAINT nombre_provincia NOT NULL,
     pais_id NUMBER(6)
          CONSTRAINT pais_id_fk_nn NOT NULL,
          CONSTRAINT pais_id_fk_provincia FOREIGN KEY(pais_id)
               REFERENCES pais(pais_id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(50),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(50)   
);
