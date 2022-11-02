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
        if (Seguridad::haySesion()) {
            $data["listaUsers"] = $this->user->getAll();
            View::render("users/showUser", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    public function formularioInsertarUser(){
        if (Seguridad::haySesion()) {
        View::render("users/insert");
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("users/login", $data);
    }
    }


    public function insertarUser(){
        if (Seguridad::haySesion()) {
        $username = Seguridad::limpiar($_REQUEST["username"]);
        $password = Seguridad::limpiar($_REQUEST["password"]);
        $realname = Seguridad::limpiar($_REQUEST["realname"]);
        $type = Seguridad::limpiar($_REQUEST["type"]);
        
        $result = $this -> user ->insert($username, $password, $realname, $type);
        if ($result != 1) {
            $data["error"] = "Error al insertar";   
        }

        header("location: index.php?controller=UsersController&action=mostrarlistaUsers");
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("users/login", $data);
    }
    }

    public function formularioModificarUser(){
        if (Seguridad::haySesion()) {
        $data["listaUsers"] = $this->user->get(Seguridad::limpiar($_REQUEST["id"]));
        //var_dump($data["listaUsers"]);
        View::render("users/modificar" , $data);
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("users/login", $data);
    }
    }

    public function modificarUser(){
        if (Seguridad::haySesion()) {
        $id = Seguridad::limpiar($_REQUEST["id"]);
        $username = Seguridad::limpiar($_REQUEST["username"]);
        $password = Seguridad::limpiar($_REQUEST["password"]);
        $realname = Seguridad::limpiar($_REQUEST["realname"]);
        $type = Seguridad::limpiar($_REQUEST["type"]);

        $result = $this -> user ->update($id, $username, $password, $realname, $type);
        if ($result == 1) {
            $data["info"] = "Resource actualizado con éxito";   
        } else {
            $data["error"] = "Error al modificar";
        }
        header("location: index.php?controller=UsersController&action=mostrarlistaUsers");
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("users/login", $data);
    }
    }

    public function borrarUser(){
        if (Seguridad::haySesion()) {
        $id = Seguridad::limpiar($_REQUEST["id"]);
        $result = $this -> user -> delete($id);
        if ($result == 1) {
            $data["info"] = "Resource borrado con éxito";   
        } else {
            $data["error"] = "Error al borrar";
        }
        header("location: index.php?controller=UsersController&action=mostrarlistaUsers");
        //View::render("Users/all", $data);
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("users/login", $data);
    }
    }

    public function buscarUser() {
        if (Seguridad::haySesion()) {
        // Recuperamos el texto de búsqueda de la variable de formulario
        $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
        // Buscamos los libros que coinciden con la búsqueda
        $data["listaUsers"] = $this->user->search($textoBusqueda);
        $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
        // Mostramos el resultado en la misma vista que la lista completa de libros
        View::render("users/showUser", $data);
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("usuario/login", $data);
    }
    }


    public function login() {
        View::render("users/login");
    }

    // Comprueba los datos de login. Si son correctos, el modelo iniciará la sesión y
    // desde aquí se redirige a otra vista. Si no, nos devuelve al formulario de login.
    public function procesarFormLogin() {
        $username = Seguridad::limpiar($_REQUEST["username"]);
        $password = Seguridad::limpiar($_REQUEST["password"]);
        $result = $this->user->login($username, $password);
        if ($result) { 
            header("Location: index.php?controller=ResourcesController&action=mostrarListaResources");
        } else {
            $data["error"] = "Usuario o contraseña incorrectos";
            View::render("users/login", $data);
        }
    }

    // Cierra la sesión y nos lleva a la vista de login
    public function cerrarSesion() {
        $this->user->cerrarSesion();
        $data["info"] = "Sesión cerrada con éxito";
        View::render("users/login", $data);
    }
 
}

