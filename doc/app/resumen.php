<?php

	require "Persistencia.php";

	$nombre = $email = $telefono = $calzado = $nacimiento = $fecha = "";
	$errorNombre = $errorEmail = $errorTelefono = $errorCalzado = $errorNacimiento = $errorFecha = "";

	/* Función que elimina caracteres extras, y convierte a códigos HTML. */
	function validar($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	/* Función que determina la edad. */
	function edad($nacimiento) {
		$fecha = strtotime($nacimiento);
		$res = date("Y") - date("Y", $fecha);
		if (date("m") < date("m", $fecha)) {
			return $res - 1;
		} else if (date("m") == date("m", $fecha) && date("d") < date("d", $fecha)) {
			return $res - 1;
		}
		return $res;
	}

	/* Función que devuelve el nombre para guardar un archivo asociado al turno. */
	function getImageName($fecha, $hora) {
		$aux = strtotime($fecha);
		$res = date("Y-m-d", $aux);
		$aux = strtotime($hora);
		$res .= "-".date("H-i", $aux);
		return $res;
	}

	/* Validaciones: */
	/* Valor booleano que indica si el formulario se completó correctamente. Inicialmente 'true'. */
	$esValido = true;
	/* Validar nombre del paciente. */
	$data = validar($_REQUEST["nombre"]);
	$data = filter_var($data, FILTER_SANITIZE_STRING);
	if (strlen($data) > 0) {
		$nombre = $data;
	} else {
		$esValido = false;
		$errorNombre = "*  El nombre es obligatorio.";
	}
	/* Validar email. */
	$data = validar($_REQUEST["email"]);
	$data = filter_var($data, FILTER_SANITIZE_EMAIL);
	if (filter_var($data, FILTER_VALIDATE_EMAIL) == true) {
		$email = $data;
	} else {
		$esValido = false;
		$errorEmail = "*  El email es inválido.";
	}
	/* Validar teléfono. */
	$data = validar($_REQUEST["telefono"]);
	if (strlen($data) > 0) {
		$telefono = $data;
	} else {
		$esValido = false;
		$errorTelefono = "*  El teléfono es inválido.";
	}
	/* Validar talla de calzado. */
	if (strlen($_REQUEST["calzado"]) > 0) {
		$data = validar($_REQUEST["calzado"]);
		if (filter_var($data, FILTER_VALIDATE_INT, array("options" => array("min_range" => 20, "max_range" => 45))) == true) {
			$calzado = $data;
		} else {
			$esValido = false;
			$errorCalzado = "*  La talla de calzado es inválida o no está dentro del rango válido (20..45).";
		}
	}
	if (strlen($_REQUEST["nacimiento"]) > 0) {
		$nacimiento = $_REQUEST["nacimiento"];
	} else {
		$esValido = false;
		$errorNacimiento = "*  La fecha de nacimiento es obligatoria.";
	}
	if (strlen($_REQUEST["fecha"]) > 0) {
		$fecha = $_REQUEST["fecha"];
	} else {
		$esValido = false;
		$errorFecha = "*  La fecha del turno es obligatoria.";
	}
	/* Si no pasó la validación se redirige a otra página. */
	if (!$esValido) {
		header("Location: http://".$_SERVER["HTTP_HOST"]);
		exit();
	} else {
		$_REQUEST["edad"] = edad($nacimiento);
		if ($_FILES["diagnostico"]["size"] > 0) {
			$destinoImagen = "imagenesCargadas/".basename($_FILES["diagnostico"]["name"]);
			$tipoImagen = strtolower(pathinfo($destinoImagen, PATHINFO_EXTENSION));
			$destinoImagen = "imagenesCargadas/".getImageName($fecha, $_REQUEST["horario"]).".$tipoImagen";
			$imagenValida = true;
			$check = getimagesize($_FILES["diagnostico"]["tmp_name"]);
			if($check === false) {
				$imagenValida = false;
			}
			if ($tipoImagen != "jpg" && $tipoImagen != "png") {
				$imagenValida = false;
			}
			if ($imagenValida == false) {
				header("Location: http://".$_SERVER["HTTP_HOST"]);
				exit();
			}
			if (!move_uploaded_file($_FILES["diagnostico"]["tmp_name"], $destinoImagen)) {
				header("Location: http://".$_SERVER["HTTP_HOST"]);
				exit();
			}
			$_REQUEST["diagnostico"] = $destinoImagen;
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			guardar($_REQUEST);
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Resumen del turno</title>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Solicitar turno en el médico</h1>
		<h2>Datos ingresados:</h2>
		<?php

			if ($_FILES["diagnostico"]["size"] > 0) {
				echo '<img src="'.$destinoImagen.'" alt="Diagnóstico" width="100px" height="100px" />';
			}

		?>
		<table>
			<thead>
				<tr>
					<th colspan="2">Resumen del turno</th>
				</tr>
			</thead>
			<tbody>
				<?php

					foreach ($_REQUEST as $k => $v) {
						echo "<tr><th>$k</th><td>$v</td></tr>";
					}

				?>
			</tbody>
		</table>
		<a href="index.php">Volver a la lista de turnos</a>
	</body>
</html>