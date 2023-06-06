DROP TABLE IF EXISTS viajeros;
CREATE TABLE viajeros (
nombre VARCHAR (24) NOT NULL,
dni VARCHAR (9) NOT NULL,
nacionalidad VARCHAR (20) NOT NULL,
fecha_n VARCHAR (15) NOT NULL,
PRIMARY KEY (dni)
);

DROP TABLE IF EXISTS ciudades;
CREATE TABLE ciudades (
id_ciudad SERIAL,
nombre_ciudad VARCHAR (40) NOT NULL,
num_habitantes INT NOT NULL,
descripcion VARCHAR (150) NOT NULL,
PRIMARY KEY (id_ciudad)
);


DROP TABLE IF EXISTS vuelos;
CREATE TABLE vuelos (
id_viaje SERIAL,
dni_viajero VARCHAR (9) NOT NULL,
c_origen INT NOT NULL,
c_destino INT NOT NULL,
f_salida DATE NOT NULL,
f_llegada DATE NOT NULL,
PRIMARY KEY (id_viaje),
FOREIGN KEY (dni_viajero) REFERENCES viajeros(dni),
FOREIGN KEY (c_origen) REFERENCES ciudades(id_ciudad),
FOREIGN KEY (c_destino) REFERENCES ciudades(id_ciudad)
);
