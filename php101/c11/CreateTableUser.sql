CREATE TABLE `inest_stg_db`.`authorized_users` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`Id`));