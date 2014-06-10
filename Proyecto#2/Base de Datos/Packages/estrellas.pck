CREATE OR REPLACE PACKAGE estrellas IS
--name of the function
FUNCTION get_countPersonaFisica (pcalificacion NUMBER, pcedulaFisica NUMBER) RETURN NUMBER;
FUNCTION get_countEntidad (pcalificacion NUMBER,pcedulaJuridica NUMBER) RETURN NUMBER;
FUNCTION get_totalUsuarioDePF (pcedulaFisica NUMBER) RETURN NUMBER;
FUNCTION get_totalUsuarioDeEntidad (pcedulaJuridica NUMBER) RETURN NUMBER;
FUNCTION get_sumaCaliPersonaFisica (pcedulaFisica NUMBER) RETURN NUMBER;
FUNCTION get_sumaCaliEntidad (pcedulaJuridica NUMBER) RETURN NUMBER;


PROCEDURE calificarPersonaFisica( pnota VARCHAR2, pdescripcion VARCHAR2,pcedulaUsuario_id NUMBER, pcalificacion NUMBER, pcedulaFisica NUMBER, url VARCHAR2);
PROCEDURE calificarEntidad (pnota VARCHAR2, pdescripcion VARCHAR2,pcedulaUsuario_id NUMBER, pcalificacion NUMBER, pCedulaEntidad NUMBER, url VARCHAR2);

FUNCTION  has_ratedPersonaFisica(pcedulaUsuario NUMBER, pcedulaFisica NUMBER)RETURN NUMBER;
FUNCTION  has_ratedEntidad (pcedulaUsuario NUMBER, entidadId NUMBER) RETURN NUMBER;
END estrellas;
/
CREATE OR REPLACE PACKAGE BODY estrellas IS
FUNCTION get_countPersonaFisica (pcalificacion NUMBER, pcedulaFisica NUMBER)
RETURN NUMBER
AS cali NUMBER;
BEGIN
  SELECT COUNT(calificacion)
  INTO cali
  FROM review r,review_personafisica rpf , personaFisica pf
  WHERE r.calificacion = pcalificacion and pcedulaFisica = pf.cedulafisica_id and pf.cedulafisica_id = rpf.cedulafisica_id and rpf.review_id = r.review_id;
  RETURN cali;
END;


FUNCTION get_countEntidad (pcalificacion NUMBER, pcedulaJuridica NUMBER)
RETURN NUMBER
AS cali NUMBER;
BEGIN
  SELECT COUNT(calificacion)
  INTO cali
  FROM review r, entidad e ,review_entidad re
  WHERE r.calificacion = pcalificacion and pcedulaJuridica = e.cedulajuridica and e.entidad_id = re.entidad_id and re.review_id = r.review_id;
  RETURN cali;
END;


FUNCTION get_totalUsuarioDePF (pcedulaFisica NUMBER)
RETURN NUMBER
AS tot NUMBER;
BEGIN
  SELECT COUNT(r.review_id)
  INTO tot
  FROM review r, Review_Personafisica rpf, personafisica pf
  WHERE pcedulaFisica = rpf.cedulafisica_id and rpf.review_id = r.review_id and rpf.cedulafisica_id = pf.cedulafisica_id;
  RETURN tot;
END;

FUNCTION get_totalUsuarioDeEntidad(pcedulaJuridica NUMBER)
RETURN NUMBER
AS tot NUMBER;
BEGIN
  SELECT COUNT(r.review_id)
  INTO tot
  FROM review r, review_entidad re, entidad e
  WHERE pcedulaJuridica = e.cedulajuridica and re.review_id = r.review_id and re.entidad_id = e.entidad_id ;
  RETURN tot;
END;



FUNCTION get_sumaCaliPersonaFisica(pcedulaFisica NUMBER)
RETURN NUMBER
AS sumtotal NUMBER;
BEGIN
  SELECT SUM(calificacion)
  INTO sumtotal
  FROM review r, review_personafisica rpf, personaFisica pf
  WHERE pcedulaFisica = pf.cedulafisica_id and rpf.cedulafisica_id = pf.cedulafisica_id and r.review_id = rpf.review_id;
  RETURN sumtotal;
END;


FUNCTION get_sumaCaliEntidad (pcedulaJuridica  NUMBER)
RETURN NUMBER
AS sumtotal NUMBER;
BEGIN
  SELECT SUM(calificacion)
  INTO sumtotal
  FROM review r, entidad e, review_entidad re
  WHERE pcedulaJuridica = e.cedulajuridica and re.entidad_id = e.entidad_id and r.review_id = re.review_id;
  RETURN sumtotal;
END;


PROCEDURE calificarPersonaFisica (pnota VARCHAR2, pdescripcion VARCHAR2,pcedulaUsuario_id NUMBER, pcalificacion NUMBER, pcedulaFisica NUMBER, url VARCHAR2)AS
  BEGIN
    INSERT INTO review (review_id,nota,descripcion,calificacion,cedulausuario_id, url_file)
    VALUES (s_review.nextval,pnota,pdescripcion,pcalificacion,pcedulaUsuario_id, url);
    INSERT INTO review_personafisica (review_personafisica_id,review_id,cedulafisica_id)
    VALUES (s_review_personafisica.nextval,s_review.currval,pcedulaFisica);
    commit;
  END;

PROCEDURE calificarEntidad (pnota VARCHAR2, pdescripcion VARCHAR2,pcedulaUsuario_id NUMBER, pcalificacion NUMBER, pCedulaEntidad NUMBER, url VARCHAR2)AS
  BEGIN
    INSERT INTO review (review_id,nota,descripcion,calificacion,cedulausuario_id, url_file)
    VALUES (s_review.nextval,pnota,pdescripcion,pcalificacion,pcedulaUsuario_id, url);
    INSERT INTO review_entidad (review_entidad_id,review_id,entidad_id)
    VALUES (s_review_entidad.nextval,s_review.currval, pack_entidad.get_idPorCedula(pCedulaEntidad));
    commit;
 END;
 
 --------------------------
 
FUNCTION has_ratedPersonaFisica(pcedulaUsuario NUMBER, pcedulaFisica NUMBER) 
         
        return NUMBER
        is countCed NUMBER;
        BEGIN
            SELECT count(1) 
            into countCed     
            from review r, review_personafisica r_pf
            where r.cedulausuario_id = pcedulaUsuario and r_pf.cedulafisica_id = pcedulaFisica and r.review_id = r_pf.review_id;
            return countCed;
    END;
    
FUNCTION has_ratedEntidad(pcedulaUsuario NUMBER, entidadId NUMBER) 
         
        return NUMBER
        is countCed NUMBER;
        BEGIN
            SELECT count(1) 
            into countCed     
            from review r, review_entidad r_e
            where r.cedulausuario_id = pcedulaUsuario and r_e.entidad_id = entidadId and 
                  r.review_id = r_e.review_id;
            return countCed;
    END;    

END estrellas; 
/
