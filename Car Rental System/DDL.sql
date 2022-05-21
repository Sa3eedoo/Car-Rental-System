drop database if exists car_rental_system;

create database car_rental_system;

use car_rental_system;

CREATE TABLE customer (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    license_id VARCHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL,
    pnumber INT(11) NOT NULL,
    CONSTRAINT unique_license_id UNIQUE (license_id),
    CONSTRAINT unique_customer_email UNIQUE (email),
    CONSTRAINT unique_pnumber UNIQUE (pnumber)
);

CREATE TABLE car (
    car_id INT AUTO_INCREMENT,
    plate_id VARCHAR(10) UNIQUE,
    model VARCHAR(20) NOT NULL,
    city VARCHAR(20) NOT NULL,
    country VARCHAR(20) NOT NULL,
    color VARCHAR(20) NOT NULL,
    `year` YEAR NOT NULL,
    cost_per_day FLOAT NOT NULL,
    `status` ENUM('Active', 'Out of service') NOT NULL,
    CONSTRAINT unique_plate_id UNIQUE (plate_id),
    PRIMARY KEY (car_id)
);

CREATE TABLE reservation (
    customer_id INT,
    car_id INT,
    pick_up_date DATE,
    return_date DATE,
    paid ENUM('yes', 'no') NOT NULL,
    PRIMARY KEY (customer_id, car_id, pick_up_date),
    FOREIGN KEY (customer_id) REFERENCES customer (customer_id),
    FOREIGN KEY (car_id) REFERENCES car (car_id)
);

CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    CONSTRAINT unique_admin_email UNIQUE (email)
);

CREATE VIEW reservation_info AS
SELECT
    plate_id,
    model,
    `year`,
    color,
    country,
    city,
    pick_up_date,
    return_date,
    DATEDIFF(return_date, pick_up_date) AS Rental_Duration,
    DATEDIFF(return_date, pick_up_date) * cost_per_day AS COST
FROM
    car NATURAL JOIN reservation;