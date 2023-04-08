    <?php 

        include "consultas.php";

        function validar_campo($campo) {
            // Limpia los datos recibidos
            $campo = trim($campo);
            $campo = stripslashes($campo);
            $campo = htmlspecialchars($campo);
            // Realiza la comprobación de si es el email y el user es válido
            // Retorna el campo limpio y validado
            return $campo;
        }        function pintaCategorias($defecto) {
            // Completar...	
        }
                function pintaTablaUsuarios(){
            // Completar...	
        }
        function pintaProductos($orden) {
            // Completar...	
        }

    ?>