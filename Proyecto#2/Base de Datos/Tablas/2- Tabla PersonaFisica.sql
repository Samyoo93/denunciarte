CREATE TABLE PersonaFisica
(
     cedulaFisica_id NUMBER(9)
          CONSTRAINT cedulaFisica_id_nn NOT NULL
          CONSTRAINT cedulaFisica_id_pk PRIMARY KEY, 
     persona_id NUMBER(6)
          CONSTRAINT persona_id_fk_PersonaFisica_nn NOT NULL,
          CONSTRAINT persona_id_fk_PersonaFisica FOREIGN KEY (persona_id)
               REFERENCES persona(persona_id),
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(25),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(25)      
);
