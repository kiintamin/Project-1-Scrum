CREATE database `inloggegevens`;
USE `inloggegevens`;

CREATE TABLE `users` (
	id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);
-- creat a datebase for todolist
CREATE TABLE `todolist` (
	id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    todolist VARCHAR(250) NOT NULL
);
