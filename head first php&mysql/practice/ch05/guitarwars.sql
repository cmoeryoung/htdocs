CREATE DATABASE gwdb;
USE gwdb;
CREATE TABLE 'guitarwars'(
  'id' INT NOT NULL AUTO_INCREMENT ,
  'date' TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
  'name' VARCHAR (32),
  'score' INT,
  PRIMARY KEY ('id'),
  KEY 'name' ('name')
);