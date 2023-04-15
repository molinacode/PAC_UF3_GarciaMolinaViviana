<?php
include "consultas.php";
// Verificar las credenciales del usuario (debe manejar la verificación de contraseñas de forma segura)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $idUsuario = isset($_COOKIE["datos"]) ? $_COOKIE["datos"] : 0; // Aqui se usa el ID del usuario que inicia sesión

    $tipoUsuario = tipoUsuario($usuario, $email);
    setcookie("datos",$tipoUsuario,time()+500);

    switch ($tipoUsuario) {
        case 'superadmin': // si es un superadministrador
            
            header("Location: users.php"); // redirigir al usuario a la pagina de usuarios
            break;

        case 'autorizado': // si es un usuario autorizado
            
            header("Location: articulos.php"); // redirigir al usuario a la pagina de articulos
            break;

        case 'registrado': // si es un usuario registrado
            http_response_code(403); // mostrar un mensaje de error indicando que el usuario no tiene permisos suficientes
            echo "No tienes permisos suficientes para acceder a esta página.";
            break;

        default: // si las credenciales del usuario son inválidas
            http_response_code(401); // mostrar un mensaje de error indicando que las credenciales del usuario son inválidas
            echo "Las credenciales de usuario no son válidas. Por favor, inténtalo de nuevo.";
            break;
    }
    exit; // salir del script
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