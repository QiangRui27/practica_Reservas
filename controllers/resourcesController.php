<?php

// CONTROLADOR DE LIBROS

use LDAP\Result;

include_once("models/resource.php");  // Modelos
//include_once("models/TimeSlots.php");
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
        /*if (Seguridad::haySesion()) {*/
            $data["listaResources"] = $this->resource->getAll();
            View::render("resources/all", $data);
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }*/
    }

    public function formularioInsertarResource(){
        
        View::render("resources/insert");

    }


    public function insertarResource(){
        $name = $_REQUEST["name"];
        $description = $_REQUEST["description"];
        $location = $_REQUEST["location"];

        $dir = 'imagenes/';
        $file = $dir.basename($_FILES['image']['name']);
        
       /* if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
            echo 'El archivo se ha subido correctamente.';
        } else {
            echo 'Ha habido un error en la subida del archivo.';
        }*/
        
        $result = $this -> resource ->insert($name, $description, $location, $file);
        if ($result != 1) {
            $data["error"] = "Error al insertar";   
        }

        header("Location: index.php?controller=ResourcesController&action=mostrarListaResources");

    }

    public function formularioModificarResource(){
        
        $data["listaResources"] = $this->resource->get($_REQUEST["id"]);
        //var_dump($data["listaResources"]);
        View::render("resources/modificar" , $data);

    }

    public function modificarResource(){
        $id = $_REQUEST["id"];
        $name = $_REQUEST["name"];
        $description = $_REQUEST["description"];
        $location = $_REQUEST["location"];
        $image = $_REQUEST["image"];

        $result = $this -> resource ->update($id, $name, $description, $location, $image);
        if ($result == 1) {
            $data["info"] = "Resource actualizado con éxito";   
        } else {
            $data["error"] = "Error al modificar";
        }
        header("Location: index.php?controller=ResourcesController&action=mostrarListaResources");

    }

    public function borrarResource(){
        $id = $_REQUEST["id"];
        $result = $this -> resource -> delete($id);
        if ($result == 1) {
            $data["info"] = "Resource borrado con éxito";   
        } else {
            $data["error"] = "Error al borrar";
        }
        header("Location: index.php?controller=ResourcesController&action=mostrarListaResources");
        //View::render("resources/all", $data);
    }

    public function buscarResource() {
        // Recuperamos el texto de búsqueda de la variable de formulario
        $textoBusqueda = $_REQUEST["textoBusqueda"];
        // Buscamos los libros que coinciden con la búsqueda
        $data["listaResources"] = $this->resource->search($textoBusqueda);
        $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
        // Mostramos el resultado en la misma vista que la lista completa de libros
        View::render("resources/all", $data);
    }

}