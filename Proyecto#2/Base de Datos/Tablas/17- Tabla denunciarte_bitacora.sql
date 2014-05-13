--Crear la tabla denunciarte_bitacora

CREATE TABLE denunciarte_bitacora
(      
     bitacora_id NUMBER
          CONSTRAINT bitacora_id_nn NOT NULL 
          CONSTRAINT bitacora_id_pk PRIMARY KEY,
     nom_usuario VARCHAR2(30) DEFAULT 'Barnum@denunciarte',
     nom_tabla VARCHAR2(30)
          CONSTRAINT nomTabla_nn NOT NULL, 
     nom_campo VARCHAR2(30)
          CONSTRAINT nomCampo_nn NOT NULL,                 
     Fec_cambio DATE
          CONSTRAINT fecCambio_nn NOT NULL, 
     valor_anterior VARCHAR2(100)
          CONSTRAINT valorAnterior_nn NOT NULL, 
     valor_actual VARCHAR2(100)
          CONSTRAINT valorActual_nn NOT NULL 
)
