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
    public function getMaxId()
    {
        $result = $this->db->dataQuery("SELECT MAX(id) AS ultimoIdReservations FROM Reservations");
        return $result[0]->ultimoIdReservations;
    }

    // Inserta un recurso. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($idResource, $idUser, $idTimeSlot, $date, $remarks)
    {
        
        return $this->db->dataManipulation("INSERT INTO Reservations (idResource,idUser,idTimeSlot,remarks) VALUES ('$idResource','$idUser', '$idTimeSlot', '$date', '$remarks')");
    }

    
    // Inserta los autores de un libro. Recibe el id del libro y la lista de ids de los autores en forma de array.
    // Devuelve el número de autores insertados con éxito (0 en caso de fallo).
    /*public function insertAutores($idLibro, $autores)
    {
        $correctos = 0;
        foreach ($autores as $idAutor) {
            $correctos += $this->db->dataManipulation("INSERT INTO escriben(idLibro, idPersona) VALUES('$idLibro', '$idAutor')");
        }
        return $correctos;
    }*/

    // Actualiza un libro (todo menos sus autores). Devuelve 1 si tiene éxito y 0 en caso de fallo.
    public function update($id, $idResource, $idUser, $idTimeSlot, $date, $remarks)
    {
        $ok = $this->db->dataManipulation("UPDATE Reservations SET
                                idResource = '$idResource',
                                idUser = '$idUser',
                                idTimeSlot = '$idTimeSlot',
                                date = '$date',
                                remarks = '$remarks'
                                WHERE id = '$id'");
        return $ok;
    }


    // Busca un texto en las tablas de libros y autores. Devuelve un array de objetos con todos los libros
    // que cumplen el criterio de búsqueda.
    public function search($textoBusqueda)
    {
        // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda
        $result = $this->db->dataQuery("SELECT * FROM Reservations
					                   /* INNER JOIN escriben ON libros.idLibro = escriben.idLibro
					                    INNER JOIN personas ON escriben.idPersona = personas.idPersona*/
					                    WHERE date LIKE '%$textoBusqueda%'
					            
					                    ORDER BY date");
        return $result;
    }
}
