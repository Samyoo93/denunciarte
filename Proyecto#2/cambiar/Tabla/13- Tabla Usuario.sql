CREATE TABLE Usuario
(
     cedulaUsuario_id NUMBER(9)
          CONSTRAINT cedulaUsuario_id_pk PRIMARY KEY
          CONSTRAINT cedulaUsuario_id_nn NOT NULL,
     usuario VARCHAR2(25)
          CONSTRAINT usuario_nn NOT NULL,
     contrasena VARCHAR2(15)
          CONSTRAINT contrasena_nn NOT NULL,
     privacidad NUMBER(1)
          CONSTRAINT privacidad_nn NOT NULL,
     estado NUMBER(1)
          CONSTRAINT estado_nn NOT NULL,
     persona_id NUMBER(6)
          CONSTRAINT persona_id_fk_perfil_nn NOT NULL,
          CONSTRAINT persona_id_fk_perfil FOREIGN KEY(persona_id)
               REFERENCES persona(persona_id),
     numBans NUMBER(1),
     numReportes NUMBER(2), 
     fecha_creacion DATE,
     usuario_creacion VARCHAR2(25),
     fec_ultima_modificacion DATE,
     usuario_ultima_modificacion VARCHAR2(25)   
);
