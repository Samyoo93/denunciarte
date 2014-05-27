<?php

	include("conection.php");
	$conn = OCILogon($user, $pass, $db);

	//Nombra las variables obtenidas de InicioUsuarios.php
	$busqueda = $_POST['busquedaGeneral'];

	//Busca persona fisica por el nombre*****************************************************************************************
	//Se inicia el query con el procedimiento asignado
	$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.personaPorNombre(:nombre); END;");
	//Genera el cursor donde la informacion sera guardada
	$cursor1 = oci_new_cursor($conn);

	//Se le pasa el parametro de busqueda
	oci_bind_by_name($query_procedimiento, ':nombre', $busqueda);
	oci_bind_by_name($query_procedimiento, ':cursor', $cursor1, -1, OCI_B_CURSOR);

	ociexecute($query_procedimiento);
	oci_execute($cursor1, OCI_DEFAULT);

	//Usa el fetch a conveniencia para persona fisica
	oci_fetch_all($cursor1, $array1, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);

	//Busca persona juridica por el nombre**************************************************************************************
	//Se inicia el query con el procedimiento asignado
	$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.entidadPorNombre(:nombre); END;");
	//Genera el cursor donde la informacion sera guardada
	$cursor2 = oci_new_cursor($conn);

	//Se le pasa el parametro de busqueda
	oci_bind_by_name($query_procedimiento, ':nombre', $busqueda);
	oci_bind_by_name($query_procedimiento, ':cursor', $cursor2, -1, OCI_B_CURSOR);

	//Se ejecutan el query y el cursor
	ociexecute($query_procedimiento);
	oci_execute($cursor2, OCI_DEFAULT);

	//Usa el fetch a conveniencia para persona juridica
	oci_fetch_all($cursor2, $array2, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_NUM);


	//Declaracion de la division por la que se cambiara, esta es la misma para todos los casos, solo cambia el contenido
	$division ='<section id="mostrar" style="position:absolute; width:630px; height:400px;">
					<div style="width:600px; height:510px;line-height:3em;overflow:auto;padding:5px;">';

	//Pasa los parametros ordenados de persona fisica al section
	foreach($array1 as $fila){
		/*$query_procedimiento = ociparse($conn, "BEGIN :edad := get_edadPersona(:fechaNacimiento); END;");
		$edad = 0;
		oci_bind_by_name($query_procedimiento, ':fechaNacimiento', $fila['PERSONA_ID']);
		oci_bind_by_name($query_procedimiento, ':edad', $edad);
		ociexecute($query_procedimiento);

		oci_execute($cursor, OCI_DEFAULT);*/
		$division = $division . '<div>
								<a href="mostrarDatos.php?persona=personaFisica&id='.$fila['PERSONA_ID'].'"><b>' . $fila['NOMBRE'] . ' ' . $fila['PRIMERAPELLIDO'] . ' ' . $fila['SEGUNDOAPELLIDO']. '</b></a><br>
								<a>	Cédula física:' . $fila['CEDULAFISICA_ID'] . '</a><br>
								<a> Lugar de trabajo:' . $fila['LUGARTRABAJO'] . '</a><br>
								<hr size=5 width=580>
							</div>';
	}
	//Pasa los parametros ordenados de persona juridica al section
	foreach($array2 as $fila){
		$division = $division . '<div>
								<a href="mostrarDatos.php?persona=personaJuridica&id='.$fila[0].'"><b>' . $fila[1] . '</b></a><br>
								<a> Cedula Jurídica:' . $fila[2] . '</a><br>
								<a>	Dirección:' .$fila[3] . ', ' . $fila[4] . ', ' . $fila[5] . ', ' . $fila[6] . ', ' . $fila[7] . '</a><br>
								<a> Entidad</b><br>
								<hr size=5 width=600>
							</div>';
	}
	//El cierre de la seccion donde la informacion fue cargada
	$division = $division . '</div></section>';

	echo $division;

	OCICommit($conn);
	ociLogOff($conn);
?>
