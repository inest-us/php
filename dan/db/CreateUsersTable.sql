CREATE TABLE `users`
(
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`username` VARCHAR
( 255 ) NOT NULL ,
`email` VARCHAR
( 255 ) NOT NULL ,
`password` VARCHAR
( 8 ) NOT NULL ,
`status` ENUM
( 'active', 'inactive' ) NOT NULL
) ENGINE = MYISAM ;