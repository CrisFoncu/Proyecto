<?php
$conexion = conectar(); // Conectar a la base de datos

// array de las localidades canarias
$localidades = [
    'Corralejo',
    'Matorral',
    'La Laguna',
    'Arrecife',
    'Puerto del Rosario'
];

// función para obtener 4 localidades aleatorias
function obtener_localidades_aleatorias($localidades)
{
    $cantidad = rand(1, 4);
    $indices = (array) array_rand($localidades, $cantidad);
    $seleccionadas = [];

    foreach ($indices as $indice) {
        $seleccionadas[] = $localidades[$indice];
    }
    return $seleccionadas;
}

// Si el formulario no ha sido enviado, genera nueva secuencia
if (!isset($_POST['respuesta'])) {
    $mostrarlocalidades = obtener_localidades_aleatorias($localidades);
    $secuencia = implode(',', $mostrarlocalidades);
} else {
    // Recupera la secuencia original y la respuesta del usuario
    $secuencia = $_POST['secuencia'];
    $respuesta = $_POST['respuesta'];

    // Compara respuesta con secuencia original
    if (strtolower(str_replace(' ', '', $respuesta)) === strtolower(str_replace(' ', '', $secuencia))) {
        $mensaje = "¡Correcto! Has acertado la secuencia.";

        // Obtener datos del usuario para determinar los puntos según la tarjeta
        $idusuario = $_SESSION['idusuario'];
        $sql = "SELECT * FROM usuarios WHERE idusuario = '$idusuario'";
        $result = mysqli_query($conexion, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $usuario = mysqli_fetch_assoc($result);

            // Determinar puntos según el tipo de tarjeta
            $puntos_ganados = 0;
            if (strpos(strtolower($usuario['numero_tarjeta']), 'nt10') === 0) {
                $puntos_ganados = 50; // Tarjeta verde
            } elseif (strpos(strtolower($usuario['numero_tarjeta']), 'nt20') === 0) {
                $puntos_ganados = 100; // Tarjeta plata
            } elseif (strpos(strtolower($usuario['numero_tarjeta']), 'nt30') === 0) {
                $puntos_ganados = 150; // Tarjeta oro
            }

            // Actualizar los puntos del usuario en la base de datos
            $nuevo_puntos = $usuario['puntos'] + $puntos_ganados;
            $sql_update = "UPDATE usuarios SET puntos = '$nuevo_puntos' WHERE idusuario = '$idusuario'";
            if (!mysqli_query($conexion, $sql_update)) {
                echo "Error al actualizar los puntos: " . mysqli_error($conexion);
                exit;
            }

            $mensaje .= " Has ganado $puntos_ganados puntos.";
        } else {
            $mensaje = "Error al obtener los datos del usuario.";
        }
    } else {
        $mensaje = "Incorrecto. La secuencia correcta era: " . $secuencia;
    }
}
