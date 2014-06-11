<?php
    /*
        Refresca el segundo combobox de búsquedas dependiendo del contenido del primero.
    */
    $persona = $_POST['persona'];
    $tipoBusqueda = $_POST['tipoBusqueda'];

    $select = "<select id='tipoBusqueda' style='position:absolute; top:220px; left:350px;'>
                <option value='null'>Seleccione una</option>";
    echo $select;
    if($persona == 'personaJuridica') {
        echo "<option value='cedula'>Cédula</option>
	          <option value='nombre'>Nombre</option>";
    } elseif($persona == 'categoria') {
        echo "<option value='alfabetico'>Orden Alfabético</option>";
    } elseif($persona == 'personaFisica') {
        echo "<option value='primerApellido'>Primer Apellido</option>
              <option value='segundoApellido'>Segundo Apellido</option>
              <option value='cedula'>Cédula</option>
              <option value='nombre'>Nombre</option>";

    } elseif($persona == 'juridicaFisica') {
        echo "<option value='categoria'>Categoría</option>";
    }
    echo "</select>";

?>
