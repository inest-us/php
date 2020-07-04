CREATE TABLE `inest_stg_db`.`Order_Items` (
  `OrderID` INT NOT NULL,
  `ISBN` VARCHAR(13) NOT NULL,
  `Quantity` INT NULL,
  PRIMARY KEY (`OrderID`, `ISBN`));