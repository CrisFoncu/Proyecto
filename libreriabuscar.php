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

// Colores según el tipo de tarjeta
$tarjeta_colores = [
    'verde' => '#00843d',
    'plata' => '#c0c0c0',
    'oro' => '#d5ac4e'
];

$color_tarjeta = $tarjeta_colores['verde']; // Valor predeterminado
if (strpos($usuario['numero_tarjeta'], 'NT20') === 0) {
    $color_tarjeta = $tarjeta_colores['plata'];
} elseif (strpos($usuario['numero_tarjeta'], 'NT30') === 0) {
    $color_tarjeta = $tarjeta_colores['oro'];
}
// Procesar búsqueda si hay un filtro
$filtro_columna = isset($_POST['filtro_columna']) ? $_POST['filtro_columna'] : '';
$filtro_valor = isset($_POST['filtro_valor']) ? $_POST['filtro_valor'] : '';

$sql_vuelos = "SELECT * FROM vuelos";

if (!empty($filtro_columna) && !empty($filtro_valor)) {
    $sql_vuelos .= " WHERE $filtro_columna LIKE '%$filtro_valor%'";
}

$vuelos = mysqli_query($conexion, $sql_vuelos);
?>