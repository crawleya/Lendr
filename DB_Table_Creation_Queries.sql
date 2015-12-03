-- MySQL Table Creation Queries
-- CS 361 Project B
-- Lendr

-- DROP TABLES if already existing
DROP TABLE IF EXISTS `Item`;
DROP TABLE IF EXISTS `User_to_Group`;
DROP TABLE IF EXISTS `User`;
DROP TABLE IF EXISTS `Group`;

-- 'User' Creation Query
-- Create 'User' Table first because 'Item' and 'User_to_Group' Table both reference it with a foreign key
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB;

-- 'Group' Table Creation Query
-- Create 'Group' Table next because 'User_to_Group' Table references it with foreign key
CREATE TABLE `Group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE,
  PRIMARY KEY(`id`)
) ENGINE=InnoDB;

-- 'Item' Table Creation Query
CREATE TABLE `Item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  PRIMARY KEY(`id`),
  FOREIGN KEY(`owner_id`) REFERENCES `User`(`id`)
) ENGINE=InnoDB;

-- 'User_to_Group' Table Creation Query
CREATE TABLE `User_to_Group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY(`user_id`, `group_id`),
  FOREIGN KEY(`user_id`) REFERENCES `User`(`id`),
  FOREIGN KEY(`group_id`) REFERENCES `Group`(`id`)
) ENGINE=InnoDB;