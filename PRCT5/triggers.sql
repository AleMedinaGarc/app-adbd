-- -----------------------------------------------------
-- Schema viverosdb
-- -----------------------------------------------------
DROP DATABASE IF EXISTS viverosdb;
CREATE DATABASE viverosdb;

-- -----------------------------------------------------
-- Table viverosdb.VIVERO
-- -----------------------------------------------------
DROP TABLE IF EXISTS viverosdb.VIVERO CASCADE;

CREATE TABLE IF NOT EXISTS viverosdb.VIVERO (
  Coordenadas VARCHAR(100) NOT NULL,
  Localidad VARCHAR(45) NULL,
  PRIMARY KEY (Coordenadas));


-- -----------------------------------------------------
-- Table viverosdb.CLIENTE
-- -----------------------------------------------------

DROP TABLE IF EXISTS viverosdb.CLIENTE CASCADE;

CREATE TABLE IF NOT EXISTS viverosdb.CLIENTE (
  DNI VARCHAR(9) NOT NULL,
  Nombre VARCHAR(45) NOT NULL,
  Apellidos VARCHAR(45) NOT NULL,
  Bonificación DECIMAL(3,2) NULL,
  Total_mensual INT NULL,
  Fecha_ingreso DATE NULL,
  Correo VARCHAR(45) NULL,
  PRIMARY KEY (DNI));


-- -----------------------------------------------------
-- Table viverosdb.ZONA
-- -----------------------------------------------------

DROP TABLE IF EXISTS viverosdb.ZONA CASCADE;

