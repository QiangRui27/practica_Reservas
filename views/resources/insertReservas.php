
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

echo "<form action = 'index.php' method = 'get'>
        <input type='hidden' name='idResource' value='" . $resource[0]->id . "'>
        <input type='hidden' name='idTimeslot' value='" . $timeSlot[0]->id . "'>
        Día:<input type='date' name='dayOfWeek' value='" . $timeSlot[0]->dayOfWeek . "'><br>
        Hora Inicial:<input type='time' name='startTime' value='" . $timeSlot[0]->startTime . "'><br>
        Hora Final:<input type='time' name='endTime' value='" . $timeSlot[0]->endTime . "'><br>";
echo  "<select>";

foreach ($timeSlot as $fila) {
        echo "<option value='".$timeSlot[0]->id."' selected>".$timeSlot[0]->dayOfWeek."</option>";
}

        

echo  "Comentarios:<br><textarea name='remarks' rows='10' cols='40'></textarea><br>";



echo "  <input type='hidden' name='controller' value='ResourcesController'>";
echo "  <input type='hidden' name='action' value='insertarReservation'>";

echo "	<input type='submit'></form>";
echo "<p><a href='index.php?controller=ResourcesController&action=mostrarListaResources'>Volver</a></p>";
