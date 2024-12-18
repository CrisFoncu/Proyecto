<?php
$conexion = conectar();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['idusuario'])) {
    header("Location: login.php");
    exit;
}

// Obtener los datos del usuario
$idusuario = $_SESSION['idusuario'];
$sql = "SELECT * FROM usuarios WHERE idusuario = '$idusuario' LIMIT 1";
$result = mysqli_query($conexion, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $usuario = mysqli_fetch_assoc($result);
} else {
    echo "Error al cargar los datos del usuario.";
    exit;
}

$mensaje = '';
$puntos_ganados = 0;
$palabras = ["avion", "luna", "sol", "estrella", "binter", "isla", "aeropuerto"];

// Comprobar si ya existe una palabra seleccionada en la sesión
if (!isset($_SESSION['palabra_secreta'])) {
    $_SESSION['palabra_secreta'] = $palabras[array_rand($palabras)];
    $_SESSION['letras_adivinadas'] = array_fill(0, strlen($_SESSION['palabra_secreta']), '_');
    $_SESSION['intentos'] = 6;
}

$palabra_secreta = $_SESSION['palabra_secreta'];
$letras_adivinadas = $_SESSION['letras_adivinadas'];
$intentos = $_SESSION['intentos'];
$longitud_palabra = strlen($palabra_secreta);

$mensaje_error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $letra = $_POST['letra'];

    // Validar que la letra sea una sola y no repetida
    if (strlen($letra) != 1 || !ctype_alpha($letra)) {
        $mensaje_error = "Por favor, ingresa solo una letra.";
    } elseif (in_array($letra, $letras_adivinadas)) {
        $mensaje_error = "Ya has adivinado esa letra. Intenta con otra.";
    } else {
        // Comprobar si la letra está en la palabra secreta
        $letra_encontrada = false;
        for ($i = 0; $i < $longitud_palabra; $i++) {
            if (strtolower($palabra_secreta[$i]) == strtolower($letra)) {
                $letras_adivinadas[$i] = $letra;
                $letra_encontrada = true;
            }
        }

        // Si la letra no está, restamos un intento
        if (!$letra_encontrada) {
            $intentos--;
        }

        // Comprobar si adivinó la palabra completa
        if (implode('', $letras_adivinadas) == $palabra_secreta) {
            // Determinar los puntos ganados según el tipo de tarjeta
            if (strpos(strtolower($usuario['numero_tarjeta']), 'nt10') === 0) {
                $puntos_ganados = 100; // Tarjeta verde
            } elseif (strpos(strtolower($usuario['numero_tarjeta']), 'nt20') === 0) {
                $puntos_ganados = 200; // Tarjeta plata
            } elseif (strpos(strtolower($usuario['numero_tarjeta']), 'nt30') === 0) {
                $puntos_ganados = 300; // Tarjeta oro
            } else {
                $puntos_ganados = 0; // Por si no coincide ningún tipo
            }

            $mensaje = "¡Felicidades! Has adivinado la palabra '$palabra_secreta'. Has ganado $puntos_ganados puntos.";

            // Actualizar puntos del usuario en la base de datos
            $nuevo_puntos = $usuario['puntos'] + $puntos_ganados;
            $sql_update = "UPDATE usuarios SET puntos = '$nuevo_puntos' WHERE idusuario = '$idusuario'";
            if (!mysqli_query($conexion, $sql_update)) {
                echo "Error al actualizar los puntos: " . mysqli_error($conexion);
                exit;
            }

            // Reiniciar juego: resetear las variables de sesión
            unset($_SESSION['palabra_secreta']);
            unset($_SESSION['letras_adivinadas']);
            unset($_SESSION['intentos']);

            // Redirigir a la misma página para reiniciar el juego
            echo "$mensaje";
            header("Refresh: 3; URL=ahorcado.php");
            exit; // Asegurarse de que el script se detiene después del header
        } elseif ($intentos == 0) {
            $mensaje = "Lo siento, has perdido. La palabra correcta era '$palabra_secreta'.";
            // Resetear el juego al perder
            unset($_SESSION['palabra_secreta']);
            unset($_SESSION['letras_adivinadas']);
            unset($_SESSION['intentos']);
        }



    }

    // Actualizar sesión con los nuevos valores
    $_SESSION['letras_adivinadas'] = $letras_adivinadas;
    $_SESSION['intentos'] = $intentos;
}