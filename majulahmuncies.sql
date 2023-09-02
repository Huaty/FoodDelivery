
CREATE DATABASE MajulahMunchies;
USE MajulahMunchies;

CREATE TABLE users(
    user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    home_address VARCHAR(255) NOT NULL

);

CREATE TABLE menu (
    item_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    foodname VARCHAR(255) NOT NULL,
    food_description VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,

)


CREATE TABLE order(
    order_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    FOREIGN KEY (user_id) REFERENCES user(user_id),
    FOREIGN KEY (item_id) REFERENCES menu(item_id),
    order_date DATE NOT NULL,
    quantity INT NOT NULL,

)

