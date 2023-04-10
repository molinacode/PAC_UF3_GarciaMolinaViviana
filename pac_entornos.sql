-- Creación de la tabla Category
CREATE TABLE Category (
CategoryID int PRIMARY KEY,
Name varchar(50) NOT NULL
);

-- Creación de la tabla User
CREATE TABLE User (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    FullName VARCHAR(100) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Type VARCHAR(20) NOT NULL,
    Enabled BIT NOT NULL,
    AdminLevel INT NOT NULL,
    CONSTRAINT FK_User_Category FOREIGN KEY (AdminLevel)
        REFERENCES Category (CategoryID)
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
