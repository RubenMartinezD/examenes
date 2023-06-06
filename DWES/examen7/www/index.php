<?php
$equipo_BD = "172.20.0.3"; 
$nombre_BD = "viajes"; 
$usuario_BD = "root";
$password_BD = "root"; 
$puerto = 5432;

try {
	$dbConn = new PDO("pgsql:host=$equipo_BD;port=$puerto;dbname=$nombre_BD;user=$usuario_BD;password=$password_BD");
	$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	?>
	<!DOCTYPE html>

	<head>
		<meta charset="utf-8">
	</head>
	<p>Conexión exitosa a la base de datos</p>
	<a href="stats.php">Consultar estadísticas de la base de datos</a>
	<a href="modificar.php">Modificar la base de datos</a>
	</html>
	<?php
	$dbConn = null;
} catch (PDOException $e) {
	echo "Falló la conexión con error: " . $e->getMessage() . "<br>";
	echo $e;
	echo "<br>" . phpinfo();
}
?>