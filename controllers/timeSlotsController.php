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
        if (Seguridad::haySesion()) {
            $data["listaTimeSlots"] = $this->timeSlot->getAll();
            View::render("timeSlots/showTime", $data);
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    public function formularioInsertarTimeSlot(){
        if (Seguridad::haySesion()) {
        View::render("timeSlots/insert");
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("users/login", $data);
    }
    }
    //$dayOfWeek','$startTime', '$endTime'

    public function insertarTimeSlot(){
        if (Seguridad::haySesion()) {
        $dayOfWeek = Seguridad::limpiar($_REQUEST["dayOfWeek"]);
        $startTime = Seguridad::limpiar($_REQUEST["startTime"]);
        $endTime = Seguridad::limpiar($_REQUEST["endTime"]);
        
        $result = $this -> timeSlot ->insert($dayOfWeek, $startTime, $endTime);
        if ($result != 1) {
            $data["error"] = "Error al insertar";   
        }

        header("Location: index.php?controller=timeSlotsController&action=mostrarListaTimeSlots");
        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }

    public function formularioModificarTimeSlot(){
        if (Seguridad::haySesion()) {
        $data["listaTimeSlots"] = $this->timeSlot->get($_REQUEST["id"]);
        //var_dump($data["listaResources"]);
        View::render("timeSlots/modificar" , $data);
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("users/login", $data);
    }
    }

    public function modificarTimeSlot(){
        if (Seguridad::haySesion()) {
        $id = Seguridad::limpiar($_REQUEST["id"]);
        $dayOfWeek = Seguridad::limpiar($_REQUEST["dayOfWeek"]);
        $startTime = Seguridad::limpiar($_REQUEST["startTime"]);
        $endTime = Seguridad::limpiar($_REQUEST["endTime"]);

        $result = $this -> timeSlot ->update($id, $dayOfWeek, $startTime, $endTime );
        if ($result == 1) {
            $data["info"] = "Time actualizado con ??xito";   
        } else {
            $data["error"] = "Error al modificar";
        }
        header("Location: index.php?controller=timeSlotsController&action=mostrarListaTimeSlots");
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("users/login", $data);
    }
    }

    public function borrarTimeSlot(){
        if (Seguridad::haySesion()) {
        $id = Seguridad::limpiar($_REQUEST["id"]);
        $result = $this -> timeSlot -> delete($id);
        if ($result == 1) {
            $data["info"] = "Time borrado con ??xito";   
        } else {
            $data["error"] = "Error al borrar";
        }
        header("Location: index.php?controller=timeSlotsController&action=mostrarListaTimeSlots");
        //View::render("resources/all", $data);
    } else {
        $data["error"] = "No tienes permiso para eso";
        View::render("users/login", $data);
    }
    }

    public function buscarTimeSlot() {
        if (Seguridad::haySesion()) {
        // Recuperamos el texto de b??squeda de la variable de formulario
        $textoBusqueda = Seguridad::limpiar($_REQUEST["textoBusqueda"]);
        // Buscamos los libros que coinciden con la b??squeda
        $data["listaTimeSlots"] = $this->timeSlot->search($textoBusqueda);
        $data["info"] = "Resultados de la b??squeda: <i>$textoBusqueda</i>";
        // Mostramos el resultado en la misma vista que la lista completa de libros
        View::render("timeSlots/showTime", $data);

        } else {
            $data["error"] = "No tienes permiso para eso";
            View::render("users/login", $data);
        }
    }
}