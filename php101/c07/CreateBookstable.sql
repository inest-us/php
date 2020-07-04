CREATE TABLE `inest_stg_db`.`Books` (
  `ISBN` VARCHAR(13) NOT NULL,
  `Author` VARCHAR(100) NULL,
  `Title` VARCHAR(250) NULL,
  `Price` FLOAT NULL,
  PRIMARY KEY (`ISBN`));