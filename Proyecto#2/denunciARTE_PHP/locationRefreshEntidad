<?php

    /* Utilizado para modificar dinamicamente los boxes de pais, provincia, canton, distrito y barrio.
    Falta definir bien "$def" que corresponde a todo el html que se tenga que reimprimir luego de procesar este archivo.
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
    

	echo "<label style='position: absolute; left: 480px; top: 130px; font-size:24px'>Dirección</label>";

	$pais= "<label style='position: absolute; left: 400px; top: 180px; font-size:20px'>País</label>	
						<select name='pais' id='pais' style='position:absolute; top:180px; left:480px; width:160px;' onchange='refresh()'>
							<option value=''>Seleccione uno</option>";
	$provincia="	<label style='position: absolute; left: 400px; top: 230px; font-size:20px'>Provincia</label>	
						<select name='provincia' id='provincia' style='position:absolute; top:230px; left:480px; width:160px;'onchange='refresh()'>
							<option value=''>Seleccione uno</option>";
	$canton="				<label style='position: absolute; left: 400px; top: 280px; font-size:20px'>Cantón</label>
						<select name='canton' id='canton' style='position:absolute; top:280px; left:480px; width:160px;' onchange='refresh()'>
							<option value=''>Seleccione uno</option>";
	$distrito="		<label style='position: absolute; left: 400px; top: 330px; font-size:20px'>Distrito</label>
						<select name='distrito' id='distrito' style='position:absolute; top:330px; left:480px; width:160px;'>
							<option value=''>Seleccione uno</option>";
    $barrio="		<label style='position: absolute; left: 400px; top: 330px; font-size:20px'>Barrio</label>
						<select name='barrio' id='barrio' style='position:absolute; top:330px; left:480px; width:160px;' onchange='refresh()'>
							<option value=''>Seleccione uno</option>";
    
    //Selecciona todos los paises
	$paises = 'select nombre from pais';
	$query_paises = ociparse($conn, $paises);
	ociexecute($query_paises);
	//imprime el html de pais
    echo $pais;
	
    //despliega todos los paises de la base
	while ($row = oci_fetch_assoc($query_paises) ) {
		if($row['NOMBRE']==$paisval) {
			echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		} else {
			echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		}
	}
	echo "</select>";
	
	//Selecciona todas las provincias correspondientes al pais
	$sql = "select nombre from provincia where pais_id_fk = pack_pais.get_id(:pais)";
	$stmt = oci_parse($conn, $sql);
	OCIBindByName($stmt, ":pais", $paisval);
	ociexecute($stmt); 
	
    //imprime el html de provincia
    echo $provincia;
    
    //despliega las provincias del pais correspondiente
	while ( $row = oci_fetch_assoc($stmt) ) {
		if($row['NOMBRE']==$provval) {
			echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		} else {
			echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		}
	}
	echo "</select>";
	
	//Selecciona todos los cantones correspondientes a la provincia
	$sql = "select nombre from canton where provincia_id_fk = pack_provincia.get_id(:provincia)";
	$stmt = oci_parse($conn, $sql);
	OCIBindByName($stmt, ":provincia", $provval);
	ociexecute($stmt); 
    
    //imprime el html de canton
	echo $canton;
	
    //despliega los cantones de la provincia correspondiente
	while ( $row = oci_fetch_assoc($stmt) ) {
		if($row['NOMBRE']==$cantonval) {
			echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		} else {
			echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		}
	}
	echo "</select>";
	
	//Selecciona todos los distritos correspondientes al canton
	$sql = "select nombre from distrito where canton_id_fk = pack_canton.get_id(:canton)";
	$stmt = oci_parse($conn, $sql);
	OCIBindByName($stmt, ":canton", $cantonval);
	ociexecute($stmt); 
    
    //imprime el html de distrito
	echo $distrito;
	
    //despliega los distritos del canton correspondiente
	while ( $row = oci_fetch_assoc($stmt) ) {
		if($row['NOMBRE']==$distritoval) {
			echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		} else {
			echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		}
	}
	echo "</select>";	

    //Selecciona todos los barrios correspondientes al distrito 
    $sql = "select nombre from barrio where distrito_id_fk = pack_distrito.get_id(:distrito)";
	$stmt = oci_parse($conn, $sql);
	OCIBindByName($stmt, ":distrito", $distritoval);
	ociexecute($stmt); 
    
    //imprime el html de barrio
	echo $barrio;

    //despliega los distritos del barrio correspondiente
	while ( $row = oci_fetch_assoc($stmt) ) {
		if($row['NOMBRE']==$barrioval) {
			echo "<option selected value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		} else {
			echo "<option value='$row[NOMBRE]'>$row[NOMBRE]</option>"."<BR>";
		}
	}
	echo "</select>";


?>
