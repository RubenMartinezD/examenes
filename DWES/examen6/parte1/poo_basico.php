<?php
include 'vehiculos.inc';
$v1 = new Vehiculo("1080BYH", 5);
$v2 = new Vehiculo("666AAA", 1);
$v1->ver();
$v2->ver_completo();
$v2->actualizar_matricula("8080JJJ");
$v2->ver();
//la extensión Intelephense me impide cerrrar el archivo con 
?> //