
-- -----------------------------------------------------
-- Schema app-tienda
-- -----------------------------------------------------
DROP DATABASE `app-tienda`;
CREATE DATABASE IF NOT EXISTS `app-tienda` DEFAULT CHARACTER SET utf8 ;
USE `app-tienda` ;

-- -----------------------------------------------------
-- Table `app-tienda`.`PRODUCTS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `app-tienda`.`PRODUCTS` ;

CREATE TABLE IF NOT EXISTS `app-tienda`.`PRODUCTS` (
  `ID` INT(10) NOT NULL AUTO_INCREMENT,
  `nameItem` VARCHAR(45) NOT NULL UNIQUE,
  `family` VARCHAR(45) NULL,
  `descr` VARCHAR(1000) NULL,
  `stock` INT(5) NOT NULL,
  `size` DECIMAL(10,2) NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `weight` DECIMAL(10,2) NULL,
  PRIMARY KEY (`ID`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `app-tienda`.`CLIENTS`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `app-tienda`.`CLIENTS` ;

CREATE TABLE IF NOT EXISTS `app-tienda`.`CLIENTS` (
  `email` VARCHAR(45) NOT NULL,
  `DNI` VARCHAR(9) NOT NULL,
  `pc` VARCHAR(45) NULL,
  `tlf` INT(9) NULL,
  `nameClient` VARCHAR(45) NULL,
  `surname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE INDEX `DNI_UNIQUE` (`DNI` ASC) VISIBLE,
  UNIQUE INDEX `tlf_UNIQUE` (`tlf` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `app-tienda`.`PURCHASES`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `app-tienda`.`PURCHASES` ;

CREATE TABLE IF NOT EXISTS `app-tienda`.`PURCHASES` (
  `IDPurchase` INT(10) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(60) NOT NULL,
  `IDProduct` INT(10) NOT NULL,
  `amount` INT(3) NOT NULL,
  `totalPrice` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`IDPurchase`),
  INDEX `email_idx` (`email` ASC) VISIBLE,
  INDEX `IDProduct_idx` (`IDProduct` ASC) VISIBLE,
  CONSTRAINT `email`
    FOREIGN KEY (`email`)
    REFERENCES `app-tienda`.`CLIENTS` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `IDProduct`
    FOREIGN KEY (`IDProduct`)
    REFERENCES `app-tienda`.`PRODUCTS` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Data for table `app-tienda`.`PRODUCTS`
-- -----------------------------------------------------

INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'iPhone 13 Pro Max', 'Movil', NULL, 56, 45.57, 1000.43, 48);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'Samsung Galaxy S21 Ultra', 'Movil', NULL, 35, 65.2, 740.54, 62);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'OnePlus 9 Pro', 'Movil', NULL, 37, 32, 230.67, 59);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'iPhone 13 Pro', 'Movil', NULL, 25, 43.4, 560.99, 127);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'Google Pixel 6', 'Movil', NULL, 84, 65.4, 790.99, 84);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'OPPO Reno6 Pro 5G', 'Movil', NULL, 52, 35.3, 390.14, 837);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'LG 24MT49S-PZ', 'Televisor', NULL, 31, 194.5, 1500.56, 72);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'CHiQ Televisor Smart TV LED 40″', 'Televisor', NULL, 64, 287.5, 1030.67, 74);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'Xiaomi Mi LED TV 4S', 'Televisor', NULL, 53, 132.4, 900.89, 93);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'Samsung Crystal UHD 2020 43TU7095', 'Televisor', NULL, 31, 185.5, 1800.32, 92);
INSERT INTO `app-tienda`.`PRODUCTS` (`ID`, `nameItem`, `family`, `descr`, `stock`, `size`, `price`, `weight`) VALUES (DEFAULT, 'Hisense 58AE7000F', 'Televisor', NULL, 64, 195.9, 2300.09, 184);



-- -----------------------------------------------------
-- Data for table `app-tienda`.`CLIENTS`
-- -----------------------------------------------------
INSERT INTO `app-tienda`.`CLIENTS` (`email`, `DNI`, `pc`, `tlf`, `nameClient`, `surname`) VALUES ('paco@gmail.com', '39471554Y', '38111', 933761861 , 'Paco', 'Gómez');
INSERT INTO `app-tienda`.`CLIENTS` (`email`, `DNI`, `pc`, `tlf`, `nameClient`, `surname`) VALUES ('luis@gmail.com', '17483946B', '38111', 342518741 , 'Luis', 'Martínez');
INSERT INTO `app-tienda`.`CLIENTS` (`email`, `DNI`, `pc`, `tlf`, `nameClient`, `surname`) VALUES ('maria@gmail.com', '18462946N', '38108', 776689201 , 'María', 'González');
INSERT INTO `app-tienda`.`CLIENTS` (`email`, `DNI`, `pc`, `tlf`, `nameClient`, `surname`) VALUES ('luisa@gmail.com', '94738451M', '38205', 610566954 , 'Luisa', 'Pérez');
INSERT INTO `app-tienda`.`CLIENTS` (`email`, `DNI`, `pc`, `tlf`, `nameClient`, `surname`) VALUES ('alfonso@gmail.com', '18360573A', '38296', 315643231 , 'Alfonso', 'Muñoz');
INSERT INTO `app-tienda`.`CLIENTS` (`email`, `DNI`, `pc`, `tlf`, `nameClient`, `surname`) VALUES ('laura@gmail.com', '17462837T', '38108', 327426095 , 'Laura', 'Medina');


