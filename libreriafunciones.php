<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// arrays con la información de los vuelos
$vueloHoraSalida = [
    "NT223" => "12:00",
    "NT935" => "12:15",
    "NT624" => "13:30",
    "NT448" => "14:45",
    "NT756" => "16:00",
    "NT234" => "17:15",
    "NT812" => "18:30",
    "NT987" => "19:45"
];

$vueloAeroSalida = [
    "NT223" => "LPA",
    "NT935" => "FUE",
    "NT624" => "TFN",
    "NT448" => "LPA",
    "NT756" => "ACE",
    "NT234" => "LPA",
    "NT812" => "FUE",
    "NT987" => "FUE"
];

$vueloAeroLlegada = [
    "NT223" => "FUE",
    "NT935" => "TFN",
    "NT624" => "LPA",
    "NT448" => "ACE",
    "NT756" => "TFN",
    "NT234" => "TFN",
    "NT812" => "ACE",
    "NT987" => "LPA"

];

// funcion para filtrar vuelos por destino y rango de horas
function filtrarVuelos($destino, $origen, $horaInicio, $horaFin, $vueloHoraSalida, $vueloAeroSalida, $vueloAeroLlegada)
{

    $vuelosFiltrados = [];

    foreach ($vueloHoraSalida as $numVuelo => $horaSalida) {
        if (
            $vueloAeroLlegada[$numVuelo] == $destino &&
            $vueloAeroSalida[$numVuelo] == $origen &&
            $horaSalida >= $horaInicio &&
            $horaSalida <= $horaFin

        ) {
            $vuelosFiltrados[$numVuelo] = [
                'horaSalida' => $horaSalida,
                'aeroSalida' => $vueloAeroSalida[$numVuelo],
                'aeroLlegada' => $vueloAeroLlegada[$numVuelo]
            ];
        }
    }

    return $vuelosFiltrados;
}


// arrays con los paises y su informacion
$paises_info = array(
    "Estados Unidos" => array(
        "moneda" => "Dólar estadounidense (USD)",
        "temp_min" => 20,
        "temp_max" => 38,
        "sitios" => array("Estatua de la Libertad", "Gran Cañón", "Times Square")
    ),
    "México" => array(
        "moneda" => "Peso mexicano (MXN)",
        "temp_min" => 18,
        "temp_max" => 35,
        "sitios" => array("Chichén Itzá", "Cancún", "Centro Histórico CDMX")
    ),
    "Brasil" => array(
        "moneda" => "Real brasileño (BRL)",
        "temp_min" => 20,
        "temp_max" => 33,
        "sitios" => array("Cristo Redentor", "Pan de Azúcar", "Playas de Copacabana")
    ),
    "Reino Unido" => array(
        "moneda" => "Libra esterlina (GBP)",
        "temp_min" => 5,
        "temp_max" => 25,
        "sitios" => array("Big Ben", "Torre de Londres", "Buckingham Palace")
    ),
    "España" => array(
        "moneda" => "Euro (EUR)",
        "temp_min" => 10,
        "temp_max" => 35,
        "sitios" => array("Sagrada Familia", "Alhambra", "Plaza Mayor")
    ),
    "Japón" => array(
        "moneda" => "Yen japonés (JPY)",
        "temp_min" => 5,
        "temp_max" => 30,
        "sitios" => array("Monte Fuji", "Templo Senso-ji", "Castillo de Osaka")
    ),
    "Australia" => array(
        "moneda" => "Dólar australiano (AUD)",
        "temp_min" => 15,
        "temp_max" => 40,
        "sitios" => array("Ópera de Sídney", "Gran Barrera de Coral", "Uluru")
    ),
    "Canadá" => array(
        "moneda" => "Dólar canadiense (CAD)",
        "temp_min" => -10,
        "temp_max" => 30,
        "sitios" => array("Cataratas del Niágara", "CN Tower", "Parque Nacional Banff")
    ),
    "China" => array(
        "moneda" => "Yuan chino (CNY)",
        "temp_min" => 0,
        "temp_max" => 35,
        "sitios" => array("Gran Muralla China", "Ciudad Prohibida", "Guerreros de Terracota")
    ),
    "India" => array(
        "moneda" => "Rupia india (INR)",
        "temp_min" => 15,
        "temp_max" => 40,
        "sitios" => array("Taj Mahal", "Fuerte Amber", "Varanasi")
    )
);

// Muestra la informacion del pais seleccionado
function mostrarInfoPais($pais_seleccionado, $paises_info)
{
    if ($pais_seleccionado == true) {
        $info = $paises_info[$pais_seleccionado];
        $moneda = $info['moneda'];
        $temp_aprox = rand($info['temp_min'] * 10, $info['temp_max'] * 10) / 10;
        $sitios = implode(", ", $info['sitios']);

        return "<div class='container'>
                    <div class='row'>
                        <div class='col-12 text-center'>
                            <p>La moneda de $pais_seleccionado es: <strong>$moneda</strong></p>
                            <p>La temperatura aproximada en $pais_seleccionado podría ser: <strong>$temp_aprox ºC</strong></p>
                            <p>Lugares populares para visitar: <strong>$sitios</strong></p>
                        </div>
                    </div>
                </div>";
    } else {
        return "<p>Por favor, selecciona un país.</p>";
    }
}





?>