CREATE TABLE Review_personaFisica
(
     review_personaFisica_id NUMBER(6)
          CONSTRAINT review_personaFisica_id_pk PRIMARY KEY
          CONSTRAINT review_personaFisica_id_nn NOT NULL,
     review_id_fk NUMBER(6)
          CONSTRAINT review_id_fk_RevPerFis_nn NOT NULL,
          CONSTRAINT review_id_fk_RevPerFis FOREIGN KEY(review_id_fk)
               REFERENCES review(review_id),
     cedulaFisica_id_fk   NUMBER(9)
          CONSTRAINT fisica_id_fk_RevPerFis_nn NOT NULL,
          CONSTRAINT fisica_id_fk_RevPerFis FOREIGN KEY(cedulaFisica_id_fk)
               REFERENCES personaFisica(cedulafisica_Id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(25),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(25)   
);
