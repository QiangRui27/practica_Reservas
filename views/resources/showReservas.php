<?php
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$listaResources = $data["listaResources"];


// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

echo "<form action='index.php'>
        <input type='hidden' name='action' value='buscarResource'>
        <input type='text' name='textoBusqueda'>
        <input type='submit' value='Buscar'>
      </form><br>";

// Ahora, la tabla con los datos de los libros
if (count($listaResources) == 0) {
  echo "No hay datos";
} else {
  echo "<table  border ='1'>";
    echo "<tr>";

    echo "<th>Nombre</th>";
    echo "<th>Descripción</th>";
    echo "<th>Ubicación</th>";
    echo "<th>Imagen</th>";
    echo "<th colspan= '2' >Opciones</th>";

    echo "</tr>"; 
  foreach ($listaResources as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->name . "</td>";
    echo "<td>" . $fila->description . "</td>";
    echo "<td>" . $fila->location . "</td>";
    echo '<td><img src="' . $fila->image . '"width="200px" height="200px"></td>';
    echo "<td><a href='index.php?controller=ResourcesController&action=formularioReservarResource&id=" . $fila->id . "'>Reservar</a></td>";
    echo "</tr>";
  }
  
  echo "</table>";
}
echo "<p><a href='index.php?controller=ResourcesController&action=formularioInsertarResource'>Nuevo</a></p>";

