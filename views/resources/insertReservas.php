
<?php
echo "<h1>Reservas de recursos</h1>";

$resource = $data["listaResources"];
$timeSlot = $data["listaTimeSlots"];

/*var_dump($resource);
echo "<br>";
var_dump($timeSlot);
echo "<br>";
echo "<br>";*/
echo "<b>Nombre del recurso:</b> ".$resource[0]->name."</br>";
echo "<b>Descripción del recurso</b>: ".$resource[0]->description."</br>";
echo "<b>Lugar del recurso</b>: ".$resource[0]->location."</br>";
echo '<img src="' . $resource[0]->image . '"width="200px" height="200px">';
echo"<br>";

echo "<form action = 'index.php' method = 'get'>
        <input type='hidden' name='idResource' value='" . $resource[0]->id . "'>
        Fecha:<input type='date' name='date' value=''>";
        //Hora Inicial:<input type='time' name='startTime' value='" . $timeSlot[0]->startTime . "'><br>
        //Hora Final:<input type='time' name='endTime' value='" . $timeSlot[0]->endTime . "'><br>";
echo  " Día y hora: <select name='idTimeSlot'>";

$i = 0;
foreach ($timeSlot as $fila) {
        echo "<option value='".$timeSlot[$i]->id."' selected>".$timeSlot[$i]->dayOfWeek." de ".$timeSlot[$i]->startTime." a ".$timeSlot[$i]->endTime."</option>";
        $i++;
}

        
echo "</select><br>";
echo  '<br><label for="remarks"> Comentarios </label> ';
echo "<br><textarea name='remarks' rows='5' cols='40'></textarea><br>";



echo "  <input type='hidden' name='controller' value='ResourcesController'>";
echo "  <input type='hidden' name='action' value='insertarReserva'>";

echo "	<input type='submit'></form>";
echo "<p><a href='index.php?controller=ResourcesController&action=mostrarListaResources'>Volver</a></p>";
