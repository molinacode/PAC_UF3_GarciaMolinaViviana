<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="30">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="./css/styles.css">
    <script src=""></script>
    <title>Inicio</title>
</head>

<body>
    <div id="formulario">
        <h3>Inicio de sesión</h3>
        <img src="" alt="logo de inicio de la app" />
        <form method="post" action="index.php">
            <label for="usuario">Nombre de usuario</label>
            <input type="text" name="user" required></br>
            <label for="email">Email</label>
            <input type="email" name="email" required></br>
            <input type="submit" name="submit" value="Acceder">
        </form>
        <?php
        // Incluye el archivo de conexión a la base de datos y las funciones necesarias
        require_once 'conexion.php';

        // Comprueba si el formulario ha sido enviado
        if (isset($_POST['Acceder'])) {
            // Obtiene los datos del formulario y los valida
            $nombre = validar_campo($_POST['user']);
            $correo = validar_campo($_POST['email']);
            setcookie("datos", $user, time() + 500);
            // Utiliza switch para manejar diferentes tipos de usuario
            switch ($user['type']) {
                case 'superadmin':
                    // Si es un superadmin, redirige a usuarios.php
                    header('Location: users.php');
                    exit;
                case 'autorizado':
                    // Si es un usuario autorizado, redirige a articulos.php
                    header('Location: articulos.php');
                    exit;
                case 'registrado':
                    // Si es un usuario registrado pero no autorizado, muestra un mensaje de error
                    echo 'Lo siento, no tienes permisos para acceder a esta aplicación.';
                    break;
                default:
                    // Si el tipo de usuario no es reconocido, muestra un mensaje de error
                    echo 'Lo siento, el usuario no está registrado.';
                    break;
            }
        } else {
            // Si no se encontró un usuario con las credenciales proporcionadas, muestra un mensaje de error
            echo 'Lo siento, el usuario no está registrado.';
        }
        ?>
    </div>
</body>

</html>