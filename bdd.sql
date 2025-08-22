CREATE DATABASE evalphp2025 CHARSET utf8mb4;
USE evalphp2025;

CREATE TABLE users(
id_users INT PRIMARY KEY AUTO_INCREMENT,
firstname VARCHAR(50) NOT NULL ,
lastname VARCHAR(50) NOT NULL,
email VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(100) NOT NULL 
)ENGINE=innoDB;

CREATE TABLE category(
id_category INT PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(50) NOT NULL UNIQUE
)ENGINE=innoDB;

CREATE TABLE book(
id_book INT PRIMARY KEY AUTO_INCREMENT,
title VARCHAR(50) NOT NULL ,
description TEXT,
publication_date DATETIME NOT NULL,
author VARCHAR(50) NOT NULL,
id_category INT NOT NULL,
id_users INT NOT NULL,
FOREIGN KEY (id_category) REFERENCES category(id_category),
FOREIGN KEY (id_users) REFERENCES users(id_users) 
)ENGINE=innoDB;

ALTER TABLE book
MODIFY publication_date DATE;


