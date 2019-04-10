<?php

	/* Archivo que contiene la cantidad de turnos. */
	define("Config", "persistencia.txt");

	/* Función que devuelve la cantidad de turnos. Se le pasa 'true' si se debe actualizar. */
	function getCantTurnos($actualizar) {
		$res = 0;
		if (filesize(Config) > 0) {
			$archivo = fopen(Config, "r");
			$res = fread($archivo, filesize(Config));
			fclose($archivo);
		}
		if ($actualizar === true) {
			$res++;
			$archivo = fopen(Config, "w");
			fwrite($archivo, $res);
			fclose($archivo);
		}
		return $res;
	}

	/* Función para guardar un objeto. */
	function guardar($data) {
		$id = getCantTurnos(true);
		$data["id"] = $id;
		$archivo = fopen("turno_$id.txt", "w");
		fwrite($archivo, json_encode($data));
		fclose($archivo);
	}

	/* Función para cargar un objeto. */
	function cargar($id) {
		$res = array();
		$archivo = fopen("turno_$id.txt", "r") or die();
		$len = filesize("turno_$id.txt");
		if ($len > 0) {
			$res = json_decode(fread($archivo, $len), true);
		}
		fclose($archivo);
		return $res;
	}

?>