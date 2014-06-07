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
    --Busquedas de categorias
    FUNCTION categoriaPorNombre (pCategoria VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION categoriaPorId (pid NUMBER) RETURN TYPES.ref_c;
    FUNCTION categoriaPorTipo(pTipo VARCHAR2) RETURN TYPES.ref_c;

    --Busquedas de usuario
    FUNCTION usuarioPorCedula (pcedula NUMBER) RETURN TYPES.ref_c;
   
    FUNCTION buscarPorCategoriaConPF (pcategoria VARCHAR2) RETURN TYPES.ref_c;
    FUNCTION reviewPorNombre (pnombre VARCHAR2) RETURN TYPES.ref_c;
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
            where INSTR(p.nombre, pnombre) > 0 and p.persona_id = pf.persona_id
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
            where INSTR(p.primerapellido, pprimerApellido) > 0 and p.persona_id = pf.persona_id;
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
            where INSTR(p.segundoapellido, psegundoApellido) > 0 and p.persona_id = pf.persona_id;
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
            WHERE INSTR(c.nombre, pcategoria) > 0 and c.categoria_id = cp.categoria_id and
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
            WHERE INSTR(e.nombre, pEntidad) > 0 and e.entidad_id = dn.entidad_id and
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
            WHERE INSTR(cat.nombre, pcategoria) > 0 and cat.categoria_id= ce.categoria_id and
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
                    d.nombre, c.nombre, p.nombre, pais.nombre
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
            WHERE INSTR(c.nombre, pCategoria) > 0
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

     FUNCTION buscarPorCategoriaConPF (pcategoria VARCHAR2)
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
          BEGIN
               OPEN l_cursor FOR
               SELECT c.categoria_id,c.nombre,c.descripcion,c.tipo, p.nombre,p.primerapellido,p.segundoapellido,pf.cedulafisica_id
               FROM categoria c,categoria_personafisica cpf, personafisica pf, persona p
               WHERE pcategoria = c.nombre AND cpf.categoria_id = c.categoria_id AND cpf.cedulafisica_id = pf.cedulafisica_id
                    AND p.persona_id = pf.persona_id;
               RETURN l_cursor;
     END;

     FUNCTION reviewPorNombre (pnombre VARCHAR2)
          RETURN TYPES.ref_c
          AS l_cursor TYPES.ref_c;
          BEGIN
               OPEN l_cursor FOR
               SELECT p.nombre,p.primerapellido,p.segundoapellido,p.genero,p.fechanacimiento, r.nota, r.calificacion
               FROM persona p, Personafisica pf, review_personafisica rpf, review r
               WHERE pnombre = p.nombre and p.persona_id = pf.persona_id AND pf.cedulafisica_id = rpf.cedulafisica_id
                    AND rpf.review_id = r.review_id;
               RETURN l_cursor;
     END;
END busquedas;
/
