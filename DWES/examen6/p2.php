<?php

//1. Tiempo hoy

echo "<h2>Tiempo hoy: </h2><br>";      //Igual era más fácil hacerlo, pero solo conseguí hacerlo así
$data = array('lat' => '42.2328', 'lon' => '-8.7226', 'appid' => 'idprivada');     ////CAMBIAR POR ID PRIVADA
$data = http_build_query($data);
$context_options = array(
    'http' => array(
        'method' => 'GET',
        'header' => "Content-type: application/x-www-form-urlencoded\r\n"
            . "Content-Length: " . strlen($data) . "\r\n",
        'content' =>  $data
    )
);
$url = "https://api.openweathermap.org/data/3.0/onecall?" . $data;
$context = stream_context_create($context_options);
$response = file_get_contents($url, false, $context);
echo $response;


//2. Tiempo pasado

echo "<br> <h2>Tiempo el 15 de Julio de 2021 a las 18:11:08: </h2><br>";
$data = array('lat' => '42.2328', 'lon' => '-8.7226', 'dt' => '1626372668', 'appid' => 'idprivada');     ////CAMBIAR POR ID PRIVADA
$data = http_build_query($data);
$context_options = array(
    'http' => array(
        'method' => 'GET',
        'header' => "Content-type: application/x-www-form-urlencoded\r\n"
            . "Content-Length: " . strlen($data) . "\r\n",
        'content' =>  $data
    )
);
echo "<br>" . $data;
$url2 = "https://api.openweathermap.org/data/3.0/onecall/timemachine?" . $data;
$context = stream_context_create($context_options);
$response = file_get_contents($url2, false, $context);
echo $response;


//3. Desripción

$array = json_decode($response, true);
$array = $array['data'];
echo "<br>";
echo "<br>";
print_r($array);
//   $index_seleccionado = rand(0, $var_elementos);
$index_seleccionado = $array[0];
echo "<br>";
echo "<h2>Descripción: </h2><br>";
foreach ($index_seleccionado as $key => $value) {
    if ($key == "dt") {
        echo "hora:" . gmdate('r', (date($value)));
    }
    if ($key == "clouds") {
        echo "<br> porcentaje de nubes: " . $value . "%";
    }
    if ($key == "pressure") {
        echo " <br> valor de presión: " . $value . " atmósferas";
    }
    if ($key == "humidity") {
        echo " <br> porcentaje de humedad: " . $value . " %";
    }
    if ($key == "weather") {
        $valiu = $value[0];
        foreach ($valiu as $ki => $valor) {

            if ($ki == "description") {
                echo "<br> El tiempo ahora mismo es el siguiente: " . $valor;
            }
        }
    }
}
