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

			.req, .importante {
				color: red;
			}

		</style>
	</head>
	<body>
		<h1>Solicitar turno en el médico</h1>
		<h2>Ingresar datos (método GET):</h2>
		<p class="importante"><strong>NOTA:</strong> Para persistir los datos, se deben ingresar por el método POST.</p>
		<form method="GET" action="<?= htmlspecialchars("http://".$_SERVER["HTTP_HOST"]."/resumen.php") ?>"
				enctype="multipart/form-data">
			<?php  require "formulario.php"; ?>
			<input type="reset" value="Limpiar" />
			<input type="submit" value="Enviar" />
		</form>
		<a href="sacarTurno.php">Cambiar al método POST</a>
	</body>
</html>