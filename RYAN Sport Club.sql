CREATE DATABASE RYAN_SPORT_CLUB;

USE RYAN_SPORT_CLUB;

CREATE TABLE Service(
	ServiceID INT AUTO_INCREMENT PRIMARY KEY,
	Famous_Players VARCHAR(225) NOT NULL,
	Name VARCHAR(225) NOT NULL, 
	Rules TEXT NOT NULL,
	Time FLOAT NOT NULL,
	CategoryID INT,
	FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID) ON DELETE SET NULL
);

DELETE FROM service WHERE ServiceID = '1';

INSERT INTO service(Famous_Players, Name, Rules, Time, CategoryID)
VALUES ("afsda", "Tennis", "alfjlas", 30.0, 1);

DROP TABLE Sports;

CREATE TABLE Categories(
	CategoryID INT AUTO_INCREMENT PRIMARY KEY,
	Name VARCHAR(255) NOT null
);

INSERT INTO categories(Name)
VALUES	("Indoor Sport"),
 			("Outdoor Sport"),
 			("Recreation");
 			
 			
INSERT INTO categories(CategoryID, Name)
VALUES (1, 'Indoor Sport'),
			(2, 'Outdoor Sport');

DROP TABLE Categories;

CREATE TABLE pictures(
	PictureID INT AUTO_INCREMENT PRIMARY KEY,
	Name VARCHAR(255) NOT NULL,
	URL TEXT NOT NULL,
	ServiceID INT,
	FOREIGN KEY (ServiceID) REFERENCES service(ServiceID) ON DELETE SET NULL;
);

INSERT INTO pictures (Name, URL, ServiceID)
VALUES ("afda", "alkfa", 1);

DROP TABLE pictures;

create table admin(
	username varchar(255) primary KEY not NULL ,
	password char(40) not null,
	fullname varchar(255) not null,
	phone char(11) not null,
	email varchar(255) not NULL,
	pass VARCHAR(255) NOT NULL
);


INSERT INTO admin (userName, password, fullName, phone, email,pass)
VALUES("afafa", "adsfa", "afaf", 131341324, "afdwefas","asaa");

drop table admin;