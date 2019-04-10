<?php
	echo '<label for="nombre">Nombre del paciente*:</label>';
	echo '<input type="text" name="nombre" />';
	echo '<p class="req">*  Requerido</p>';
	echo '<label for="email">Email*:</label>';
	echo '<input type="email" name="email" />';
	echo '<p class="req">*  Requerido</p>';
	echo '<label for="telefono">Teléfono*:</label>';
	echo '<input type="text" name="telefono" />';
	echo '<p class="req">*  Requerido</p>';
	echo '<label for="calzado">Talla de calzado:</label>';
	echo '<input type="number" name="calzado" min="20" max="45" />';
	echo '<label for="altura">Altura:</label>';
	echo '<input type="range" name="altura" min="50" max="250" />';
	echo '<p>Entre 50 cm. y 250 cm.</p>';
	echo '<label for="nacimiento">Fecha de nacimiento*:</label>';
	echo '<input type="date" name="nacimiento" min="1900-01-01" max="'.date("Y-m-d").'" />';
	echo '<p class="req">*  Requerido</p>';
	echo '<label for="pelo">Color de pelo:</label>';
	echo '<input type="color" name="pelo" />';
	echo '<label for="fecha">Fecha del turno*:</label>';
	echo '<input type="date" name="fecha" min="'.$fechaMin.'" max="'.$fechaMax.'" />';
	echo '<p class="req">*  Requerido</p>';
	echo '<label for="horario">Horario del turno*:</label>';
	echo '<select name="horario">';
	for ($h = 8; $h < 17; $h++) {
		echo '<option value="'.$h.':00">'.$h.':00</option>';
		echo '<option value="'.$h.':15">'.$h.':15</option>';
		echo '<option value="'.$h.':30">'.$h.':30</option>';
		echo '<option value="'.$h.':45">'.$h.':45</option>';
	}
	echo '<option value="17:00">17:00</option>';
	echo '</select>';
	echo '<p class="req">*  Requerido</p>';
?>