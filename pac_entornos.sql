-- Creación de la tabla User
CREATE TABLE User (
    UserID int PRIMARY KEY AUTO_INCREMENT,
    Name varchar(50) NOT NULL,
    Email varchar(100) NOT NULL,
    FullName varchar(100) NOT NULL,
    Password varchar(255) NOT NULL,
    Type varchar(20) NOT NULL,
    Enabled bit NOT NULL,
    AdminLevel int NOT NULL,
    CONSTRAINT FK_User_Category FOREIGN KEY (AdminLevel) REFERENCES Category(CategoryID)
);

-- Creación de la tabla Category
CREATE TABLE Category (
CategoryID int PRIMARY KEY,
Name varchar(50) NOT NULL
);

-- Creación de la tabla Product
CREATE TABLE Product (
ProductID int PRIMARY KEY,
Name varchar(50) NOT NULL,
Cost decimal(10,2) NOT NULL,
Price decimal(10,2) NOT NULL,
CategoryID int NOT NULL,
FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID)
);

-- Creación de la tabla Setup
CREATE TABLE Setup (
Authentication bit NOT NULL,
SuperAdmin int NOT NULL
);