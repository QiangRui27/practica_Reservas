<?php
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$listaDatos = $data["listaDatos"];



// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

/*echo "<form action='index.php'>
        <input type='hidden' name='action' value='buscarResource'>
        <input type='text' name='textoBusqueda'>
        <input type='submit' value='Buscar'>
      </form><br>";*/

// Ahora, la tabla con los datos de los libros
if (count($listaDatos) == 0) {
  echo "No hay datos";
} else {
  echo "<table  border ='1'>";
    echo "<tr>";

    echo "<th>Usuario</th>";
    echo "<th>Recurso</th>";
    echo "<th>Imagen</th>";
    echo "<th>Fecha</th>";
    echo "<th>Dia y Hora</th>";
    echo "<th>Remarks</th>";
    echo "<th>Cancelación</th>";

    echo "</tr>"; 
  foreach ($listaDatos as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->username . "</td>";
    echo "<td>" . $fila->name . "</td>";
    echo '<td><img src="' . $fila->image . '"width="200px" height="200px"></td>';
    echo "<td>" . $fila->date . "</td>";
    echo "<td>" . $fila->dayOfWeek ." de ". $fila->startTime ." a ". $fila->endTime."</td>";
    echo "<td>" . $fila->remarks . "</td>";
    
    echo "<td><a href='index.php?controller=ResourcesController&action=borrarReserva&idReserva=" . $fila->idReserva . "'>Cancelar</a></td>";
    echo "</tr>";
  }
  
  echo "</table>";
}


