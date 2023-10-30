use MOVIE;

-- CREATE TABLE users(
--     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT ,
--     firstname VARCHAR(255) NOT NULL,
--     email VARCHAR(255) NOT NULL,
--     pwd VARCHAR(255) NOT NULL,
--     homeaddress VARCHAR(255) NOT NULL
-- );




-- create Table Movie(
--     MovieID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     MovieName varchar(255) NOT NULL,
--     MovieGenre varchar(255) NOT NULL,
--     MovieDescription varchar(255) NOT NULL,
--     MovieImage MEDIUMBLOB NOT NULL
-- );


-- CREATE TABLE menus (
--     item_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     foodname VARCHAR(255) NOT NULL,
--     cuisine VARCHAR(255) NOT NULL,
--     food_description VARCHAR(255) NOT NULL,
--     price DECIMAL(10,2) NOT NULL,
--     image_data MEDIUMBLOB NOT NULL

-- );

-- create table Checkout (
--     CheckoutID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
--     UserID int NOT NULL,
--     HomeAddress varchar(255) NOT NULL,
--     OrderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (UserID) REFERENCES users(id)
-- );

CREATE TABLE Seats (
    SeatID int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    MovieID int NOT NULL,
    SeatNumber varchar(3) NOT NULL, -- e.g., "A1", "A2", ... "F8"
    IsBooked boolean DEFAULT FALSE, 
    FOREIGN KEY (MovieID) REFERENCES Movie(MovieID)
);