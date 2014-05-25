CREATE TABLE Categoria_Entidad
(
     categoria_entidad_id  NUMBER(6)
          CONSTRAINT catEnt_Entidades_id_pk PRIMARY KEY
          CONSTRAINT catEnt_Entidades_id_nn NOT NULL,
     categoria_id NUMBER(6)
          CONSTRAINT categoria_id_fk_CatEnt_nn NOT NULL,
          CONSTRAINT categoria_id_fk_CatEnt FOREIGN KEY(categoria_id)
               REFERENCES categoria(categoria_id),
     entidad_id NUMBER(6)
          CONSTRAINT entidad_id_fk_CatEnt_nn NOT NULL,
          CONSTRAINT entidad_id_fk_CatEnt FOREIGN KEY(categoria_id)
               REFERENCES categoria(categoria_id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(25),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(25)   
);
