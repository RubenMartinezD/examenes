<!DOCTYPE html>
<html>

<body>
    <?php

    /*Crear un archivo de texto cualquiera (ejemplo.txt) y lo dejas en el mismo directorio. Haz una página php (archivos.php) que realice las siguientes tareas

*/


    // Muestra el nombre y ruta del archivo.

    echo "EJERCICIO 1<br>";
    $path_parts = pathinfo('ejemplo.txt');

    echo $path_parts['dirname'], "\n"; // muestra un punto porque eso representa el directorio actual
    echo $path_parts['filename'], "\n";

    // Crea una función que detecte si un archivo existe

    echo "<br>EJERCICIO 2<br>";
    if (!is_readable('ejemplo.txt')) {
        echo "el ejemplo que buscas solo está en tu cabeza";
    } else echo "el ejemplo que buscas SÍ existe";

    // Carga el archivo en una variable

    echo "<br>EJERCICIO 3<br>";
    $serialobjetos = serialize('ejemplo.txt');
    echo $serialobjetos;

    // Crea un array con 4 elementos y los escribes, línea a línea en el archivo. Sobreescribes lo que había
    echo "<br>EJERCICIO 4<br>";
    $list = array('aaa', 'bbb', 'ccc', 'dddd');
    $fp = fopen('ejemplo.txt', 'w');

    foreach ($list as $fields) {
        fwrite($fp, $fields . PHP_EOL);
    }

    fclose($fp);
    ?>
</body>

</html>