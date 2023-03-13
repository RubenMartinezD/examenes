<?php
class Vehiculo
{
    public string $matr;
    public int $edad;
    public function __construct($matr, $edad)
    {
        $this->matr = $matr;
        $this->edad = $edad;
    }
    public function ver()
    {
        echo "La matrícula del coche es " . $this->matr . " y el vehículo tiene " . $this->edad . " años de antigüedad";
    }

    public function actualizar_matricula($nueva_matr)
    {
        $this->matr = $nueva_matr;
    }

    public function ver_completo()
    {
        var_dump($this);
    }
}
$cochazo = new Vehiculo("1080BYH", 5);
$cochazo->ver();
$cochazo->actualizar_matricula("8080JJJ");
$cochazo->ver();
$cochazo->ver_completo();

//la extensión Intelephense me impide cerrrar el archivo con 
?> //