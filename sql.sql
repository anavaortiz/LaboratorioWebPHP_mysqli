CREATE DATABASE LabWeb;

USE LabWeb;

CREATE TABLE Pizza(
IdCliente int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
NombrePizza nvarchar(50) NOT NULL, 
Ingredientes nvarchar(255) NOT NULL, 
Email nvarchar(50) NULL, 
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO Pizza (IdCliente, NombrePizza, Ingredientes, Email, created_at)
VALUES (1, 
'LabWeb Especial', 
'Salami, queso extra, salchicha, chorizo, jalapeño, champiñones', 
'labweb@labweb.edu', 
'2021-04-23'
);
