-- SHOW databases;

-- CREATE DATABASE MajulahMunchies;

-- USE MajulahMunchies;

-- CREATE TABLE users(
--     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
--     firstname VARCHAR(255) NOT NULL,
--     email VARCHAR(255) NOT NULL,
--     pwd VARCHAR(255) NOT NULL,
--     homeaddress VARCHAR(255) NOT NULL
-- );

-- CREATE TABLE menus (
--     item_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     foodname VARCHAR(255) NOT NULL,
--     cuisine VARCHAR(255) NOT NULL,
--     category_course VARCHAR(255) NOT NULL,
--     category_food VARCHAR(255) NOT NULL,
--     food_description VARCHAR(255) NOT NULL,
--     price DECIMAL(10,2) NOT NULL,
--     image_data MEDIUMBLOB NOT NULL

-- );


-- CREATE TABLE Orders (
--     OrderID INT AUTO_INCREMENT PRIMARY KEY,
--     UserID INT NOT NULL,
--     HomeAddress VARCHAR(255) NOT NULL ,
--     OrderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP

-- );

-- CREATE TABLE OrderDetails (
--     OrderDetail_ID INT AUTO_INCREMENT PRIMARY KEY,
--     OrderID INT,
--     FoodName VARCHAR(255),
--     Quantity INT,
--     TotalPrice DECIMAL(10,2),
--     FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
-- );

