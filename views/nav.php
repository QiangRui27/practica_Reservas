<?php
    if (Seguridad::haySesion()) {
        echo "<h3>Bienvenido/a ". $_SESSION['username']. "</h3>";
    }

?>

<hr/>

<nav>
    Menú de navegación: 
    <a href='index.php?controller=ResourcesController&action=mostrarListaReservas'>Reservas</a>
    <a href='index.php?controller=ResourcesController&action=mostrarListaResources'>Resources</a>
    <a href='index.php?controller=timeSlotsController&action=mostrarListaTimeSlots'>Horarios</a>
    <a href='index.php?controller=usersController&action=mostrarListaUsers'>Usuarios</a>
    
    <?php
        if (Seguridad::haySesion()) {
            echo "<a href='index.php?controller=UsersController&action=cerrarSesion'>Cerrar sesión</a>";
        }
    ?>

</nav>
<hr/>