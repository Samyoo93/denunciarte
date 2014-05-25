CREATE TABLE Review_entidad
(
     review_entidad_id NUMBER(6)
          CONSTRAINT review_entidad_id_pk PRIMARY KEY
          CONSTRAINT review_entidad_id_nn NOT NULL,
     review_id NUMBER(6)
          CONSTRAINT review_id_fk_RevEnt_nn NOT NULL,
          CONSTRAINT review_id_fk_RevEnt FOREIGN KEY(review_id)
               REFERENCES review(review_id),
     entidad_id NUMBER(9)
          CONSTRAINT entidad_id_fk_RevEnt_nn NOT NULL,
          CONSTRAINT entidad_id_fk_RevEnt FOREIGN KEY(entidad_id)
               REFERENCES entidad(entidad_id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(50),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(50)   
);
