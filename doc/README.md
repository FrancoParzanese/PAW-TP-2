Consignas:
----------

Ejercicio 1: Elabore una aplicación PHP que ofrezca al usuario un formulario web para la carga de los datos de una persona que solicita turno en el médico. Campos del formulario:
        a. Nombre del paciente (obligatorio).
        b. Email (obligatorio).
        c. Teléfono (obligatorio).
        d. Edad.
        e. Talla de calzado (desde 20 a 45 enteros).
        f. Altura (usando la herramienta de deslizador).
        g. Fecha de nacimiento (obligatorio).
        h. Color de pelo (usando un elemento select con las opciones que usted considere adecuadas).
        i. Fecha del turno (obligatorio).
        j. Horario del turno (entre las 8:00 hasta las 17:00 con turnos cada 15 minutos).
        k. 2 botones: enviar y limpiar.
    Todos los elementos del formulario deben validarse del lado de cliente y servidor, con el formato que mejor se ajuste y permitan HTML y PHP. Además, tomar en cuenta de validar que los datos ingresados se encuentren en los rangos especificados.

Ejercicio 2: Extienda el ejercicio anterior para que al enviar el formulario mediante el método POST se muestre al usuario un resumen del turno.

Ejercicio 3: Realice las modificaciones necesarias para que el script del punto anterior reciba los datos mediante el método GET. ¿Qué diferencia nota? ¿Cuándo es conveniente usar cada método?

Ejercicio 4: Agregue al formulario un campo que permita adjuntar una imagen, y que la etiqueta del campo sea Diagnóstico. El campo debe validar que sea un tipo de imagen válido (.jpg o .png) y será optativo. La imagen debe almacenarse en un subdirectorio del proyecto y también debe mostrarse al usuario al mostrar el resumen del turno del ejercicio 2. ¿Qué sucede si 2 usuarios cargan imágenes con el mismo nombre de imagen? ¿Qué mecanismo implementar para evitar que un usuario sobreescriba una imagen con el mismo nombre?

Ejercicio 5: Utilice las herramientas para desarrollador del navegador y observe cómo fueron cofificados por el navegador los datos enviados por el navegador en los dos ejercicios anteriores. ¿Qué diferencia nota?

Ejercicio 6: Agregar persistencia al sistema de turnos. Todos los datos del formulario deben almacenarse mediante algún mecanismo para poder ser recuperados posteriormente. Crear una nueva vista que le permita a un empleado administrativo visualizar todos los turnos en una tabla. La tabla debe incluir los siguientes campos:
        a. Fecha del turno.
        b. Hora del turno.
        c. Nombre del paciente.
        d. Teléfono.
        e. Email.
        f. Link a la ficha del turno.
    Esta página y la del formulario del punto 2 deben contar con una barra de navegación que permita ir a una u otra pantalla.
    Además, al procesar el formulario en el lado servidor, el sistema asigne un número de turno (que no debe repetirse).
    Para generar el sistema de persistencia, se aconseja estudiar algún mecanismo de serialización de datos.
    ¿Cómo relaciona la imagen del turno con los datos del turno? Comente alternativas que evaluó y opción elegida.

Ejercicio 7: Construya la vista de ficha de turno. Dicha vista debe permitir acceder al turno y mostrar todos sus datos, recuperados del mecanismo de persistencia elaborado en el punto anterior. ¿Cómo se identifica y discrimina un turno de otro? Debe funcionar el link a la ficha que se encuentra en la tabla de turnos. Recuerde agregar un enlace para volver a la tabla de turnos.

--------------------------------------------------------------------------------

Respuestas:
-----------

Ejercicio 3: La diferencia es que cada campo es enviado a través de la URL, por lo que son visibles para los usuarios, quienes pueden modificarlos y enviar cualquier cosa. Los datos de los formularios siempre deben ser enviados con el método POST, por cuestiones de seguridad. El método get debe ser usado para páginas que recuperan datos, tales como la del ejercicio 7, la cual muestra la ficha de un turno según su id.

Ejercicio 4: Si dos usuarios cargan imágenes con el mismo nombre de imagen, éstas se reemplazan, es decir, la segunda pisa a la primera, y no solo eso, sino que el usuario que había cargado la primera imagen, queda también vinculado a la nueva imagen. Para solucionar esto se deben renombrar las imágenes con nombres unívocos y que sigan representando al usuario que las cargó. En mi caso, les modifico el nombre a uno que concatena la fecha y hora del turno, puesto que en una implementación real de este sistema, se debería impedir dar de alta un turno en una fecha y hora ya ocupadas. El nombre que le doy a las imágenes es 'YYYY-mm-dd-hh-ii.[jpg|png]'.

Ejercicio 5: Cuando se agrega la imagen, el navegador envía una segunda petición HTTP por la imagen. El navegador interpreta el código HTML recibido, y cuando se encuentra con el tag '<img>' emite la petición HTTP por la imagen. Esta nueva petición se realiza por el método GET.

Ejercicio 6: En mi caso creo un archivo .txt por cada turno, llamados 'turno_X.txt', donde X es el id del turno. En dichos archivos guardo la serialización mediante JSON del array _REQUEST, el cual contiene todos los datos del formulario; uno de los datos es el source de la imagen, por lo que así la vinculo al turno. Las imagenes las nombro teniendo en cuenta la fecha y hora del turno al que pertenecen.

Ejercicio 7: Los turnos se identifican por un id único, el cual se crea cuando se da de alta un turno. Este id permite consultar la ficha de cada turno en particular en la página 'ficha.php' pasándole como parámetro el id. Por ejemplo: 'ficha.php?id=2' nos mostrará la ficha del turno cuyo id sea 2. Esto también facilita el pasar de un turno a otro simplemente modificando el parámetro en la URL.

--------------------------------------------------------------------------------

Aclaraciones:
-------------

El contenido del directorio 'app' debe ser volcado en el document root para que algunos enlaces funcionen correctamente.