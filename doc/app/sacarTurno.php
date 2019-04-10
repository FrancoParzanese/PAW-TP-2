<?php

	/* Configuración de zona horaria. */
	date_default_timezone_set("America/Argentina/Buenos_Aires");

	/* Se determina el rango de fechas disponible para sacar turnos. */
	$fechaMin = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 1, date("Y")));
	$fechaMax = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") + 21, date("Y")));

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Solicitar turno</title>
		<meta charset="UTF-8" />
		<style>

			.req {
				color: red;
			}

		</style>
	</head>
	<body>
		<h1>Solicitar turno en el médico</h1>
		<nav>| <a href="index.php">Lista de turnos</a> | Nuevo turno |</nav>
		<h2>Ingresar datos (método POST):</h2>
		<form method="POST" action="<?= htmlspecialchars("http://".$_SERVER["HTTP_HOST"]."/resumen.php") ?>"
				enctype="multipart/form-data">
			<?php  require "formulario.php"; ?>
			<label for="imagen">Adjuntar una imagen:</label>
			<input type="file" name="diagnostico" />
			<input type="reset" value="Limpiar" />
			<input type="submit" value="Enviar" />
		</form>
		<a href="sacarTurnoGet.php">Cambiar al método GET</a>
	</body>
</html>