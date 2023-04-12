<?php
// Verificar las credenciales del usuario (debe manejar la verificación de contraseñas de forma segura)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];

    // verificar las credenciales de usuario aquÃ­

    if ($es_superadmin) {
        // redirigir al usuario a la pagina de usuarios
        header("Location: users.php");
        exit;
    } elseif ($es_autorizado) {
        // redirigir al usuario a la pagina de articulos
        header("Location: articulos.php");
        exit;
    } elseif ($es_registrado) {
        // mostrar un mensaje de error indicando que el usuario no tiene permisos suficientes
        http_response_code(403);
        echo "No tienes permisos suficientes para acceder a esta página.";
        exit;
    } else {
        // mostrar un mensaje de error indicando que las credenciales del usuario son inválidas
        http_response_code(401);
        echo "Las credenciales de usuario no son válidas. Por favor, inténtalo de nuevo.";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <form method="POST" action="index.php">
        <label for="user">Nombre de usuario</label>
        <input type="text" name="usuario" required></br>
        <label for="email">Email</label>
        <input type="email" name="email" required></br>
        <input type="submit" value="Acceder" name="submit">
    </form>
</body>
</html>