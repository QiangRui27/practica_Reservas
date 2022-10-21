<?php
// VISTA PARA LA LISTA DE TIMESLOTS

// Recuperamos la lista de libros
$listaTimeSlots = $data["listaTimeSlots"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

echo "<form action='index.php'>
        <input type='hidden' name='action' value='buscarTimeSlot'>
        <input type='text' name='textoBusqueda'>
        <input type='submit' value='Buscar'>
      </form><br>";

// Ahora, la tabla con los datos de los libros
if (count($listaTimeSlots) == 0) {
  echo "No hay datos";
} else {
  echo "<table  border ='1'>";
    echo "<tr>";

    echo "<th>Día</th>";
    echo "<th>Hora inicial</th>";
    echo "<th>Hora final</th>";
    echo "<th colspan= '2' >Opciones</th>";

    echo "</tr>"; 
  foreach ($listaTimeSlots as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->dayOfWeek . "</td>";
    echo "<td>" . $fila->startTime . "</td>";
    echo "<td>" . $fila->endTime . "</td>";
    echo "<td><a href='index.php?action=formularioModificarTimeSlot&id=" . $fila->id . "'>Modificar</a></td>";
    echo "<td><a href='index.php?action=borrarTimeSlot&id=" . $fila->id . "'>Borrar</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a href='index.php?action=formularioInsertarTimeSlot'>Nuevo</a></p>";