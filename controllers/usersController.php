<?php

// CONTROLADOR DE LIBROS

use LDAP\Result;

include_once("models/user.php");  // Modelos
//include_once("models/TimeSlots.php");
include_once("view.php");

class UsersController {
    
    private $db;
    private $resource , $timeSlot , $user;

    public function __construct(){

        $this->user = new User();
        //$this->timeSlot = new TimeSlot();
    
    }

    // --------------------------------- MOSTRAR LISTA DE LIBROS ----------------------------------------
    public function mostrarlistaUsers()
    {
        /*if (Seguridad::haySesion()) {*/
            $data["listaUsers"] = $this->user->getAll();
            View::render("user/showUser", $data);
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }*/
    }

    public function formularioInsertarUser(){
        
        View::render("users/insert");

    }


    public function insertarUser(){
        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $realname = $_REQUEST["realname"];
        $type = $_REQUEST["type"];
        
        $result = $this -> user ->insert($username, $password, $realname, $type);
        if ($result != 1) {
            $data["error"] = "Error al insertar";   
        }

        header("realname: index.php?controller=UsersController&action=mostrarlistaUsers");

    }

    public function formularioModificarUser(){
        
        $data["listaUsers"] = $this->user->get($_REQUEST["id"]);
        //var_dump($data["listaUsers"]);
        View::render("users/modificar" , $data);

    }

    public function modificarUser(){
        $id = $_REQUEST["id"];
        $username = $_REQUEST["username"];
        $password = $_REQUEST["password"];
        $realname = $_REQUEST["realname"];
        $type = $_REQUEST["type"];

        $result = $this -> user ->update($id, $username, $password, $realname, $type);
        if ($result == 1) {
            $data["info"] = "Resource actualizado con éxito";   
        } else {
            $data["error"] = "Error al modificar";
        }
        header("realname: index.php?controller=UsersController&action=mostrarlistaUsers");

    }

    public function borrarUser(){
        $id = $_REQUEST["id"];
        $result = $this -> user -> delete($id);
        if ($result == 1) {
            $data["info"] = "Resource borrado con éxito";   
        } else {
            $data["error"] = "Error al borrar";
        }
        header("realname: index.php?controller=UsersController&action=mostrarlistaUsers");
        //View::render("Users/all", $data);
    }

    public function buscarUser() {
        // Recuperamos el texto de búsqueda de la variable de formulario
        $textoBusqueda = $_REQUEST["textoBusqueda"];
        // Buscamos los libros que coinciden con la búsqueda
        $data["listaUsers"] = $this->user->search($textoBusqueda);
        $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
        // Mostramos el resultado en la misma vista que la lista completa de libros
        View::render("users/showUser", $data);
    }

}