<?php

	require "Persistencia.php";

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Turnos</title>
		<meta charset="UTF-8" />
	</head>
	<body>
		<h1>Lista de turnos</h1>
		<nav>| Lista de turnos | <a href="sacarTurno.php">Nuevo turno</a> |</nav>
		<table>
			<thead>
				<tr>
					<th>Fecha del turno</th>
					<th>Hora del turno</th>
					<th>Nombre del paciente</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Ficha</th>
				</tr>
			</thead>
			<tbody>
				<?php

					$cant = getCantTurnos(false);
					for ($i = 1; $i <= $cant; $i++) {
						$turno = cargar($i);
						echo "<tr><td>" . $turno["fecha"] . "</td>";
						echo "<td>" . $turno["horario"] . "</td>";
						echo "<td>" . $turno["nombre"] . "</td>";
						echo "<td>" . $turno["telefono"] . "</td>";
						echo "<td>" . $turno["email"] . "</td>";
						echo '<td><a href="ficha.php?id=' . $turno["id"] . '">Ver ficha</a></td>';
					}

				?>
			</tbody>
		</table>
	</body>
</html>