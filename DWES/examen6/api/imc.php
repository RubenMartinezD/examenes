<?php

// ej: http://localhost/webservice/webservice.php?nombre=Pepe&peso=75&estatura=183


//recogemos variables
$nombre = $_GET['nombre'];
$peso = $_GET['peso'];
$estatura = $_GET['estatura'];

//validamos variables vacías
if (!empty($nombre) && !empty($peso) && !empty($estatura)) {
    // convertimos cm en m
    $estatura = $estatura / 100;

    //fórmula peso(kg)/talla(m2)
    $imc = $peso / ($estatura * $estatura);

    //redondeamos a dos decimales
    $imc = round($imc, 2);

    //entregamos respuesta 
    echo "El imc de $nombre es de $imc";
} else {
    //entregamos respuesta 
    echo "Datos inválidos";
}
