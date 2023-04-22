<!DOCTYPE html>

<body>

    <h2>API database</h2><br>
    <a href="/api/colores">Colores </a><br>
    <a href="/api/refranes">Refranes </a><br>
    <a href="/api/refranes-json">Refranes en JSON</a><br>
    <?php

    //Contador de String
    $string = "cosas";
    echo '<a href="/api/contador/' . $string . '">Enlace de cuenta-string</a><br>';

    //Calculadora de IMC
    $nombre = "Jorge";
    $peso = 68;
    $estatura = 42;
    echo '<a href="/api/imc/' . $nombre . '/' . $peso . '/' . $estatura . '">Enlace de IMC</a>'


    ?>

</body>