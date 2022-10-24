<?php

// CONTROLADOR DE LIBROS

use LDAP\Result;

include_once("models/timeSlot.php");  // Modelos
//include_once("models/TimeSlots.php");
include_once("view.php");

class TimeSlotsController {
    
    private $db;
    private $resource , $timeSlot;

    public function __construct(){

        $this->timeSlot = new TimeSlot();
        //$this->timeSlot = new TimeSlot();
    
    }

    // --------------------------------- MOSTRAR LISTA DE LIBROS ----------------------------------------
    public function mostrarListaTimeSlots()
    {
        /*if (Seguridad::haySesion()) {*/
            $data["listaTimeSlots"] = $this->timeSlot->getAll();
            View::render("timeSlots/showTime", $data);
        /*} else {
            $data["error"] = "No tienes permiso para eso";
            View::render("usuario/login", $data);
        }*/
    }

    public function formularioInsertarTimeSlot(){
        
        View::render("timeSlots/insert");

    }
    //$dayOfWeek','$startTime', '$endTime'

    public function insertarTimeSlot(){
        $dayOfWeek = $_REQUEST["dayOfWeek"];
        $startTime = $_REQUEST["startTime"];
        $endTime = $_REQUEST["endTime"];
        
        $result = $this -> timeSlot ->insert($dayOfWeek, $startTime, $endTime);
        if ($result != 1) {
            $data["error"] = "Error al insertar";   
        }

        header("Location: index.php?controller=timeSlotsController&action=mostrarListaTimeSlots");

    }

    public function formularioModificarTimeSlot(){
        
        $data["listaTimeSlots"] = $this->timeSlot->get($_REQUEST["id"]);
        //var_dump($data["listaResources"]);
        View::render("timeSlots/modificar" , $data);

    }

    public function modificarTimeSlot(){
        $id = $_REQUEST["id"];
        $dayOfWeek = $_REQUEST["dayOfWeek"];
        $startTime = $_REQUEST["startTime"];
        $endTime = $_REQUEST["endTime"];

        $result = $this -> timeSlot ->update($id, $dayOfWeek, $startTime, $endTime );
        if ($result == 1) {
            $data["info"] = "Time actualizado con éxito";   
        } else {
            $data["error"] = "Error al modificar";
        }
        header("Location: index.php?controller=timeSlotsController&action=mostrarListaTimeSlots");

    }

    public function borrarTimeSlot(){
        $id = $_REQUEST["id"];
        $result = $this -> timeSlot -> delete($id);
        if ($result == 1) {
            $data["info"] = "Time borrado con éxito";   
        } else {
            $data["error"] = "Error al borrar";
        }
        header("Location: index.php?controller=timeSlotsController&action=mostrarListaTimeSlots");
        //View::render("resources/all", $data);
    }

    public function buscarTimeSlot() {
        // Recuperamos el texto de búsqueda de la variable de formulario
        $textoBusqueda = $_REQUEST["textoBusqueda"];
        // Buscamos los libros que coinciden con la búsqueda
        $data["listaTimeSlots"] = $this->timeSlot->search($textoBusqueda);
        $data["info"] = "Resultados de la búsqueda: <i>$textoBusqueda</i>";
        // Mostramos el resultado en la misma vista que la lista completa de libros
        View::render("timeSlots/showTime", $data);
    }

}