<?php

// MODELO DE RECURSOS

include_once "model.php";

class User extends Model
{

    // Constructor. Especifica el nombre de la tabla de la base de datos
    public function __construct()
    {
        $this->table = "Users";
        $this->idColumn = "id";
        parent::__construct();
    }

    // Devuelve el último id asignado en la tabla de recursos
    public function getMaxId()
    {
        $result = $this->db->dataQuery("SELECT MAX(id) AS ultimoIdUser FROM Users");
        return $result[0]->ultimoIdUser;
    }

    // Inserta un recurso. Devuelve 1 si tiene éxito o 0 si falla.
    public function insert($username, $password, $realname, $type)
    {
        return $this->db->dataManipulation("INSERT INTO Users (username,password,realname,type) VALUES ('$username','$password', '$realname', '$type')");
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
   public function update($id, $username, $password, $realname, $type)
    {
        $ok = $this->db->dataManipulation("UPDATE Users SET
                                username = '$username',
                                password = '$password',
                                realname = '$realname',
                                type = '$type'
                                WHERE id = '$id'");
        return $ok;
    }
    

    // Busca un texto en las tablas de libros y autores. Devuelve un array de objetos con todos los libros
    // que cumplen el criterio de búsqueda.
    public function search($textoBusqueda)
    {
        // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda
        $result = $this->db->dataQuery("SELECT * FROM Users
					                   /* INNER JOIN escriben ON libros.idLibro = escriben.idLibro
					                    INNER JOIN personas ON escriben.idPersona = personas.idPersona*/
					                    WHERE username LIKE '%$textoBusqueda%'
					            
					                    ORDER BY username");
        return $result;
    }


    // Comprueba si $email y $passwd corresponden a un usuario registrado. Si es así, inicia usa sesión creando
    // una variable de sesión y devuelve true. Si no, de vuelve false.
    public function login($username, $passwd) {
        $query = "SELECT * FROM Users WHERE username='$username' AND password='$passwd' ";
        $result = $this->db->dataQuery($query);
        var_dump($result);

        if (count($result) == 1) {
            foreach ($result as $user) {
                $id= $user->id;
                $username= $user->username;
                $type= $user->type;
            }
            Seguridad::iniciarSesion($id,$username,$type);
            return true;
        } else {
            return false;
        }
    }


    // Cierra una sesión (destruye variables de sesión)
    public function cerrarSesion() {
        Seguridad::cerrarSesion();
    }

}