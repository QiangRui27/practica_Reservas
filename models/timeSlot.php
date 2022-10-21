<?php

//MODELOS DE TRAMOS HORARIOS

include_once("model.php");

class TimeSlot extends Model
{   
    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "Resources";
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
        return $this->db->dataManipulation("INSERT INTO TimeSlots (dayOfWeek,startTime,endTime) VALUES ('$dayOfWeek','$startTime', '$endTime')");
    }

    // Actualiza un TimeSlot. Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($id, $name, $description, $location, $image)
    {
        $ok = $this->db->dataManipulation("UPDATE Resources SET
                                name = '$name',
                                description = '$description',
                                location = '$location',
                                image = '$image'
                                WHERE id = '$id'");
        return $ok;
    }


}
