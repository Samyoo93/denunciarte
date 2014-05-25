CREATE TABLE Distrito
(
     distrito_id NUMBER(6)
          CONSTRAINT distrito_id_nn NOT NULL
          CONSTRAINT distrito_id_pk PRIMARY KEY,
     nombre VARCHAR2(25)
          CONSTRAINT nombre_distrito NOT NULL,
     canton_id_fk NUMBER(6)
          CONSTRAINT canton_id_fk_nn NOT NULL,
          CONSTRAINT canton_id_fk_distrito FOREIGN KEY(canton_id_fk)
               REFERENCES canton(canton_id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(25),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(25)   
);
