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

// Cargar los vuelos disponibles
$sql_vuelos = "SELECT * FROM vuelos";
$vuelos = mysqli_query($conexion, $sql_vuelos);

// Cargar las tarifas disponibles
$sql_tarifas = "SELECT tipoTarifa FROM reservas";
$tarifas = mysqli_query($conexion, $sql_tarifas);

// Listar las reservas actuales
$sql_reservas = "SELECT r.*, v.NumVuelo, v.origen, v.destino, r.fecha_reserva, r.tipoTarifa
                 FROM reservas r
                 JOIN vuelos v ON r.idvuelo = v.IdVuelo
                 WHERE r.idusuario = '$idusuario'";
$reservas = mysqli_query($conexion, $sql_reservas);

// Crear una nueva reserva
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idvuelo'])) {
    $idvuelo = $_POST['idvuelo'];
    $tipotarifa = $_POST['tipotarifa']; // Tarifa seleccionada
    $fecha_reserva = date('Y-m-d H:i:s');
    $estado = 'activa'; // Estado por defecto
    $fecha_limite = null;

    // Determinar la fecha límite de acuerdo con el tipo de tarjeta
    if ($color_tarjeta == '#00843d') {
        $fecha_limite = date('Y-m-d H:i:s', strtotime('+24 hours'));
    } elseif ($color_tarjeta == '#c0c0c0') {
        $fecha_limite = date('Y-m-d H:i:s', strtotime('+48 hours'));
    } elseif ($color_tarjeta == '#d5ac4e') {
        $fecha_limite = date('Y-m-d H:i:s', strtotime('+72 hours'));
    }


    // Continuar con la inserción o actualización
    $sql_reserva = "INSERT INTO reservas (idusuario, idvuelo, fecha_reserva, fecha_limite, estado, tipotarifa) 
                    VALUES ('$idusuario', '$idvuelo', '$fecha_reserva', '$fecha_limite', '$estado', '$tipotarifa')";
    if (mysqli_query($conexion, $sql_reserva)) {
        echo '<p>Reserva creada con éxito.</p>';
        header("Refresh:0 URL=carga.php");
    } else {
        echo '<p>Error al crear la reserva.</p>';
    }
}


// Modificar reserva
if (isset($_POST['modificar_id'])) {
    $idreserva = $_POST['modificar_id'];
    $nuevo_idvuelo = $_POST['nuevo_idvuelo'];
    $nuevo_tipotarifa = $_POST['nuevo_tipotarifa'];



    $sql_modificar = "UPDATE reservas SET idvuelo = '$nuevo_idvuelo', tipoTarifa = '$nuevo_tipotarifa' WHERE idreserva = '$idreserva'";
    if (mysqli_query($conexion, $sql_modificar)) {
        echo '<p>Reserva modificada con éxito.</p>';
        header("Refresh:0"); // Refresca la página
    } else {
        echo '<p>Error al modificar la reserva.</p>';
    }
}

// Eliminar reserva
if (isset($_GET['eliminar_id'])) {
    $idreserva = $_GET['eliminar_id'];
    $sql_eliminar = "DELETE FROM reservas WHERE idreserva = '$idreserva'";
    if (mysqli_query($conexion, $sql_eliminar)) {
        echo '<p>Reserva eliminada con éxito.</p>';
        header("Location: misreservas.php"); // Refresca la página
    } else {
        echo '<p>Error al eliminar la reserva.</p>';
    }
}
?>