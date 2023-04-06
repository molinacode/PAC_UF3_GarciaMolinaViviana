<?php
// Incluye el archivo de conexión a la base de datos y las funciones necesarias
require_once 'conexion.php';
require_once 'funciones.php';

// Comprueba si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario y los valida
    $nombre = validar_campo($_POST['user']);
    $correo = validar_campo($_POST['email']);

    // Realiza la consulta a la base de datos para comprobar si el usuario existe y es válido
    $query = "SELECT * FROM users WHERE user = '$nombre' AND password = '$correo'";
    $result = mysqli_query($conn, $query);

    // Comprueba si se encontró un usuario con las credenciales proporcionadas
    if (mysqli_num_rows($result) === 1) {
        // Obtiene los datos del usuario
        $user = mysqli_fetch_assoc($result);

       /* // Comprueba el tipo de usuario
        if ($user['type'] === 'superadmin') {
            // Si es un superadmin, redirige a usuarios.php y crea la cookie
            setcookie('tipo_usuario', 'superadmin');
            header('Location: usuarios.php');
            exit;
        } elseif ($user['type'] === 'autorizado') {
            // Si es un usuario autorizado, redirige a articulos.php y crea la cookie
            setcookie('tipo_usuario', 'autorizado');
            header('Location: articulos.php');
            exit;
        } elseif ($user['type'] === 'registrado') {
            // Si es un usuario registrado pero no autorizado, muestra un mensaje de error y no crea la cookie
            echo 'Lo siento, no tienes permisos para acceder a esta aplicación.';
        }
    } else {
        // Si no se encontró un usuario con las credenciales proporcionadas, muestra un mensaje de error y no crea la cookie
        echo 'Lo siento, el usuario no está registrado.';
    */
    }
     // Utiliza switch para manejar diferentes tipos de usuario
    switch ($user['type']) {
        case 'superadmin':
          // Si es un superadmin, redirige a usuarios.php
            header('Location: usuarios.php');
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

<!DOCTYPE html>
<html lang="es"></html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="30">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <link rel="stylesheet" href="/css/styles.css">
    <script src=""></script>
    <title></title>
</head>

<body>
    <div id="formulario">
        <img src="" alt="logo de inicio de la app" />
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="usuario">Nombre de usuario</label>
            <input type="text" name="user" required>
            <label for="email">Email</label>
            <input type="email" name="email" required>
            <input type="submit" name="submit" value="Acceder">
        </form>
    </div>
</body>
</html>   