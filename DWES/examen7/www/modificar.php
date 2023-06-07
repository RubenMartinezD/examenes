<?php
$equipo_BD = "172.20.0.2"; //cambiar por la IP del contenedor Postgres
$nombre_BD = "viajes"; 
$usuario_BD = "root"; 
$password_BD = "root"; 
$puerto = 5432;
 
try {
       $dbConn = null;
       $dbConn = new PDO("pgsql:host=$equipo_BD;port=$puerto;dbname=$nombre_BD;user=$usuario_BD;password=$password_BD");
       $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
       echo "Falló la conexión con error: " . $e . "<br>";
       echo $e;
       echo "<br>" . phpinfo();
}
 
 
 
function prepararStatement($tablainsercion, $dbConn, $data){
$queries = ["INSERT INTO viajeros (nombre, dni, nacionalidad, fecha_n) VALUES (:nombre, :dni, :nacionalidad, :fecha_n)",
"INSERT INTO ciudades (nombre_ciudad, num_habitantes, descripcion) VALUES (:nombre_ciudad, :num_habitantes, :descripcion)",
"INSERT INTO vuelos (dni_viajero, c_origen, c_destino, f_salida, f_llegada) VALUES (:dni_viajero, :c_origen, :c_destino, :f_salida, :f_llegada)",
"UPDATE viajeros SET nombre = :nombre, nacionalidad= :nacionalidad, fecha_n = :fecha_n WHERE dni = :dni",
"DELETE FROM viajeros WHERE dni = :dni",
"DELETE FROM ciudades WHERE id_ciudad = :id_ciudad",
"DELETE FROM vuelos WHERE id_viaje = :id_viaje",
];
$datos_recogidos= $data;
$stmt = $dbConn->prepare($queries[$tablainsercion]);
$stmt->execute($datos_recogidos);
};
 
if (isset($_POST['registro_viajero'])){
       $nombre = $_POST['nombre'];
       $dni = $_POST['dni'];
       $nacionalidad = $_POST['nacionalidad'];
       $fecha_n = $_POST['fecha_n'];
       $data = [    //intenté meter todos los datos de todas las posibles consultas en un array de arrays para sacar solo el array que quisiera usando un método pero era muy complicado recuperar luego los valores de POST porque había que pasarlos por parámetro y las cantidades de parámetros variaban.
              'nombre' => $nombre,
              'dni' => $dni,
              'nacionalidad' => $nacionalidad,
              'fecha_n' => $fecha_n,
       ];
       prepararStatement(0, $dbConn, $data);
       $dbConn = null;
       header("Location: stats.php");
       exit();
}
 
if (isset($_POST['registro_ciudad'])){
       $nombre_ciudad = $_POST['nombre_ciudad'];
       $num_habitantes = $_POST['num_habitantes'];
       $descripcion = $_POST['descripcion'];
       $data = [   
              'nombre_ciudad' => $nombre_ciudad,
              'num_habitantes' => $num_habitantes,
              'descripcion' => $descripcion,
       ];
       prepararStatement(1, $dbConn, $data);
       $dbConn = null;
       header("Location: stats.php");
       exit();
}
 
if (isset($_POST['registro_viaje'])){
       $dni_viajero = $_POST['dni_viajero'];
       $c_origen = $_POST['c_origen'];
       $c_destino = $_POST['c_destino'];
       $f_salida = $_POST['f_salida'];
       $f_llegada = $_POST['f_llegada'];
       $data = [   
              'dni_viajero' => $dni_viajero,
              'c_origen' => $c_origen,
              'c_destino' => $c_destino,
              'f_salida' => $f_salida,
              'f_llegada' => $f_llegada,
       ];
       prepararStatement(2, $dbConn, $data);
       $dbConn = null;
       header("Location: stats.php");
       exit();
}
 
if (isset($_POST['actualizar_viajero'])){
       $nombre = $_POST['nombre'];
       $dni = $_POST['dni'];
       $nacionalidad = $_POST['nacionalidad'];
       $fecha_n = $_POST['fecha_n'];
       $data = [
              'nombre' => $nombre,
              'dni' => $dni,
              'nacionalidad' => $nacionalidad,
              'fecha_n' => $fecha_n,
       ];
       prepararStatement(3, $dbConn, $data);
       $dbConn = null;
       header("Location: stats.php");
       exit();
}
 
if (isset($_POST['borrar_viajero'])){
       $dni = $_POST['dni'];
       $data = [
              'dni' => $dni,
       ];
       prepararStatement(4, $dbConn, $data);
       $dbConn = null;
       header("Location: stats.php");
       exit();
}
 
