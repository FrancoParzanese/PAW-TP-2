<?php

	require "Persistencia.php";

	$data = null;
	if (isset($_GET["id"])) {
		$data = cargar($_GET["id"]);
	} else {
		header("Location: http://".$_SERVER["HTTP_HOST"]);
		exit();
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Resumen del turno</title>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Ficha del turno:</h1>
		<?php

			if (isset($data["diagnostico"])) {
				echo '<img src="'.$data["diagnostico"].'" alt="Diagnóstico" width="100px" height="100px" />';
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

					foreach ($data as $k => $v) {
						echo "<tr><th>$k</th><td>$v</td></tr>";
					}

				?>
			</tbody>
		</table>
		<a href="index.php">Volver a la lista de turnos</a>
	</body>
</html>