<?php
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$listaResources = $data["listaResources"];
$listaTimeSlot = $data["listaTimeSlot"];
$listaReservas = $data["listaReservas"];
var_dump($listaReservas);

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
if (count($listaReservas) == 0) {
  echo "No hay datos";
} else {
  echo "<table  border ='1'>";
    echo "<tr>";

    echo "<th>idResource</th>";
    echo "<th>idUser</th>";
    echo "<th>idTimeSlot</th>";
    echo "<th>date</th>";
    echo "<th>Remarks</th>";
    echo "<th colspan= '2' >Opciones</th>";

    echo "</tr>"; 
  foreach ($listaReservas as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->idResource . "</td>";
    echo "<td>" . $fila->idUser . "</td>";
    echo "<td>" . $fila->idTimeSlot . "</td>";
    echo "<td>" . $fila->date . "</td>";
    echo "<td>" . $fila->remarks . "</td>";
    
    echo "<td><a href='index.php?controller=ResourcesController&action=formularioModificarReserva&id=" . $fila->idResource . "'>Modificar</a></td>";
    echo "<td><a href='index.php?controller=ResourcesController&action=BorrarReserva&id=" . $fila->idResource . "'>Borrar</a></td>";
    echo "</tr>";
  }
  
  echo "</table>";
}


