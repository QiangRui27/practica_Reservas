<?php
// VISTA PARA INSERCIÓN/EDICIÓN DE LIBROS

// extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales ($libro, $todosLosAutores y $autoresLibro)

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $libro: si existe, es porque estamos modificando un libro. Si no, estamos insertando uno nuevo.

    echo "<h1>Inserción de Horario</h1>";



// Sacamos los datos del libro (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay libro, dejamos los campos en blanco y el formulario servirá para inserción).


// Creamos el formulario con los campos del libro
echo "<form action='index.php' method = 'get'>
        <input type='hidden' name='id' value=''>
        Día de la semana:<input type='text' name='dayOfWeek' value=''><br>
        Tiempo inicial:<input type='time' name='startTime' value=''><br>
        Tiempo final:<input type='time' name='endTime' value=''><br>";

/*echo "Autores: <select name='autor[]' multiple size='3'>";
foreach ($todosLosAutores as $fila) {
    if (in_array($fila->idPersona, $autoresLibro))
        echo "<option value='$fila->idPersona' selected>$fila->nombre $fila->apellido</option>";
    else
        echo "<option value='$fila->idPersona'>$fila->nombre $fila->apellido</option>";
}
echo "</select>";*/

// Finalizamos el formulario
echo "  <input type='hidden' name='controller' value='TimeSlotsController'>";
echo "  <input type='hidden' name='action' value='insertarTimeSlot'>";

echo "	<input type='submit'></form>";

echo "<p><a href='index.php?controller=timeSlotsController&action=mostrarListaTimeSlots'>Volver</a></p>";


