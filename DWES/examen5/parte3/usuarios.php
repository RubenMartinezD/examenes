<!DOCTYPE html>
<html>

<body>
    <?php
    /*Crea una aplicación php (usuarios.php) que gestione usuarios (con dni, nombre e email) utilizando el almacén de datos «usuarios.json». Permitirá ver:
El listado completo de usuarios en el almacén
Los datos de un usuario (con dni concreto)
Puedes utilizar maquetación con rejilla (grid), que quizá es la más sencilla para mostrar los datos.*/

    //DECLARACIÓN DE LA RUTA DE LOS DATOS DE USUARIOS Y REDIRECCIONES
    $path = "usuarios.json";   //ruta relativa de los datos de usuario
    include_once $path;

    //RECOGIDA DE DATOS DESDE EL ARCHIVO JSON
    $contents = file_get_contents($path);
    $data = json_decode($contents, true);  //array descodificado de los datos de usuario existentes

    //RECORRIENDO ARRAY
    $keys = array_keys($data);
    for ($i = 0; $i < count($data); $i++) {
        echo $keys[$i] . "{<br>";
        foreach ($data[$keys[$i]] as $key => $value) {
            echo $key . " : " . $value . "<br>";
        };
        echo "<br>";
    };

    //BÚSQUEDA DE USUARIO
    $variable_id_array = 9999999;   //variable que guarda el índice donde se encontrará el usuario con el dni correspondiente (después de darle muchas vueltas, solo se me ocurrió de esta forma)
    $dniejemplo = "56764345N";
    $keys = array_keys($data);
    for ($i = 0; $i < count($data); $i++) {
        foreach ($data[$keys[$i]] as $key => $value) {
            if (($key == "dni") && ($value == $dniejemplo)) {  //si  encuentra una coincidencia en el valor del dni
                $variable_id_array = $i;  //fijar la variable del índice
            }
        };
    };
    for ($i = 0; $i < 1; $i++) {
        foreach ($data[$keys[$variable_id_array]] as $key => $value) {     //lee solamente los datos del usuario que encontró en el bucle anterior
            if (($key == "nombre")) {
                echo "El nombre de este sujeto es " . $value;
            }
            if (($key == "dni")) {
                echo " y su dni es " . $value;
            }
        };
    };
    /*

    Intenté llamar a la propiedad dni de esta forma, pero no me dejó, y no entiendo por qué si cuando hice la web este código me había funcionado perfectamente para buscar los usuarios:
    for ($i = 0; $i < count($data); $i++) {
        if (($data[$keys[$i]]->dni == "56764345N")) {
            echo "el nombre de ese usuario es" . $data[$keys[$i]]->nombre;
        };
        
        El error era:  "Warning: Attempt to read property "nombre" on array in C:\xampp\htdocs\index.php on line 34" y pasaba igual con nombre y con dni.

*/
    ?>
</body>

</html>