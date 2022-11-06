<?php
// VISTA PARA INSERCIÓN/EDICIÓN DE LIBROS

// extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales ($libro, $todosLosAutores y $autoresLibro)

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $libro: si existe, es porque estamos modificando un libro. Si no, estamos insertando uno nuevo.

    echo "<h1>Inserción de Usuarios</h1>";



// Sacamos los datos del libro (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay libro, dejamos los campos en blanco y el formulario servirá para inserción).


// Creamos el formulario con los campos del libro
echo "<form action='index.php' method = 'get'>
        <input type='hidden' name='id' value=''>
        Nombre de Usuario:<input type='text' name='username' value=''><br>
        Contraseña:<input type='text' name='password' value=''><br>
        Nombre real:<input type='text' name='realname' value=''><br>
        Tipo:<select name='type'>
        <option value='User'>Usuario</option>
        <option value='Admin'>Administrador</option>
        </select><br>";

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
echo "  <input type='hidden' name='action' value='insertarUser'>";

echo "	<input type='submit'></form>";

echo "<p><a href='index.php?controller=usersController&action=mostrarListaUsers'>Volver</a></p>";


