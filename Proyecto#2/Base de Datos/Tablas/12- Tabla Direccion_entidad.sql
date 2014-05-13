CREATE TABLE Direccion_entidad
(
     direccion_entidad_id NUMBER(6) 
          CONSTRAINT direccion_entidad_id_nn NOT NULL
          CONSTRAINT direccion_entidad_id_pk PRIMARY KEY,
     direccionExacta VARCHAR2(50)
          CONSTRAINT direccionExacta_nn NOT NULL,
     entidad_id_fk NUMBER(6)
          CONSTRAINT entidad_id_fk_DirecEnt_nn NOT NULL,
          CONSTRAINT entidad_id_fk_DirecEnt FOREIGN KEY(entidad_id_fk)
               REFERENCES entidad(entidad_id),     
     barrio_id_fk NUMBER(6)
          CONSTRAINT barrio_id_fk_nn NOT NULL,
          CONSTRAINT barrio_id_fk_DirecEnt FOREIGN KEY(barrio_id_fk)
               REFERENCES barrio(barrio_id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(25),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(25)   
);
