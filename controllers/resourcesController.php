<?php

// CONTROLADOR DE LIBROS

use LDAP\Result;

include_once("models/resource.php");  // Modelos
include_once("models/TimeSlots.php");
include_once("view.php");

class ResourcesController {
    
    private $db;
    private $resource , $timeSlot;

    public function __construct(){

        $this->resource = new Resource();
        //$this->timeSlot = new TimeSlot();
    
    }

    // --------------------------------- MOSTRAR LISTA DE LIBROS ----------------------------------------
    public function mostrarListaResources()
    {
        if (Seguridad::haySesion()) {
            $data["listaResources"] = $this->resource->getAll();
            View::render("resources/all", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    public function formularioInsertarResource(){
        if (Seguridad::haySesion()) {
            View::render("resources/insert");
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }


    public function insertarResource(){
        if (Seguridad::haySesion()) {
        $name = Seguridad::limpiar($_REQUEST["name"]);
        $description = Seguridad::limpiar($_REQUEST["description"]);
        $location = Seguridad::limpiar($_REQUEST["location"]);

        $dir = 'imagenes/';
        $file = $dir.basename($_FILES['image']['name']);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
            $data["info"] = "Imagen subida con exito";
        } else {
            $data["info"] = "Fallo al subir la imagen";;
        }
        
        $result = $this -> resource ->insert($name, $description, $location, $file);
        if ($result != 1) {
            $data["error"] = "Error al insertar";   
        }

        header("Location: index.php?controller=ResourcesController&action=mostrarListaResources");

        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }


    public function formularioModificarResource(){
        if (Seguridad::haySesion()) {
        $data["listaResources"] = $this->resource->get($_REQUEST["id"]);
        //var_dump($data["listaResources"]);
        View::render("resources/modificar" , $data);

        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    public function modificarResource(){
        if (Seguridad::haySesion()) {
        $id = Seguridad::limpiar($_REQUEST["id"]);
        $name = Seguridad::limpiar($_REQUEST["name"]);
        $description = Seguridad::limpiar($_REQUEST["description"]);
        $location = Seguridad::limpiar($_REQUEST["location"]);
        $dir = 'imagenes/';
        $file = $dir.basename($_FILES['image']['name']);
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
            $data["info"] = "Imagen subida con exito";
        } else {
            $data["info"] = "Fallo al subir la imagen";;
        }

        $result = $this -> resource ->update($id, $name, $description, $location, $file);
        if ($result == 1) {
            $data["info"] = "Resource actualizado con éxito";   
        } else {
            $data["error"] = "Error al modificar";
        }
        header("Location: index.php?controller=ResourcesController&action=mostrarListaResources");

        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    public function borrarResource(){
        if (Seguridad::haySesion()) {
        $id = Seguridad::limpiar($_REQUEST["id"]);
        $result = $this -> resource -> delete($id);
        if ($result == 1) {
            $data["info"] = "Resource borrado con éxito";   
        } else {
            $data["error"] = "Error al borrar";
        }
        header("Location: index.php?controller=ResourcesController&action=mostrarListaResources");
        //View::render("resources/all", $data);
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    public function buscarResource() {
        if (Seguridad::haySesion()) {
        // Recuperamos el texto de búsqueda de la variable de formulario
        $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
        // Buscamos los libros que coinciden con la búsqueda
        $data["listaResources"] = $this->resource->search($textoBusqueda);
        $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
        // Mostramos el resultado en la misma vista que la lista completa de libros
        View::render("resources/all", $data);
        }else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    public function formularioReservarResource(){
        if (Seguridad::haySesion()) {
            $this->timeSlot = new TimeSlot();
            $data["listaResources"] = $this->resource->getAll();
            $data["listaTimeSlots"] = $this->timeSlot->getAll();
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
        
    }

}