if (isset($_POST['borrar_ciudad'])){
       $id_ciudad = $_POST['id_ciudad'];
       $data = [
              'id_ciudad' => $id_ciudad,
       ];
       prepararStatement(5, $dbConn, $data);
       $dbConn = null;
       header("Location: stats.php");
       exit();
}
 
if (isset($_POST['borrar_viaje'])){
       $id_viaje = $_POST['id_viaje'];
       $data = [
              'id_viaje' => $id_viaje,
       ];
       prepararStatement(6, $dbConn, $data);
       $dbConn = null;
       header("Location: stats.php");
       exit();
}
 
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <form method='POST' name="nuevo_viajero">
        <h2>Inserción de nuevo viajero:</h2><br>
        <p>Nombre del viajero*: <input type="text" name="nombre" size="13" maxlength="24" style="width: 200px" required> </p>
        <p>DNI*: <input type="text" name="dni" size="13" maxlength="9" style="width: 40px" required> </p>
        <p>Nacionalidad* <input type="text" name="nacionalidad" size="13" maxlength="20" style="width: 40px" required> </p>
        <p>Fecha de nacimiento: <input type="date" name="fecha_n" size="13" style="width: 150px" required> </p>
        <input type="submit" name="registro_viajero" value="Registrar a un nuevo viajero"></input>
    </form>
    <br><br>

    <form method='POST' name="nueva_ciudad">
        <h2>Inserción de nueva ciudad:</h2><br>
        <p>Nombre_ciudad*: <input type="text" name="nombre_ciudad" size="13" maxlength="40" style="width: 150px" required> </p>
        <p>Número de habitantes* <input type="number" name="num_habitantes" style="width: 60px" min="0" required> </p>
        <p>Descripción: <input type="text" name="descripcion" size="13" maxlength="150" style="width: 900px" required> </p>
        <input type="submit" name="registro_ciudad" value="Registrar una nueva ciudad"></input>
    </form>
    <br><br>

    <form method='POST' name="nuevo_viaje">
        <h2>Inserción de nuevo viaje:</h2><br>
        <p>Dni Viajero* <input type="text" name="dni_viajero" size="13" maxlength="9" style="width: 60px" required> </p>
        <p>ID de ciudad de origen*: <input type="number" name="c_origen" style="width: 60px" min="0" required> </p>
        <p>ID de ciudad de destino*: <input type="number" name="c_destino" style="width: 60px" min="0" required></p>
        <p>Fecha de salida*: <input type="date" name="f_salida" size="13" style="width: 150px" required></p>
        <p>Fecha de llegada*: <input type="date" name="f_llegada" size="13" style="width: 150px" required></p>
        </p>
        <input type="submit" name="registro_viaje" value="Registrar un nuevo viaje"></input>
    </form>
    <br><br>


    <form method='POST' name="nuevo_viajero">
        <h2>Actualizar datos de viajero (El DNI no puede ser cambiado):</h2><br>
        <p>Nombre del viajero*: <input type="text" name="nombre" size="13" maxlength="24" style="width: 200px" required> </p>
        <p>DNI*: <input type="text" name="dni" size="13" maxlength="9" style="width: 40px" required> </p>
        <p>Nacionalidad* <input type="text" name="nacionalidad" size="13" maxlength="20" style="width: 40px" required> </p>
        <p>Fecha de nacimiento: <input type="date" name="fecha_n" size="13" style="width: 150px" required> </p>
        <input type="submit" name="actualizar_viajero" value="Actualizar los datos del viajero"></input>
    </form>
    <br><br>

    <form method='POST' name="adios_viajero">
        <h2>Borrar a un viajero:</h2><br>
        <p>DNI*: <input type="text" name="dni" size="13" maxlength="9" style="width: 40px" required> </p>
        <input type="submit" name="borrar_viajero" value="Borrar los datos de este viajero"></input>
    </form>
    <br><br>

    <form method='POST' name="adios_ciudad">
        <h2>Borrar una ciudad de la faz de la Tierra:</h2><br>
        <p>ID de la ciudad a borrar*: <input type="number" name="id_ciudad" style="width: 60px" min="0" required></p>
        </p>
        <input type="submit" name="borrar_ciudad" value="Borrar los datos de este viajero"></input>
    </form>
    <br><br>

    <form method='POST' name="fin_viaje">
        <h2>Borrar un viaje:</h2><br>
        <p>ID del viaje a borrar*: <input type="number" name="id_viaje" style="width: 60px" min="0" required> </p>
        <input type="submit" name="borrar_viaje" value="Eliminar este viaje"></input>
    </form>
    <br><br>

    <a href="index.php">Volver al índice</a>
</body>

</html>