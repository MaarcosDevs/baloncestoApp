CREATE DATABASE baloncesto;

USE baloncesto;

CREATE TABLE
    equiposBaloncesto (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tipoEquipo ENUM ('EquipoNBA', 'EquipoEuropa') NOT NULL,
        nombre VARCHAR(255),
        ciudad VARCHAR(255),
        pais VARCHAR(255),
        presupuestoAnual DECIMAL(15, 2),
        conferencia VARCHAR(255),
        anillosGanados INT,
        liga VARCHAR(255),
        tienePabellonPropio BOOLEAN
    );