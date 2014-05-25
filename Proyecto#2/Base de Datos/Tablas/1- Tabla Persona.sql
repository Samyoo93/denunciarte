CREATE TABLE Persona 
(
     persona_id NUMBER(6)
          CONSTRAINT persona_id_nn NOT NULL
          CONSTRAINT persona_id_pk PRIMARY KEY,
     nombre VARCHAR2(25)
          CONSTRAINT nombre_persona_nn NOT NULL,
     primerApellido VARCHAR2(25)
          CONSTRAINT primerApellido_nn NOT NULL,
     segundoApellido VARCHAR2(25)
          CONSTRAINT segundoApellido_nn NOT NULL,
     genero VARCHAR2(10)
          CONSTRAINT genero_nn NOT NULL,
     fechaNacimiento DATE
          CONSTRAINT fechaNacimiento_nn NOT NULL,
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(50),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(50)   
);
