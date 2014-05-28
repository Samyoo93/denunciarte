CREATE OR REPLACE PACKAGE estrellas IS
--name of the function
FUNCTION get_countPersonaFisica (pcalificacion NUMBER, pcedulaFisica NUMBER) RETURN NUMBER;
FUNCTION get_countEntidad (pcalificacion NUMBER,pentidad_id NUMBER) RETURN NUMBER;
FUNCTION get_totalUsuarioDePF (pcedulaFisica NUMBER) RETURN NUMBER;
FUNCTION get_totalUsuarioDeEntidad (pentidad_id NUMBER) RETURN NUMBER;
FUNCTION get_sumaCaliPersonaFisica (pcedulaFisica NUMBER) RETURN NUMBER;
FUNCTION get_sumaCaliEntidad (pentidad_id NUMBER) RETURN NUMBER;
 
PROCEDURE calificarPersonaFisica( pnota VARCHAR2, pdescripcion VARCHAR2,pcedulaUsuario_id NUMBER, pcalificacion NUMBER, pcedulaFisica NUMBER);

END estrellas;

CREATE OR REPLACE PACKAGE BODY estrellas IS
FUNCTION get_countPersonaFisica (pcalificacion NUMBER, pcedulaFisica NUMBER)
RETURN NUMBER
AS cali NUMBER;
BEGIN
  SELECT COUNT(calificacion) 
  INTO cali
  FROM review r,review_personafisica rpf , personaFisica pf
  WHERE r.calificacion = pcalificacion and pcedulaFisica = pf.cedulafisica_id and pf.cedulafisica_id = rpf.cedulafisica_id_fk and rpf.review_id_fk = r.review_id;
  RETURN cali;
END;


FUNCTION get_countEntidad (pcalificacion NUMBER, pentidad_id NUMBER) 
RETURN NUMBER
AS cali NUMBER;
BEGIN
  SELECT COUNT(calificacion) 
  INTO cali
  FROM review r, entidad e ,review_entidad re
  WHERE r.calificacion = pcalificacion and pentidad_id = r.cedulausuario_id_fk and r.cedulausuario_id_fk = re.entidad_id_fk and re.entidad_id_fk = e.entidad_id;
  RETURN cali;
END;


FUNCTION get_totalUsuarioDePF (pcedulaFisica NUMBER)
RETURN NUMBER
AS tot NUMBER;
BEGIN
  SELECT COUNT(review_id) 
  INTO tot
  FROM review r, Review_Personafisica rpf, personafisica pf
  WHERE pcedulaFisica = rpf.cedulafisica_id_fk and rpf.review_id_fk = r.review_id and rpf.cedulafisica_id_fk = pf.cedulafisica_id;
  RETURN tot;
END;

FUNCTION get_totalUsuarioDeEntidad(pentidad_id NUMBER)
RETURN NUMBER
AS tot NUMBER;
BEGIN
  SELECT COUNT(review_id) 
  INTO tot
  FROM review r, review_entidad re, entidad e
  WHERE pentidad_id = re.entidad_id_fk and re.review_id_fk = r.review_id and re.entidad_id_fk = e.entidad_id ;
  RETURN tot;
END;



FUNCTION get_sumaCaliPersonaFisica(pcedulaFisica NUMBER)
RETURN NUMBER
AS sumtotal NUMBER;
BEGIN
  SELECT SUM(calificacion)
  INTO sumtotal
  FROM review r, review_personafisica rpf, personaFisica pf
  WHERE pcedulaFisica = pf.cedulafisica_id and rpf.cedulafisica_id_fk = pf.cedulafisica_id and r.review_id = rpf.review_id_fk;
  RETURN sumtotal;
END;
  

FUNCTION get_sumaCaliEntidad (pentidad_id  NUMBER)
RETURN NUMBER
AS sumtotal NUMBER;
BEGIN
  SELECT SUM(calificacion)
  INTO sumtotal
  FROM review r, entidad e, review_entidad re
  WHERE  pentidad_id = e.entidad_id and re.entidad_id_fk = e.entidad_id and r.review_id = re.review_id_fk;
  RETURN sumtotal;
END;


PROCEDURE calificarPersonaFisica (pnota VARCHAR2, pdescripcion VARCHAR2,pcedulaUsuario_id NUMBER, pcalificacion NUMBER, pcedulaFisica NUMBER)AS
  BEGIN
    INSERT INTO review (review_id,nota,descripcion,calificacion,cedulausuario_id_fk)
    VALUES (s_review.nextval,pnota,pdescripcion,pcalificacion,pcedulaUsuario_id);
    INSERT INTO review_personafisica (review_personafisica_id,review_id_fk,cedulafisica_id_fk)
    VALUES (s_review_personafisica.nextval,s_review.currval,pcedulaFisica);
  END;


END estrellas;

