CREATE DATABASE projecttwo;

CREATE TABLE users(
	user_id int(11) NOT NULL PRIMARY KEY AUTOINCREMENT,
	user_name VARCHAR(255),
	user_email VARCHAR(255)
);