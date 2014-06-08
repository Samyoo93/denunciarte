CREATE OR REPLACE PACKAGE busquedas IS
--name of the function

    --Busquedas de persona fisicas
    FUNCTION personaPorNombre(pnombre VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION personaPorPrimerApellido (pprimerApellido VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION personaPorSegundoApellido (psegundoApellido VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION personaPorCedula (pcedula NUMBER) RETURN TYPES.ref_c;
    FUNCTION personaPorId(personaId NUMBER)return TYPES.ref_c;
    FUNCTION personaPorCategoria(pcategoria VARCHAR2) RETURN TYPES.ref_c;

    --Busquedas de persona juridicas
    FUNCTION entidadPorNombre(pEntidad VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION entidadPorCedula(cedula VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION entidadPorCategoria(pcategoria VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION entidadPorId(entidadId NUMBER)RETURN TYPES.ref_c;
    
     --Busquedas de usuario
    FUNCTION usuarioPorCedula (pcedula NUMBER) RETURN TYPES.ref_c;
    
    --Busquedas de categorias
    FUNCTION categoriaPorNombre (pCategoria VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION categoriaPorId (pid NUMBER) RETURN TYPES.ref_c;
    FUNCTION categoriaPorTipo(pTipo VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION categoriaPorAlfabetico(letra VARCHAR2) RETURN TYPES.ref_c;
    
    --Busquedas de reviews
    FUNCTION reviewPorCedulaPersona(cedula NUMBER)RETURN TYPES.ref_c;
    FUNCTION reviewPorCedulaPersonaEntidad(cedula NUMBER)RETURN TYPES.ref_c;
    FUNCTION reviewEntidadPorUsuario(cedula NUMBER)RETURN TYPES.ref_c;
    FUNCTION reviewPersonaFPorUsuario(cedula NUMBER)RETURN TYPES.ref_c;
END busquedas;
/
CREATE OR REPLACE PACKAGE BODY busquedas IS
--here goes every functions called on the package.
    FUNCTION personaPorNombre(pnombre IN varchar2)
        return TYPES.ref_c
        AS l_cursor types.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT p.persona_id, p.nombre,p.primerapellido,p.segundoapellido,p.genero,p.fechanacimiento,
                   pf.cedulafisica_id, pf.lugartrabajo
            from persona p, personafisica pf
            where p.nombre LIKE '%' || pnombre || '%' and p.persona_id = pf.persona_id
            order by p.nombre;
            return l_cursor;
    END;
    
    FUNCTION personaPorPrimerApellido(pprimerApellido VARCHAR2)
        return TYPES.ref_c
        AS l_cursor types.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT p.persona_id,p.nombre,p.primerapellido,p.segundoapellido,
                   p.genero,p.fechanacimiento, pf.cedulafisica_id, pf.lugartrabajo
            from persona p, personafisica pf
            where p.primerapellido like '%' || pprimerApellido || '%' and p.persona_id = pf.persona_id;
            return l_cursor;
    END;
    
    FUNCTION personaPorSegundoApellido(psegundoApellido VARCHAR2)
        return TYPES.ref_c
        AS l_cursor types.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT p.persona_id,p.nombre,p.primerapellido,p.segundoapellido,
                   p.genero, p.fechanacimiento, pf.cedulafisica_id, pf.lugartrabajo
            from persona p, personafisica pf
            where p.segundoapellido LIKE '%' || psegundoApellido || '%' and p.persona_id = pf.persona_id;
            return l_cursor;
    END;
    
    
    FUNCTION personaPorCedula(pcedula IN NUMBER)
        return TYPES.ref_c
        AS l_cursor types.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT p.persona_id, p.nombre,p.primerapellido, p.segundoapellido, p.genero,
                   p.fechanacimiento, pf.cedulafisica_id, pf.lugartrabajo
            from persona p, personafisica pf
            where pf.cedulafisica_id = pcedula and p.persona_id = pf.persona_id;
            return l_cursor;
    END;
    
    FUNCTION personaPorId(personaId NUMBER)
        return TYPES.ref_c
        AS l_cursor types.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT p.persona_id,p.nombre,p.primerapellido,p.segundoapellido,p.genero,p.fechanacimiento,
                   pf.cedulafisica_id, pf.lugartrabajo, pf.cargo
            from persona p, personafisica pf
            where p.persona_id = personaId and p.persona_id = pf.persona_id
            order by p.nombre;
            return l_cursor;
    END;

    FUNCTION personaPorCategoria(pcategoria VARCHAR2)
        RETURN TYPES.ref_c
        AS l_cursor TYPES.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT p.persona_id,p.nombre,p.primerapellido,p.segundoApellido,p.genero,
                   p.fechaNacimiento, pf.cedulafisica_id, pf.lugartrabajo
            FROM persona p, personafisica pf, categoria_personafisica cp, categoria c
            WHERE c.nombre like '%' || pcategoria || '%' and c.categoria_id = cp.categoria_id and
                  cp.cedulaFisica_id = pf.cedulafisica_id and pf.persona_id = p.persona_id
             ORDER BY p.nombre;
            RETURN l_cursor;
    END;

    FUNCTION entidadPorNombre(pEntidad VARCHAR2)
        RETURN TYPES.ref_c
        AS l_cursor TYPES.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT e.entidad_id, e.nombre, e.cedulajuridica, dn.direccionexacta, b.nombre, 
                   d.nombre, c.nombre, p.nombre, pais.nombre 
            FROM entidad e, direccion_entidad dn, barrio b, distrito d, canton c, provincia p,
                 pais
            WHERE e.nombre like '%' || pEntidad || '%' and e.entidad_id = dn.entidad_id and 
                  dn.barrio_id = b.barrio_id and b.distrito_id = d.distrito_id and 
                  d.canton_id = c.canton_id and c.provincia_id = p.provincia_id and
                  p.pais_id = pais.pais_id;
            RETURN l_cursor;
    END;
    
    FUNCTION entidadPorCedula(cedula VARCHAR2)
        RETURN TYPES.ref_c
        AS l_cursor TYPES.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT e.entidad_id, e.nombre, e.cedulajuridica, 
                   dn.direccionexacta, b.nombre, d.nombre, 
                   c.nombre, p.nombre, pais.nombre
            FROM entidad e, direccion_entidad dn, barrio b, distrito d, canton c, provincia p,
                 pais
            WHERE e.cedulajuridica = cedula and e.entidad_id = dn.entidad_id and 
                  dn.barrio_id = b.barrio_id and b.distrito_id = d.distrito_id and 
                  d.canton_id = c.canton_id and c.provincia_id = p.provincia_id and
                  p.pais_id = pais.pais_id;
            RETURN l_cursor;
    END;
    
    FUNCTION entidadPorCategoria (pcategoria VARCHAR2)
        RETURN TYPES.ref_c
        AS l_cursor TYPES.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT cat.nombre, e.nombre, e.cedulajuridica, de.direccionexacta, 
                   b.nombre, d.nombre, c.nombre, p.nombre, pais.nombre
            FROM categoria cat, categoria_entidad ce, entidad e, direccion_entidad de,
                 barrio b, distrito d, canton c, provincia p, pais
            WHERE cat.nombre like '%' || pcategoria || '%' and cat.categoria_id= ce.categoria_id and
                  ce.entidad_id = e.entidad_id and e.entidad_id = de.entidad_id and
                  de.barrio_id = b.barrio_id and b.distrito_id = d.distrito_id and 
                  d.canton_id = c.canton_id and c.provincia_id = p.provincia_id and
                  p.pais_id = pais.pais_id;

            RETURN l_cursor;
    END;
    
    FUNCTION entidadPorId(entidadId NUMBER)
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
          BEGIN
               OPEN l_cursor FOR
               SELECT e.nombre, e.cedulajuridica, dn.direccionexacta, b.nombre, 
                    d.nombre, c.nombre, p.nombre, pais.nombre, e.entidad_id
               FROM entidad e, direccion_entidad dn, barrio b, distrito d, canton c, provincia p,
                pais
          WHERE e.entidad_id = entidadId and e.entidad_id = dn.entidad_id and 
                 dn.barrio_id = b.barrio_id and b.distrito_id = d.distrito_id and 
                 d.canton_id = c.canton_id and c.provincia_id = p.provincia_id and
                 p.pais_id = pais.pais_id;
          RETURN l_cursor;
    END;
    
    FUNCTION usuarioPorCedula(pcedula IN NUMBER)
        return TYPES.ref_c
        AS l_cursor types.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT p.persona_id, p.nombre,p.primerapellido, p.segundoapellido, p.genero,
                   p.fechanacimiento, u.usuario, u.cedulausuario_id 
            from persona p, usuario u
            where u.cedulausuario_id = pcedula and p.persona_id = u.persona_id;
            return l_cursor;
    END;

    FUNCTION categoriaPorNombre(pCategoria VARCHAR2)
        RETURN TYPES.ref_c
        AS l_cursor TYPES.ref_c;
        BEGIN
            OPEN l_cursor FOR
            SELECT c.categoria_id,c.nombre,c.descripcion,c.tipo
            FROM categoria c
            WHERE c.nombre like '%' || pCategoria || '%'
            ORDER BY c.nombre;
            RETURN l_cursor;
    END;

     FUNCTION categoriaPorId(pid NUMBER)
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
          BEGIN
               OPEN l_cursor FOR
               SELECT c.categoria_id,c.nombre,c.descripcion,c.tipo
               FROM categoria c
               WHERE pid = c.categoria_id
               ORDER BY c.nombre;
               RETURN l_cursor;
     END;

     FUNCTION categoriaPorTipo (pTipo VARCHAR2)
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
          BEGIN
               OPEN l_cursor FOR
               SELECT c.categoria_id,c.nombre,c.descripcion,c.tipo, p.nombre,p.primerapellido,p.segundoapellido,pf.cedulafisica_id
               FROM categoria c,categoria_personafisica cpf, personafisica pf, persona p
               WHERE pTipo = c.tipo AND c.categoria_id = cpf.categoria_id AND cpf.cedulafisica_id = pf.cedulafisica_id 
                    AND pf.persona_id = p.persona_id;
               RETURN l_cursor;
     END;
     
     FUNCTION categoriaPorAlfabetico(letra VARCHAR2) 
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
           BEGIN
               OPEN l_cursor FOR
               SELECT c.categoria_id,c.nombre,c.descripcion,c.tipo
               FROM categoria c
               WHERE c.nombre LIKE letra || '%';
               RETURN l_cursor;
     END;
     
     FUNCTION reviewPorCedulaPersona (cedula NUMBER)
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
          BEGIN
               OPEN l_cursor FOR
               SELECT r.nota, r.descripcion, r.calificacion, p.nombre, p.primerapellido, 
                      p.segundoapellido, u.cedulausuario_id
               FROM personaFisica pf, review_personaFisica rpf, review r, usuario u, persona p
               WHERE pf.cedulafisica_id = cedula and pf.cedulafisica_id = rpf.cedulafisica_id and
                     rpf.review_id = r.review_id and r.cedulausuario_id = u.cedulausuario_id and
                     u.persona_id = p.persona_id;
               RETURN l_cursor;
     END;
     
     
     FUNCTION reviewPorCedulaPersonaEntidad(cedula NUMBER)
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
          BEGIN
               OPEN l_cursor FOR
               SELECT r.nota, r.descripcion, r.calificacion, p.nombre, p.primerapellido, 
                      p.segundoapellido, u.cedulausuario_id
               FROM entidad e, review_entidad re, review r, usuario u, persona p
               WHERE e.cedulajuridica = cedula and e.entidad_id = re.entidad_id and 
                     re.review_id = r.review_id and r.cedulausuario_id = u.cedulausuario_id and 
                     u.persona_id = p.persona_id;
               RETURN l_cursor;
     END;
     
     FUNCTION reviewEntidadPorUsuario(cedula NUMBER)
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
          BEGIN
               OPEN l_cursor FOR
               SELECT r.nota, r.descripcion, r.calificacion, e.nombre
               FROM entidad e, review_entidad re, review r, usuario u
               WHERE u.cedulausuario_id = cedula and u.cedulausuario_id = r.cedulausuario_id 
                     and r.review_id = re.review_id and re.entidad_id = e.entidad_id;
               RETURN l_cursor;
     END;
     
    FUNCTION reviewPersonaFPorUsuario(cedula NUMBER)
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
          BEGIN
               OPEN l_cursor FOR
               SELECT r.nota, r.descripcion, r.calificacion, p.nombre, p.primerapellido,
                      p.segundoapellido
               FROM personaFisica pf, review_personaFisica rpf, review r, usuario u, persona p
               WHERE u.cedulausuario_id = cedula and u.cedulausuario_id = r.cedulausuario_id 
                     and r.review_id = rpf.review_id and rpf.cedulafisica_id = 
                     pf.cedulafisica_id and pf.persona_id = p.persona_id;
               RETURN l_cursor;
     END;
     
END busquedas;
/
