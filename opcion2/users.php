<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    // Incluir los archivos necesarios
    include "funciones.php";

    if (!isset($_COOKIE["datos"]) or ($_COOKIE["datos"] != "superadmin")) {
        echo "No tienes permiso para estar aquí.";

    } else {
        if (isset($_GET['Cambiar'])) {
            cambiarPermisos();
        }
    }
?>
    <h1>Usuarios</h1>
    
    <p> Los permisos actuales están a <span>
            <?php echo getPermisos(); ?>
        </span></p>

    <form action="users.php" method="GET">
        <p><input type="submit" name="Cambiar" value="Cambiar Permisos"></p>
    </form>
    <?php
    pintaTablaUsuarios();
    ?>
    <a href="index.php">Volver a la página principal</a>
</body>
</html>