CREATE TABLE `inest_stg_db`.`Orders` (
  `OrderID` INT NOT NULL AUTO_INCREMENT,
  `CustomerID` INT NULL,
  `Amount` FLOAT NULL,
  `Date` DATETIME NULL,
  PRIMARY KEY (`OrderID`));