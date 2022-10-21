<?php

//MODELOS DE TRAMOS HORARIOS

include_once("model.php");

class TimeSlot extends Model
{   
    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "Times";
        $this->idColumn = "id";
        parent::__construct();
    }

    public function getMaxId()
    {
        $result = $this->db->dataQuery("SELECT MAX(id) AS ultimoIdTimeSlot FROM TimeSlots");
        return $result[0]->ultimoIdTimeSlot;
    }

    // Inserta un recurso. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($dayOfWeek, $startTime, $endTime)
    {
        return $this->db->dataManipulation("INSERT INTO TimeSlots (dayOfWeek,startTime,endTime) 
                                            VALUES ('$dayOfWeek','$startTime', '$endTime')");
    }

    // Actualiza un TimeSlot. Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($id, $dayOfWeek, $startTime, $endTime, $image)
    {
        $ok = $this->db->dataManipulation("UPDATE TimeSlots SET
                                dayOfWeek = '$dayOfWeek',
                                startTime = '$startTime',
                                endTime = '$endTime'
                                WHERE id = '$id'");
        return $ok;
    }


}
