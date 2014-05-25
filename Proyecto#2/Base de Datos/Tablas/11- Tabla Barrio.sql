CREATE TABLE Barrio
(
     barrio_id NUMBER(6)
          CONSTRAINT barrio_id_nn NOT NULL
          CONSTRAINT barrio_id_pk PRIMARY KEY,
     nombre VARCHAR2(25)
          CONSTRAINT nombre_barrio NOT NULL,
     distrito_id NUMBER(6)
          CONSTRAINT distrito_id_fk_nn NOT NULL,
          CONSTRAINT distrito_id_fk_barrio FOREIGN KEY(distrito_id)
               REFERENCES distrito(distrito_id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(50),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(50)   
);
