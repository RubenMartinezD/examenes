<?php
$equipo_BD = "172.20.0.3"; 
$nombre_BD = "viajes"; 
$usuario_BD = "root"; 
$password_BD = "root"; 
$puerto = 5432;

try {
       $dbConn = new PDO("pgsql:host=$equipo_BD;port=$puerto;dbname=$nombre_BD;user=$usuario_BD;password=$password_BD");
       $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
       echo "Falló la conexión con error: " . $e . "<br>";
       echo $e;
       echo "<br>" . phpinfo();
}

function prepararQuery($numquery){
$array_queries=["","SELECT * FROM viajeros","SELECT * FROM vuelos","SELECT count(*) FROM viajeros","SELECT count(*) FROM vuelos","SELECT nombre FROM viajeros ORDER BY fecha_n LIMIT 1","SELECT ciudades.nombre_ciudad, (SELECT count(*) FROM vuelos WHERE vuelos.c_origen=ciudades.id_ciudad) from ciudades"];
$querydevuelta = $array_queries[$numquery];
return $querydevuelta;
}

function prepararStatement($numquery, $dbConn){
$stmt = $dbConn->query(prepararQuery($numquery));
return $stmt;
}

$mostrar_viajeros = (prepararStatement(1,$dbConn))->fetchAll(PDO::FETCH_ASSOC);
$mostrar_viajes = (prepararStatement(2,$dbConn))->fetchAll(PDO::FETCH_ASSOC);
$num_viajeros = (prepararStatement(3,$dbConn))->fetchColumn();
$num_viajes = (prepararStatement(4,$dbConn))->fetchColumn();
$viajoven = (prepararStatement(5,$dbConn))->fetch(PDO::FETCH_ASSOC);
$viajesbyciudad = (prepararStatement(6,$dbConn))->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
</head>
<body>
<h1>Estadísticas de la base de datos</h1><br>
<h3>Nombres de viajeros:<span><?php foreach ($mostrar_viajeros as $i){$nombre_viajero = $i; echo '<br>'.$nombre_viajero['nombre'];};?></span> 
<h4>Datos de viajes:<span><?php foreach ($mostrar_viajes as $i){$datos_viaje = $i; echo '<br>ID Viaje:'.$datos_viaje['id_viaje'] 
       . '  - DNI Viajero:'.$datos_viaje['dni_viajero'] 
       . '  - ID de ciudad de partida:'.$datos_viaje['c_origen'] 
       . '  - ID de ciudad de destino:'.$datos_viaje['c_destino'] 
       . '  - Fecha de partida:'.$datos_viaje['f_salida'] 
       . '  - Fecha de llegada:'.$datos_viaje['f_llegada'] 
       ;};?></span> </h4>
<h3>Número total de viajeros: <span><?php print_r($num_viajeros); ?></span> 
<h3>Número total de viajes: <span><?php print_r($num_viajes); ?></span> 
<h3>Viajero más joven: <span><?php echo $viajoven['nombre']; ?></span> 
<h4>Número de viajes según ciudad de origen:<span><?php foreach ($viajesbyciudad as $i){$ciudad_viaje = $i; echo '<br>'.$ciudad_viaje['nombre_ciudad'].':  '.$ciudad_viaje['count']; } ?></span> 
<br><br>
<a href="index.php">Volver al índice</a>
</body>
</html>
