<!DOCTYPE html>

<head>
</head>

<body>

    <p>API Chuck Norris Jokes . API pública con chistes en categorías</p>


    <h2>Consulta de un chiste aleatorio</h2>
    <?php

    //1. Me muestre un chiste aleatorio (chiste, la fecha de actualización y la categoría a la que pertenece).

    $context_options = array(
        'http' => array(
            'method' => 'GET',
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        )
    );

    $context = stream_context_create($context_options);
    $response = file_get_contents('https://api.chucknorris.io/jokes/random', false, $context);
    $array = json_decode($response, true);

    print_r($array['value']);
    echo "<br>";
    // print_r($array['categories']);   //solo conseguí ver la categoría al probar la API con curl en Ubuntu. Con wget en windows y aquí en php me devuelve las categorías en blanco
    echo "Chiste creado el ";
    print_r($array['created_at']);

    echo "<br>";
    $context_options = array(
        'http' => array(
            'method' => 'GET',
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        )
    );


    //2. Que me muestre una lista de todas las categorías disponibles. La lista tiene un url para mostrar un chiste de esa categoría en concreto

    echo "<br>";
    $context = stream_context_create($context_options);
    $response = file_get_contents('https://api.chucknorris.io/jokes/categories', false, $context);
    $array = json_decode($response, true);
    echo "<br>";
    echo "<h2>Categorías de chistes: </h2><br>";
    foreach ($array as $key => $value) {
        print_r($value . "<br>");
    }

    //3. Que me muestre una lista de todas las categorías disponibles. La lista tiene un url para mostrar un chiste de esa categoría en concreto

    echo "<h2>Busqueda de chiste: </h2><br>";      //Igual era más fácil hacerlo, pero solo conseguí hacerlo así
    $data = array('query' => 'nowhere');
    $data = http_build_query($data);
    $context_options = array(
        'http' => array(
            'method' => 'GET',
            'header' => "Content-type: application/x-www-form-urlencoded\r\n"
                . "Content-Length: " . strlen($data) . "\r\n",
            'content' =>  $data
        )
    );
    echo "<br>";
    //    $data = ($pos = strpos($data, "=")) ? substr($data, $pos + 1) : $data;
    //  echo "<br>" . $data;
    //    echo "<br>";
    $url1 = "https://api.chucknorris.io/jokes/search?";
    $urlfinal = $url1 .  $data;
    $context = stream_context_create($context_options);
    $response = file_get_contents($urlfinal, false, $context);
    $array = json_decode($response, true);
    $array = $array['result'];
    $var_elementos = (count($array) - 1);   //numero de resultados de la busqueda = numero de elementos de los cuales se escogerá uno al azar
    $index_seleccionado = rand(0, $var_elementos);
    $index_seleccionado = $array[$index_seleccionado];


    foreach ($index_seleccionado as $key => $value) {
        if ($key == "value") {
            print_r($value);
        }
    }

    ?>