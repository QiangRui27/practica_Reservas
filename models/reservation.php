<?php

// MODELO DE RECURSOS

include_once "model.php";

class Reservation extends Model
{

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "Reservations";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Devuelve el último id asignado en la tabla de recursos
    public function getMaxIdReserva()
    {
        $result = $this->db->dataQuery("SELECT MAX(id) AS ultimoIdReservations FROM Reservation");
        return $result[0]->ultimoIdReservations;
    }


    public function insertReserva($idResource, $idUser, $idTimeSlot, $date, $remarks)
    {
        return $this->db->dataManipulation("INSERT INTO Reservations (idResource,idUser,idTimeSlot,date,remarks) VALUES ('$idResource','$idUser', '$idTimeSlot', '$date', '$remarks')");
    }


    public function mostrarDatosReserva()
    {
        $result = $this->db->dataQuery("SELECT * FROM `Reservations` INNER JOIN Resources ON Reservations.idResource = Resources.id INNER JOIN TimeSlots ON Reservations.idTimeSlot = TimeSlots.id INNER JOIN Users ON Reservations.idUser = Users.id ORDER BY Resources.name ");
        return $result;
    }
    
    public function deleteReserva( $idReserva) {
        $result = $this->db->dataManipulation("DELETE FROM Reservations WHERE idReserva = $idReserva");
        return $result;
      }
}
