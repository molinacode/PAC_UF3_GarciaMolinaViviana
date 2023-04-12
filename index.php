<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="30">
    <link rel="icon" type="image/x-icon" href="">
    <link rel="stylesheet" href="">
    <title>Inicio</title>
</head>

<body>
    <?php
    // Incluye el archivo de conexión a la base de datos y las funciones necesarias
    require_once 'conexion.php';
    ?>

    <form action="index.php" method="post">
        <label for="user">Nombre de usuario</label>
        <input type="text" name="user" required></br>
        <label for="email">Email</label>
        <input type="email" name="email" required></br>
        <input type="submit" value="Acceder" name="submit">
    </form>
    <?php
    // Comprueba si el formulario ha sido enviado
    if (isset($_POST['Acceder'])) {
        // Obtiene los datos del formulario y los valida
        $nombre = $_POST['user'];
        $correo = $_POST['email'];
        setcookie('datos', $nombre, time() + 500);
        echo "cookie establecida. Los datos son: " . $_COOKIE['datos'] . "<br>";

        // Utiliza switch para manejar diferentes tipos de usuario
        switch ($nombre) {
            case 'superadmin':
                // Si es un superadmin, redirige a usuarios.php
                setcookie('datos', $nombre, time() + 500);
                header('Location: users.php');
                exit;
            case 'autorizado':
                // Si es un usuario autorizado, redirige a articulos.php
                setcookie('datos', $nombre, time() + 500);
                header('Location: articulos.php');
                exit;
            case 'registrado':
                // Si es un usuario registrado pero no autorizado, muestra un mensaje de advertencia
                echo 'Hola ' . $nombre . ', no tienes permisos para acceder a esta aplicación.';
                break;
            default:
                // Si el nombre de usuario no está registrado, muestra un mensaje de error
                echo 'Lo siento, ' . $nombre . ' no está registrado.';
                break;
        }
    }
    ?>
    <?php // Mostrar mensaje de bienvenida si se estableció una cookie de tipo de usuario
    if (isset($_COOKIE['datos'])) {
        $nombre = $_COOKIE['datos'];
        switch ($nombre) {
            case 'superadmin':
                echo '¡Bienvenido, ' . $nombre . '! Haz clic <a href="users.php">aquí</a> para acceder a la página de usuarios.';
                break;
            case 'autorizado':
                echo '¡Bienvenido, ' . $nombre . '! Haz clic <a href="articulos.php">aquí</a> para acceder a la página de artículos.';
                break;
            case 'registrado':
                echo 'Hola ' . $nombre . ', no tienes permisos para acceder a esta aplicación.';
                break;
        }
    }
    ?>
    <?php
    // Establecer cookie
    setcookie('datos', $nombre, time() + 500);

    // Mostrar mensaje de confirmaciÃ³n
    if (isset($_COOKIE['datos'])) {
        $valor = $_COOKIE['datos'];
        echo "La cookie ha sido establecida con el valor: " . $valor;
    } else {
        echo "Cookie no establecida.";
    }
    ?>

</body>

</html>