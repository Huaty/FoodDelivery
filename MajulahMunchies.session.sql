CREATE DATABASE MajulahMunchies;

USE MajulahMunchies;

CREATE TABLE users(
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
    -- Must be interger number, not null, cannot be blank, primary key for unique key, auto_increament : plus one to user id
    firstname VARCHAR(255) NOT NULL,
    -- can be what ever interget but cannot be null
    email VARCHAR(255) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    homeaddress VARCHAR(255) NOT NULL
);

CREATE TABLE menus (
    item_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    foodname VARCHAR(255) NOT NULL,
    food_description VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL

);


CREATE TABLE orders (
    order_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    item_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    -- copy foreign key, user id to put in this order 
    FOREIGN KEY (item_id) REFERENCES menus(item_id),
    order_date DATE NOT NULL,
    quantity INT NOT NULL

);

