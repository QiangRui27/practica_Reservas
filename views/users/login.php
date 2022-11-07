<h1>LOGIN</h1>

<?php
if (isset($data["error"])) {
    echo "<div style='color: red'>".$data["error"]."</div>";
}
if (isset($data["info"])) {
    echo "<div style='color: blue'>".$data["info"]."</div>";
}
?>

<form action="index.php" method="get">
    Nombre de usuario: <input type='text' name='username'><br/>
    Password: <input type='password' name='password'><br/>
    <input type='hidden' name='action' value='procesarFormLogin'>
    <input type='hidden' name='controller' value='UsersController'>
    <button type='submit'>Enviar</button>
</form>