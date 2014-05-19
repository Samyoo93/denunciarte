CREATE TABLE Categoria_PersonaFisica
(    
     categoria_persona_id NUMBER(6)
          CONSTRAINT categoria_pesona_id_nn NOT NULL
          CONSTRAINT  pk_categoria_pesona_id PRIMARY KEY ,     
     cedulaFisica_id NUMBER(9)
          CONSTRAINT fisica_id_fk_CatPerFis_nn NOT NULL,
          CONSTRAINT fisica_id_fk_CatPerFis FOREIGN KEY(cedulaFisica_id)
               REFERENCES personaFisica(cedulaFisica_id),
     categoria_id NUMBER(6)
          CONSTRAINT categoria_id_fk_CatPerFis_nn NOT NULL,
          CONSTRAINT categoria_id_fk_CatPerFis FOREIGN KEY(categoria_id)
               REFERENCES categoria(categoria_id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(25),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(25)   
);
