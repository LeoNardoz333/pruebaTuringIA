CREATE USER 'userTuring'@'localhost' IDENTIFIED BY 'turingIA123';
GRANT ALL PRIVILEGES ON localComida.* TO 'userTuring'@'localhost';
create database localComida;
use localComida;