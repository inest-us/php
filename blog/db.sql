CREATE TABLE `sampledb`.`blog_posts` (
  `postID` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `postTitle` VARCHAR(255) NULL,
  `postDesc` MEDIUMTEXT NULL,
  `postContent` LONGTEXT NULL,
  `postDate` DATETIME NULL,
  PRIMARY KEY (`postID`));

CREATE TABLE `sampledb`.`blog_members` (
  `memberID` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  PRIMARY KEY (`memberID`));

insert into blog_posts(postTitle, postDesc, postContent, postDate)
values
('post 1', 'test post number 1', 'this is my test post.', '2017-07-08');

insert into blog_members(username, password, email) 
values
('user1', 'password1', 'user1@ebay.com')