CREATE USER 'userTuring'@'localhost' IDENTIFIED BY 'turingIA123';
GRANT ALL PRIVILEGES ON localComida.* TO 'userTuring'@'localhost';
create database localComida;
use localComida;

/*la contraseña es: turingIA123*/
insert into users (nombre, email, password, permisos, created_at, updated_at) values
('admin', 'admin@turingIA.com', '$2y$12$aDZzbMokfQMSW0YZY74RD.JkW2oLK3p/pdWR.371EKG77qpGTyqK6', 
'admin', now(), now());