CREATE TABLE IF NOT EXISTS viverosdb.ZONA (
  Nombre VARCHAR(45) NOT NULL,
  VIVERO_Coordenadas VARCHAR(100) NOT NULL,
  PRIMARY KEY (Nombre, VIVERO_Coordenadas),
  CONSTRAINT fk_ZONA_VIVERO
    FOREIGN KEY (VIVERO_Coordenadas)
    REFERENCES viverosdb.VIVERO (Coordenadas)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table viverosdb.EMPLEADO
-- -----------------------------------------------------

DROP TABLE IF EXISTS viverosdb.EMPLEADO CASCADE;

CREATE TABLE IF NOT EXISTS viverosdb.EMPLEADO (
  DNI VARCHAR(9) NOT NULL,
  ZONA_Nombre VARCHAR(45) NOT NULL,
  ZONA_VIVERO_Coordenadas VARCHAR(100) NOT NULL,
  Antigüedad VARCHAR(45) NULL,
  Sueldo DECIMAL(6,2) NULL,
  CSS VARCHAR(45) NULL,
  Fecha_ini DATE NULL,
  Fecha_fin DATE NULL,
  Ventas INT NULL,
  PRIMARY KEY (DNI),
  CONSTRAINT fk_EMPLEADO_ZONA1
    FOREIGN KEY (ZONA_Nombre , ZONA_VIVERO_Coordenadas)
    REFERENCES viverosdb.ZONA (Nombre , VIVERO_Coordenadas)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table viverosdb.PRODUCTO
-- -----------------------------------------------------

DROP TABLE IF EXISTS viverosdb.PRODUCTO CASCADE;

CREATE TABLE IF NOT EXISTS viverosdb.PRODUCTO (
  Código_producto INT NOT NULL,
  Precio DECIMAL(4,2) NULL,
  Stock INT NULL,
  PRIMARY KEY (Código_producto));


-- -----------------------------------------------------
-- Table viverosdb.COMPRA
-- -----------------------------------------------------

DROP TABLE IF EXISTS viverosdb.COMPRA CASCADE;

CREATE TABLE IF NOT EXISTS viverosdb.COMPRA (
  Fecha DATE NOT NULL,
  CLIENTE_DNI VARCHAR(9) NOT NULL,
  PRODUCTO_Código_producto INT NOT NULL,
  EMPLEADO_DNI VARCHAR(9) NOT NULL,
  Cantidad INT NULL,
  PRIMARY KEY (Fecha),
  CONSTRAINT fk_COMPRA_CLIENTE1
    FOREIGN KEY (CLIENTE_DNI)
    REFERENCES viverosdb.CLIENTE (DNI)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_COMPRA_PRODUCTO1
    FOREIGN KEY (PRODUCTO_Código_producto)
    REFERENCES viverosdb.PRODUCTO (Código_producto)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_COMPRA_EMPLEADO1
    FOREIGN KEY (EMPLEADO_DNI)
    REFERENCES viverosdb.EMPLEADO (DNI)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table viverosdb.UBICA
-- -----------------------------------------------------

DROP TABLE IF EXISTS viverosdb.UBICA CASCADE ;

CREATE TABLE IF NOT EXISTS viverosdb.UBICA (
  ZONA_Nombre VARCHAR(45) NULL,
  ZONA_VIVERO_Coordenadas VARCHAR(100) NULL,
  PRODUCTO_Código_producto INT NULL,
  CONSTRAINT fk_UBICA_ZONA1
    FOREIGN KEY (ZONA_Nombre , ZONA_VIVERO_Coordenadas)
    REFERENCES viverosdb.ZONA (Nombre , VIVERO_Coordenadas)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_UBICA_PRODUCTO1
    FOREIGN KEY (PRODUCTO_Código_producto)
    REFERENCES viverosdb.PRODUCTO (Código_producto)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Definicion de los triggers
-- -----------------------------------------------------

-- Function para Trigger 1
CREATE OR REPLACE FUNCTION crear_email() RETURNS TRIGGER AS $example_table$
  BEGIN
    IF NEW.Correo IS NULL THEN
        NEW.Correo = CONCAT(NEW.Nombre,NEW.Apellidos,'@',TG_ARGV[0]);
    ELSIF NEW.Correo !~ '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$' THEN
        NEW.Correo = CONCAT(NEW.Nombre,NEW.Apellidos,'@',TG_ARGV[0]);
    END IF;
    RETURN NEW;
  END;
$example_table$ LANGUAGE 'plpgsql';

-- Function para Trigger 2
CREATE OR REPLACE FUNCTION comparar_ubicacion_trigger() RETURNS TRIGGER AS $$
BEGIN
  IF (TRUE = ANY(SELECT(NEW.Coordenadas = Coordenadas AND NEW.Localidad = Localidad) FROM viverosdb.VIVERO)) THEN
    RAISE EXCEPTION 'Esa ubicacion ya esta asignada a otro vivero';
  END IF;
  RETURN NEW;
END;
$$
LANGUAGE 'plpgsql';

-- Function para Trigger 3
CREATE OR REPLACE FUNCTION compra_insert_trigger_fnc() RETURNS trigger AS $$
BEGIN
        UPDATE viverosdb.PRODUCTO set Stock = Stock - new.Cantidad
        WHERE Código_producto = new.PRODUCTO_Código_producto;
        RETURN NEW;
END;
$$ LANGUAGE 'plpgsql';

-- Trigger 1
CREATE TRIGGER trigger_crear_email_before_insert BEFORE INSERT ON viverosdb.CLIENTE
FOR EACH ROW EXECUTE PROCEDURE crear_email('ull.edu.es');

-- Trigger 2
CREATE TRIGGER comprobar_ubicacion_trigger BEFORE INSERT ON viverosdb.VIVERO
  FOR EACH ROW 
  EXECUTE PROCEDURE comparar_ubicacion_trigger();

-- Trigger 3
CREATE TRIGGER compra_insert_trigger AFTER INSERT ON viverosdb.COMPRA
FOR EACH ROW EXECUTE PROCEDURE compra_insert_trigger_fnc();

-- -----------------------------------------------------
-- Inserts de vivero
-- -----------------------------------------------------

START TRANSACTION;
INSERT INTO viverosdb.VIVERO (Coordenadas, Localidad) VALUES ('28,27,46,N 16,18,22,W', 'La Laguna');
INSERT INTO viverosdb.VIVERO (Coordenadas, Localidad) VALUES ('28,23,43,N 16,32,50,W', 'La Orotava');
INSERT INTO viverosdb.VIVERO (Coordenadas, Localidad) VALUES ('28,23,43,N 16,32,50,B', 'La Orotava');

COMMIT;

-- -----------------------------------------------------
-- Data for table `viverosdb`.`CLIENTE`
-- -----------------------------------------------------

START TRANSACTION;
INSERT INTO viverosdb.CLIENTE (DNI, Nombre, Apellidos, Bonificación, Total_mensual, Fecha_ingreso, Correo) VALUES ('33333333C', 'Pedro', 'Perez', NULL, NULL, NULL, NULL);
INSERT INTO viverosdb.CLIENTE (DNI, Nombre, Apellidos, Bonificación, Total_mensual, Fecha_ingreso, Correo) VALUES ('44444444D', 'Juana', 'Garcia', NULL, NULL, NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `viverosdb`.`ZONA`
-- -----------------------------------------------------

START TRANSACTION;
INSERT INTO viverosdb.ZONA (Nombre, VIVERO_Coordenadas) VALUES ('Caja', '28,27,46,N 16,18,22,W');
INSERT INTO viverosdb.ZONA (Nombre, VIVERO_Coordenadas) VALUES ('Caja', '28,23,43,N 16,32,50,W');
INSERT INTO viverosdb.ZONA (Nombre, VIVERO_Coordenadas) VALUES ('Almacén', '28,27,46,N 16,18,22,W');
INSERT INTO viverosdb.ZONA (Nombre, VIVERO_Coordenadas) VALUES ('Almacén', '28,23,43,N 16,32,50,W');

COMMIT;


-- -----------------------------------------------------
-- Data for table `viverosdb`.`EMPLEADO`
-- -----------------------------------------------------

START TRANSACTION;
INSERT INTO viverosdb.EMPLEADO (DNI, ZONA_Nombre, ZONA_VIVERO_Coordenadas, Antigüedad, Sueldo, CSS, Fecha_ini, Fecha_fin, Ventas) VALUES ('11111111A', 'Caja', '28,27,46,N 16,18,22,W', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO viverosdb.EMPLEADO (DNI, ZONA_Nombre, ZONA_VIVERO_Coordenadas, Antigüedad, Sueldo, CSS, Fecha_ini, Fecha_fin, Ventas) VALUES ('22222222B', 'Almacén', '28,23,43,N 16,32,50,W', NULL, NULL, NULL, NULL, NULL, NULL);

COMMIT;


-- -----------------------------------------------------
-- Data for table `viverosdb`.`PRODUCTO`
-- -----------------------------------------------------

START TRANSACTION;
INSERT INTO viverosdb.PRODUCTO (Código_producto, Precio, Stock) VALUES (001, 10.00, 3);
INSERT INTO viverosdb.PRODUCTO (Código_producto, Precio, Stock) VALUES (002, 7.25, 5);

COMMIT;


-- -----------------------------------------------------
-- Data for table `viverosdb`.`COMPRA`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO viverosdb.COMPRA (Fecha, CLIENTE_DNI, PRODUCTO_Código_producto, EMPLEADO_DNI, Cantidad) VALUES ('2021-12-01', '33333333C', 001, '11111111A', 2);
INSERT INTO viverosdb.COMPRA (Fecha, CLIENTE_DNI, PRODUCTO_Código_producto, EMPLEADO_DNI, Cantidad) VALUES ('2021-11-24', '44444444D', 002, '22222222B', 3);



COMMIT;


-- -----------------------------------------------------
-- Data for table `viverosdb`.`UBICA`
-- -----------------------------------------------------

START TRANSACTION;
INSERT INTO viverosdb.UBICA (ZONA_Nombre, ZONA_VIVERO_Coordenadas, PRODUCTO_Código_producto) VALUES ('Almacén', '28,27,46,N 16,18,22,W', 001);
INSERT INTO viverosdb.UBICA (ZONA_Nombre, ZONA_VIVERO_Coordenadas, PRODUCTO_Código_producto) VALUES ('Almacén', '28,23,43,N 16,32,50,W', 001);
INSERT INTO viverosdb.UBICA (ZONA_Nombre, ZONA_VIVERO_Coordenadas, PRODUCTO_Código_producto) VALUES ('Caja', '28,27,46,N 16,18,22,W', 002);
INSERT INTO viverosdb.UBICA (ZONA_Nombre, ZONA_VIVERO_Coordenadas, PRODUCTO_Código_producto) VALUES ('Caja', '28,23,43,N 16,32,50,W', 002);

COMMIT;