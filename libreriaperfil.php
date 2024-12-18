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
$beneficios = []; // Ventajas asociadas a cada tarjeta

if (strpos($usuario['numero_tarjeta'], 'NT20') === 0) {
    $color_tarjeta = $tarjeta_colores['plata'];
    $beneficios = [
        "Promociones exclusivas.",
        "Acumulación de puntos más rápida.",
        "Asistencia preferencial en eventos."
    ];
} elseif (strpos($usuario['numero_tarjeta'], 'NT30') === 0) {
    $color_tarjeta = $tarjeta_colores['oro'];
    $beneficios = [
        "Acceso a zonas VIP.",
        "Puntos dobles por compras.",
        "Atención personalizada 24/7."
    ];
} else {
    $beneficios = [
        "Acumula puntos por tus compras.",
        "Promociones y descuentos básicos.",
        "Asistencia básica en reservas."
    ];
}

// Subir y actualizar avatar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto_perfil'])) {
    $foto_perfil = $_FILES['foto_perfil'];
    $tamaniomaximo = 2 * 1024 * 1024; // 2MB
    $tipopermitido = array('image/jpeg', 'image/png');

    // Verificación de la existencia y error del archivo subido
    if (!isset($_FILES['foto_perfil']) || $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_OK) {
        echo '<p>Error: No se seleccionó ninguna imagen o ocurrió un problema al subirla.</p>';
        return;
    }
    

    // Verificación de tamaño
    if ($foto_perfil['size'] > $tamaniomaximo) {
        echo '<p>El archivo de fotografía no puede superar los 2MB.</p>';
        return;
    }

    // Verificación de tipo
    if (!in_array($foto_perfil['type'], $tipopermitido)) {
        echo '<p>Solo se permiten archivos de imagen en formato JPG o PNG.</p>';
        return;
    }

    $dir_subida = './fotos/';
    if (!is_dir($dir_subida)) {
        mkdir($dir_subida, 0755, true); // Crear el directorio si no existe
    }

    $new_filename = sha1_file($foto_perfil['tmp_name']) . '.' . pathinfo($foto_perfil['name'], PATHINFO_EXTENSION);
    $fichero_subido = $dir_subida . $new_filename;

    // Subir el archivo
    if (move_uploaded_file($foto_perfil['tmp_name'], $fichero_subido)) {
        // Actualizar la base de datos
        $sql_update_foto = "UPDATE usuarios SET foto_perfil = '$new_filename' WHERE idusuario = '$idusuario'";
        if (mysqli_query($conexion, $sql_update_foto)) {
            echo header('Location: perfil.php');
        } else {
            echo '<p>Error al guardar la foto en la base de datos.</p>';
        }
    } else {
        echo '<p>Error al subir la foto.</p>';
    }
}



?>