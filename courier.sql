-- Create the database
CREATE DATABASE courier_system;

-- Switch to the created database
USE courier_system;

-- Create the table for senders
CREATE TABLE senders (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(50) NOT NULL,
  address VARCHAR(100) NOT NULL
);

-- Create the table for receivers
CREATE TABLE receivers (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(50) NOT NULL,
  address VARCHAR(100) NOT NULL
);

-- Create the table for couriers
CREATE TABLE couriers (
  id INT PRIMARY KEY AUTO_INCREMENT,
  sender_id INT NOT NULL,
  receiver_id INT NOT NULL,
  description VARCHAR(100) NOT NULL,
  weight DECIMAL(5,2) NOT NULL,
  status ENUM('Pending', 'In Transit', 'Delivered') NOT NULL,
  delivery_date DATE,
  FOREIGN KEY (sender_id) REFERENCES senders(id),
  FOREIGN KEY (receiver_id) REFERENCES receivers(id)
);

-- Create the table for admins
CREATE TABLE admins (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,
  name VARCHAR(50) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(50) NOT NULL
);

-- Create the table for tracking
CREATE TABLE tracking (
  id INT PRIMARY KEY AUTO_INCREMENT,
  courier_id INT NOT NULL,
  statuss ENUM('Pending', 'In Transit', 'Delivered') NOT NULL,
  location VARCHAR(100) NOT NULL,
  date_time DATETIME,
  FOREIGN KEY (courier_id) REFERENCES couriers(id),
  FOREIGN key (statuss) REFERENCES couriers(status)
);

