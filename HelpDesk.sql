CREATE DATABASE HelpDesk;

USE HelpDesk;

CREATE TABLE Queries (
    query_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    department VARCHAR(50),
    query_type ENUM('Social Media', 'Websites', 'PhotoVideography'),
    image_video VARCHAR(255) DEFAULT NULL,
    website_link VARCHAR(255) DEFAULT NULL,
    description TEXT,
    create_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('open', 'resolved') DEFAULT 'open'
);

CREATE TABLE Admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(255),
    admin_type ENUM('Super Admin', 'Social Media Admin', 'Websites Admin', 'PhotoVideography Admin')
);
