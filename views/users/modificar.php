<?php
// VISTA PARA INSERCIÓN/EDICIÓN DE LIBROS

//extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales ($libro, $todosLosAutores y $autoresLibro)

extract($data);
// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $libro: si existe, es porque estamos modificando un libro. Si no, estamos insertando uno nuevo.

echo "<h1>Modificación de Recursos</h1>";



// Sacamos los datos del libro (si existe) a variables individuales para mostrarlo en los inputs del formulario.
/*(Si no hay libro, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $resource->id ?? "";
$name = $resource->name ?? "";
$description = $resource->description ?? "";
$location = $resource->location ?? "";
$image = $resource->image ?? "";
$cartel = $resource->cartel ?? "";*/

// Creamos el formulario con los campos del libro
echo "<form action = 'index.php' method = 'get'>
        <input type='hidden' name='id' value='" . $listaUsers[0]->id . "'>
        Nombre de Usuario:<input type='text' name='username' value='" . $listaUsers[0]->username . "'><br>
        Contraseña:<input type='text' name='password' value='" . $listaUsers[0]->password . "'><br>
        Nombre real:<input type='text' name='realname' value='" . $listaUsers[0]->realname . "'><br>
        Tipo:<select name='type'>";

        if ($listaUsers[0]->type == "User") {
            echo    "<option value='User' selected>Usuario</option>
                     <option value='Admin'>Administrador</option>
                     </select><br>";
        } else {
            echo    "<option value='User' >Usuario</option>
                     <option value='Admin' selected>Administrador</option>
                     </select><br>";
        }
        
            


/*echo "Autores: <select name='autor[]' multiple size='3'>";
foreach ($todosLosAutores as $fila) {
    if (in_array($fila->idPersona, $autoresLibro))
        echo "<option value='$fila->idPersona' selected>$fila->nombre $fila->apellido</option>";
    else
        echo "<option value='$fila->idPersona'>$fila->nombre $fila->apellido</option>";
}
echo "</select>";*/

// Finalizamos el formulario
echo "  <input type='hidden' name='controller' value='UsersController'>";
    echo "  <input type='hidden' name='action' value='modificarUser'>";


echo "	<input type='submit'></form>";
echo "<p><a href='index.php?controller=usersController&action=mostrarListaUsers'>Volver</a></p>";
