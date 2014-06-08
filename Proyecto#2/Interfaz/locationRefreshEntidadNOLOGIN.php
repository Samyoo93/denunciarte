<?php

    /* Utilizado para modificar dinamicamente los boxes de pais, provincia, canton, distrito y barrio.
    */
    include('conection.php');
    $conn = oci_connect($user, $pass, $db);
	if (!$conn) {
		echo "Invalid conection" . var_dump (OCIError());
		die();
	}


    $paisval = $_POST['pais'];
    $provval = $_POST['provincia'];
    $cantonval = $_POST['canton'];
    $distritoval = $_POST['distrito'];
    $barrioval = $_POST['barrio'];
    $which = $_POST['which'];

    $title = '<h2 style="position:absolute; top:170px; left:60px;">Dirección</h2>
            <a style="position:absolute; top:210px; left:60px;">__________</a>
            <a style="position:absolute; top:250px; left:60px;">País</a>
            <a style="position:absolute; top:290px; left:60px;">Provincia</a>
            <a style="position:absolute; top:330px; left:60px;">Cantón</a>
            <a style="position:absolute; top:370px; left:60px;">Distrito</a>
            <a style="position:absolute; top:400px; left:60px;">Barrio</a>';


	$provincia="	<select name='provincia' required id='provincia' onchange='refresh(2)'
                        style='position:absolute; top:290px; text-align:center; left:130px; width:300px;'>
					   <option value=''>Seleccione uno</option>";

	$canton="		<select name='canton' required id='canton' onchange='refresh(3)'
                        style='position:absolute; top:330px; text-align:center; left:130px; width:300px;'>
					   <option value=''>Seleccione uno</option>";

    $distrito="		<select name='distrito' required id='distrito' onchange='refresh(4)'
                        style='position:absolute; top:370px; text-align:center; left:130px; width:300px;'>
					   <option value=''>Seleccione uno</option>";
    $barrio="		<select name='barrio' required id='barrio' onchange='refresh(5)'
                        style='position:absolute; top:400px; text-align:center; left:130px; width:300px;'>
						<option value=''>Seleccione uno</option>";


    echo $title;
    //Selecciona todos los paises
	$sql = "SELECT nombre FROM pais";
    $stmt = oci_parse($conn, $sql);
    ociexecute($stmt);
    echo "<select name='pais' required id='pais' onchange='refresh(1)'
    style='position:absolute; top:250px; text-align:center; left:130px; width:300px;'>";
    echo "<option value=''>Seleccione uno</option>";
    while ( $row = oci_fetch_assoc($stmt) ) {

        if($row['NOMBRE']==$paisval) {
            echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
        } else {
            echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
        }
    }

	echo "</select>";


	//Selecciona todas las provincias correspondientes al pais
	$sql = "select nombre from provincia where pais_id = pack_pais.get_id(:pais)";
	$stmt = oci_parse($conn, $sql);
	OCIBindByName($stmt, ":pais", $paisval);
	ociexecute($stmt);

    //imprime el html de provincia
    echo $provincia;

    //despliega las provincias del pais correspondiente
	while ( $row = oci_fetch_assoc($stmt) ) {
		if($row['NOMBRE']==$provval and $which >= 2) {
			echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		} else {
			echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		}
	}
	echo "</select>";

	//Selecciona todos los cantones correspondientes a la provincia
	$sql = "select nombre from canton where provincia_id = pack_provincia.get_id(:provincia)";
	$stmt = oci_parse($conn, $sql);
	OCIBindByName($stmt, ":provincia", $provval);
	ociexecute($stmt);

    //imprime el html de canton
	echo $canton;

    //despliega los cantones de la provincia correspondiente
	while ( $row = oci_fetch_assoc($stmt) ) {
		if($row['NOMBRE']==$cantonval and $which >= 3) {
			echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		} else {
			echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		}
	}
	echo "</select>";

	//Selecciona todos los distritos correspondientes al canton
	$sql = "select nombre from distrito where canton_id = pack_canton.get_id(:canton)";
	$stmt = oci_parse($conn, $sql);
	OCIBindByName($stmt, ":canton", $cantonval);
	ociexecute($stmt);

    //imprime el html de distrito
	echo $distrito;

    //despliega los distritos del canton correspondiente
	while ( $row = oci_fetch_assoc($stmt) ) {
		if($row['NOMBRE']==$distritoval and $which >= 4) {
			echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		} else {
			echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		}
	}
	echo "</select>";

    //Selecciona todos los barrios correspondientes al distrito
    $sql = "select nombre from barrio where distrito_id = pack_distrito.get_id(:distrito)";
	$stmt = oci_parse($conn, $sql);
	OCIBindByName($stmt, ":distrito", $distritoval);
	ociexecute($stmt);

    //imprime el html de barrio
	echo $barrio;

    //despliega los distritos del barrio correspondiente
	while ( $row = oci_fetch_assoc($stmt) ) {
		if($row['NOMBRE']==$barrioval and $which == 5) {
			echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		} else {
			echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		}
	}
	echo "</select>";

?>
