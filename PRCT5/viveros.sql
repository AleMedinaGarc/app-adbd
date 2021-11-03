-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS mydb;

-- -----------------------------------------------------
-- Table mydb.VIVERO
-- -----------------------------------------------------
DROP TABLE IF EXISTS mydb.VIVERO ;

CREATE TABLE IF NOT EXISTS mydb.VIVERO (
  Coordenadas VARCHAR(100) NOT NULL,
  Localidad VARCHAR(45) NULL,
  PRIMARY KEY (Coordenadas));


-- -----------------------------------------------------
-- Table mydb.CLIENTE
-- -----------------------------------------------------
DROP TABLE IF EXISTS mydb.CLIENTE ;

CREATE TABLE IF NOT EXISTS mydb.CLIENTE (
  DNI VARCHAR(9) NOT NULL,
  Nombre VARCHAR(20)
  ApellidoS VARCHAR(40),
  Bonificación DECIMAL(3,2) NULL,
  Total_mensual INT NULL,
  Fecha_ingreso DATE NULL,
  Correo VARCHAR(60),   
  PRIMARY KEY (DNI));


-- -----------------------------------------------------
-- Table mydb.ZONA
-- -----------------------------------------------------
DROP TABLE IF EXISTS mydb.ZONA ;

CREATE TABLE IF NOT EXISTS mydb.ZONA (
  Nombre VARCHAR(45) NOT NULL,
  VIVERO_Coordenadas VARCHAR(100) NOT NULL,
  PRIMARY KEY (Nombre, VIVERO_Coordenadas),
  CONSTRAINT fk_ZONA_VIVERO
    FOREIGN KEY (VIVERO_Coordenadas)
    REFERENCES mydb.VIVERO (Coordenadas)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table mydb.EMPLEADO
-- -----------------------------------------------------
DROP TABLE IF EXISTS mydb.EMPLEADO ;

CREATE TABLE IF NOT EXISTS mydb.EMPLEADO (
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
    REFERENCES mydb.ZONA (Nombre , VIVERO_Coordenadas)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table mydb.PRODUCTO
-- -----------------------------------------------------
DROP TABLE IF EXISTS mydb.PRODUCTO ;

CREATE TABLE IF NOT EXISTS mydb.PRODUCTO (
  Código_producto INT NOT NULL,
  Precio DECIMAL(4,2) NULL,
  Stock INT NULL,
  PRIMARY KEY (Código_producto));


-- -----------------------------------------------------
-- Table mydb.COMPRA
-- -----------------------------------------------------
DROP TABLE IF EXISTS mydb.COMPRA ;

CREATE TABLE IF NOT EXISTS mydb.COMPRA (
  Fecha DATE NOT NULL,
  CLIENTE_DNI VARCHAR(9) NOT NULL,
  PRODUCTO_Código_producto INT NOT NULL,
  EMPLEADO_DNI VARCHAR(9) NOT NULL,
  Cantidad INT NULL,
  PRIMARY KEY (Fecha),
  CONSTRAINT fk_COMPRA_CLIENTE1
    FOREIGN KEY (CLIENTE_DNI)
    REFERENCES mydb.CLIENTE (DNI)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_COMPRA_PRODUCTO1
    FOREIGN KEY (PRODUCTO_Código_producto)
    REFERENCES mydb.PRODUCTO (Código_producto)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_COMPRA_EMPLEADO1
    FOREIGN KEY (EMPLEADO_DNI)
    REFERENCES mydb.EMPLEADO (DNI)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table mydb.UBICA
-- -----------------------------------------------------
DROP TABLE IF EXISTS mydb.UBICA ;

CREATE TABLE IF NOT EXISTS mydb.UBICA (
  ZONA_Nombre VARCHAR(45) NULL,
  ZONA_VIVERO_Coordenadas VARCHAR(100) NULL,
  PRODUCTO_Código_producto INT NULL,
  CONSTRAINT fk_UBICA_ZONA1
    FOREIGN KEY (ZONA_Nombre , ZONA_VIVERO_Coordenadas)
    REFERENCES mydb.ZONA (Nombre , VIVERO_Coordenadas)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_UBICA_PRODUCTO1
    FOREIGN KEY (PRODUCTO_Código_producto)
    REFERENCES mydb.PRODUCTO (Código_producto)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


CREATE OR REPLACE FUNCTION crear_email() RETURNS TRIGGER AS $example_table$
   BEGIN
      -- SI EL CORREO PARA LA ENTRADA INSERT CLIENTE ESTÁ VACIO
      IF NEW.Correo IS NULL THEN
        INSERT INTO CLIENTE(Correo) VALUES (CONCAT(NEW.Nombre, NEW.Apellidos, '@viverostenerife.com');
        -- GENERAR EMAIL NUEVO E INSERTAR TODO JUNTO
      END IF;
      
      RETURN NEW;

   END;
$example_table$ LANGUAGE plpgsql;


CREATE TRIGGER example_trigger BEFORE INSERT ON CLIENTE
FOR EACH ROW EXECUTE PROCEDURE crear_email();

-- -----------------------------------------------------
-- Data for table mydb.VIVERO
-- -----------------------------------------------------
BEGIN;
INSERT INTO mydb.VIVERO (Coordenadas, Localidad) VALUES ('28º 27 46 N 16º 18 22 W', 'La Laguna');
INSERT INTO mydb.VIVERO (Coordenadas, Localidad) VALUES ('28º 23 43 N 16º 32 50 W', 'La Orotava');
COMMIT;


-- -----------------------------------------------------
-- Data for table mydb.CLIENTE
-- -----------------------------------------------------
BEGIN;
INSERT INTO mydb.CLIENTE (DNI, Bonificación, Total_mensual, Fecha_ingreso) VALUES ('33333333C', NULL, NULL, NULL);
INSERT INTO mydb.CLIENTE (DNI, Bonificación, Total_mensual, Fecha_ingreso) VALUES ('44444444D', NULL, NULL, NULL);
COMMIT;


-- -----------------------------------------------------
-- Data for table mydb.ZONA
-- -----------------------------------------------------
BEGIN;
INSERT INTO mydb.ZONA (Nombre, VIVERO_Coordenadas) VALUES ('Caja', '28º 27 46 N 16º 18 22 W');
INSERT INTO mydb.ZONA (Nombre, VIVERO_Coordenadas) VALUES ('Caja', '28º 23 43 N 16º 32 50 W');
INSERT INTO mydb.ZONA (Nombre, VIVERO_Coordenadas) VALUES ('Almacén', '28º 27 46 N 16º 18 22 W');
INSERT INTO mydb.ZONA (Nombre, VIVERO_Coordenadas) VALUES ('Almacén', '28º 23 43 N 16º 32 50 W');
COMMIT;


-- -----------------------------------------------------
-- Data for table mydb.EMPLEADO
-- -----------------------------------------------------
BEGIN;
INSERT INTO mydb.EMPLEADO (DNI, ZONA_Nombre, ZONA_VIVERO_Coordenadas, Antigüedad, Sueldo, CSS, Fecha_ini, Fecha_fin, Ventas) VALUES ('11111111A', 'Caja', '28º 27 46 N 16º 18 22 W', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO mydb.EMPLEADO (DNI, ZONA_Nombre, ZONA_VIVERO_Coordenadas, Antigüedad, Sueldo, CSS, Fecha_ini, Fecha_fin, Ventas) VALUES ('22222222B', 'Almacén', '28º 23 43 N 16º 32 50 W', NULL, NULL, NULL, NULL, NULL, NULL);
COMMIT;


-- -----------------------------------------------------
-- Data for table mydb.PRODUCTO
-- -----------------------------------------------------
BEGIN;
INSERT INTO mydb.PRODUCTO (Código_producto, Precio, Stock) VALUES (001, 10.00, 3);
INSERT INTO mydb.PRODUCTO (Código_producto, Precio, Stock) VALUES (002, 7.25, 5);
COMMIT;


-- -----------------------------------------------------
-- Data for table mydb.COMPRA
-- -----------------------------------------------------
BEGIN;
INSERT INTO mydb.COMPRA (Fecha, CLIENTE_DNI, PRODUCTO_Código_producto, EMPLEADO_DNI, Cantidad) VALUES ('2021-12-01', '33333333C', 001, '11111111A', NULL);
INSERT INTO mydb.COMPRA (Fecha, CLIENTE_DNI, PRODUCTO_Código_producto, EMPLEADO_DNI, Cantidad) VALUES ('2021-11-24', '44444444D', 002, '22222222B', NULL);
COMMIT;


-- -----------------------------------------------------
-- Data for table mydb.UBICA
-- -----------------------------------------------------
BEGIN;
INSERT INTO mydb.UBICA (ZONA_Nombre, ZONA_VIVERO_Coordenadas, PRODUCTO_Código_producto) VALUES ('Almacén', '28º 27 46 N 16º 18 22 W', 001);
INSERT INTO mydb.UBICA (ZONA_Nombre, ZONA_VIVERO_Coordenadas, PRODUCTO_Código_producto) VALUES ('Almacén', '28º 23 43 N 16º 32 50 W', 001);
INSERT INTO mydb.UBICA (ZONA_Nombre, ZONA_VIVERO_Coordenadas, PRODUCTO_Código_producto) VALUES ('Caja', '28º 27 46 N 16º 18 22 W', 002);
INSERT INTO mydb.UBICA (ZONA_Nombre, ZONA_VIVERO_Coordenadas, PRODUCTO_Código_producto) VALUES ('Caja', '28º 23 43 N 16º 32 50 W', 002);
COMMIT;
