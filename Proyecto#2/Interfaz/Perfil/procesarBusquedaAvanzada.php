<?php

	include("conection.php");
	$conn = OCILogon($user, $pass, $db);

	//Nombra las variables obtenidas de consultasAvanzadas
	$busqueda = $_POST['busqueda'];
	$persona = $_POST['persona'];
	$tipoBusqueda = $_POST['tipoBusqueda'];

	//Declaracion de la division por la que se cambiara, esta es la misma para todos los casos, solo cambia el contenido
	$division ='<section id="mostrar" style="position:absolute; width:630px; height:400px;">
					<div style="width:600px; height:510px;line-height:3em;overflow:auto;padding:5px;">';

	//Busca persona fisica**************************************************************************************************
	if($persona == 'personaFisica'){

		if($tipoBusqueda == 'nombre'){

			//Se inicia el query con el procedimiento asignado
			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.personaPorNombre(:nombre); END;");
			//Genera el cursor donde la informacion sera guardada
			$cursor = oci_new_cursor($conn);

			//Se le pasa el parametro de busqueda
			oci_bind_by_name($query_procedimiento, ':nombre', $busqueda);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

			ociexecute($query_procedimiento);
			oci_execute($cursor, OCI_DEFAULT);
		} else if($tipoBusqueda == 'primerApellido'){

			//Se inicia el query con el procedimiento asignado
			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.personaPorPrimerApellido(:primerApellido); END;");
			//Genera el cursor donde la informacion sera guardada
			$cursor = oci_new_cursor($conn);

			//Se le pasa el parametro de busqueda
			oci_bind_by_name($query_procedimiento, ':primerApellido', $busqueda);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

			ociexecute($query_procedimiento);
			oci_execute($cursor, OCI_DEFAULT);
		} else if($tipoBusqueda == 'segundoApellido'){

			//Se inicia el query con el procedimiento asignado
			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.personaPorSegundoApellido(:segundoApellido); END;");
			//Genera el cursor donde la informacion sera guardada
			$cursor = oci_new_cursor($conn);

			//Se le pasa el parametro de busqueda
			oci_bind_by_name($query_procedimiento, ':segundoApellido', $busqueda);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

			ociexecute($query_procedimiento);
			oci_execute($cursor, OCI_DEFAULT);
		} else if($tipoBusqueda == 'cedula'){

			//Se inicia el query con el procedimiento asignado
			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.personaPorCedula(:cedula); END;");
			//Genera el cursor donde la informacion sera guardada
			$cursor = oci_new_cursor($conn);

			//Se le pasa el parametro de busqueda
			oci_bind_by_name($query_procedimiento, ':cedula', $busqueda);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

			ociexecute($query_procedimiento);
			oci_execute($cursor, OCI_DEFAULT);
		}

		oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
		foreach($array as $fila){
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
									<a> Persona Física</a><br>
									<hr size=5 width=580>
								</div>';
		}

	//Busca persona juridica*********************************************************************************************************
	} else if ($persona == 'personaJuridica'){
		if($tipoBusqueda == 'nombre'){

			//Se inicia el query con el procedimiento asignado
			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.entidadPorNombre(:nombre); END;");
			//Genera el cursor donde la informacion sera guardada
			$cursor = oci_new_cursor($conn);

			//Se le pasa el parametro de busqueda
			oci_bind_by_name($query_procedimiento, ':nombre', $busqueda);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

			//Se ejecutan el query y el cursor
			ociexecute($query_procedimiento);
			oci_execute($cursor, OCI_DEFAULT);

		} else if($tipoBusqueda == 'cedula'){

			//Se inicia el query con el procedimiento asignado
			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.entidadPorCedula(:cedula); END;");
			$cursor = oci_new_cursor($conn);

			//Se le pasa el parametro de busqueda
			oci_bind_by_name($query_procedimiento, ':cedula', $busqueda);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor , -1, OCI_B_CURSOR);

			//Se ejecutan el query y el cursor
			ociexecute($query_procedimiento);
			oci_execute($cursor, OCI_DEFAULT);

		}

		//Usa el fetch a conveniencia
		oci_fetch_all($cursor, $array, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_NUM);

		foreach($array as $fila){

			$division = $division . '<div>
									<a href="mostrarDatos.php?persona=personaJuridica&id='.$fila[0].'"><b>' . $fila[1] . '</b></a><br>
									<a> Cedula Jurídica:' . $fila[2] . '</a><br>
									<a> Persona Jurídica</b><br>
									<hr size=5 width=600>
								</div>';
		}
	//Busca por cateria******************************************************************************************************************
	} else if($persona == 'categoria'){
		if($tipoBusqueda == 'nombre'){

			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.personaPorCategoria(:categoria); END;");
			$cursor1 = oci_new_cursor($conn);

			oci_bind_by_name($query_procedimiento, ':categoria', $busqueda);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor1 , -1, OCI_B_CURSOR);

			ociexecute($query_procedimiento);
			oci_execute($cursor1, OCI_DEFAULT);

			//Busca a las personas juridicas por la categoria
			$query_procedimiento = ociparse($conn, "BEGIN :cursor := busquedas.entidadPorNombre(:categoria); END;");
			$cursor2 = oci_new_cursor($conn);

			oci_bind_by_name($query_procedimiento, ':categoria', $busqueda);
			oci_bind_by_name($query_procedimiento, ':cursor', $cursor2 , -1, OCI_B_CURSOR);

			ociexecute($query_procedimiento);
			oci_execute($cursor2, OCI_DEFAULT);

			oci_fetch_all($cursor1, $array1, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_ASSOC);
			oci_fetch_all($cursor2, $array2, null, null, OCI_FETCHSTATEMENT_BY_ROW + OCI_NUM);

			//Agrega los datos de las persona físicas
			foreach($array1 as $fila){

				$division = $division . '<div>
								<a href="mostrarDatos.php?persona=personaFisica&id='.$fila['PERSONA_ID'].'"><b>' . $fila['NOMBRE'] . ' ' . $fila['PRIMERAPELLIDO'] . ' ' . $fila['SEGUNDOAPELLIDO']. '</b></a><br>
								<a> Cedula Física:' . $fila['CEDULAFISICA_ID'] . '</a><br>
								<a>	Lugar de Trabajo:' . $fila['LUGARTRABAJO'] . '</a><br>
								<a> Persona Física </a><br>
								<hr size=5 width=580>
							</div>';
			}

			foreach($array2 as $fila){
				/*$query_procedimiento = ociparse($conn, "BEGIN :edad := get_edadPersona(:fechaNacimiento); END;");
				$edad = 0;

				oci_bind_by_name($query_procedimiento, ':fechaNacimiento', $fila['PERSONA_ID']);
				oci_bind_by_name($query_procedimiento, ':edad', $edad);
				ociexecute($query_procedimiento);

				oci_execute($cursor, OCI_DEFAULT);*/
				$division = $division . '<div>
								<a href="mostrarDatos.php?persona=personaJuridica&id='.$fila[0].'"><b>' . $fila[1] . '</b></a><br>
								<a> Cedula Jurídica:' . $fila[2] . '</a><br>
								<a>	Dirección:' .$fila[4] . ', ' . $fila[5] . ', ' . $fila[6] . ', ' . $fila[7] . ', ' . $fila[8] . '</a><br>
								<a> Persona Jurídica</a><br>
								<hr size=5 width=600>
							</div>';
			}
		}
	}

	//El cierre de la seccion donde la informacion fue cargada
	$division = $division . '</div></section>';

	echo $division;

	OCICommit($conn);
	ociLogOff($conn);
?>
