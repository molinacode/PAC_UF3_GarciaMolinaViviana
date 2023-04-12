<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="30">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <link rel="stylesheet" href="">
    <title>Usuarios</title>
</head>

<body>
    <div class="content">
        <h1>Usuarios</h1>
        <?php
        // Incluir los archivos necesarios
        include "funciones.php";
        if (!isset($_COOKIE['datos']) or ($_COOKIE['datos'] != "superadmin")) {
            echo "No tienes permiso para estar aquí.";
        } else {
            if (isset($_GET['Cambiar'])) {
                cambiarPermisos();
            }
        }
        ?>
        <p> Los permisos actuales están a <span>
                <?php echo getPermisos(); ?>
            </span></p>
        <form action="users.php" action="GET">
            <p><input type="submit" name="Cambiar" value="Cambiar Permisos"></p>
        </form>
        <?php
        pintaTablaUsuarios();
        ?>
        <a href="index.php">Volver a la página principal</a>
    </div>
</body>
</html>